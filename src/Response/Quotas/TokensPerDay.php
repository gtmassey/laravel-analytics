<?php

namespace GarrettMassey\Analytics\Response\Quotas;

use Spatie\LaravelData\Data;

class TokensPerDay extends Data
{
    public function __construct(
        public int $consumed,
        public int $remaining,
    ) {
    }
}
