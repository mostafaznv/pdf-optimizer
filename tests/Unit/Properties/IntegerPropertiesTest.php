<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();
});


it('wont include the given option in the final script by default', function (string $option) {
    $command = $this->optimizer->toString();
    $contains = str_contains($command, $option);

    expect($contains)->toBeFalse();

})->with([
    '-dPDFA',
    '-dPDFACompatibilityPolicy',
    '-dMaxInlineImageSize',
    '-dColorImageResolution',
    '-dGrayImageResolution',
    '-dMonoImageResolution',
    '-dMaxSubsetPct'
]);


it('will include the given option in the final script', function (string $option, string $method) {
    $number = random_int(1, 10);
    $command = $this->optimizer->$method($number)->command();

    expect($command)->toContain("$option=$number");

})->with([
    ['-dPDFA', 'pdfA'],
    ['-dPDFACompatibilityPolicy', 'pdfACompatibilityPolicy'],
    ['-dMaxInlineImageSize', 'maxInlineImageSize'],
    ['-dColorImageResolution', 'colorImageResolution'],
    ['-dGrayImageResolution', 'grayImageResolution'],
    ['-dMonoImageResolution', 'monoImageResolution'],
    ['-dMaxSubsetPct', 'maxSubsetPct'],
]);
