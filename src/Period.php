<?php

namespace GarrettMassey\Analytics;

use Carbon\Carbon;
use GarrettMassey\Analytics\Exceptions\InvalidPeriodException;
use DateTimeInterface;
use Google\Analytics\Data\V1beta\DateRange;

class Period
{
    public Carbon $startDate;
    public Carbon $endDate;

    public function __construct(Carbon $startDate, Carbon $endDate)
    {
        //construct period
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function create(DateTimeInterface $startDate, DateTimeInterface $endDate): self
    {
        return new Period($startDate, $endDate);
    }

    /**
     * creates an instance of the period class for the last 7 days
     */
    public static function week(): self
    {
        return new Period(Carbon::today()->subDays(7), Carbon::today());
    }

    /**
     * creates an instance of the period class for the last 30 days
     */
    public static function month(): self
    {
        return new Period(Carbon::today()->subDays(30), Carbon::today());
    }

    /**
     * creates an instance of the period class for the last 365 days
     */
    public static function year(): self
    {
        return new Period(Carbon::today()->subDays(365), Carbon::today());
    }

    /**
     * creates an instance of the period class for the last n days
     */
    public static function days(int $days): self
    {
        return new Period(Carbon::today()->subDays($days), Carbon::today());
    }

    /**
     * creates an instance of the period class for the last n weeks
     */
    public static function weeks(int $weeks): self
    {
        return new Period(Carbon::today()->subWeeks($weeks), Carbon::today());
    }

    /**
     * creates an instance of the period class for the last n months
     */
    public static function months(int $months): self
    {
        return new Period(Carbon::today()->subMonths($months), Carbon::today());
    }

    /**
     * creates an instance of the period class for the last n years
     */
    public static function years(int $years): self
    {
        return new Period(Carbon::today()->subYears($years), Carbon::today());
    }

    public function getDateRanges()
    {
        return new DateRange([
            'start_date' => $this->startDate->format('Y-m-d'),
            'end_date' => $this->endDate->format('Y-m-d'),
        ]);
    }
}
