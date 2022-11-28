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

    public static function cannotGetFutureQuarter($quarter): InvalidPeriodException
    {
        $message = 'Q'.$quarter.' is in the future. Cannot get future quarters.';

        return new static($message);
    }

    public static function invalidQuarter($quarter): InvalidPeriodException
    {
        $message = 'Q'.$quarter.' is not a valid quarter. $quarter must be between 1 and 4.';

        return new static($message);
    }

    public static function invalidYearType(string $yearType): InvalidPeriodException
    {
        $message = 'Year type '.$yearType.' is not a valid year type. $yearType must be either "calendar" or "fiscal".';

        return new static($message);
    }
}
