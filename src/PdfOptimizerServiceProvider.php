<?php

namespace Mostafaznv\PdfOptimizer;

use Illuminate\Support\ServiceProvider;


class PdfOptimizerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('pdf-optimizer.php')], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'pdf-optimizer');
    }
}
