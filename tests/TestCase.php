<?php

namespace GarrettMassey\Analytics\Tests;

use GarrettMassey\Analytics\AnalyticsServiceProvider;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Illuminate\Support\Facades\Storage;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra {
	protected function getPackageProviders($app): array
	{
		return [
			AnalyticsServiceProvider::class,
		];
	}

	public function getEnvironmentSetUp($app)
	{
		Storage::fake('testing-storage');

		Storage::disk('testing-storage')
			->put('test-credentials.json', json_encode([
			'type'                        => 'service_account',
			'project_id'                  => 'bogus-project',
			'private_key_id'              => 'bogus-id',
			'private_key'                 => 'bogus-key',
			'client_email'                => 'bogus-user@bogus-app.iam.gserviceaccount.com',
			'client_id'                   => 'bogus-id',
			'auth_uri'                    => 'https://accounts.google.com/o/oauth2/auth',
			'token_uri'                   => 'https://accounts.google.com/o/oauth2/token',
			'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
			'client_x509_cert_url'        => 'https://www.googleapis.com/robot/v1/metadata/x509/bogus-ser%40bogus-app.iam.gserviceaccount.com',
		]));

		$credentialsPath = storage_path('/framework/testing/disks/testing-storage/');
		config()->set('analytics.property_id', 'test123');
		config()->set('analytics.credentials_path', $credentialsPath . 'test-credentials.json');
	}

	/**
	 * @param    array    $reportRequest
	 *
	 * @return array{property: string, dateRanges: DateRange[], dimensions: Dimension[], metrics: Metric[]}
	 */
	protected function parseReportRequest(array $reportRequest): array
	{
		return $reportRequest;
	}
}
