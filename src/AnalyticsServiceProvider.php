<?php

namespace GarrettMassey\Analytics;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Illuminate\Foundation\Application;
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
            ->hasConfigFile('analytics')
            ->hasCommand(AnalyticsCommand::class);

		$this->app->bind(BetaAnalyticsDataClient::class, function () {
			if (getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
				$credentials = null;
			} elseif (config('analytics.credentials.file') !== null) {
				$credentials = json_decode(file_get_contents(config('analytics.credentials.file')), true);
			} elseif (config('analytics.credentials.json') !== null) {
				$credentials = json_decode(config('analytics.credentials.json'), true);
			} else {
				$credentials = config('analytics.credentials.array');
			}

			return new BetaAnalyticsDataClient(['credentials' => $credentials]);
		});
    }
}
