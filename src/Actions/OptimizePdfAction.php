<?php

namespace Mostafaznv\PdfOptimizer\Actions;

use Mostafaznv\PdfOptimizer\DTOs\OptimizeResult;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\Disk;
use Mostafaznv\PdfOptimizer\Laravel\Concerns\File;
use Mostafaznv\PdfOptimizer\PdfOptimizerLogger;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;


class OptimizePdfAction
{
    private readonly ?File $file;
    private readonly ?Disk $outputDisk;

    private int             $timeout = 60;
    private LoggerInterface $logger;


    public function __construct(?File $file = null, ?Disk $outputDisk = null)
    {
        $this->file = $file;
        $this->outputDisk = $outputDisk;

        $this->logger(new PdfOptimizerLogger);
    }

    public static function init(File $file = null, Disk $outputDisk = null): self
    {
        return new self($file, $outputDisk);
    }


    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function execute(array $command, string $input, string $output): OptimizeResult
    {
        $this->logger->info('Start optimizing');

        $originalOutput = $output;
        [$input, $output] = $this->io($input, $output);

        $command = $this->command($command, $input, $output);

        $process = new Process($command);
        $process->setTimeout($this->timeout);
        $process->run();

        $status = $process->isSuccessful();

        if ($status) {
            $this->store($output, $originalOutput);
        }

        $this->cleanup();
        $this->logResult($process);

        return OptimizeResult::make(
            status: $status,
            message: !$status ? $process->getErrorOutput() : ''
        );
    }

    public function logger(?LoggerInterface $logger): self
    {
        if ($logger) {
            $this->logger = $logger;
        }

        return $this;
    }

    private function io(string $input, string $output): array
    {
        if ($this->file) {
            $input = $this->file->getLocalPath();
        }
        if ($this->outputDisk?->getAdapter()) {
            $output = $this->outputDisk->isLocalDisk()
                ? $this->outputDisk->getAdapter()->path($output)
                : $this->outputDisk->getTemporaryDisk()->path($output);
        }

        $this->logger->info("Input: $input", [
            'input' => $input,
        ]);

        $this->logger->info("Output: $output", [
            'output' => $output,
        ]);

        return [$input, $output];
    }

    private function command(array $command, string $input, string $output): array
    {
        if ($output) {
            $exists = false;

            foreach ($command as $value) {
                if (str_starts_with($value, '-sOutputFile')) {
                    $exists = true;
                }
            }

            if (!$exists) {
                $command[] = "-sOutputFile=$output";
            }
        }

        if ($input) {
            $exists = false;

            foreach ($command as $value) {
                if (str_ends_with($value, '.pdf') and !str_starts_with($value, '-sOutputFile')) {
                    $exists = true;
                }
            }

            if (!$exists) {
                $command[] = $input;
            }
        }

        $this->logger->info('Command: ' . implode(', ', $command), [
            'command' => $command,
        ]);

        return $command;
    }

    private function store(string $output, string $originalOutput): void
    {
        if ($this->outputDisk?->getAdapter()) {
            if (!$this->outputDisk->isLocalDisk()) {
                $this->logger->info('Store optimized file to remote disk', [
                    'path' => $originalOutput
                ]);

                $this->outputDisk->getAdapter()->writeStream(
                    $originalOutput,
                    fopen($output, 'r')
                );
            }
        }
    }

    private function cleanup(): void
    {
        $this->logger->info('Cleanup temporary files');

        $this->file?->cleanup();
        $this->outputDisk?->cleanupTemporaryDirectory();
    }

    private function logResult(Process $process): void
    {
        if (!$process->isSuccessful()) {
            $this->logger->error('Process ended with error', [
                'output_log'       => $process->getOutput(),
                'error_output_log' => $process->getErrorOutput()
            ]);

            return;
        }

        $this->logger->info('Process successfully ended', [
            'output_log' => $process->getOutput()
        ]);
    }
}
