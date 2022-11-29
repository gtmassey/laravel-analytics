<?php

namespace GarrettMassey\Analytics;

use Exception;
use GarrettMassey\Analytics\Parameters\Dimensions;
use GarrettMassey\Analytics\Parameters\Metrics;
use GarrettMassey\Analytics\Reports\Reports;
use GarrettMassey\Analytics\Response\ResponseData;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\MetricAggregation;
use Google\Analytics\Data\V1beta\RunReportResponse;
use Google\ApiCore\ApiException;
use Illuminate\Support\Collection;

class Analytics
{
    use Reports;

    //TODO: clean up class, add comments
    //TODO: add support for remaining metrics and dimensions
    //TODO: add generic report generation (i.e. things like getUsersAndPageViews($period) )
    public string $viewId;

    public string $propertyID;

    /** @var Collection<int, Dimension> */
    public Collection $dimensions;

    /** @var Collection<int, Metric> */
    public Collection $metrics;

    /** @var Collection<int, DateRange> */
    public Collection $dateRanges;

    public string $dimensionsFilter;

    public string $metricsFilter;

    public string $orderBys;

    public string $limit;

    public string $offset;

    public string $currencyCode;

    public string $cohortSpec;

    public bool $keepEmptyRows;

    public bool $returnPropertyQuota;

    public BetaAnalyticsDataClient $client;

    public function __construct()
    {
        $this->client = resolve(BetaAnalyticsDataClient::class);

        $propertyId = config('analytics.property_id');

        if (! is_string($propertyId) || empty($propertyId)) {
            throw new Exception('Property ID is not set.');
        }

        $this->propertyID = $propertyId;
        $this->dimensions = new Collection();
        $this->metrics = new Collection();
        $this->dateRanges = new Collection();
    }

    public static function query(): self
    {
        return resolve(Analytics::class);
    }

    public function getClient(): BetaAnalyticsDataClient
    {
        return $this->client;
    }

    /****************************************
     * Query Builders
     ****************************************/

    /**
     * Ability to add metrics to the query using a callback method
     * for example:
     * $query->setMetrics(function ($q) { $q->sessions(); $q->bounceRate(); });
     *
     * @param  callable  $callback
     * @return $this
     */
    public function setMetrics(callable $callback): static
    {
        $metrics = $callback(new Metrics());
        $this->metrics = $metrics->getMetrics();

        return $this;
    }

    /**
     * Ability to add dimensions to the query using a callback method
     * for example:
     * $query->setDimensions(function ($q) { $q->pageTitle(); $q->pagePath(); });
     *
     * @param  callable  $callback
     * @return $this
     */
    public function setDimensions(callable $callback): static
    {
        $dimensions = $callback(new Dimensions());
        $this->dimensions = $dimensions->getDimensions();

        return $this;
    }

    /**
     * Add a date range to the query, required for most queries
     *
     * @param  Period  $period
     * @return $this
     */
    public function forPeriod(Period $period): static
    {
        $this->dateRanges->push($period->getDateRange());

        return $this;
    }

    /****************************************
     * Process and Run Query
     ****************************************/

    /**
     * @throws ApiException
     */
    public function run(): ResponseData
    {
        $requestArgs = $this->buildQueryArray();

        $reportResponse = $this->client->runReport($requestArgs);

        return $this->toResponse($reportResponse);
    }

    /**
     * @return array{property: string, dateRanges: DateRange[], dimensions: Dimension[], metrics: Metric[]}
     */
    private function buildQueryArray(): array
    {
        $dimensions = collect(['dimensions' => $this->dimensions]);
        $metrics = collect(['metrics' => $this->metrics]);
        $dateRanges = collect(['dateRanges' => $this->dateRanges]);
        $resource = collect(
            $dateRanges->merge(
                $dimensions->merge(
                    $metrics
                )
            )
        );
        $request = collect(['property' => 'properties/'.$this->propertyID]);
        $request = $request->merge($resource);
//        $request->offsetSet('metricAggregations', [MetricAggregation::TOTAL]);
//        $request->offsetSet('returnPropertyQuota', true);
        //get the last error message from json
        //ddd($request->toArray());

        /** @var array{property: string, dateRanges: DateRange[], dimensions: Dimension[], metrics: Metric[]} $requestArgs */
        $requestArgs = $request->toArray();

        return $requestArgs;
    }

    private function toResponse(RunReportResponse $reportResponse): ResponseData
    {
        $json = $reportResponse->serializeToJsonString();

        $report = json_decode($json, true);

        return ResponseData::from($report);
    }
}
