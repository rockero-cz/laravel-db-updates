<?php

namespace Rockero\DatabaseUpdates;

use Rockero\DatabaseUpdates\Commands\MakeUpdateCommand;
use Rockero\DatabaseUpdates\Commands\UpdateDatabaseCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DatabaseUpdatesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('db-updates')
            ->hasMigration('create_database_updates_table')
            ->hasCommand(UpdateDatabaseCommand::class)
            ->hasCommand(MakeUpdateCommand::class);
    }
}
