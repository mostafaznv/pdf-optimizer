<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();
});


it('can add custom options to the script', function () {
    $this->optimizer->setExtraOptions([
        '-dCustom1=true',
        '-dCustom2=false'
    ]);

    expect($this->optimizer->command())
        ->toContain('-dCustom1=true')
        ->toContain('-dCustom2=false');
});


it('will set timeout', function () {
    $timeout = 41;
    $this->optimizer->setTimeout($timeout);

    $class = new ReflectionClass($this->optimizer);
    $reflection = $class->getProperty('timeout');

    expect($reflection->getValue($this->optimizer))->toBe($timeout);
});
