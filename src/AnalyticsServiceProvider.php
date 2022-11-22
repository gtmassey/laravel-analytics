<?php

namespace GarrettMassey\Analytics;

use GarrettMassey\Analytics\Commands\AnalyticsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile('analytics')
            ->hasCommand(AnalyticsCommand::class);
    }
}
