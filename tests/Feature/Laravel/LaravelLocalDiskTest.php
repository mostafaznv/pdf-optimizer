<?php

use Illuminate\Http\UploadedFile;
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Illuminate\Support\Facades\Storage;


beforeEach(function () {
    Storage::fake('s3');
    Storage::fake('local');

    $this->input = pdf();
    $this->output = output();
    $this->file = new UploadedFile($this->input, 'test.pdf', 'application/pdf', null, true);

    Storage::disk('local')->put('input.pdf', file_get_contents($this->input));
    Storage::disk('s3')->put('input.pdf', file_get_contents($this->input));

    @unlink($this->output);
});


# to local-path
test('path -> local-path', function () {
    expect(file_exists($this->output))->toBeFalse();

    $res = PdfOptimizer::open($this->input)->optimize($this->output);

    expect($res->status)
        ->toBeTrue()
        ->and(file_exists($this->output))
        ->toBeTrue();
});

test('uploaded-file -> local-path', function () {
    $res = PdfOptimizer::open($this->file)->optimize($this->output);

    expect($res->status)
        ->toBeTrue()
        ->and(file_exists($this->output))
        ->toBeTrue();
});

test('disk -> local-path', function () {
    expect(file_exists($this->output))->toBeFalse();

    $res = PdfOptimizer::fromDisk('local')
        ->open('input.pdf')
        ->optimize($this->output);

    expect($res->status)
        ->toBeTrue()
        ->and(file_exists($this->output))
        ->toBeTrue();
});

# to local-disk
test('path -> disk(local)', function () {
    $disk = 'local';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::open($this->input)
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();

    expect($res->status)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(2)
        ->toContain($output);
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
        ->toHaveCount(2)
        ->toContain($output);
});

test('disk -> disk(local)', function () {
    $disk = 'local';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(1);

    $res = PdfOptimizer::fromDisk('local')
        ->open('input.pdf')
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();

    expect($res->status)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(2)
        ->toContain($output);
});

# to remote-disk
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

    expect($res->status)
        ->toBeTrue()
        ->and($files)
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

    expect($res->status)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(2)
        ->toContain($output);
});

test('disk -> disk(remote)', function () {
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

    expect($res->status)
        ->toBeTrue()
        ->and($localFiles)
        ->toHaveCount(1)
        ->and($remoteFiles)
        ->toHaveCount(2)
        ->toContain($output);
});
