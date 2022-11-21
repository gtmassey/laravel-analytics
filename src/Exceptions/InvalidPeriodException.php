<?php

namespace GarrettMassey\Analytics\Exceptions;

use DateTimeInterface;

class InvalidPeriodException extends \Exception
{
    public static function startDateCannotBeAfterEndDate(DateTimeInterface $startDate, DateTimeInterface $endDate): InvalidPeriodException
    {
        return new static("Start date `{$startDate->format('Y-m-d')}` cannot be after end date `{$endDate->format('Y-m-d')}`.");
    }

    public static function startDateCannotBeInTheFuture(DateTimeInterface $startDate): InvalidPeriodException
    {
        return new static("Start date `{$startDate->format('Y-m-d')}` cannot be in the future.");
    }

    public static function endDateCannotBeInTheFuture(DateTimeInterface $endDate): InvalidPeriodException
    {
        return new static("End date `{$endDate->format('Y-m-d')}` cannot be in the future.");
    }
}
