<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\UploadedFile;
use Mostafaznv\PdfOptimizer\Events\PdfOptimizerJobFinished;
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Illuminate\Support\Facades\Storage;
use Mostafaznv\PdfOptimizer\Tests\TestSupport\JobTestLogger;
use Illuminate\Support\Facades\DB;


beforeEach(function () {
    Storage::fake('s3');
    Storage::fake('local');
    Event::fake(PdfOptimizerJobFinished::class);

    config()->set('pdf-optimizer.queue.enabled', true);

    $pdfPath = pdf();
    $this->input = $pdfPath;
    $this->outputRealPath = output();
    $this->file = new UploadedFile($pdfPath, 'test.pdf', 'application/pdf', null, true);

    Storage::disk('s3')->put('input.pdf', file_get_contents($pdfPath));
    Storage::disk('local')->put('input.pdf', file_get_contents($pdfPath));

    @unlink($this->output);
});


test('will process optimization through queue', function () {
    Bus::fake();

    expect(file_exists($this->outputRealPath))->toBeFalse();

    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->optimize($this->outputRealPath);


    expect($res->status)
        ->toBeTrue()
        ->and($res->isQueued)
        ->toBeTrue()
        ->and($res->queueId)
        ->toBeUuid()
        ->and(file_exists($this->outputRealPath))
        ->toBeFalse();
});

test('will process optimization through queue using onQueue method', function () {
    config()->set('pdf-optimizer.queue.enabled', false);

    Bus::fake();

    expect(file_exists($this->outputRealPath))->toBeFalse();

    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->onQueue()
        ->optimize($this->outputRealPath);


    expect($res->status)
        ->toBeTrue()
        ->and($res->isQueued)
        ->toBeTrue()
        ->and($res->queueId)
        ->toBeUuid()
        ->and(file_exists($this->outputRealPath))
        ->toBeFalse();
});

test('will fire finished event', function () {
    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->onQueue()
        ->optimize($this->outputRealPath);

    Event::assertNotDispatched(PdfOptimizerJobFinished::class);

    Artisan::call('queue:work --once');

    Event::assertDispatched(function (PdfOptimizerJobFinished $event) use ($res) {
        expect($event->id)
            ->toBe($res->queueId)
            ->and($event->status)
            ->toBeTrue()
            ->and($event->message)
            ->toBeString();

        return true;
    });
});

test('can log events', function () {
    $disk = 'local';
    $logPath = 'input.txt';

    PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->logger(new JobTestLogger($disk, $logPath))
        ->optimize($this->outputRealPath);

    $file = Storage::disk($disk)->get($logPath);
    expect($file)->toBeNull();

    Artisan::call('queue:work --once');

    $file = Storage::disk($disk)->get($logPath);
    $logs = explode("\n", $file);

    expect($logs)
        ->toHaveCount(8)
        ->and($logs[2])
        ->toContain('Input: ')
        ->and($logs[3])
        ->toContain('Output: ')
        ->and($logs[6])
        ->toContain('Process successfully ended');
});

test('will fail', function () {
    $disk = 'local';
    $logPath = 'input.txt';

    PdfOptimizer::open('invalid-file.pdf')
        ->setGsBinary('corrupted-gs')
        ->logger(new JobTestLogger($disk, $logPath))
        ->optimize($this->outputRealPath);

    $jobs = DB::table('jobs')->count();
    expect($jobs)->toBe(1);

    Artisan::call('queue:work --once');

    $file = Storage::disk($disk)->get($logPath);
    $logs = explode("\n", $file);

    expect($logs)->toContain('Job finished with error.');
});


# remote
test('remote -> local-path', function () {
    expect(file_exists($this->outputRealPath))->toBeFalse();

    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->optimize($this->outputRealPath);

    expect($res->isQueued)
        ->toBeTrue()
        ->and(file_exists($this->outputRealPath))
        ->toBeFalse();

    Artisan::call('queue:work --once');

    expect(file_exists($this->outputRealPath))->toBeTrue();
});

test('remote -> disk(local)', function () {
    $disk = 'local';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();
    expect($res->isQueued)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1);

    Artisan::call('queue:work --once');

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(2)->toContain($output);
});

