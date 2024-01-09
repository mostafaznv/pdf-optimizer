<?php

namespace Mostafaznv\PdfOptimizer\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Mostafaznv\PdfOptimizer\PdfOptimizerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;


abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

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

    protected function setUpDatabase(Application $app): void
    {
        $app['db']->connection()
            ->getSchemaBuilder()
            ->create('jobs', function(Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('queue')->index();
                $table->longText('payload');
                $table->unsignedTinyInteger('attempts');
                $table->unsignedInteger('reserved_at')->nullable();
                $table->unsignedInteger('available_at');
                $table->unsignedInteger('created_at');
            });

        $app['db']->connection()
            ->getSchemaBuilder()
            ->create('failed_jobs', function(Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
    }
}
