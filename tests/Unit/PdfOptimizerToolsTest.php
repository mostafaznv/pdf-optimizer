<?php

use Mostafaznv\PdfOptimizer\PdfOptimizer;


beforeEach(function () {
    $this->optimizer = PdfOptimizer::init();
});


it('can change the path of gs binary file', function () {
    $class = new ReflectionClass($this->optimizer);
    $reflection = $class->getProperty('gsBinary');

    expect($reflection->getValue($this->optimizer))->toBe('gs');

    $optimizer = PdfOptimizer::init('/usr/local/bin/gs');
    $class = new ReflectionClass($optimizer);
    $reflection = $class->getProperty('gsBinary');

    expect($reflection->getValue($optimizer))->toBe('/usr/local/bin/gs');
});

it('will generate command correctly', function () {
    $command = $this->optimizer->command();

    expect($command)
        ->toContain('gs')
        ->toContain('-sDEVICE=pdfwrite')
        ->toContain('-dNOPAUSE')
        ->toContain('-dQUIET')
        ->toContain('-dBATCH');
});

it('will add input/output paths correctly', function () {
    $command = $this->optimizer->command('input.pdf', 'output.pdf');
    $string = $this->optimizer->toString('input.pdf', 'output.pdf');

    expect($command)
        ->toContain('-sOutputFile=output.pdf')
        ->toContain('input.pdf')
        ->and($string)
        ->toContain('-sOutputFile=output.pdf input.pdf');
});
