<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Facades\Analytics;
use GarrettMassey\Analytics\Reports\Reports;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Mockery;
use Mockery\MockInterface;

class ReportTest extends TestCase
{
    public function test_method_does_not_exist_exception()
    {
        $this->expectException(\GarrettMassey\Analytics\Exceptions\ReportException::class);
        $report = Analytics::undefinedMethodTest();
    }

    public function test_report_methods_can_be_run()
    {
        $reportMethods = get_class_methods(Reports::class);
        foreach ($reportMethods as $reportMethod) {
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

                        $this->assertCount(1, $parsedReportRequest['metrics']);

                        return true;
                    }))
                    ->once();
            });

            $report = Analytics::$reportMethod();
        }
    }
}
