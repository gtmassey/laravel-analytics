<?php

namespace GarrettMassey\Analytics;

use Carbon\CarbonImmutable;
use Google\Analytics\Data\V1beta\DateRange;

class Period
{
    public CarbonImmutable $startDate;
    public CarbonImmutable $endDate;

    public function __construct(CarbonImmutable $startDate, CarbonImmutable $endDate)
    {
        //construct period
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function create(CarbonImmutable $startDate, CarbonImmutable $endDate): self
    {
        return new Period($startDate, $endDate);
    }

    /**
     * creates an instance of the period class for the last 7 days
     */
    public static function week(): self
    {
        return new Period(CarbonImmutable::today()->subDays(7), CarbonImmutable::today());
    }

    /**
     * creates an instance of the period class for the last 30 days
     */
    public static function month(): self
    {
        return new Period(CarbonImmutable::today()->subDays(30), CarbonImmutable::today());
    }

    /**
     * creates an instance of the period class for the last 365 days
     */
    public static function year(): self
    {
        return new Period(CarbonImmutable::today()->subDays(365), CarbonImmutable::today());
    }

    /**
     * creates an instance of the period class for the last n days
     */
    public static function days(int $days): self
    {
        return new Period(CarbonImmutable::today()->subDays($days), CarbonImmutable::today());
    }

    /**
     * creates an instance of the period class for the last n weeks
     */
    public static function weeks(int $weeks): self
    {
        return new Period(CarbonImmutable::today()->subWeeks($weeks), CarbonImmutable::today());
    }

    /**
     * creates an instance of the period class for the last n months
     */
    public static function months(int $months): self
    {
        return new Period(CarbonImmutable::today()->subMonths($months), CarbonImmutable::today());
    }

    /**
     * creates an instance of the period class for the last n years
     */
    public static function years(int $years): self
    {
        return new Period(CarbonImmutable::today()->subYears($years), CarbonImmutable::today());
    }

    public function getDateRanges()
    {
        return new DateRange([
            'start_date' => $this->startDate->format('Y-m-d'),
            'end_date' => $this->endDate->format('Y-m-d'),
        ]);
    }
}
