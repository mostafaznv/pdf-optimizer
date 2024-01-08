<?php

use Illuminate\Http\UploadedFile;
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Illuminate\Support\Facades\Storage;


beforeEach(function () {
    Storage::fake('s3');
    Storage::fake('local');

    $pdfPath = pdf();

    $this->outputRealPath = output();
    $this->file = new UploadedFile($pdfPath, 'test.pdf', 'application/pdf', null, true);

    Storage::disk('s3')->put('input.pdf', file_get_contents($pdfPath));

    @unlink($this->output);
});


test('remote -> local-path', function () {
    expect(file_exists($this->outputRealPath))->toBeFalse();

    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->optimize($this->outputRealPath);

    expect($res->status)
        ->toBeTrue()
        ->and(file_exists($this->outputRealPath))
        ->toBeTrue();
});

test('remote -> disk(local)', function () {
    $disk = 'local';
    $output = 'output.pdf';

    $files = Storage::disk($disk)->allFiles();
    expect($files)->toHaveCount(0);

    $res = PdfOptimizer::fromDisk('s3')
        ->open('input.pdf')
        ->toDisk($disk)
        ->optimize($output);

    $files = Storage::disk($disk)->allFiles();

    expect($res->status)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(1)
        ->toContain($output);
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

    expect($res->status)
        ->toBeTrue()
        ->and($files)
        ->toHaveCount(2)
        ->toContain($output);
});
