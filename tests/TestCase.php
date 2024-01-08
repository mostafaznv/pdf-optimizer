<?php

namespace Mostafaznv\PdfOptimizer\Tests;

use Mostafaznv\PdfOptimizer\PdfOptimizerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;


abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            PdfOptimizerServiceProvider::class,
        ];
    }


    public function getEnvironmentSetUp($app): void
    {
        config()->set('cache.default', 'array');
        config()->set('queue.default', 'database');

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);


        config()->set('filesystems.default', 'local');
        config()->set('filesystems.disks.local.driver', 'local');
        config()->set('filesystems.disks.local.root', public_path('uploads'));
        config()->set('filesystems.disks.local.url', config('app.url') . '/uploads');
        config()->set('filesystems.disks.local.visibility', 'public');

        config()->set('filesystems.disks.s3.driver', 's3');
        config()->set('filesystems.disks.s3.key', 'key');
        config()->set('filesystems.disks.s3.secret', 'secret');
        config()->set('filesystems.disks.s3.region', 'region-1');
        config()->set('filesystems.disks.s3.bucket', 'files');
        config()->set('filesystems.disks.s3.url', 'https://s3-storage.dev/uploads');
        config()->set('filesystems.disks.s3.endpoint', 'https://console.s3-storage.dev:9000');
    }
}
