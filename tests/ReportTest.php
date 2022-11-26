<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Analytics;
use GarrettMassey\Analytics\Reports\Reports;
use GarrettMassey\Analytics\Response\ResponseData;
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

            $responseMock = $this->mock(RunReportResponse::class, function (MockInterface $mock) {
                $mock->shouldReceive('serializeToJsonString')
                    ->once()
                    ->andReturn(json_encode([
                        'dimensionHeaders' => [
                            [
                                'name' => 'eventName',
                            ],
                        ],
                        'metricHeaders' => [
                            [
                                'name' => 'eventCount',
                                'type' => 'TYPE_INTEGER',
                            ],
                        ],
                        'rows' => [
                            [
                                'dimensionValues' => [
                                    [
                                        'value' => 'testEvent1',
                                    ],
                                ],
                                'metricValues' => [
                                    [
                                        'value' => '222',
                                    ],
                                ],
                            ],
                            [
                                'dimensionValues' => [
                                    [
                                        'value' => 'testEvent2',
                                    ],
                                ],
                                'metricValues' => [
                                    [
                                        'value' => '111',
                                    ],
                                ],
                            ],
                        ],
                        'totals' => [
                            [
                                'dimensionValues' => [
                                    [
                                        'value' => 'RESERVED_TOTAL',
                                    ],
                                ],
                                'metricValues' => [
                                    [
                                        'value' => '333',
                                    ],
                                ],
                            ],
                        ],
                        'rowCount' => 2,
                        'metadata' => [
                            'currencyCode' => 'USD',
                            'timeZone' => 'UTC',
                        ],
                        'kind' => 'analyticsData#runReport',
                    ]));
            });

            $this->mock(BetaAnalyticsDataClient::class, function (MockInterface $mock) use ($responseMock) {
                $mock->shouldReceive('runReport')
                    ->with(Mockery::on(function (array $reportRequest) {
                        /** @var array{property: string, dateRanges: DateRange[], dimensions: Dimension[], metrics: Metric[]} $reportRequest */
                        $this->assertEquals('properties/'.'test123', $reportRequest['property']);

                        $this->assertCount(1, $reportRequest['dateRanges']);
                        $this->assertEquals('2022-10-22', $reportRequest['dateRanges'][0]->getStartDate());
                        $this->assertEquals('2022-11-21', $reportRequest['dateRanges'][0]->getEndDate());

                        $this->assertCount(1, $reportRequest['dimensions']);
                        $this->assertEquals('eventName', $reportRequest['dimensions'][0]->getName());

                        $this->assertCount(1, $reportRequest['metrics']);
                        $this->assertEquals('eventCount', $reportRequest['metrics'][0]->getName());

                        return true;
                    }))
                    ->once()
                    ->andReturn($responseMock);
            });

            $this->assertInstanceOf(ResponseData::class, Analytics::$reportMethod());
        }
    }
}
