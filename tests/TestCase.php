<?php

namespace GarrettMassey\Analytics\Tests;

use GarrettMassey\Analytics\AnalyticsServiceProvider;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
	protected function getPackageProviders($app): array
	{
		return [
			AnalyticsServiceProvider::class,
		];
	}

	public function getEnvironmentSetUp($app)
	{
		config()->set('analytics.property_id', 'test123');
	}

	/**
	 * @param array $reportRequest
	 * @return array{property: string, dateRanges: DateRange[], dimensions: Dimension[], metrics: Metric[]}
	 */
	protected function parseReportRequest(array $reportRequest): array
	{
		return $reportRequest;
	}
}
