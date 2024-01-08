<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();

    $this->input = pdf();
    $this->output = output();
});


it('will optimize pdf file using the custom options', function () {
    $result = $this->optimizer
        ->setExtraOptions([
            '-dColorImageResolution=72'
        ])
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

});

