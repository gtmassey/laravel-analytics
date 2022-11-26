<?php

namespace GarrettMassey\Analytics\Response;

use Spatie\LaravelData\Data;

class Metadata extends Data
{
    public function __construct(
        public string $currencyCode,
        public string $timeZone,
    ) {
    }
}
