<?php

namespace GarrettMassey\Analytics\Reports;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Analytics;
use GarrettMassey\Analytics\Parameters\Dimensions;
use GarrettMassey\Analytics\Parameters\Metrics;
use GarrettMassey\Analytics\Period;

class Reports
{
    public static function getTopEvents(?Period $period)
    {
        //create analytics instance
        $query = Analytics::query();
        //if a period is provided, use that
        if ($period) {
            $query->setMetrics(function (Metrics $metric) {
                return $metric->eventCount();
            })->setDimensions(function (Dimensions $dimension) {
                return $dimension->eventName();
            })->forPeriod(
                $period
            );
        } else {
            $query->setMetrics(function (Metrics $metric) {
                return $metric->eventCount();
            })->setDimensions(function (Dimensions $dimension) {
                return $dimension->eventName();
            })->forPeriod(
                Period::create(
                    CarbonImmutable::now()->subDays(30),
                    CarbonImmutable::now()
                )
            );
        }

        return $query->run();
    }
}
