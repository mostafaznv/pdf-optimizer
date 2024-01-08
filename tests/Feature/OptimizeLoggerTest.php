<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Tests\TestSupport\TestLogger;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();

    $this->logger = new TestLogger;
    $this->input = pdf();
    $this->output = output();
});


it('can pass logger to optimizer class', function () {
    expect($this->logger->getLogs())->toHaveCount(0);

    $this->optimizer
        ->logger($this->logger)
        ->optimize($this->input, $this->output);

    expect(count($this->logger->getLogs()))->toBeGreaterThan(0);
});

