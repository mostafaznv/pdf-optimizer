<?php

namespace Mostafaznv\PdfOptimizer\Events;

use Illuminate\Queue\SerializesModels;


class PdfOptimizerJobFinished
{
    use SerializesModels;

    public function __construct(
        public readonly string $id,
        public readonly bool   $status,
        public readonly string $message
    ) {}
}
