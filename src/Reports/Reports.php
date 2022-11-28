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
}
