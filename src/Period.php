<?php

namespace GarrettMassey\Analytics;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Closure;
use Google\Analytics\Data\V1beta\DateRange;

class Period
{
    public CarbonImmutable $startDate;

    public CarbonImmutable $endDate;

    /**
     * @var (Closure(): Period)|null
     */
    private static ?Closure $defaultPeriodClosure = null;

    private static int $startOfWeek = CarbonInterface::MONDAY;

    public function __construct(CarbonImmutable $startDate, CarbonImmutable $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function defaultPeriod(): self
    {
        if (self::$defaultPeriodClosure !== null) {
            return (self::$defaultPeriodClosure)();
        }

        return self::create(
            startDate: CarbonImmutable::today()->subDays(30),
            endDate: CarbonImmutable::today(),
        );
    }

    /**
     * @param    (Closure(): Period)|null    $periodClosure
     * @return void
     */
    public static function setDefaultPeriodClosure(?Closure $periodClosure = null): void
    {
        self::$defaultPeriodClosure = $periodClosure;
    }

    public static function startOfWeek(): int
    {
        return self::$startOfWeek;
    }

    public static function setStartOfWeek(int $startOfWeek): void
    {
        self::$startOfWeek = $startOfWeek;
    }

    public static function create(CarbonImmutable $startDate, CarbonImmutable $endDate): self
    {
        return new Period($startDate, $endDate);
    }

    public static function today(): self
    {
        return self::create(CarbonImmutable::today(), CarbonImmutable::today());
    }

    public static function yesterday(): self
    {
        return self::create(CarbonImmutable::yesterday(), CarbonImmutable::yesterday());
    }

    public static function lastDays(int $days): self
    {
        return new Period(CarbonImmutable::today()->subDays($days - 1), CarbonImmutable::today());
    }

    public static function lastDaysExcludingToday(int $days): self
    {
        return new Period(CarbonImmutable::today()->subDays($days), CarbonImmutable::yesterday());
    }

    public static function thisWeek(): self
    {
        return new Period(CarbonImmutable::today()->startOfWeek(self::$startOfWeek), CarbonImmutable::today());
    }

    public static function thisWeekExcludingToday(): self
    {
        return new Period(
            startDate: $startOfWeek = CarbonImmutable::today()->startOfWeek(self::$startOfWeek),
            endDate: $startOfWeek->isToday() ? CarbonImmutable::today() : CarbonImmutable::yesterday(),
        );
    }

    public static function lastWeek(): self
    {
        return new Period(
            startDate: $startOfWeek = CarbonImmutable::today()->subWeek()->startOfWeek(self::$startOfWeek),
            endDate: $startOfWeek->addDays(6),
        );
    }

    public static function lastWeeks(int $weeks): self
    {
        return new Period(
            startDate: CarbonImmutable::today()->subWeeks($weeks)->startOfWeek(self::$startOfWeek),
            endDate: CarbonImmutable::today()->startOfWeek()->subDay(),
        );
    }

    public static function thisMonth(): self
    {
        return new Period(CarbonImmutable::today()->startOfMonth(), CarbonImmutable::today());
    }

    public static function thisMonthExcludingToday(): self
    {
        return new Period(
            startDate: $startOfMonth = CarbonImmutable::today()->startOfMonth(),
            endDate: $startOfMonth->isToday() ? CarbonImmutable::today() : CarbonImmutable::yesterday(),
        );
    }

    public static function lastMonth(): self
    {
        return new Period(
            startDate: $startOfMonth = CarbonImmutable::today()->subMonthNoOverflow()->startOfMonth(),
            endDate: $startOfMonth->endOfMonth(),
        );
    }

    public static function lastMonths(int $months): self
    {
        return new Period(
            startDate: CarbonImmutable::today()->subMonthsNoOverflow($months)->startOfMonth(),
            endDate: CarbonImmutable::today()->startOfMonth()->subDay(),
        );
    }

    public static function thisQuarter(): self
    {
        return new Period(CarbonImmutable::today()->startOfQuarter(), CarbonImmutable::today());
    }

    public static function thisQuarterExcludingToday(): self
    {
        return new Period(
            startDate: $startOfQuarter = CarbonImmutable::today()->startOfQuarter(),
            endDate: $startOfQuarter->isToday() ? CarbonImmutable::today() : CarbonImmutable::yesterday(),
        );
    }

    public static function lastQuarter(): self
    {
        return new Period(
            startDate: $startOfQuarter = CarbonImmutable::today()->subQuarterNoOverflow()->startOfQuarter(),
            endDate: $startOfQuarter->endOfQuarter(),
        );
    }

    public static function lastQuarters(int $n): self
    {
        return new Period(
            startDate: CarbonImmutable::today()->subQuartersNoOverflow($n)->startOfQuarter(),
            endDate: CarbonImmutable::today()->startOfQuarter()->subDay(),
        );
    }

    public static function thisYear(): self
    {
        return new Period(CarbonImmutable::today()->startOfYear(), CarbonImmutable::today());
    }

    public static function thisYearExcludingToday(): self
    {
        return new Period(
            startDate: $startOfYear = CarbonImmutable::today()->startOfYear(),
            endDate: $startOfYear->isToday() ? CarbonImmutable::today() : CarbonImmutable::yesterday(),
        );
    }

    public static function lastYear(): self
    {
        return new Period(
            startDate: $startOfYear = CarbonImmutable::today()->subYearNoOverflow()->startOfYear(),
            endDate: $startOfYear->endOfYear(),
        );
    }

    public static function lastYears(
        int $years
    ): self {
        return new Period(
            startDate: CarbonImmutable::today()->subYears($years)->startOfYear(),
            endDate: CarbonImmutable::today()->startOfYear()->subDay(),
        );
    }

    public function getDateRange(): DateRange
    {
        return new DateRange([
            'start_date' => $this->startDate->toDateString(),
            'end_date' => $this->endDate->toDateString(),
        ]);
    }
}
