<?php

namespace GarrettMassey\Analytics\Response;

use Spatie\LaravelData\Data;

class DimensionHeader extends Data
{
    public function __construct(
        public string $name,
    ) {
    }
}
