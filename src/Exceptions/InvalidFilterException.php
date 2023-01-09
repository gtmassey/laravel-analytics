<?php

namespace Gtmassey\LaravelAnalytics\Exceptions;

use Exception;

class InvalidFilterException extends Exception
{
    const NO_DIMENSION_FILTER = 'No dimension filter was set.';

    const NO_METRIC_FILTER = 'No metric filter was set.';

    public static function noDimensionFilter(): self
    {
        return new self(message: self::NO_DIMENSION_FILTER);
    }

    public static function noMetricFilter(): self
    {
        return new self(message: self::NO_METRIC_FILTER);
    }
}
