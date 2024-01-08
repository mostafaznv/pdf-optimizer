<?php

namespace Mostafaznv\PdfOptimizer\Laravel\Concerns;

use Mostafaznv\PdfOptimizer\Actions\OptimizePdfAction;
use Mostafaznv\PdfOptimizer\Concerns\ExportsScript;
use Mostafaznv\PdfOptimizer\Concerns\PdfOptimizerProperties;
use Mostafaznv\PdfOptimizer\DTOs\OptimizeResult;
use Psr\Log\LoggerInterface;


class Export
{
    use PdfOptimizerProperties, ExportsScript;

    private ?string          $disk   = null;
    private ?LoggerInterface $logger = null;


    public function __construct(
        private readonly File $file,
        private string        $gsBinary = 'gs',
    ) {}


    public function toDisk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    public function setGsBinary(string $binary): self
    {
        $this->gsBinary = $binary;

        return $this;
    }

    public function logger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }

    public function optimize(string $pathToOptimizedFile): OptimizeResult
    {
        $disk = Disk::make($this->disk);

        return OptimizePdfAction::init($this->file, $disk)
            ->logger($this->logger)
            ->setTimeout($this->timeout)
            ->execute(
                command: $this->command(),
                input: $this->file->getPath(),
                output: $pathToOptimizedFile
            );
    }
}
