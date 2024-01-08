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

    $this->input = pdf();
    $this->output = output();
});


it('will optimize pdf file using the given option', function (string $method, BackedEnum $enum) {
    $result = $this->optimizer
        ->$method($enum)
        ->optimize($this->input, $this->output);


    $inputSize = filesize($this->input);
    $outputSize = filesize($this->output);

    expect($result->status)
        ->toBeTrue()
        ->and($inputSize)
        ->toBeGreaterThan(0)
        ->and($outputSize)
        ->toBeGreaterThan(0)
        ->and($inputSize !== $outputSize)
        ->toBeTrue();

})->with([
    ['settings', PdfSettings::SCREEN],
    ['settings', PdfSettings::EBOOK],
    ['settings', PdfSettings::PRINTER],
    ['settings', PdfSettings::PREPRESS],
    ['settings', PdfSettings::DEFAULT],

    ['compatibilityLevel', CompatibilityLevel::PDF1_3],
    ['compatibilityLevel', CompatibilityLevel::PDF1_4],
    ['compatibilityLevel', CompatibilityLevel::PDF1_5],
    ['compatibilityLevel', CompatibilityLevel::PDF1_6],
    ['compatibilityLevel', CompatibilityLevel::PDF1_7],

    ['processColorModel', ProcessColorModel::GRAY],
    ['processColorModel', ProcessColorModel::RGB],
    ['processColorModel', ProcessColorModel::CMYK],

    ['colorConversionStrategy', ColorConversionStrategy::UNCHANGED],
    ['colorConversionStrategy', ColorConversionStrategy::GRAY],
    ['colorConversionStrategy', ColorConversionStrategy::RGB],
    ['colorConversionStrategy', ColorConversionStrategy::CMYK],
    ['colorConversionStrategy', ColorConversionStrategy::DEVICE_INDEPENDENT_COLOR],

    ['ucRandBbInfo', UCRandBGInfo::REMOVE],
    ['ucRandBbInfo', UCRandBGInfo::PRESERVE],

    ['autoRotatePages', AutoRotatePages::NONE],
    ['autoRotatePages', AutoRotatePages::ALL],
    ['autoRotatePages', AutoRotatePages::PAGE_BY_PAGE],

    ['colorImageDownSampleType', ColorImageDownSampleType::SUB_SAMPLE],
    ['colorImageDownSampleType', ColorImageDownSampleType::AVERAGE],
    ['colorImageDownSampleType', ColorImageDownSampleType::BICUBIC],

    ['grayImageDownSampleType', GrayImageDownSampleType::SUB_SAMPLE],
    ['grayImageDownSampleType', GrayImageDownSampleType::AVERAGE],
    ['grayImageDownSampleType', GrayImageDownSampleType::BICUBIC],

    ['monoImageDownSampleType', MonoImageDownSampleType::SUB_SAMPLE],
    ['monoImageDownSampleType', MonoImageDownSampleType::AVERAGE],
    ['monoImageDownSampleType', MonoImageDownSampleType::BICUBIC],

    ['colorImageDepth', ImageDepth::ONE],
    ['colorImageDepth', ImageDepth::TWO],
    ['colorImageDepth', ImageDepth::FOUR],
    ['colorImageDepth', ImageDepth::EIGHT],
    ['colorImageDepth', ImageDepth::UNCHANGED],

    ['grayImageDepth', ImageDepth::ONE],
    ['grayImageDepth', ImageDepth::TWO],
    ['grayImageDepth', ImageDepth::FOUR],
    ['grayImageDepth', ImageDepth::EIGHT],
    ['grayImageDepth', ImageDepth::UNCHANGED],

    ['monoImageDepth', ImageDepth::ONE],
    ['monoImageDepth', ImageDepth::TWO],
    ['monoImageDepth', ImageDepth::FOUR],
    ['monoImageDepth', ImageDepth::EIGHT],
    ['monoImageDepth', ImageDepth::UNCHANGED],

    ['colorImageFilter', ImageFilter::JPEG],
    ['colorImageFilter', ImageFilter::ZIP],

    ['grayImageFilter', ImageFilter::JPEG],
    ['grayImageFilter', ImageFilter::ZIP],

    ['monoImageFilter', MonoImageFilter::CCITT],
    ['monoImageFilter', MonoImageFilter::FLATE],
    ['monoImageFilter', MonoImageFilter::RUN_LENGTH],

    ['defaultRenderingIntent', DefaultRenderingIntent::DEFAULT],
    ['defaultRenderingIntent', DefaultRenderingIntent::PERCEPTUAL],
    ['defaultRenderingIntent', DefaultRenderingIntent::SATURATION],
    ['defaultRenderingIntent', DefaultRenderingIntent::ABSOLUTE_COLORIMETRIC],
    ['defaultRenderingIntent', DefaultRenderingIntent::RELATIVE_COLORIMETRIC],
]);
