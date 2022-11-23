<?php

namespace GarrettMassey\Analytics;

use Carbon\CarbonImmutable;

class Quarter extends Period
{
    //TODO: write tests for quarter, make sure it works with fiscal and calendar years
    //TODO: check that the Quarter class works as expected as an extension of Period for GA query
    public string $quarter;

    public string $year;

    public string $startMonth;

    public string $endMonth;

    public CarbonImmutable $currentDate;

    public bool $useCalendarYear;

    public int $daysInQuarter;

    /**
     * @param  CarbonImmutable|null  $date
     * @param  string  $yearType
     */
    public function __construct(CarbonImmutable $date = null, $yearType = 'calendar')
    {
        //call the parent constructor
        $startDate = self::determineQuarterStartDate($date, $yearType);
        $endDate = self::determineQuarterEndDate($date, $yearType);
        parent::__construct($startDate, $endDate);
        if ($date === null) {
            $date = CarbonImmutable::now();
        }
        //determine what quarter we are in based on the current date
        $this->currentDate = $date;
        $this->quarter = self::determineQuarter($date, $yearType)['quarter'];
        $this->year = self::determineQuarter($date, $yearType)['year'];
        $this->startMonth = self::determineQuarter($date, $yearType)['startMonth'];
        $this->endMonth = self::determineQuarter($date, $yearType)['endMonth'];
        $this->useCalendarYear = $yearType === 'calendar';
        $this->daysInQuarter = $this->startDate->diffInDays($this->currentDate);
    }

    /**
     * @param  CarbonImmutable  $date
     * @return int
     */
    private static function determineFiscalYear(CarbonImmutable $date): int
    {
        //if the date is before July 1st, the fiscal year will be the current calendar year
        if ($date->month < 7) {
            return $date->year;
        } else {
            //if the date is after June 30th, the fiscal year will be the next calendar year
            return $date->year + 1;
        }
    }

    /**
     * determines the quarter based on the date and the year type
     *
     * @param  CarbonImmutable  $date
     * @param  string  $yearType
     * @return array
     */
    private static function determineQuarter(CarbonImmutable $date, string $yearType): array
    {
        //if the yearType is 'calendar', then $year is the year of $date
        //if the yearType is 'fiscal', then $year is the fiscal year of $date
        if ($yearType === 'calendar') {
            $year = $date->year;
        } else {
            $year = self::determineFiscalYear($date);
        }
        //if the date is between Jan 1 and end of march, and the yearType is calendar
        //then the quarter will be Q1
        //otherwise, the quarter will be Q3
        if ($date->month >= 1 && $date->month <= 3) {
            if ($yearType === 'calendar') {
                return [
                    'quarter' => 'Q1',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year, 1, 1),
                    'endDate' => CarbonImmutable::create($year, 3, 31),
                    'startMonth' => 'January',
                    'endMonth' => 'March',
                ];
            } else {
                return [
                    'quarter' => 'Q3',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year, 01, 01),
                    'endDate' => CarbonImmutable::create($year, 03, 31),
                    'startMonth' => 'January',
                    'endMonth' => 'March',
                ];
            }
        }
        //if the date is between April 1 and end of June, the quarter will be Q2
        if ($date->month >= 4 && $date->month <= 6) {
            if ($yearType === 'calendar') {
                return [
                    'quarter' => 'Q2',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year, 04, 01),
                    'endDate' => CarbonImmutable::create($year, 06, 30),
                    'startMonth' => 'April',
                    'endMonth' => 'June',
                ];
            } else {
                return [
                    'quarter' => 'Q4',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year, 04, 01),
                    'endDate' => CarbonImmutable::create($year, 06, 30),
                    'startMonth' => 'April',
                    'endMonth' => 'June',
                ];
            }
        }
        //if the date is between July 1 and end of September, the quarter will be Q3
        if ($date->month >= 7 && $date->month <= 9) {
            if ($yearType === 'calendar') {
                return [
                    'quarter' => 'Q3',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year, 07, 01),
                    'endDate' => CarbonImmutable::create($year, 9, 30),
                    'startMonth' => 'July',
                    'endMonth' => 'September',
                ];
            } else {
                return [
                    'quarter' => 'Q1',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year - 1, 07, 01),
                    'endDate' => CarbonImmutable::create($year - 1, 9, 30),
                    'startMonth' => 'July',
                    'endMonth' => 'September',
                ];
            }
        }
        //if the date is between October 1 and end of December, the quarter will be Q4
        if ($date->month >= 10 && $date->month <= 12) {
            if ($yearType === 'calendar') {
                return [
                    'quarter' => 'Q4',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year, 10, 01),
                    'endDate' => CarbonImmutable::create($year, 12, 31),
                    'startMonth' => 'October',
                    'endMonth' => 'December',
                ];
            } else {
                return [
                    'quarter' => 'Q2',
                    'year' => $year,
                    'startDate' => CarbonImmutable::create($year - 1, 10, 01),
                    'endDate' => CarbonImmutable::create($year - 1, 12, 31),
                    'startMonth' => 'October',
                    'endMonth' => 'December',
                ];
            }
        }
        //a full year period if none of the above is true, somehow
        return [
            'quarter' => '',
            'year' => '',
            'startDate' => CarbonImmutable::create($year, 1, 1),
            'endDate' => CarbonImmutable::create($year, 12, 31),
            'startMonth' => 'January',
            'endMonth' => 'December',
        ];
    }

    private static function determineQuarterStartDate(CarbonImmutable $date, string $yearType)
    {
        $quarter = self::determineQuarter($date, $yearType);

        return $quarter['startDate'];
    }

    private static function determineQuarterEndDate(CarbonImmutable $date, string $year)
    {
        $quarter = self::determineQuarter($date, $year);

        return $quarter['endDate'];
    }

    /**
     * @return string
     */
    public function getQuarter(): string
    {
        return $this->quarter;
    }

    /**
     * @return CarbonImmutable
     */
    public function getQuarterStartDate(): CarbonImmutable
    {
        return $this->startDate;
    }

    /**
     * @return CarbonImmutable
     */
    public function getQuarterEndDate(): CarbonImmutable
    {
        return $this->endDate;
    }

    /**
     * @return Quarter
     */
    public function getPreviousQuarter(): Quarter
    {
        return new Quarter($this->startDate->subMonth(), ($this->useCalendarYear) ? 'calendar' : 'fiscal');
    }

    /**
     * @return Quarter
     */
    public function getNextQuarter(): Quarter
    {
        return new Quarter($this->endDate->addDay(), ($this->useCalendarYear) ? 'calendar' : 'fiscal');
    }

    /**
     * gets the quarter as a sentence string, i.e. "Quarter 2"
     *
     * @return string
     */
    public function getQuarterString(): string
    {
        return 'Quarter '.substr($this->quarter, 1);
    }
}
