<?php

namespace GarrettMassey\Analytics\Parameters;

use GarrettMassey\Analytics\Analytics;
use Google\Analytics\Data\V1beta\Metric;
use Illuminate\Support\Collection;

class Metrics
{
    private Collection $metrics;

    public function __construct()
    {
        $this->metrics = collect();
    }

    public function getMetrics(): Collection
    {
        return $this->metrics;
    }

    public function eventCount()
    {
        $this->metrics->push(new Metric(['name' => 'eventCount']));
        return $this;
    }
}
