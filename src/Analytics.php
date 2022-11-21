<?php

namespace GarrettMassey\Analytics;

use Carbon\Carbon;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\Dimension;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Illuminate\Support\Collection;

class Analytics
{

    //public GoogleAnalyticsDataClient $client;
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
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path() . '/analyticsAPI/credentials.json');
        $this->client = new BetaAnalyticsDataClient();
        $this->propertyID = config('analytics.property_id');
        $this->dimensions = collect([]);
        $this->metrics = collect([]);
        $this->dateRanges = collect([]);
        return $this;
    }

    public static function query()
    {
        return new Analytics();
    }

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
        $callback($this);
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
        $callback($this);
        return $this;
    }

    //prebuilt queries:
    public function getUsersForQuarter($year, $quarter)
    {
        $period = new Period(
            Carbon::create($year, $quarter * 3 - 2, '01'),
            Carbon::create($year, $quarter * 3, '01')->endOfMonth()
        );
        $this->metrics([
            'totalUsers'
        ]);
        $this->period($period);
        return $this;
    }

    public function getSessionsForQuarter($year, $quarter)
    {
        $period = new Period(
            Carbon::create($year, $quarter * 3 - 2, '01'),
            Carbon::create($year, $quarter * 3, '01')->endOfMonth()
        );
        $this->metrics([
            'sessions'
        ]);
        $this->period($period);
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
        foreach ($metrics as $metric) {
            $this->metrics->push(new Metric($metric));
        }
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
    public function dimensions(array $dimensions): static
    {
        foreach ($dimensions as $dimension) {
            $this->dimensions->push(new Dimension(['name' => $dimension]));
        }
        return $this;
    }

    /****************************************
     * Metrics
     ****************************************/

    //list of common metrics from the google analytics api
    //https://developers.google.com/analytics/devguides/reporting/data/v1/rest/v1beta/properties/runReport#metric

    /**
     * The number of distinct active users on your site or app within a 1 day period.
     *
     * @return $this
     */
    public function active1DayUsers()
    {
        $this->metrics->push(new Metric(['name' => 'active1DayUsers']));
        return $this;
    }

    /**
     * The number of distinct active users on your site or app within a 28 day period.
     *
     * @return $this
     */
    public function active28DayUsers()
    {
        $this->metrics->push(new Metric(['name' => 'active28DayUsers']));
        return $this;
    }

    /**
     * The number of distinct active users on your site or app within a 7 day period.
     *
     * @return $this
     */
    public function active7DayUsers()
    {
        $this->metrics->push(new Metric(['name' => 'active7DayUsers']));
        return $this;
    }

    /**
     * The number of distinct active users on your site or app for one day
     * the day is specified by the date parameter, and is a single day,
     * or the last day in a given period
     *
     * @return $this
     */
    public function activeUsers()
    {
        $this->metrics->push(new Metric(['name' => 'activeUsers']));
        return $this;
    }

    /**
     * The average duration (in seconds) of users' sessions.
     *
     * @return $this
     */
    public function averageSessionDuration()
    {
        $this->metrics->push(new Metric(['name' => 'averageSessionDuration']));
        return $this;
    }

    /**
     * The percentage of sessions that were not engaged
     * ((Sessions Minus Engaged sessions) divided by Sessions).
     * @return $this
     */
    public function bounceRate()
    {
        $this->metrics->push(new Metric(['name' => 'bounceRate']));
        return $this;
    }

    public function cohortActiveUsers()
    {
        $this->metrics->push(new Metric(['name' => 'cohortActiveUsers']));
        return $this;
    }

    public function cohortTotalUsers()
    {
        $this->metrics->push(new Metric(['name' => 'cohortTotalUsers']));
        return $this;
    }

    public function conversions()
    {
        $this->metrics->push(new Metric(['name' => 'conversions']));
        return $this;
    }

    public function engagedSessions()
    {
        $this->metrics->push(new Metric(['name' => 'engagedSessions']));
        return $this;
    }

    public function engagementRate()
    {
        $this->metrics->push(new Metric(['name' => 'engagementRate']));
        return $this;
    }

    public function eventCount()
    {
        $this->metrics->push(new Metric(['name' => 'eventCount']));
        return $this;
    }

    public function eventCountPerUser()
    {
        $this->metrics->push(new Metric(['name' => 'eventCountPerUser']));
        return $this;
    }

    public function eventValue()
    {
        $this->metrics->push(new Metric(['name' => 'eventValue']));
        return $this;
    }

    public function eventsPerSession()
    {
        $this->metrics->push(new Metric(['name' => 'eventsPerSession']));
        return $this;
    }

    public function newUsers()
    {
        $this->metrics->push(new Metric(['name' => 'newUsers']));
        return $this;
    }

    public function organicGoogleSearchAveragePosition()
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchAveragePosition']));
        return $this;
    }

    public function organicGoogleSearchClickThroughRate()
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchClickThroughRate']));
        return $this;
    }

    public function organicGoogleSearchClicks()
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchClicks']));
        return $this;
    }

    public function organicGoogleSearchImpressions()
    {
        $this->metrics->push(new Metric(['name' => 'organicGoogleSearchImpressions']));
        return $this;
    }

    public function screenPageViews()
    {
        $this->metrics->push(new Metric(['name' => 'screenPageViews']));
        return $this;
    }

    public function screenPageViewsPerSession()
    {
        $this->metrics->push(new Metric(['name' => 'screenPageViewsPerSession']));
        return $this;
    }

    public function sessionConversionRate()
    {
        $this->metrics->push(new Metric(['name' => 'sessionConversionRate']));
        return $this;
    }

    public function sessions()
    {
        $this->metrics->push(new Metric(['name' => 'sessions']));
        return $this;
    }

    public function sessionsPerUser()
    {
        $this->metrics->push(new Metric(['name' => 'sessionsPerUser']));
        return $this;
    }

    public function totalUsers()
    {
        $this->metrics->push(new Metric(['name' => 'totalUsers']));
        return $this;
    }

    public function userConversionRate()
    {
        $this->metrics->push(new Metric(['name' => 'userConversionRate']));
        return $this;
    }

    public function userEngagementDuration()
    {
        $this->metrics->push(new Metric(['name' => 'userEngagementDuration']));
        return $this;
    }

    /************************************************
     * Dimensions
     ****************************************/

    public function forPeriod(Period $period)
    {
        $this->dateRanges->push($period->getDateRanges());
        return $this;
    }

    public function pageTitle(): Analytics
    {

        $this->dimensions->push(new Dimension(['name' => 'pageTitle']));

        return $this;
    }

    public function pagePath(): Analytics
    {

        $this->dimensions->push(new Dimension(['name' => 'pagePath']));

        return $this;
    }

    public function run()
    {
        //build the query in the following structure:
        //object containing:
        //  dimensions
        //  metrics
        //  dateRanges
        //  dimensionFilter
        //  metricFilter

        return $this->buildQueryString();

        //run the query
    }

    private function buildQueryString()
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
        //$resource->resource->push($dimensions->merge($metrics));
        $request = collect(['property' => 'properties/' . $this->propertyID]);
        $request = $request->merge($resource);
        //ddd($request->toArray());
        return $this->client->runReport($request->toArray());
    }
}
