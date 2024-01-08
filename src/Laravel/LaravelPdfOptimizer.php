<?php

namespace Mostafaznv\PdfOptimizer\Laravel;

use Illuminate\Http\UploadedFile;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\Export;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\File;


class LaravelPdfOptimizer
{
    private ?string $disk = null;


    public function fromDisk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    public function open(UploadedFile|string $file): Export
    {
        if ($file instanceof UploadedFile) {
            $this->disk = null;

            $file = File::make($file->getRealPath(), $this->disk);
        }
        else {
            $file = File::make($file, $this->disk);
        }

        return new Export($file, config('pdf-optimizer.gs'));
    }
}
