<?php

use Illuminate\Http\UploadedFile;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\File;
use Illuminate\Filesystem\FilesystemAdapter;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\Disk;
use Illuminate\Support\Facades\Storage;


beforeEach(function () {
    Storage::fake();
});


it('will initiate a disk instance on construct', function () {
    $file = File::make('path');

    expect($file->getDisk())
        ->toBeInstanceOf(Disk::class)
        ->and($file->getDisk()->getAdapter())
        ->toBeNull();

    $file = File::make('path', 'local');

    expect($file->getDisk())
        ->toBeInstanceOf(Disk::class)
        ->and($file->getDisk()->getAdapter())
        ->toBeInstanceOf(FilesystemAdapter::class);
});

it('will return raw path of the given file', function () {
    $path = 'path/to/file.pdf';
    $file = File::make($path);

    expect($file->getPath())
        ->toBe($path);
});

it('will return raw path of file as local-path if driver is not set', function () {
    $path = 'path/to/file.pdf';
    $file = File::make($path);

    expect($file->getPath())->toBe($file->getLocalPath());
});

it('will return local absolute path of file as local-path when driver is local', function () {
    Storage::fake('local');

    $path = 'path/to/file.pdf';
    $file = File::make($path, 'local');

    expect($file->getPath())
        ->toBe($path)
        ->and($file->getLocalPath())
        ->toContain(storage_path())
        ->toEndWith($path);
});

it('will return local absolute path of file as local-path when driver is remote', function () {
    $disk = 's3';
    $path = 'path/to/file.pdf';

    Storage::fake($disk);
    Storage::disk($disk)->put(
        $path,
        UploadedFile::fake()->create('file.pdf', 1000, 'application/pdf')
    );

    $file = File::make($path, $disk);
    $localPath = $file->getLocalPath();


    expect($file->getDisk()->getTemporaryDisk()->allFiles())
        ->toBeArray()
        ->toHaveCount(1)
        ->toContain($path)
        ->and(file_exists($localPath))
        ->toBeTrue()
        ->and($localPath)
        ->toContain(pdf_temp_dir())
        ->toEndWith($path)
        ->and($file->getDisk()->getTemporaryDisk()->exists($path))
        ->toBeTrue()
        ->and($file->getDisk()->getTemporaryDisk()->path($path))
        ->toBe($localPath);
});

it('will delete temporary disk', function () {
    $disk = 's3';
    $path = 'path/to/file.pdf';

    Storage::fake($disk);
    Storage::disk($disk)->put(
        $path,
        UploadedFile::fake()->create('file.pdf', 1000, 'application/pdf')
    );

    $file = File::make($path, $disk);
    $localPath = $file->getLocalPath();

    expect(file_exists($localPath))->toBeTrue();

    $file->cleanup();
    expect(file_exists($localPath))->toBeFalse();
});

it('will delete temporary directory on __destruct', function () {
    $localPath = '';

    function t(): void
    {
        $disk = 's3';
        $path = 'path/to/file.pdf';

        Storage::fake($disk);
        Storage::disk($disk)->put(
            $path,
            UploadedFile::fake()->create('file.pdf', 1000, 'application/pdf')
        );

        $file = File::make($path, $disk);
        $localPath = $file->getLocalPath();

        expect(file_exists($localPath))->toBeTrue();
    }

    t();

    expect(file_exists($localPath))->toBeFalse();
});
