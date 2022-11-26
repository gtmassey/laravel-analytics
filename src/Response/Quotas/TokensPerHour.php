<?php

namespace GarrettMassey\Analytics\Response\Quotas;

use Spatie\LaravelData\Data;

class TokensPerHour extends Data
{
    public function __construct(
        public int $consumed,
        public int $remaining,
    ) {
    }
}
