<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();

    $this->input = pdf();
    $this->output = output();
});


it('will optimize pdf file using the given option', function (string $method, int $number) {
    $result = $this->optimizer
        ->$method($number)
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
    ['pdfA', 1],
    ['pdfA', 2],
    ['pdfA', 3],

    ['pdfACompatibilityPolicy', 0],
    ['pdfACompatibilityPolicy', 1],
    ['pdfACompatibilityPolicy', 2],

    ['maxInlineImageSize', 4000],
    ['maxInlineImageSize', 2000],
    ['maxInlineImageSize', 100],

    ['colorImageResolution', 9],
    ['colorImageResolution', 2400],
    ['colorImageResolution', 1250],

    ['grayImageResolution', 9],
    ['grayImageResolution', 2400],
    ['grayImageResolution', 1250],

    ['monoImageResolution', 9],
    ['monoImageResolution', 2400],
    ['monoImageResolution', 1250],

    ['maxSubsetPct', 1],
    ['maxSubsetPct', 100],
    ['maxSubsetPct', 43],
]);
