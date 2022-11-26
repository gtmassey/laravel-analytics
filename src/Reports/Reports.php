<?php

namespace GarrettMassey\Analytics\Reports;

use GarrettMassey\Analytics\Analytics;
use GarrettMassey\Analytics\Parameters\Dimensions;
use GarrettMassey\Analytics\Parameters\Metrics;
use GarrettMassey\Analytics\Period;
use Google\Analytics\Data\V1beta\RunReportResponse;
use Google\ApiCore\ApiException;
use Illuminate\Support\Collection;

trait Reports
{
    /**
     * @param  Period|null  $period
     * @return Collection<int, RunReportResponse>
     *
     * @throws ApiException
     */
    public static function getTopEvents(?Period $period = null): Collection
    {
        return Analytics::query()
            ->setMetrics(fn (Metrics $metric) => $metric->eventCount())
            ->setDimensions(fn (Dimensions $dimension) => $dimension->eventName())
            ->forPeriod($period ?? Period::defaultPeriod())
            ->run();
    }
}
