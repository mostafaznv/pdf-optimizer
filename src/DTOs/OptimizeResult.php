<?php

namespace Mostafaznv\PdfOptimizer\DTOs;


class OptimizeResult
{
    public function __construct(
        public bool   $status,
        public string $message = '',
    ) {}


    public static function make(bool $status, string $message = ''): self
    {
        return new self($status, $message);
    }
}
