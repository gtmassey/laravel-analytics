<?php

namespace GarrettMassey\Analytics\Response;

use Spatie\LaravelData\Data;

class MetricValue extends Data
{
    public function __construct(
        public string $value,
    ) {
    }
}
