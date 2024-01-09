<?php

namespace Mostafaznv\PdfOptimizer\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mostafaznv\PdfOptimizer\Actions\OptimizePdfAction;
use Mostafaznv\PdfOptimizer\DTOs\PdfOptimizerJobData;
use Mostafaznv\PdfOptimizer\Events\PdfOptimizerJobFinished;


class PdfOptimizerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly PdfOptimizerJobData $data) {}


    public function handle(): void
    {
        $this->data->logger?->info("Job {$this->data->id} started.");

        $result = OptimizePdfAction::init($this->data->file, $this->data->disk)
            ->logger($this->data->logger)
            ->setTimeout($this->data->timeout)
            ->execute(
                $this->data->commands,
                $this->data->input,
                $this->data->output
            );

        event(
            new PdfOptimizerJobFinished($this->data->id, $result->status, $result->message)
        );

        if ($result->status) {
            $this->data->logger?->info('Job finished successfully.');
        }
        else {
            $this->data->logger?->error('Job finished with error.');

            $this->fail($result->message);
        }
    }
}
