<?php

namespace GarrettMassey\Analytics\Reports;

use Carbon\CarbonImmutable;
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
