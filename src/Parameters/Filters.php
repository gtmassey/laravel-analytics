<?php

namespace GarrettMassey\Analytics\Parameters;

class Filters
{
    private Collection $metricFilters;

    private Collection $dimensionFilters;

    public function __construct()
    {
        $this->metricFilters = collect();
        $this->dimensionFilters = collect();
    }

    //TODO: add query builder for filters, add support for multiple filters
    //dimension filter example: https://developers.google.com/analytics/devguides/reporting/data/v1/basics#dimension_filters
}
