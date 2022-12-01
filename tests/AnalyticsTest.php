<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use Exception;
use GarrettMassey\Analytics\Analytics;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportResponse;
use Google\ApiCore\ApiException;
use Mockery;
use Mockery\MockInterface;
use Spatie\LaravelData\Exceptions\InvalidDataCollectionOperation;

class AnalyticsTest extends TestCase
{
    public function test_default_constructor(): void
    {
        $this->assertInstanceOf(Analytics::class, new Analytics());
    }

    /**
     * @throws ApiException
     * @throws InvalidDataCollectionOperation
     */
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

        $responseData = Analytics::getTopEvents();

        $this->assertEquals(2, $responseData->rowCount);
        $this->assertCount(2, $responseData->rows);

        $this->assertEquals('eventName', $responseData->dimensionHeaders->first()?->name);
        $this->assertEquals('eventCount', $responseData->metricHeaders->first()?->name);
        $this->assertEquals('TYPE_INTEGER', $responseData->metricHeaders->first()?->type);

        $this->assertEquals('testEvent1', $responseData->rows->first()?->dimensionValues->first()?->value);
        $this->assertEquals('testEvent2', $responseData->rows->offsetGet(1)->dimensionValues->first()?->value);
        $this->assertEquals(222, $responseData->rows->first()?->metricValues->first()?->value);
        $this->assertEquals(111, $responseData->rows->offsetGet(1)->metricValues->first()?->value);

        $this->assertEquals('USD', $responseData->metadata->currencyCode);
        $this->assertEquals('UTC', $responseData->metadata->timeZone);
        $this->assertEquals('analyticsData#runReport', $responseData->kind);
    }

    public function test_property_string_is_empty_exception(): void
    {
        config()->set('analytics.credentials.file');
        config()->set('analytics.credentials.json', json_encode($this->credentials()));
        config()->set('analytics.property_id', null);

        $this->expectException(Exception::class);

        Analytics::query();
    }

    public function test_property_string_is_not_string_exception(): void
    {
        config()->set('analytics.credentials.file');
        config()->set('analytics.credentials.json', json_encode($this->credentials()));
        config()->set('analytics.property_id', 1234);

        $this->expectException(Exception::class);

        Analytics::query();
    }
}
