<?php

namespace Mostafaznv\PdfOptimizer\Laravel\Concerns;

use Mostafaznv\PdfOptimizer\Actions\OptimizePdfAction;
use Mostafaznv\PdfOptimizer\Concerns\ExportsScript;
use Mostafaznv\PdfOptimizer\Concerns\PdfOptimizerProperties;
use Mostafaznv\PdfOptimizer\DTOs\OptimizeResult;
use Mostafaznv\PdfOptimizer\DTOs\PdfOptimizerJobData;
use Mostafaznv\PdfOptimizer\DTOs\QueueData;
use Mostafaznv\PdfOptimizer\Jobs\PdfOptimizerJob;
use Psr\Log\LoggerInterface;


class Export
{
    use PdfOptimizerProperties, ExportsScript;

    private readonly File    $file;
    private string           $gsBinary;
    private ?string          $disk   = null;
    private ?LoggerInterface $logger = null;
    private QueueData        $queue;


    public function __construct(File $file, string $gsBinary = 'gs')
    {
        $this->file = $file;
        $this->gsBinary = $gsBinary;
        $this->timeout = config('pdf-optimizer.timeout');

        $queue = config('pdf-optimizer.queue');

        $this->queue = QueueData::make(
            $queue['enabled'], $queue['name'], $queue['connection'], $queue['timeout']
        );
    }


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

    public function onQueue(bool $enabled = true, string $name = 'default', ?string $connection = null, int $timeout = 900): self
    {
        $this->queue = QueueData::make($enabled, $name, $connection, $timeout);

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

        $commands = $this->command();
        $input = $this->file->getPath();

        if ($this->queue->enabled) {
            return $this->optimizeOnQueue(
                $commands, $input, $pathToOptimizedFile, $disk
            );
        }

        return OptimizePdfAction::init($this->file, $disk)
            ->logger($this->logger)
            ->setTimeout($this->timeout)
            ->execute(
                $commands, $input, $pathToOptimizedFile
            );
    }


    private function optimizeOnQueue(array $commands, string $input, string $output, Disk $disk): OptimizeResult
    {
        $data = PdfOptimizerJobData::make(
            commands: $commands,
            input: $input,
            output: $output,
            file: $this->file,
            disk: $disk,
            logger: $this->logger,
            timeout: $this->queue->timeout
        );

        PdfOptimizerJob::dispatch($data)
            ->onQueue($this->queue->name)
            ->onConnection($this->queue->connection);

        return OptimizeResult::make(true, true, $data->id);

    }
}
