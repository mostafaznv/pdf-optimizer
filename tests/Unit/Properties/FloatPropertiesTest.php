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
    '-dColorImageDownsampleThreshold',
    '-dGrayImageDownsampleThreshold',
    '-dMonoImageDownsampleThreshold'
]);


it('will include the given option in the final script', function (string $option, string $method) {
    $number = (float)(mt_rand(1, 10) . '.' . mt_rand(1, 10));
    $command = $this->optimizer->$method($number)->command();

    expect($command)->toContain("$option=$number");

})->with([
    ['-dColorImageDownsampleThreshold', 'colorImageDownSampleThreshold'],
    ['-dGrayImageDownsampleThreshold', 'grayImageDownSampleThreshold'],
    ['-dMonoImageDownsampleThreshold', 'monoImageDownSampleThreshold']
]);
