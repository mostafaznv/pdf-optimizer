<?php

use Mostafaznv\PdfOptimizer\Concerns\ExportsScript;
use Mostafaznv\PdfOptimizer\Concerns\PdfOptimizerProperties;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\Export;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\File;
use Illuminate\Support\Facades\Storage;
use Mostafaznv\PdfOptimizer\Tests\TestSupport\TestLogger;


beforeEach(function () {
    Storage::fake('local');
    Storage::fake('s3');

    $this->file = File::make(pdf());
    $this->logger = new TestLogger();
    $this->export = new Export($this->file);
    $this->output = pdf_temp_dir() . '/output.pdf';
});


it('can set gs properties', function () {
    expect(Export::class)
        ->toUse(PdfOptimizerProperties::class)
        ->toHaveMethod('setExtraOptions')
        ->toHaveMethod('setTimeout')
        ->toHaveMethod('settings');
});

it('can export command', function () {
    expect(Export::class)
        ->toUse(ExportsScript::class)
        ->toHaveMethod('command')
        ->toHaveMethod('toString');
});

it('can set custom gs binary', function () {
    $result = $this->export->optimize($this->output);
    expect($result->status)->toBeTrue();

    try {
        $result = $this->export->setGsBinary('corrupted-gs')->optimize($this->output);

        expect($result->status)->toBeFalse();
    }
    catch (Exception $e) {
        expect($e->getMessage())
            ->toContain('No such file or directory')
            ->toContain('corrupted-gs');
    }
});

it('can set logger class', function () {
    expect($this->logger->getLogs())
        ->toHaveCount(0)
        ->and($this->logger->getContext())
        ->toHaveCount(0);


    $result = $this->export
        ->logger($this->logger)
        ->optimize($this->output);

    expect($result->status)
        ->toBeTrue()
        ->and(count($this->logger->getLogs()))
        ->toBeGreaterThan(0)
        ->and(count($this->logger->getContext()))
        ->toBeGreaterThan(0);
});

it('can set disk for optimized file', function () {
    $allFiles = Storage::disk('s3')->allFiles();

    expect($allFiles)->toHaveCount(0);

    $result = $this->export
        ->toDisk('s3')
        ->optimize('output.pdf');

    $allFiles = Storage::disk('s3')->allFiles();

    expect($result->status)
        ->toBeTrue()
        ->and($allFiles)
        ->toHaveCount(1);
});
