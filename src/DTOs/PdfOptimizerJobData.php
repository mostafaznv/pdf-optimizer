<?php

namespace Mostafaznv\PdfOptimizer\DTOs;


use Illuminate\Support\Str;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\Disk;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\File;
use Psr\Log\LoggerInterface;

class PdfOptimizerJobData
{
    public function __construct(
        public readonly string           $id,
        public readonly array            $commands,
        public readonly string           $input,
        public readonly string           $output,
        public readonly ?File            $file = null,
        public readonly ?Disk            $disk = null,
        public readonly ?LoggerInterface $logger = null,
        public readonly int              $timeout = 900
    ) {}

    public static function make(array $commands, string $input, string $output, File $file, ?Disk $disk = null, ?LoggerInterface $logger = null, int $timeout = 900): self
    {
        $id = Str::orderedUuid()->toString();

        return new self($id, $commands, $input, $output, $file, $disk, $logger, $timeout);
    }
}
