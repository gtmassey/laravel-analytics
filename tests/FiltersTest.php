<?php

namespace Gtmassey\LaravelAnalytics\Tests;

use Gtmassey\LaravelAnalytics\Analytics;
use Gtmassey\LaravelAnalytics\Exceptions\InvalidFilterException;
use Gtmassey\LaravelAnalytics\Request\Dimensions;
use Gtmassey\LaravelAnalytics\Request\Filters\Filter;
use Gtmassey\LaravelAnalytics\Request\Filters\FilterExpression;
use Gtmassey\LaravelAnalytics\Request\Filters\FilterExpressionList;
use Gtmassey\LaravelAnalytics\Request\Metrics;
use Gtmassey\LaravelAnalytics\Request\RequestData;
use ReflectionProperty;

class FiltersTest extends TestCase
{
    public function test_filter_dimension_string_exact(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->exact('Chrome')
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'EXACT',
                    'value' => 'Chrome',
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_exact_case_sensitive(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->exact('Chrome', true)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'EXACT',
                    'value' => 'Chrome',
                    'caseSensitive' => true,
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_begins_with(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->beginsWith('Safari')
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'BEGINS_WITH',
                    'value' => 'Safari',
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_begins_with_case_sensitive(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->beginsWith('Safari', true)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'BEGINS_WITH',
                    'value' => 'Safari',
                    'caseSensitive' => true,
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_ends_with(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->endsWith('fox')
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'ENDS_WITH',
                    'value' => 'fox',
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_ends_with_case_sensitive(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->endsWith('fox', true)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'ENDS_WITH',
                    'value' => 'fox',
                    'caseSensitive' => true,
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_contains(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->contains('fox')
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'CONTAINS',
                    'value' => 'fox',
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_contains_case_sensitive(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->contains('fox', true)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'CONTAINS',
                    'value' => 'fox',
                    'caseSensitive' => true,
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_full_regexp(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->fullRegexp('/Firefox/')
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'FULL_REGEXP',
                    'value' => '/Firefox/',
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_full_regexp_case_sensitive(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->fullRegexp('/Firefox/', true)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'FULL_REGEXP',
                    'value' => '/Firefox/',
                    'caseSensitive' => true,
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_partial_regexp(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->partialRegexp('/fox/')
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'PARTIAL_REGEXP',
                    'value' => '/fox/',
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_partial_regexp_case_sensitive(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->partialRegexp('/fox/', true)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'PARTIAL_REGEXP',
                    'value' => '/fox/',
                    'caseSensitive' => true,
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_in_list(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->inList(['Firefox', 'Chrome'])
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'inListFilter' => [
                    'values' => ['Firefox', 'Chrome'],
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_filter_dimension_string_in_list_case_sensitive(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('browser', fn (Filter $filter) => $filter
                    ->inList(['Firefox', 'Chrome'], true)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'inListFilter' => [
                    'values' => ['Firefox', 'Chrome'],
                    'caseSensitive' => true,
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    /**
     * @throws InvalidFilterException
     */
    public function test_filter_dimension_object_string_exact(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filterDimension(
                    dimensionsCallback: fn (Dimensions $dimensions) => $dimensions->browser(),
                    filter: fn (Filter $filter) => $filter->exact('Chrome')
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'browser',
                'stringFilter' => [
                    'matchType' => 'EXACT',
                    'value' => 'Chrome',
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_invalid_dimension_filter(): void
    {
        $this->expectException(InvalidFilterException::class);
        $this->expectExceptionMessage(InvalidFilterException::NO_DIMENSION_FILTER);

        Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filterDimension(
                    dimensionsCallback: fn (Dimensions $dimensions) => $dimensions,
                    filter: fn (Filter $filter) => $filter->exact('Chrome')
                )
            );
    }

    public function test_filter_metric_equal_int(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('sessions', fn (Filter $filter) => $filter
                    ->equalInt(100)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'sessions',
                'numericFilter' => [
                    'operation' => 'EQUAL',
                    'value' => [
                        'int64Value' => '100',
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_equal_float(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('eventsPerSession', fn (Filter $filter) => $filter
                    ->equalFloat(1.23)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'eventsPerSession',
                'numericFilter' => [
                    'operation' => 'EQUAL',
                    'value' => [
                        'doubleValue' => 1.23,
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_less_than_int(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('sessions', fn (Filter $filter) => $filter
                    ->lessThanInt(100)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'sessions',
                'numericFilter' => [
                    'operation' => 'LESS_THAN',
                    'value' => [
                        'int64Value' => '100',
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_less_than_float(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('eventsPerSession', fn (Filter $filter) => $filter
                    ->lessThanFloat(1.23)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'eventsPerSession',
                'numericFilter' => [
                    'operation' => 'LESS_THAN',
                    'value' => [
                        'doubleValue' => 1.23,
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_less_than_or_equal_int(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('sessions', fn (Filter $filter) => $filter
                    ->lessThanOrEqualInt(100)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'sessions',
                'numericFilter' => [
                    'operation' => 'LESS_THAN_OR_EQUAL',
                    'value' => [
                        'int64Value' => '100',
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_less_than_or_equal_float(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('eventsPerSession', fn (Filter $filter) => $filter
                    ->lessThanOrEqualFloat(1.23)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'eventsPerSession',
                'numericFilter' => [
                    'operation' => 'LESS_THAN_OR_EQUAL',
                    'value' => [
                        'doubleValue' => 1.23,
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_greater_than_int(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('sessions', fn (Filter $filter) => $filter
                    ->greaterThanInt(100)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'sessions',
                'numericFilter' => [
                    'operation' => 'GREATER_THAN',
                    'value' => [
                        'int64Value' => '100',
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_greater_than_float(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('eventsPerSession', fn (Filter $filter) => $filter
                    ->greaterThanFloat(1.23)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'eventsPerSession',
                'numericFilter' => [
                    'operation' => 'GREATER_THAN',
                    'value' => [
                        'doubleValue' => 1.23,
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_greater_than_or_equal_int(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('sessions', fn (Filter $filter) => $filter
                    ->greaterThanOrEqualInt(100)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'sessions',
                'numericFilter' => [
                    'operation' => 'GREATER_THAN_OR_EQUAL',
                    'value' => [
                        'int64Value' => '100',
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_greater_than_or_equal_float(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('eventsPerSession', fn (Filter $filter) => $filter
                    ->greaterThanOrEqualFloat(1.23)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'eventsPerSession',
                'numericFilter' => [
                    'operation' => 'GREATER_THAN_OR_EQUAL',
                    'value' => [
                        'doubleValue' => 1.23,
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_between_int(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('sessions', fn (Filter $filter) => $filter
                    ->betweenInt(100, 200)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'sessions',
                'betweenFilter' => [
                    'fromValue' => [
                        'int64Value' => '100',
                    ],
                    'toValue' => [
                        'int64Value' => '200',
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_filter_metric_between_float(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filter('eventsPerSession', fn (Filter $filter) => $filter
                    ->betweenFloat(1.23, 2.34)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'eventsPerSession',
                'betweenFilter' => [
                    'fromValue' => [
                        'doubleValue' => 1.23,
                    ],
                    'toValue' => [
                        'doubleValue' => 2.34,
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    /**
     * @throws InvalidFilterException
     */
    public function test_filter_metric_object_equal_int(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filterMetric(
                    metricsCallback: fn (Metrics $metrics) => $metrics->sessions(),
                    filter: fn (Filter $filter) => $filter->equalInt(100)
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'filter' => [
                'fieldName' => 'sessions',
                'numericFilter' => [
                    'operation' => 'EQUAL',
                    'value' => [
                        'int64Value' => '100',
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    public function test_invalid_metric_filter(): void
    {
        $this->expectException(InvalidFilterException::class);
        $this->expectExceptionMessage(InvalidFilterException::NO_METRIC_FILTER);

        Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->filterMetric(
                    metricsCallback: fn (Metrics $metrics) => $metrics,
                    filter: fn (Filter $filter) => $filter->equalInt(100)
                )
            );
    }

    public function test_filter_not_expression(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->not(fn (FilterExpression $filterExpression) => $filterExpression
                    ->filter('browser', fn (Filter $filter) => $filter
                        ->exact('Chrome')
                    )
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'notExpression' => [
                'filter' => [
                    'fieldName' => 'browser',
                    'stringFilter' => [
                        'matchType' => 'EXACT',
                        'value' => 'Chrome',
                    ],
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    /**
     * @throws InvalidFilterException
     */
    public function test_filter_and_group_expression_list(): void
    {
        $analytics = Analytics::query()
            ->metricFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->andGroup(fn (FilterExpressionList $filterExpressionList) => $filterExpressionList
                    ->filter('sessions', fn (Filter $filter) => $filter
                        ->greaterThanInt(100)
                    )
                    ->filterMetric(
                        metricsCallback: fn (Metrics $metrics) => $metrics->totalUsers(),
                        filter: fn (Filter $filter) => $filter->lessThanInt(100)
                    )
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $metricFilter = $requestData->metricFilter?->toRequest();

        $this->assertNotNull($metricFilter);

        $this->assertEquals([
            'andGroup' => [
                'expressions' => [
                    [
                        'filter' => [
                            'fieldName' => 'sessions',
                            'numericFilter' => [
                                'operation' => 'GREATER_THAN',
                                'value' => [
                                    'int64Value' => '100',
                                ],
                            ],
                        ],
                    ],
                    [
                        'filter' => [
                            'fieldName' => 'totalUsers',
                            'numericFilter' => [
                                'operation' => 'LESS_THAN',
                                'value' => [
                                    'int64Value' => '100',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], json_decode($metricFilter->serializeToJsonString(), true));
    }

    /**
     * @throws InvalidFilterException
     */
    public function test_filter_or_group_expression_list(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->orGroup(fn (FilterExpressionList $filterExpressionList) => $filterExpressionList
                    ->filter('browser', fn (Filter $filter) => $filter
                        ->exact('Chrome')
                    )
                    ->filterDimension(
                        dimensionsCallback: fn (Dimensions $dimensions) => $dimensions->deviceCategory(),
                        filter: fn (Filter $filter) => $filter->exact('Mobile')
                    )
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'orGroup' => [
                'expressions' => [
                    [
                        'filter' => [
                            'fieldName' => 'browser',
                            'stringFilter' => [
                                'matchType' => 'EXACT',
                                'value' => 'Chrome',
                            ],
                        ],
                    ],
                    [
                        'filter' => [
                            'fieldName' => 'deviceCategory',
                            'stringFilter' => [
                                'matchType' => 'EXACT',
                                'value' => 'Mobile',
                            ],
                        ],
                    ],
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }

    public function test_nested_filters(): void
    {
        $analytics = Analytics::query()
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->orGroup(fn (FilterExpressionList $filterExpressionList) => $filterExpressionList
                    ->andGroup(fn (FilterExpressionList $filterExpressionList) => $filterExpressionList
                        ->not(fn (FilterExpression $filterExpression) => $filterExpression
                            ->filter('browser', fn (Filter $filter) => $filter
                                ->exact('Chrome')
                            )
                        )
                        ->orGroup(fn (FilterExpressionList $filterExpressionList) => $filterExpressionList
                            ->filter('browser', fn (Filter $filter) => $filter
                                ->exact('Firefox')
                            )
                            ->filter('browser', fn (Filter $filter) => $filter
                                ->exact('Safari')
                            )
                        )
                    )
                )
            );

        $this->assertInstanceOf(Analytics::class, $analytics);

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        $dimensionFilter = $requestData->dimensionFilter?->toRequest();

        $this->assertNotNull($dimensionFilter);

        $this->assertEquals([
            'orGroup' => [
                'expressions' => [
                    [
                        'andGroup' => [
                            'expressions' => [
                                [
                                    'notExpression' => [
                                        'filter' => [
                                            'fieldName' => 'browser',
                                            'stringFilter' => [
                                                'matchType' => 'EXACT',
                                                'value' => 'Chrome',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'orGroup' => [
                                        'expressions' => [
                                            [
                                                'filter' => [
                                                    'fieldName' => 'browser',
                                                    'stringFilter' => [
                                                        'matchType' => 'EXACT',
                                                        'value' => 'Firefox',
                                                    ],
                                                ],
                                            ],
                                            [
                                                'filter' => [
                                                    'fieldName' => 'browser',
                                                    'stringFilter' => [
                                                        'matchType' => 'EXACT',
                                                        'value' => 'Safari',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ], json_decode($dimensionFilter->serializeToJsonString(), true));
    }
}
