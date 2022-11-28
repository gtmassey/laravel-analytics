<?php

namespace GarrettMassey\Analytics;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Closure;
use GarrettMassey\Analytics\Exceptions\InvalidPeriodException;
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

    public static function previousQuarter(): self
    {
        return new Period(
            startDate: $startOfQuarter = CarbonImmutable::today()->subQuarterNoOverflow()->startOfQuarter(),
            endDate: $startOfQuarter->endOfQuarter(),
        );
    }

    /**
     * @throws InvalidPeriodException
     */
    public static function specificQuarter(int $year, int $quarter): self
    {
        //first, determine if the year type is calendar or fiscal
        $yearType = config('analytics.year_type');

        return match ($yearType) {
            'calendar' => self::specificCalendarQuarter($year, $quarter),
            'fiscal' => self::specificFiscalQuarter($year, $quarter),
            default => throw InvalidPeriodException::invalidYearType($yearType),
        };
    }

    /**
     * @throws InvalidPeriodException
     */
    public static function specificFiscalQuarter(int $year, int $quarter): self
    {
        $yearType = config('analytics.year_type');
        $today = CarbonImmutable::today();
        $thisYear = CarbonImmutable::today()->year;
		//for fiscal quarters, the year starts on july 1 and ends on june 30 of the NEXT year
		$startOfFiscalYear = CarbonImmutable::create($year, 7, 1);
		$endOfFiscalYear = CarbonImmutable::create($year + 1, 6, 30);
        switch ($quarter) {
            case 1:
				//q1 = jul 1 - sept 30
                $startDate = CarbonImmutable::create($year, 7, 1);
				$endDate = CarbonImmutable::create($year, 9, 30);
				//if $today is between $startDate and $endDate, call thisQuarter()
				if ($today->between($startDate, $endDate)) {
					return self::thisQuarter();
				} else {
					//if today is before startDate, throw exception
					if ($today->isBefore($startDate)) {
						throw InvalidPeriodException::invalidQuarter($quarter);
					} else {
						return new Period($startDate, $endDate);
					}
				}
            case 2:
                //q2 = oct 1 - dec 31
				$startDate = CarbonImmutable::create($year, 10, 1);
				$endDate = CarbonImmutable::create($year, 12, 31);
				//if $today is between $startDate and $endDate, call thisQuarter()
				if ($today->between($startDate, $endDate)) {
					return self::thisQuarter();
				} else {
					//if today is before startDate, throw exception
					if ($today->isBefore($startDate)) {
						throw InvalidPeriodException::invalidQuarter($quarter);
					} else {
						return new Period($startDate, $endDate);
					}
				}
            case 3:
				//q3 = jan 1 - mar 31
				$startDate = CarbonImmutable::create($year + 1, 1, 1);
				$endDate = CarbonImmutable::create($year + 1, 3, 31);
				//if today is before jan 1, throw exception
				if ($today->isBefore($startDate)) {
					throw InvalidPeriodException::invalidQuarter($quarter);
				} else {
					return new Period($startDate, $endDate);
				}

            case 4:
                //q4 = apr 1 - jun 30
				$startDate = CarbonImmutable::create($year + 1, 4, 1);
				$endDate = CarbonImmutable::create($year + 1, 6, 30);
				//if today is before apr 1, throw exception
				if ($today->isBefore($startDate)) {
					throw InvalidPeriodException::invalidQuarter($quarter);
				} else {
					return new Period($startDate, $endDate);
				}
			default:
				throw InvalidPeriodException::invalidQuarter($quarter);
		}
	}

    /**
     * @throws InvalidPeriodException
     */
    public static function specificCalendarQuarter(int $year, int $quarter): self
    {
        $yearType = config('analytics.year_type');
        $today = CarbonImmutable::today();
        $thisYear = CarbonImmutable::today()->year;
        if ($year > $thisYear) {
            throw InvalidPeriodException::cannotGetFutureQuarter($quarter);
        } else {
            switch ($quarter) {
                case 1:
                    //q1 = january 1 - March 31
                    //if today is before March 31st but after jan 1st, call thisQuarter()
                    $startDate = CarbonImmutable::create($year, 1, 1);
                    $endDate = CarbonImmutable::create($year, 3, 31);
                    if ($today->isBetween($startDate, $endDate)) {
                        return self::thisQuarter();
                    } else {
                        //if today is before jan 1, throw exception
                        if ($today->isBefore($startDate)) {
                            throw InvalidPeriodException::cannotGetFutureQuarter($quarter);
                        } else {
                            return new Period($startDate, $endDate);
                        }
                    }
                case 2:
                    //q2 = april 1 - june 30
                    //if today is before june 30th but after april 1st, call thisQuarter()
                    $startDate = CarbonImmutable::create($year, 4, 1);
                    $endDate = CarbonImmutable::create($year, 6, 30);
                    if ($today->isBetween($startDate, $endDate)) {
                        return self::thisQuarter();
                    } else {
                        //if today is before april 1, throw exception
                        if ($today->isBefore($startDate)) {
                            throw InvalidPeriodException::cannotGetFutureQuarter($quarter);
                        } else {
                            return new Period($startDate, $endDate);
                        }
                    }
                case 3:
                    //q3 = july 1 - september 30
                    //if today is before september 30th but after july 1st, call thisQuarter()
                    $startDate = CarbonImmutable::create($year, 7, 1);
                    $endDate = CarbonImmutable::create($year, 9, 30);
                    if ($today->isBetween($startDate, $endDate)) {
                        return self::thisQuarter();
                    } else {
                        //if today is before july 1, throw exception
                        if ($today->isBefore($startDate)) {
                            throw InvalidPeriodException::cannotGetFutureQuarter($quarter);
                        } else {
                            return new Period($startDate, $endDate);
                        }
                    }
                case 4:
                    //q4 = october 1 - december 31
                    //if today is before december 31st but after october 1st, call thisQuarter()
                    $startDate = CarbonImmutable::create($year, 10, 1);
                    $endDate = CarbonImmutable::create($year, 12, 31);
                    if ($today->isBetween($startDate, $endDate)) {
                        return self::thisQuarter();
                    } else {
                        //if today is before october 1, throw exception
                        if ($today->isBefore($startDate)) {
                            throw InvalidPeriodException::cannotGetFutureQuarter($quarter);
                        } else {
                            return new Period($startDate, $endDate);
                        }
                    }
                default:
                    throw InvalidPeriodException::invalidQuarter($quarter);
            }
        }
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
