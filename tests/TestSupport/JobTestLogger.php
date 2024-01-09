<?php

namespace Mostafaznv\PdfOptimizer\Tests\TestSupport;


use Illuminate\Support\Facades\Storage;

class JobTestLogger extends TestLogger
{
    public function __construct(private readonly string $disk, private readonly string $path)
    {
        Storage::fake($disk);
    }

    public function info($message, array $context = []): void
    {
        parent::info($message, $context);

        Storage::disk($this->disk)->append($this->path, $message);
    }

    public function error($message, array $context = []): void
    {
        parent::error($message, $context);

        Storage::disk($this->disk)->append($this->path, $message);
    }
}
