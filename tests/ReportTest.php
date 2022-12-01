<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Analytics;
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
    public function test_get_top_events(): void
    {
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

        $this->assertInstanceOf(ResponseData::class, Analytics::getTopEvents());
    }

    public function test_get_user_acquisition_overview(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::create(2022, 11, 21));

        $responseMock = $this->mock(RunReportResponse::class, function (MockInterface $mock) {
            $mock->shouldReceive('serializeToJsonString')
                ->once()
                ->andReturn(json_encode([
                    'dimensionHeaders' => [
                        [
                            'name' => 'firstUserDefaultChannelGroup',
                        ],
                    ],
                    'metricHeaders' => [
                        [
                            'name' => 'sessions',
                            'type' => 'TYPE_INTEGER',
                        ],
                    ],
                    'rows' => [
                        [
                            'dimensionValues' => [
                                [
                                    'value' => 'Direct',
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
                                    'value' => 'Referral',
                                ],
                            ],
                            'metricValues' => [
                                [
                                    'value' => '111',
                                ],
                            ],
                        ],
                        [
                            'dimensionValues' => [
                                [
                                    'value' => 'Organic Search',
                                ],
                            ],
                            'metricValues' => [
                                [
                                    'value' => '111',
                                ],
                            ],
                        ],
                        [
                            'dimensionValues' => [
                                [
                                    'value' => 'Organic Social',
                                ],
                            ],
                            'metricValues' => [
                                [
                                    'value' => '111',
                                ],
                            ],
                        ],
                    ],
                    'rowCount' => 4,
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
                    $this->assertEquals('firstUserDefaultChannelGroup', $reportRequest['dimensions'][0]->getName());

                    $this->assertCount(1, $reportRequest['metrics']);
                    $this->assertEquals('sessions', $reportRequest['metrics'][0]->getName());

                    return true;
                }))
                ->once()
                ->andReturn($responseMock);
        });

        $this->assertInstanceOf(ResponseData::class, Analytics::getUserAcquisitionOverview());
    }

    public function test_get_top_pages(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::create(2022, 11, 21));

        $responseMock = $this->mock(RunReportResponse::class, function (MockInterface $mock) {
            $mock->shouldReceive('serializeToJsonString')
                ->once()
                ->andReturn(json_encode([
                    'dimensionHeaders' => [
                        [
                            'name' => 'pageTitle',
                        ],
                    ],
                    'metricHeaders' => [
                        [
                            'name' => 'sessions',
                            'type' => 'TYPE_INTEGER',
                        ],
                    ],
                    'rows' => [
                        [
                            'dimensionValues' => [
                                [
                                    'value' => 'Page Title 1',
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
                                    'value' => 'Page Title 2',
                                ],
                            ],
                            'metricValues' => [
                                [
                                    'value' => '111',
                                ],
                            ],
                        ],
                        [
                            'dimensionValues' => [
                                [
                                    'value' => 'Page Title 3',
                                ],
                            ],
                            'metricValues' => [
                                [
                                    'value' => '111',
                                ],
                            ],
                        ],
                    ],
                    'rowCount' => 3,
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
                    $this->assertEquals('pageTitle', $reportRequest['dimensions'][0]->getName());

                    $this->assertCount(1, $reportRequest['metrics']);
                    $this->assertEquals('sessions', $reportRequest['metrics'][0]->getName());

                    return true;
                }))
                ->once()
                ->andReturn($responseMock);
        });

        $this->assertInstanceOf(ResponseData::class, Analytics::getTopPages());
    }

    public function test_get_user_engagement(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::create(2022, 11, 21));

        $responseMock = $this->mock(RunReportResponse::class, function (MockInterface $mock) {
            $mock->shouldReceive('serializeToJsonString')
                ->once()
                ->andReturn(json_encode([
                    'metricHeaders' => [
                        [
                            'name' => 'averageSessionDuration',
                            'type' => 'TYPE_SECONDS',
                        ],
                        [
                            'name' => 'engagedSessions',
                            'type' => 'TYPE_INTEGER',
                        ],
                        [
                            'name' => 'sessionsPerUser',
                            'type' => 'TYPE_FLOAT',
                        ],
                        [
                            'name' => 'sessions',
                            'type' => 'TYPE_INTEGER',
                        ],
                    ],
                    'rows' => [
                        [
                            'metricValues' => [
                                [
                                    'value' => '386.96577397089948',
                                ],
                                [
                                    'value' => '256',
                                ],
                                [
                                    'value' => '1.5555555555555556',
                                ],
                                [
                                    'value' => '378',
                                ],
                            ],
                        ],
                    ],
                    'rowCount' => 4,
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

                    $this->assertCount(4, $reportRequest['metrics']);
                    $this->assertEquals('averageSessionDuration', $reportRequest['metrics'][0]->getName());
                    $this->assertEquals('engagedSessions', $reportRequest['metrics'][1]->getName());
                    $this->assertEquals('sessionsPerUser', $reportRequest['metrics'][2]->getName());
                    $this->assertEquals('sessions', $reportRequest['metrics'][3]->getName());

                    return true;
                }))
                ->once()
                ->andReturn($responseMock);
        });

        $this->assertInstanceOf(ResponseData::class, Analytics::getUserEngagement());
    }
}
