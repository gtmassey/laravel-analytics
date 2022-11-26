<?php

namespace GarrettMassey\Analytics\Response;

use Spatie\LaravelData\Data;

class MetricHeader extends Data
{
    public function __construct(
        public string $name,
        public string $type //Could be ENUM
    ) {
    }
}
