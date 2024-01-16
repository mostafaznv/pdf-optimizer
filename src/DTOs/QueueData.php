<?php

namespace Mostafaznv\PdfOptimizer\DTOs;


readonly class QueueData
{
    public function __construct(
        public bool    $enabled = false,
        public string  $name = 'default',
        public ?string $connection = null,
        public int     $timeout = 900
    ) {}

    public static function make(bool $enabled = false, string $name = 'default', ?string $connection = null, int $timeout = 900): self
    {
        return new self($enabled, $name, $connection, $timeout);
    }
}
