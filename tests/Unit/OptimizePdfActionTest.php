<?php

use Mostafaznv\PdfOptimizer\Laravel\Concerns\Disk;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\File;
use Mostafaznv\PdfOptimizer\Actions\OptimizePdfAction;
use Mostafaznv\PdfOptimizer\Tests\TestSupport\TestLogger;
use Illuminate\Support\Facades\Storage;


beforeEach(function () {
    $this->logger = new TestLogger;
    $this->action = app(OptimizePdfAction::class)->logger($this->logger);

    $this->command = ['gs', '-sDEVICE=pdfwrite', '-dNOPAUSE', '-dQUIET', '-dBATCH', '-dPDFSETTINGS=/screen'];
    $this->input = 'input.pdf';
    $this->output = 'output.pdf';

    Storage::fake('local');
    Storage::fake('s3');
});


it('can set timeout for running processes', function () {
    $class = new ReflectionClass($this->action);
    $reflection = $class->getProperty('timeout');

    expect($reflection->getValue($this->action))
        ->toBe(60);

    $this->action->setTimeout(120);

    expect($reflection->getValue($this->action))
        ->toBe(120);
});

it('will overwrite input when file object is provided directly', function () {
    OptimizePdfAction::init()
        ->logger($this->logger)
        ->execute(
            $this->command, $this->input, $this->output
        );

    expect($this->logger->getContext())
        ->toHaveKey('input', $this->input);


    $this->logger->reset();
    expect($this->logger->getContext())->toBeEmpty();


    $file = File::make(pdf());

    OptimizePdfAction::init($file)
        ->logger($this->logger)
        ->execute(
            $this->command, $this->input, $this->output
        );

    expect($this->input)
        ->not()->toBe($file->getPath())
        ->and($this->logger->getContext())
        ->toHaveKey('input', $file->getPath());
});

it('will overwrite output when a disk(local) object is provided through init method', function () {
    OptimizePdfAction::init()
        ->logger($this->logger)
        ->execute(
            $this->command, $this->input, $this->output
        );

    expect($this->logger->getContext())
        ->toHaveKey('output', $this->output);


    $this->logger->reset();
    expect($this->logger->getContext())->toBeEmpty();


    $disk = Disk::make('local');
    $expectedOutput = $disk->getAdapter()->path($this->output);

    OptimizePdfAction::init(outputDisk: $disk)
        ->logger($this->logger)
        ->execute(
            $this->command, $this->input, $this->output
        );


    expect($this->output)
        ->not()->toBe($expectedOutput)
        ->and($this->logger->getContext())
        ->toHaveKey('output', $expectedOutput);
});

it('will overwrite output when a disk(remote) object is provided through init method', function () {
    OptimizePdfAction::init()
        ->logger($this->logger)
        ->execute(
            $this->command, $this->input, $this->output
        );

    expect($this->logger->getContext())
        ->toHaveKey('output', $this->output);


    $this->logger->reset();
    expect($this->logger->getContext())->toBeEmpty();


    $disk = Disk::make('s3');
    $expectedOutput = $disk->getTemporaryDisk()->path($this->output);

    OptimizePdfAction::init(outputDisk: $disk)
        ->logger($this->logger)
        ->execute(
            $this->command, $this->input, $this->output
        );


    expect($this->output)
        ->not()->toBe($expectedOutput)
        ->and($this->logger->getContext())
        ->toHaveKey('output', $expectedOutput);
});

it('will include input/output options in the final command list if they are absent from the provided command array', function () {
    $this->action->execute(
        $this->command, $this->input, $this->output
    );

    $ctx = $this->logger->getContext();

    expect($ctx)
        ->toHaveKey('command')
        ->and($ctx['command'])
        ->toContain($this->input)
        ->toContain("-sOutputFile=$this->output");
});

it('wont overwrite input/output options in the final command list if they are already included in the provided command array', function () {
    $input = 'in.pdf';
    $output = 'out.pdf';
    $command = array_merge($this->command, [
        "-sOutputFile=$output",
        $input
    ]);

    $this->action->execute(
        $command, $this->input, $this->output
    );

    $ctx = $this->logger->getContext();

    expect($ctx)
        ->toHaveKey('command')
        ->and($ctx['command'])
        ->toContain("-sOutputFile=$output")
        ->not->toContain("-sOutputFile=$this->output")
        ->toContain($input)
        ->not->toContain($this->input);
});

it('will store files to remote disks', function (string $prefix) {
    $disk = Disk::make('s3');
    $output = $prefix . $this->output;

    expect($disk->getAdapter()->allFiles())->toHaveCount(0);

    $result = OptimizePdfAction::init(outputDisk: $disk)
        ->logger($this->logger)
        ->execute(
            $this->command, pdf(), $output
        );

    $diskFiles = $disk->getAdapter()->allFiles();
    $output = ltrim($output, '/');

    expect($result->status)
        ->toBeTrue()
        ->and($diskFiles)
        ->toHaveCount(1)
        ->toContain($output);
})->with([
    '', 'prefix/', '/prefix/', 'prefix1/prefix2/'
]);

it('will cleanup temp files after finishing process', function (string $prefix) {
    $disk = 's3';
    $output = $prefix . $this->output;
    Storage::disk($disk)->put($this->input, file_get_contents(pdf()));

    $file = File::make($this->input, $disk);
    $outputDisk = Disk::make($disk);

    $file->getLocalPath();
    $outputDisk->getTemporaryDisk()->put('temp.pdf', file_get_contents(pdf()));

    $allFiles = Storage::disk($disk)->allFiles();
    $fileAllTempFiles = $file->getDisk()->getTemporaryDisk()->allFiles();
    $outputDiskAllTempFiles = $outputDisk->getTemporaryDisk()->allFiles();

    expect($allFiles)
        ->toHaveCount(1)
        ->and($fileAllTempFiles)
        ->toHaveCount(1)
        ->and($outputDiskAllTempFiles)
        ->toHaveCount(1);

    $result = OptimizePdfAction::init($file, $outputDisk)
        ->logger($this->logger)
        ->execute(
            $this->command, pdf(), $output
        );

    $allFiles = Storage::disk($disk)->allFiles();
    $fileAllTempFiles = $file->getDisk()->getTemporaryDisk()->allFiles();
    $outputDiskAllTempFiles = $outputDisk->getTemporaryDisk()->allFiles();


    expect($result->status)
        ->toBeTrue()
        ->and($allFiles)
        ->toHaveCount(2)
        ->and($fileAllTempFiles)
        ->toHaveCount(0)
        ->and($outputDiskAllTempFiles)
        ->toHaveCount(0);
})->with([
    '', 'prefix/', '/prefix/', 'prefix1/prefix2/'
]);

it('will log output for successful actions', function () {
    $result = $this->action->execute(
        $this->command, pdf(), output()
    );

    $logs = $this->logger->getLogs();
    $ctx = $this->logger->getContext();

    expect($result->status)
        ->toBeTrue()
        ->and($result->message)
        ->toBe('')
        ->and($logs)
        ->toContain('info: Process successfully ended')
        ->and($ctx)
        ->toHaveKey('output_log');
});

it('will log output for failed actions', function () {
    $result = $this->action->execute(
        $this->command, $this->input, $this->output
    );

    $logs = $this->logger->getLogs();
    $ctx = $this->logger->getContext();

    expect($result->status)
        ->toBeFalse()
        ->and($result->message)
        ->not->toBe('')
        ->and($logs)
        ->toContain('error: Process ended with error')
        ->and($ctx)
        ->toHaveKey('output_log')
        ->toHaveKey('error_output_log');
});
