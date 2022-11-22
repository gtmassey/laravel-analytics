<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Analytics;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Illuminate\Support\Facades\App;
use Mockery;
use Mockery\MockInterface;

class AnalyticsTest extends TestCase {

	/** @test */
	public function getClient_returns_GAClient()
	{
		Analytics::shouldReceive('getClient')
			->once()
			->andReturn(Mockery::mock(BetaAnalyticsDataClient::class));
	}

	/* public function test_get_top_events()
	{
		CarbonImmutable::setTestNow(CarbonImmutable::create(2022, 11, 21));

		$this->mock(BetaAnalyticsDataClient::class, function (MockInterface $mock) {
			$mock->shouldReceive('runReport')
				->with(Mockery::on(function (array $reportRequest) {
					$parsedReportRequest = $this->parseReportRequest($reportRequest);

					$this->assertEquals('properties/' . 'test123', $parsedReportRequest['property']);

					$this->assertCount(1, $parsedReportRequest['dateRanges']);
					$this->assertEquals('2022-10-22', $parsedReportRequest['dateRanges'][0]->getStartDate());
					$this->assertEquals('2022-11-21', $parsedReportRequest['dateRanges'][0]->getEndDate());

					$this->assertCount(1, $parsedReportRequest['dimensions']);
					$this->assertEquals('eventName', $parsedReportRequest['dimensions'][0]->getName());

					$this->assertCount(1, $parsedReportRequest['metrics']);
					$this->assertEquals('eventCount', $parsedReportRequest['metrics'][0]->getName());

					return true;
				}))
				->once();
		});

		//TODO: assert response
		Analytics::getTopEvents();
	} */


}
