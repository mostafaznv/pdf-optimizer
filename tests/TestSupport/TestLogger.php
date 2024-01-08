<?php

namespace Mostafaznv\PdfOptimizer\Tests\TestSupport;

use Psr\Log\LoggerInterface;


class TestLogger implements LoggerInterface
{
    private array $logs    = [];
    private array $context = [];


    public function emergency($message, array $context = []): void
    {
        $this->logs[] = "emergency: $message";
        $this->updateContext($context);
    }

    public function alert($message, array $context = []): void
    {
        $this->logs[] = "alert: $message";
        $this->updateContext($context);
    }

    public function critical($message, array $context = []): void
    {
        $this->logs[] = "critical: $message";
        $this->updateContext($context);
    }

    public function error($message, array $context = []): void
    {
        $this->logs[] = "error: $message";
        $this->updateContext($context);
    }

    public function warning($message, array $context = []): void
    {
        $this->logs[] = "warning: $message";
        $this->updateContext($context);
    }

    public function notice($message, array $context = []): void
    {
        $this->logs[] = "notice: $message";
        $this->updateContext($context);
    }

    public function info($message, array $context = []): void
    {
        $this->logs[] = "info: $message";
        $this->updateContext($context);
    }

    public function debug($message, array $context = []): void
    {
        $this->logs[] = "debug: $message";
        $this->updateContext($context);
    }

    public function log($level, $message, array $context = []): void
    {
        $this->logs[] = "log: $message";
        $this->updateContext($context);
    }


    public function getLogs(): array
    {
        return $this->logs;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function reset(): self
    {
        $this->logs = [];
        $this->context = [];

        return $this;
    }

    private function updateContext(array $context): void
    {
        $this->context = array_merge($this->context, $context);
    }
}
