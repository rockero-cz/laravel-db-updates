<?php

namespace Rockero\DatabaseUpdates\Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as Orchestra;
use Rockero\DatabaseUpdates\DatabaseUpdatesServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        File::getRequire(__DIR__.'/../database/migrations/create_database_updates_table.php.stub')->up();
    }

    protected function getPackageProviders($app): array
    {
        return [
            DatabaseUpdatesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }

    protected function runUpdates(): void
    {
        $this->artisan('db:update', [
            '--realpath' => __DIR__.'/Fixtures',
        ]);
    }
}
