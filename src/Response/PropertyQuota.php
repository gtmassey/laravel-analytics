<?php

namespace GarrettMassey\Analytics\Response;

use GarrettMassey\Analytics\Response\Quotas\ConcurrentRequests;
use GarrettMassey\Analytics\Response\Quotas\PotentiallyThresholdedRequestsPerHour;
use GarrettMassey\Analytics\Response\Quotas\ServerErrorsPerProjectPerHour;
use GarrettMassey\Analytics\Response\Quotas\TokensPerDay;
use GarrettMassey\Analytics\Response\Quotas\TokensPerHour;
use GarrettMassey\Analytics\Response\Quotas\TokensPerProjectPerHour;
use Spatie\LaravelData\Data;

class PropertyQuota extends Data
{
    public function __construct(
        public TokensPerDay $tokensPerDay,
        public TokensPerHour $tokensPerHour,
        public ConcurrentRequests $concurrentRequests,
        public ServerErrorsPerProjectPerHour $serverErrorsPerProjectPerHour,
        public PotentiallyThresholdedRequestsPerHour $potentiallyThresholdedRequestsPerHour,
        public TokensPerProjectPerHour $tokensPerProjectPerHour,
    ) {
    }
}
