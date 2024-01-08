<?php

namespace Mostafaznv\PdfOptimizer\Laravel\Facade;

use Illuminate\Support\Facades\Facade;


/**
 * @method static \Mostafaznv\PdfOptimizer\Laravel\LaravelPdfOptimizer fromDisk(string $disk)
 * @method static \Mostafaznv\PdfOptimizer\Laravel\Concerns\Export open(\Illuminate\Http\UploadedFile|string $file)
 *
 * @see \Mostafaznv\PdfOptimizer\Laravel\LaravelPdfOptimizer
 */
class PdfOptimizer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Mostafaznv\PdfOptimizer\Laravel\LaravelPdfOptimizer';
    }
}
