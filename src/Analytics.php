<?php

namespace Gtmassey\LaravelAnalytics;

use Closure;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\ApiCore\ApiException;
use Gtmassey\LaravelAnalytics\Exceptions\InvalidPropertyIdException;
use Gtmassey\LaravelAnalytics\Reports\Reports;
use Gtmassey\LaravelAnalytics\Request\Dimensions;
use Gtmassey\LaravelAnalytics\Request\Metrics;
use Gtmassey\LaravelAnalytics\Request\RequestData;
use Gtmassey\LaravelAnalytics\Response\ResponseData;

class Analytics
{
    use Reports;

    private BetaAnalyticsDataClient $client;

    private RequestData $requestData;

    /**
     * @throws InvalidPropertyIdException
     */
    public function __construct()
    {
        $propertyId = config('analytics.property_id');

        if (! is_string($propertyId) || empty($propertyId)) {
            throw InvalidPropertyIdException::invalidPropertyId();
        }

        $this->client = resolve(BetaAnalyticsDataClient::class);
        $this->requestData = new RequestData(propertyId: $propertyId);
    }

    public static function query(): self
    {
        return resolve(Analytics::class);
    }

    /****************************************
     * Query Builders
     ****************************************/

    /**
     * Ability to add metrics to the query using a callback method
     * for example:
     * $query->setMetrics(function (Metrics $metrics) { $metrics->sessions()->bounceRate(); });
     *
     * @param  Closure(Metrics): Metrics  $callback
     * @return static
     */
    public function setMetrics(Closure $callback): static
    {
        $metrics = $callback(new Metrics());
        $this->requestData->metrics->push(...$metrics->getMetrics());

        return $this;
    }

    /**
     * Ability to add dimensions to the query using a callback method
     * for example:
     * $query->setDimensions(function (Dimensions $dimensions) { $dimensions->pageTitle()->pagePath(); });
     *
     * @param  Closure(Dimensions): Dimensions  $callback
     * @return $this
     */
    public function setDimensions(Closure $callback): static
    {
        $dimensions = $callback(new Dimensions());
        $this->requestData->dimensions->push(...$dimensions->getDimensions());

        return $this;
    }

    public function forPeriod(Period $period): static
    {
        $this->requestData->dateRanges->push($period->getDateRange());

        return $this;
    }

    public function withTotals(bool $useTotals = true): static
    {
        $this->requestData->useTotals = $useTotals;

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
        $reportResponse = $this->client->runReport($this->requestData->toArray());

        return ResponseData::fromReportResponse($reportResponse);
    }
}
