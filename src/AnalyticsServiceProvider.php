<?php

namespace GarrettMassey\Analytics;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use GarrettMassey\Analytics\Commands\AnalyticsCommand;

class AnalyticsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('analytics')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_analytics_table')
            ->hasCommand(AnalyticsCommand::class);
    }
}
