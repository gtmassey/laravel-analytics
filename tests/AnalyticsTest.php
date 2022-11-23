<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Analytics;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Mockery;
use Mockery\MockInterface;

class AnalyticsTest extends TestCase
{
    public function test_client_init_with_default_credentials_env(): void
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.storage_path('/framework/testing/disks/testing-storage/test-credentials.json'));
        config()->set('analytics.credentials.file');

        $this->assertInstanceOf(BetaAnalyticsDataClient::class, Analytics::query()->getClient());
        putenv('GOOGLE_APPLICATION_CREDENTIALS=');
    }

    public function test_client_init_with_credentials_file(): void
    {
        $this->assertInstanceOf(BetaAnalyticsDataClient::class, Analytics::query()->getClient());
    }

    public function test_client_init_with_credentials_json_string(): void
    {
        config()->set('analytics.credentials.file');
        config()->set('analytics.credentials.json', json_encode($this->credentials()));

        $this->assertInstanceOf(BetaAnalyticsDataClient::class, Analytics::query()->getClient());
    }

    public function test_client_init_with_credentials_array(): void
    {
        config()->set('analytics.credentials.file');
        config()->set('analytics.credentials.array', $this->credentials());

        $this->assertInstanceOf(BetaAnalyticsDataClient::class, Analytics::query()->getClient());
    }

    public function test_client_init_with_separate_credential_values(): void
    {
        config()->set('analytics.credentials.file');
        $credentials = $this->credentials();

        foreach ($credentials as $key => $value) {
            config()->set('analytics.credentials.array.'.$key, $value);
        }

        $this->assertInstanceOf(BetaAnalyticsDataClient::class, Analytics::query()->getClient());
    }

    public function test_get_top_events(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::create(2022, 11, 21));

        $this->mock(BetaAnalyticsDataClient::class, function (MockInterface $mock) {
            $mock->shouldReceive('runReport')
                ->with(Mockery::on(function (array $reportRequest) {
                    $parsedReportRequest = $this->parseReportRequest($reportRequest);

                    $this->assertEquals('properties/'.'test123', $parsedReportRequest['property']);

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
        Analytics::query()->getTopEvents();
    }
}
