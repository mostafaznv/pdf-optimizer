<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();

    $this->input = pdf();
    $this->output = output();
});


it('will optimize pdf file using the given option', function (string $method, bool $value) {
    $result = $this->optimizer
        ->$method($value)
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
    ['fastWebView', true],
    ['fastWebView', false],

    ['detectDuplicateImages', true],
    ['detectDuplicateImages', false],

    ['preserveMarkedContent', true],
    ['preserveMarkedContent', false],

    ['pdfX', true],
    ['pdfX', false],

    ['embedAllFonts', true],
    ['embedAllFonts', false],

    ['subsetFonts', true],
    ['subsetFonts', false],

    ['compressFonts', true],
    ['compressFonts', false],

    ['convertCmykImagesToRGB', true],
    ['convertCmykImagesToRGB', false],

    ['downSampleColorImages', true],
    ['downSampleColorImages', false],

    ['downSampleGrayImages', true],
    ['downSampleGrayImages', false],

    ['downSampleMonoImages', true],
    ['downSampleMonoImages', false],

    ['preserveEpsInfo', true],
    ['preserveEpsInfo', false],

    ['preserveOpiComments', true],
    ['preserveOpiComments', false],

    ['ascii85EncodePages', true],
    ['ascii85EncodePages', false],

    ['autoFilterColorImages', true],
    ['autoFilterColorImages', false],

    ['autoFilterGrayImages', true],
    ['autoFilterGrayImages', false],

    ['compressPages', true],
    ['compressPages', false],

    ['encodeColorImages', true],
    ['encodeColorImages', false],

    ['encodeGrayImages', true],
    ['encodeGrayImages', false],

    ['encodeMonoImages', true],
    ['encodeMonoImages', false],

    ['lockDistillerParams', true],
    ['lockDistillerParams', false],

    ['parseDscComments', true],
    ['parseDscComments', false],

    ['parseDscCommentsForDocInfo', true],
    ['parseDscCommentsForDocInfo', false],

    ['preserveHalftoneInfo', true],
    ['preserveHalftoneInfo', false],

    ['preserveOverprintSettings', true],
    ['preserveOverprintSettings', false],

    ['useFlateCompression', true],
    ['useFlateCompression', false],

    ['passThroughJpegImages', true],
    ['passThroughJpegImages', false],

    ['passThroughJpxImages', true],
    ['passThroughJpxImages', false],
]);