test('remote -> disk(remote)', function () {
    $disk = 's3';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();
    expect($res->isQueued)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1);

    Artisan::call('queue:work --once');

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(2)->toContain($output);
});

# local to local-path
test('path -> local-path', function () {
    expect(file_exists($this->outputRealPath))->toBeFalse();

    $res = PdfOptimizer::open($this->input)->optimize($this->outputRealPath);

    expect($res->isQueued)
        ->toBeTrue()
        ->and(file_exists($this->outputRealPath))
        ->toBeFalse();

    Artisan::call('queue:work --once');

    expect(file_exists($this->outputRealPath))->toBeTrue();
});

test('uploaded-file -> local-path', function () {
    $res = PdfOptimizer::open($this->file)->optimize($this->outputRealPath);

    expect($res->isQueued)
        ->toBeTrue()
        ->and(file_exists($this->outputRealPath))
        ->toBeFalse();

    Artisan::call('queue:work --once');

    expect(file_exists($this->outputRealPath))->toBeTrue();
});

test('disk(local) -> local-path', function () {
    expect(file_exists($this->outputRealPath))->toBeFalse();

    $res = PdfOptimizer::fromDisk('local')
        ->open('input.pdf')
        ->optimize($this->outputRealPath);

    expect($res->isQueued)
        ->toBeTrue()
        ->and(file_exists($this->outputRealPath))
        ->toBeFalse();

    Artisan::call('queue:work --once');

    expect(file_exists($this->outputRealPath))->toBeTrue();
});

# local to local-disk
test('path -> disk(local)', function () {
    $disk = 'local';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::open($this->input)
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();

    expect($res->isQueued)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1)
        ->not->toContain($output);

    Artisan::call('queue:work --once');

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(2)->toContain($output);
});

test('uploaded-file -> disk(local)', function () {
    $disk = 'local';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::open($this->file)
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();
    expect($res->status)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1)
        ->not->toContain($output);

    Artisan::call('queue:work --once');

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(2)->toContain($output);
});

test('disk(local) -> disk(local)', function () {
    $disk = 'local';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::fromDisk('local')
        ->open('input.pdf')
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();
    expect($res->isQueued)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1)
        ->not->toContain($output);

    Artisan::call('queue:work --once');

    $files = Storage::disk($disk)->allFiles();
    expect($files)
        ->toHaveCount(2)
        ->toContain($output);
});

# local to remote-disk
test('path -> disk(remote)', function () {
    $disk = 's3';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)
        ->toHaveCount(1)
        ->toContain('input.pdf');

    $res = PdfOptimizer::open($this->input)
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();
    expect($res->isQueued)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1)
        ->not->toContain($output);

    Artisan::call('queue:work --once');

    $files = Storage::disk($disk)->allFiles();
    expect($files)
        ->toHaveCount(2)
        ->toContain($output);
});

test('uploaded-file -> disk(remote)', function () {
    $disk = 's3';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::open($this->file)
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();
    expect($res->isQueued)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1)
        ->not->toContain($output);

    Artisan::call('queue:work --once');

    $files = Storage::disk($disk)->allFiles();
    expect($files)
        ->toHaveCount(2)
        ->toContain($output);
});

test('disk(local) -> disk(remote)', function () {
    $disk = 's3';
    $output = 'output.pdf';

    $localFiles = Storage::disk('local')->allFiles();
    $remoteFiles = Storage::disk($disk)->allFiles();

    expect($localFiles)
        ->toHaveCount(1)
        ->and($remoteFiles)
        ->toHaveCount(1);

    $res = PdfOptimizer::fromDisk('local')
        ->open('input.pdf')
        ->toDisk($disk)
        ->optimize($output);

    $localFiles = Storage::disk('local')->allFiles();
    $remoteFiles = Storage::disk($disk)->allFiles();

    expect($res->isQueued)
        ->toBeTrue()
        ->and($localFiles)
        ->toHaveCount(1)
        ->and($remoteFiles)
        ->toHaveCount(1)
        ->not->toContain($output);

    Artisan::call('queue:work --once');

    $localFiles = Storage::disk('local')->allFiles();
    $remoteFiles = Storage::disk($disk)->allFiles();

    expect($localFiles)
        ->toHaveCount(1)
        ->and($remoteFiles)
        ->toHaveCount(2)
        ->toContain($output);
});
