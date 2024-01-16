<?php

use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Illuminate\Filesystem\AwsS3V3Adapter;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter as LeagueAwsS3V3Adapter;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\Disk;


it('will generate temp directory on disk construct', function () {
    $disk = Disk::make();

    $class = new ReflectionClass($disk);
    $reflection = $class->getProperty('temporaryDirectory');
    $tempDirectory = $reflection->getValue($disk);

    $array = $tempDirectory ? explode('/', $tempDirectory) : [];
    $prefix = pdf_temp_dir() . '/pdf-optimizer/';


    expect($tempDirectory)
        ->toBeTruthy()
        ->and($tempDirectory)
        ->toContain($prefix)
        ->and(end($array))
        ->toBeUuid();
});

it('will return adapter if disk is set', function () {
    $disk = Disk::make('local');

    expect($disk->getAdapter())
        ->toBeInstanceOf(FilesystemAdapter::class)
        ->and($disk->getAdapter()->getAdapter())
        ->toBeInstanceOf(LocalFilesystemAdapter::class);

    $disk = Disk::make('s3');

    expect($disk->getAdapter())
        ->toBeInstanceOf(AwsS3V3Adapter::class)
        ->and($disk->getAdapter()->getAdapter())
        ->toBeInstanceOf(LeagueAwsS3V3Adapter::class);
});

it('will return null if disk is not set', function () {
    $disk = Disk::make();

    expect($disk->getAdapter())->toBeNull();
});

it('will return a temporary local disk', function () {
    $disk = Disk::make('s3');
    $temp = $disk->getTemporaryDisk();

    expect($disk->getAdapter()->getAdapter())
        ->toBeInstanceOf(LeagueAwsS3V3Adapter::class)
        ->and($temp->getAdapter())
        ->toBeInstanceOf(LocalFilesystemAdapter::class)
        ->and($disk->getAdapter()->path('path'))
        ->toBe('path')
        ->and($temp->path('path'))
        ->toContain(pdf_temp_dir());
});

it('will create temporary path after creating an instance of temp-disk', function () {
    $disk = Disk::make('local');

    $class = new ReflectionClass($disk);
    $reflection = $class->getProperty('temporaryDirectory');
    $tempDirectory = $reflection->getValue($disk);

    expect($tempDirectory)
        ->toBeTruthy()
        ->and(is_dir($tempDirectory))
        ->toBeFalse();

    $disk->getTemporaryDisk();

    expect($tempDirectory)
        ->toBeTruthy()
        ->and(is_dir($tempDirectory))
        ->toBeTrue()
        ->and(is_writable($tempDirectory))
        ->toBeTrue();
});

it('will delete temporary directory', function () {
    $disk = Disk::make('local');

    $class = new ReflectionClass($disk);
    $reflection = $class->getProperty('temporaryDirectory');
    $tempDirectory = $reflection->getValue($disk);

    $disk->getTemporaryDisk();
    expect(is_dir($tempDirectory))->toBeTrue();

    $disk->cleanupTemporaryDirectory();
    expect(is_dir($tempDirectory))->toBeFalse();
});

it('will delete temporary directory on __destruct', function () {
    $disk = Disk::make('local');

    $class = new ReflectionClass($disk);
    $reflection = $class->getProperty('temporaryDirectory');
    $tempDirectory = $reflection->getValue($disk);

    $disk->getTemporaryDisk();
    expect(is_dir($tempDirectory))->toBeTrue();

    unset($disk);
    expect(is_dir($tempDirectory))->toBeFalse();
});

it('will assume driver a not-local driver if disk is not set', function () {
    $disk = Disk::make();

    expect($disk->isLocalDisk())->toBeFalse();
});

it('will flag disk as a local/non-local disk correctly', function () {
    $disk = Disk::make('local');
    expect($disk->isLocalDisk())->toBeTrue();

    $disk = Disk::make('s3');
    expect($disk->getAdapter())
        ->toBeInstanceOf(AwsS3V3Adapter::class)
        ->and($disk->isLocalDisk())
        ->toBeFalse();
    });
