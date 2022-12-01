<?php

namespace GarrettMassey\Analytics\Reports;

use GarrettMassey\Analytics\Analytics;
use GarrettMassey\Analytics\Parameters\Dimensions;
use GarrettMassey\Analytics\Parameters\Metrics;
use GarrettMassey\Analytics\Period;
use GarrettMassey\Analytics\Response\ResponseData;
use Google\ApiCore\ApiException;

trait Reports
{
    /**
     * @throws ApiException
     */
    public static function getTopEvents(?Period $period = null): ResponseData
    {
        return Analytics::query()
            ->setMetrics(fn (Metrics $metric) => $metric->eventCount())
            ->setDimensions(fn (Dimensions $dimension) => $dimension->eventName())
            ->forPeriod($period ?? Period::defaultPeriod())
            ->run();
    }

    /**
     * @throws ApiException
     */
    public static function getUserAcquisitionOverview(?Period $period = null): ResponseData
    {
        return Analytics::query()
            ->setMetrics(fn (Metrics $metric) => $metric->sessions())
            ->setDimensions(fn (Dimensions $dimension) => $dimension->firstUserDefaultChannelGroup())
            ->forPeriod($period ?? Period::defaultPeriod())
            ->run();
    }

    /**
     * @throws ApiException
     */
    public static function getTopPages(?Period $period = null): ResponseData
    {
        return Analytics::query()
            ->setMetrics(fn (Metrics $metric) => $metric->sessions())
            ->setDimensions(fn (Dimensions $dimension) => $dimension->pageTitle())
            ->forPeriod($period ?? Period::defaultPeriod())
            ->run();
    }

    /**
     * @throws ApiException
     */
    public static function getUserEngagement(?Period $period = null): ResponseData
    {
        //get the average session duration
        //get the number of sessions that lasted longer than 10 seconds, or had > 2 pageviews
        //get the number of sessions per user
        //get the total number of sessions
        return Analytics::query()
            ->setMetrics(function (Metrics $metric) {
                return $metric->averageSessionDuration()
                    ->engagedSessions()
                    ->sessionsPerUser()
                    ->sessions();
            })->forPeriod($period ?? Period::defaultPeriod())
            ->run();
    }
}
