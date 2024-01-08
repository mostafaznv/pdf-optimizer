<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();
});


it('will/wont include the given option in the final script by default', function (string $option, bool $isIncluded, ?bool $expectedValue) {
    $command = $this->optimizer->toString();

    $contains = str_contains($command, $option);

    expect($contains)->toBe($isIncluded);


    if ($isIncluded) {
        $expectedValue = $expectedValue ? 'true' : 'false';

        expect($command)->toContain("$option=$expectedValue");
    }

})->with([
    ['-dFastWebView', false, null],
    ['-dDetectDuplicateImages', true, true],
    ['-dPreserveMarkedContent', false, null],
    ['-dPDFX', false, null],
    ['-dEmbedAllFonts', false, null],
    ['-dSubsetFonts', false, null],
    ['-dCompressFonts', false, null],
    ['-dConvertCMYKImagesToRGB', false, null],
    ['-dDownsampleColorImages', false, null],
    ['-dDownsampleGrayImages', false, null],
    ['-dDownsampleMonoImages', false, null],
    ['-dPreserveEPSInfo', false, null],
    ['-dPreserveOPIComments', false, null],
    ['-dASCII85EncodePages', false, null],
    ['-dAutoFilterColorImages', false, null],
    ['-dAutoFilterGrayImages', false, null],
    ['-dCompressPages', false, null],
    ['-dEncodeColorImages', false, null],
    ['-dEncodeGrayImages', false, null],
    ['-dEncodeMonoImages', false, null],
    ['-dLockDistillerParams', false, null],
    ['-dParseDSCComments', false, null],
    ['-dParseDSCCommentsForDocInfo', false, null],
    ['-dPreserveHalftoneInfo', false, null],
    ['-dPreserveOverprintSettings', false, null],
    ['-dUseFlateCompression', false, null],
    ['-dPassThroughJPEGImages', false, null],
    ['-dPassThroughJPXImages', false, null],
]);


it('will include the given option in the final script', function (string $option, string $method) {
    $command = $this->optimizer->$method(true)->command();
    expect($command)->toContain("$option=true");

    $command = $this->optimizer->$method(false)->command();
    expect($command)->toContain("$option=false");

})->with([
    ['-dFastWebView', 'fastWebView'],
    ['-dDetectDuplicateImages', 'detectDuplicateImages'],
    ['-dPreserveMarkedContent', 'preserveMarkedContent'],
    ['-dPDFX', 'pdfX'],
    ['-dEmbedAllFonts', 'embedAllFonts'],
    ['-dSubsetFonts', 'subsetFonts'],
    ['-dCompressFonts', 'compressFonts'],
    ['-dConvertCMYKImagesToRGB', 'convertCmykImagesToRGB'],
    ['-dDownsampleColorImages', 'downSampleColorImages'],
    ['-dDownsampleGrayImages', 'downSampleGrayImages'],
    ['-dDownsampleMonoImages', 'downSampleMonoImages'],
    ['-dPreserveEPSInfo', 'preserveEpsInfo'],
    ['-dPreserveOPIComments', 'preserveOpiComments'],
    ['-dASCII85EncodePages', 'ascii85EncodePages'],
    ['-dAutoFilterColorImages', 'autoFilterColorImages'],
    ['-dAutoFilterGrayImages', 'autoFilterGrayImages'],
    ['-dCompressPages', 'compressPages'],
    ['-dEncodeColorImages', 'encodeColorImages'],
    ['-dEncodeGrayImages', 'encodeGrayImages'],
    ['-dEncodeMonoImages', 'encodeMonoImages'],
    ['-dLockDistillerParams', 'lockDistillerParams'],
    ['-dParseDSCComments', 'parseDscComments'],
    ['-dParseDSCCommentsForDocInfo', 'parseDscCommentsForDocInfo'],
    ['-dPreserveHalftoneInfo', 'preserveHalftoneInfo'],
    ['-dPreserveOverprintSettings', 'preserveOverprintSettings'],
    ['-dUseFlateCompression', 'useFlateCompression'],
    ['-dPassThroughJPEGImages', 'passThroughJpegImages'],
    ['-dPassThroughJPXImages', 'passThroughJpxImages'],
]);
