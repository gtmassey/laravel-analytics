<?php

namespace GarrettMassey\Analytics;

use GarrettMassey\Analytics\Exceptions\ReportException;
use GarrettMassey\Analytics\Parameters\Dimensions;
use GarrettMassey\Analytics\Parameters\Metrics;
use GarrettMassey\Analytics\Reports\Reports;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Illuminate\Support\Collection;

class Analytics
{
    //TODO: clean up class, add comments
    //TODO: add support for remaining metrics and dimensions
    //TODO: add generic report generation (i.e. things like getUsersAndPageViews($period) )
    public string $viewId;

    public string $propertyID;

    public Collection $dimensions;

    public Collection $metrics;

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
        $this->propertyID = config('analytics.property_id');
        $this->dimensions = collect([]);
        $this->metrics = collect([]);
        $this->dateRanges = collect([]);
    }

    /**
     * @throws ReportException
     */
    public function __call($name, $arguments)
    {
        //if arguments is an empty array
        if (empty($arguments)) {
            //if the method exists in the Reports class
            if (method_exists(Reports::class, $name)) {
                //call the method and return the result
                return Reports::$name(null);
            } else {
                //otherwise, throw an exception
                throw ReportException::doesNotExist($name);
            }
        } else {
            if (method_exists(Reports::class, $name)) {
                //call the method and return the result
                return Reports::$name($arguments);
            } else {
                //otherwise, throw an exception
                throw ReportException::doesNotExist($name);
            }
        }
    }

    public static function query(): Analytics
    {
        return new Analytics();
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
    public function setMetrics(callable $callback)
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
    public function setDimensions(callable $callback)
    {
        $dimensions = $callback(new Dimensions());
        $this->dimensions = $dimensions->getDimensions();

        return $this;
    }

    /**
     * Ability to add multiple metrics at a time in an array format
     * for example:
     * $query->metrics(['totalUsers', 'newUsers']);
     *
     * @param  array  $metrics
     * @return $this
     */
    public function metrics(array $metrics): static
    {
        $metricObj = new Metrics();
        foreach ($metrics as $metric) {
            $metricObj->$metric();
        }
        $this->metrics = $metricObj->getMetrics();

        return $this;
    }

    /**
     * Ability to add multiple metrics at a time in an array format
     * for example:
     * $query->metrics(['totalUsers', 'newUsers']);
     *
     * @param  array  $dimensions
     * @return $this
     */
    public function dimensions(array $dimensions): static
    {
        $dimensionsObj = new Dimensions();
        foreach ($dimensions as $dimension) {
            $dimensionsObj->$dimension();
        }
        $this->dimensions = $dimensionsObj->getDimensions();

        return $this;
    }

    public function forPeriod(Period $period)
    {
        $this->dateRanges->push($period->getDateRanges());

        return $this;
    }

    /****************************************
     * Process and Run Query
     ****************************************/

    public function run()
    {
        return $this->buildQueryArray();
    }

    private function buildQueryArray()
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
        //get the last error message from json
        //ddd($request->toArray());
        dump($request->toArray());
        $results = $this->client->runReport($request->toArray());

        return self::toCollection($results);
    }

    //TODO: clean up the data structure of $results, convert to collection
    private static function toCollection($results)
    {
        return [$results];
    }
}
