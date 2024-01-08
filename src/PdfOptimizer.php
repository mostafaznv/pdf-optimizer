<?php

namespace Mostafaznv\PdfOptimizer;

use Mostafaznv\PdfOptimizer\Actions\OptimizePdfAction;
use Mostafaznv\PdfOptimizer\Concerns\ExportsScript;
use Mostafaznv\PdfOptimizer\Concerns\PdfOptimizerProperties;
use Mostafaznv\PdfOptimizer\DTOs\OptimizeResult;
use Psr\Log\LoggerInterface;


class PdfOptimizer
{
    use PdfOptimizerProperties, ExportsScript;

    private ?LoggerInterface $logger = null;


    public function __construct(
        private readonly string $gsBinary = 'gs',
    ) {}

    public static function init(string $gsBinary = 'gs'): self
    {
        return new self($gsBinary);
    }


    public function logger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }

    public function optimize(string $pathToFile, string $pathToOptimizedFile): OptimizeResult
    {
        return OptimizePdfAction::init()
            ->logger($this->logger)
            ->setTimeout($this->timeout)
            ->execute(
                command: $this->command(),
                input: $pathToFile,
                output: $pathToOptimizedFile
            );
    }
}
