<?php

namespace Gtmassey\LaravelAnalytics\Reports;

use Google\ApiCore\ApiException;
use Gtmassey\LaravelAnalytics\Analytics;
use Gtmassey\LaravelAnalytics\Request\Dimensions;
use Gtmassey\LaravelAnalytics\Request\Metrics;
use Gtmassey\LaravelAnalytics\Response\ResponseData;
use Gtmassey\Period\Period;

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
        return Analytics::query()
            ->setMetrics(fn (Metrics $metric) => $metric
                ->averageSessionDuration()
                ->engagedSessions()
                ->sessionsPerUser()
                ->sessions()
            )
            ->forPeriod($period ?? Period::defaultPeriod())
            ->run();
    }
}
