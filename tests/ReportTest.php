<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Analytics;
use GarrettMassey\Analytics\Reports\Reports;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportResponse;
use Mockery;
use Mockery\MockInterface;

class ReportTest extends TestCase
{
    public function test_report_methods_can_be_run(): void
    {
        $reportMethods = get_class_methods(Reports::class);
        foreach ($reportMethods as $reportMethod) {
            CarbonImmutable::setTestNow(CarbonImmutable::create(2022, 11, 21));

            $this->mock(BetaAnalyticsDataClient::class, function (MockInterface $mock) {
                $mock->shouldReceive('runReport')
                    ->with(Mockery::on(function (array $reportRequest) {
                        /** @var array{property: string, dateRanges: DateRange[], dimensions: Dimension[], metrics: Metric[]} $reportRequest */
                        $this->assertEquals('properties/'.'test123', $reportRequest['property']);

                        $this->assertCount(1, $reportRequest['dateRanges']);
                        $this->assertEquals('2022-10-22', $reportRequest['dateRanges'][0]->getStartDate());
                        $this->assertEquals('2022-11-21', $reportRequest['dateRanges'][0]->getEndDate());

                        $this->assertCount(1, $reportRequest['dimensions']);

                        $this->assertCount(1, $reportRequest['metrics']);

                        return true;
                    }))
                    ->once()
                    ->andReturn(new RunReportResponse());
            });

            Analytics::$reportMethod();
        }
    }
}
