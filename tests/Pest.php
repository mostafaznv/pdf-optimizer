<?php

use Mostafaznv\PdfOptimizer\Tests\TestCase;


uses(TestCase::class)
    ->afterEach(function () {
        $tempBasePath = pdf_temp_dir() . '/test-files';

        if (is_dir($tempBasePath)) {
            array_map('unlink', glob("$tempBasePath/*.*"));
        }
    })
    ->in(__DIR__);


function pdf(): string
{
    return realpath(__DIR__ . '/TestSupport/Files/pdf-1.pdf');
}

function output(string $name = 'output.pdf'): string
{
    $tempBasePath = pdf_temp_dir() . '/test-files';

    @mkdir($tempBasePath);

    return pdf_temp_dir() . "/test-files/$name";
}
