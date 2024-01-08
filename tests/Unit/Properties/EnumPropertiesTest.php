<?php

use Mostafaznv\PdfOptimizer\Enums\AutoRotatePages;
use Mostafaznv\PdfOptimizer\Enums\ColorConversionStrategy;
use Mostafaznv\PdfOptimizer\Enums\ColorImageDownSampleType;
use Mostafaznv\PdfOptimizer\Enums\CompatibilityLevel;
use Mostafaznv\PdfOptimizer\Enums\DefaultRenderingIntent;
use Mostafaznv\PdfOptimizer\Enums\GrayImageDownSampleType;
use Mostafaznv\PdfOptimizer\Enums\ImageDepth;
use Mostafaznv\PdfOptimizer\Enums\ImageFilter;
use Mostafaznv\PdfOptimizer\Enums\MonoImageDownSampleType;
use Mostafaznv\PdfOptimizer\Enums\MonoImageFilter;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;
use Mostafaznv\PdfOptimizer\Enums\ProcessColorModel;
use Mostafaznv\PdfOptimizer\Enums\UCRandBGInfo;
use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();
});


it('will/wont include the given option in the final script by default', function (string $option, bool $isIncluded, ?BackedEnum $expectedValue) {
    $command = $this->optimizer->toString();

    $contains = str_contains($command, $option);

    expect($contains)->toBe($isIncluded);


    if ($isIncluded) {
        expect($command)->toContain("$option=$expectedValue->value");
    }

})->with([
    ['-dPDFSETTINGS', true, PdfSettings::SCREEN],
    ['-dCompatibilityLevel', false, null],
    ['-sProcessColorModel', false, null],
    ['-sColorConversionStrategy', false, null],
    ['-dUCRandBGInfo', false, null],
    ['-dAutoRotatePages', false, null],
    ['-dColorImageDownsampleType', false, null],
    ['-dGrayImageDownsampleType', false, null],
    ['-dMonoImageDownsampleType', false, null],
    ['-dColorImageDepth', false, null],
    ['-dGrayImageDepth', false, null],
    ['-dMonoImageDepth', false, null],
    ['-dColorImageFilter', false, null],
    ['-dGrayImageFilter', false, null],
    ['-dMonoImageFilter', false, null],
    ['-dDefaultRenderingIntent', false, null]
]);


it('will include the given option in the final script', function (string $option, string $method, string $enum) {
    /** @var BackedEnum $enum */
    $cases = $enum::cases();

    foreach ($cases as $case) {
        $command = $this->optimizer->$method($case)->command();

        expect($command)->toContain("$option=$case->value");
    }

})->with([
    ['-dPDFSETTINGS', 'settings', PdfSettings::class],
    ['-dCompatibilityLevel', 'compatibilityLevel', CompatibilityLevel::class],
    ['-sProcessColorModel', 'processColorModel', ProcessColorModel::class],
    ['-sColorConversionStrategy', 'colorConversionStrategy', ColorConversionStrategy::class],
    ['-dUCRandBGInfo', 'ucRandBbInfo', UCRandBGInfo::class],
    ['-dAutoRotatePages', 'autoRotatePages', AutoRotatePages::class],
    ['-dColorImageDownsampleType', 'colorImageDownSampleType', ColorImageDownSampleType::class],
    ['-dGrayImageDownsampleType', 'grayImageDownSampleType', GrayImageDownSampleType::class],
    ['-dMonoImageDownsampleType', 'monoImageDownSampleType', MonoImageDownSampleType::class],
    ['-dColorImageDepth', 'colorImageDepth', ImageDepth::class],
    ['-dGrayImageDepth', 'grayImageDepth', ImageDepth::class],
    ['-dMonoImageDepth', 'monoImageDepth', ImageDepth::class],
    ['-dColorImageFilter', 'colorImageFilter', ImageFilter::class],
    ['-dGrayImageFilter', 'grayImageFilter', ImageFilter::class],
    ['-dMonoImageFilter', 'monoImageFilter', MonoImageFilter::class],
    ['-dDefaultRenderingIntent', 'defaultRenderingIntent', DefaultRenderingIntent::class]
]);
