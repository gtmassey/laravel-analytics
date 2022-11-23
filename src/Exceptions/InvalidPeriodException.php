<?php

namespace GarrettMassey\Analytics\Exceptions;

use DateTimeInterface;
use Throwable;

final class InvalidPeriodException extends \Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public static function startDateCannotBeAfterEndDate(
        DateTimeInterface $startDate,
        DateTimeInterface $endDate
    ): InvalidPeriodException {
        $message = "Start date `{$startDate->format('Y-m-d')}` cannot be after end date `{$endDate->format('Y-m-d')}`.";

        return new static($message);
    }

    public static function startDateCannotBeInTheFuture(DateTimeInterface $startDate): InvalidPeriodException
    {
        $message = "Start date `{$startDate->format('Y-m-d')}` cannot be in the future.";

        return new static($message);
    }

    public static function endDateCannotBeInTheFuture(DateTimeInterface $endDate): InvalidPeriodException
    {
        $message = "End date `{$endDate->format('Y-m-d')}` cannot be in the future.";

        return new static($message);
    }
}
