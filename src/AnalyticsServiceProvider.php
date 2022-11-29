<?php

namespace GarrettMassey\Analytics;

use GarrettMassey\Analytics\Commands\AnalyticsCommand;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use InvalidArgumentException;
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
            ->hasConfigFile('analytics');

        $this->app->bind(BetaAnalyticsDataClient::class, function () {
            $credentials = $this->parseCredentials();

            return new BetaAnalyticsDataClient(['credentials' => $credentials]);
        });
    }

    private function parseCredentials(): ?array
    {
        if (getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
            return null;
        }

        if (($file = config('analytics.credentials.file')) !== null) {
            return $this->credentialsFile($file);
        }

        if (($json = config('analytics.credentials.json')) !== null) {
            return $this->credentialsJson($json);
        }

        return $this->credentialsArray();
    }

    private function credentialsFile(mixed $file): array
    {
        if (! is_string($file) || empty($file)) {
            throw new InvalidArgumentException('The credentials file path must be a non-empty string.');
        }

        $fileContents = file_get_contents($file);

        if ($fileContents === false) {
            throw new InvalidArgumentException('The credentials file could not be read.');
        }

        $credentials = json_decode($fileContents, true);

        if (! is_array($credentials)) {
            throw new InvalidArgumentException('The credentials file could not be decoded.');
        }

        return $credentials;
    }

    private function credentialsJson(mixed $json): array
    {
        if (! is_string($json) || empty($json)) {
            throw new InvalidArgumentException('The credentials JSON must be a non-empty string.');
        }

        $credentials = json_decode($json, true);

        if (! is_array($credentials)) {
            throw new InvalidArgumentException('The credentials JSON could not be decoded.');
        }

        return $credentials;
    }

    private function credentialsArray(): array
    {
        $credentials = config('analytics.credentials.array');

        if (! is_array($credentials)) {
            throw new InvalidArgumentException('The credentials array must be an array.');
        }

        return $credentials;
    }
}
