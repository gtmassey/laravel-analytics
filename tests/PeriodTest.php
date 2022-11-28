<?php

namespace GarrettMassey\Analytics\Tests;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use GarrettMassey\Analytics\Period;
use Google\Analytics\Data\V1beta\DateRange;

class PeriodTest extends TestCase
{
    public function test_construct(): void
    {
        $startDate = CarbonImmutable::parse('2022-10-01');
        $endDate = CarbonImmutable::parse('2022-10-31');

        $period = new Period($startDate, $endDate);

        $this->assertEquals($startDate->toDateString(), $period->startDate->toDateString());
        $this->assertEquals($endDate->toDateString(), $period->endDate->toDateString());
    }

    public function test_default_period(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-31'));

        $period = Period::defaultPeriod();

        $this->assertEquals('2022-10-01', $period->startDate->toDateString());
        $this->assertEquals('2022-10-31', $period->endDate->toDateString());
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_set_default_period(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-31'));

        Period::setDefaultPeriodClosure(fn () => Period::create(
            startDate: CarbonImmutable::today()->subDays(20),
            endDate: CarbonImmutable::today(),
        ));

        $this->assertEquals('2022-10-11', Period::defaultPeriod()->startDate->toDateString());
        $this->assertEquals('2022-10-31', Period::defaultPeriod()->endDate->toDateString());

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-01'));

        $this->assertEquals('2022-10-12', Period::defaultPeriod()->startDate->toDateString());
        $this->assertEquals('2022-11-01', Period::defaultPeriod()->endDate->toDateString());

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-31'));

        Period::setDefaultPeriodClosure();

        $this->assertEquals('2022-10-01', Period::defaultPeriod()->startDate->toDateString());
        $this->assertEquals('2022-10-31', Period::defaultPeriod()->endDate->toDateString());
    }

    public function test_start_of_week(): void
    {
        $this->assertEquals(CarbonInterface::MONDAY, Period::startOfWeek());
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test_set_start_of_week(): void
    {
        Period::setStartOfWeek(CarbonInterface::SUNDAY);

        $this->assertEquals(CarbonInterface::SUNDAY, Period::startOfWeek());

        Period::setStartOfWeek(CarbonInterface::MONDAY);
    }

    public function test_create(): void
    {
        $startDate = CarbonImmutable::parse('2022-10-01');
        $endDate = CarbonImmutable::parse('2022-10-31');

        $period = Period::create($startDate, $endDate);

        $this->assertEquals($startDate->toDateString(), $period->startDate->toDateString());
        $this->assertEquals($endDate->toDateString(), $period->endDate->toDateString());
    }

    public function test_today(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-10'));

        $period = Period::today();

        $this->assertEquals('2022-10-10', $period->startDate->toDateString());
        $this->assertEquals('2022-10-10', $period->endDate->toDateString());
    }

    public function test_yesterday(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-10'));

        $period = Period::yesterday();

        $this->assertEquals('2022-10-09', $period->startDate->toDateString());
        $this->assertEquals('2022-10-09', $period->endDate->toDateString());
    }

    public function test_last_days(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-10'));

        $period = Period::lastDays(7);

        $this->assertEquals('2022-10-04', $period->startDate->toDateString());
        $this->assertEquals('2022-10-10', $period->endDate->toDateString());
    }

    public function test_last_days_excluding_today(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-10'));

        $period = Period::lastDaysExcludingToday(7);

        $this->assertEquals('2022-10-03', $period->startDate->toDateString());
        $this->assertEquals('2022-10-09', $period->endDate->toDateString());
    }

    public function test_this_week(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-10'));

        $period = Period::thisWeek();

        $this->assertEquals('2022-11-07', $period->startDate->toDateString());
        $this->assertEquals('2022-11-10', $period->endDate->toDateString());

        Period::setStartOfWeek(CarbonInterface::SUNDAY);

        $period = Period::thisWeek();

        $this->assertEquals('2022-11-06', $period->startDate->toDateString());
        $this->assertEquals('2022-11-10', $period->endDate->toDateString());

        Period::setStartOfWeek(CarbonInterface::MONDAY);
    }

    public function test_this_week_excluding_today(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-10'));

        $period = Period::thisWeekExcludingToday();

        $this->assertEquals('2022-11-07', $period->startDate->toDateString());
        $this->assertEquals('2022-11-09', $period->endDate->toDateString());

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-07'));

        $period = Period::thisWeekExcludingToday();

        $this->assertEquals('2022-11-07', $period->startDate->toDateString());
        $this->assertEquals('2022-11-07', $period->endDate->toDateString());
    }

    public function test_last_week(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-10'));

        $period = Period::lastWeek();

        $this->assertEquals('2022-10-31', $period->startDate->toDateString());
        $this->assertEquals('2022-11-06', $period->endDate->toDateString());
    }

    public function test_last_weeks(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-10'));

        $period = Period::lastWeeks(4);

        $this->assertEquals('2022-10-10', $period->startDate->toDateString());
        $this->assertEquals('2022-11-06', $period->endDate->toDateString());
    }

    public function test_this_month(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-10'));

        $period = Period::thisMonth();

        $this->assertEquals('2022-11-01', $period->startDate->toDateString());
        $this->assertEquals('2022-11-10', $period->endDate->toDateString());
    }

    public function test_this_month_excluding_today(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-10'));

        $period = Period::thisMonthExcludingToday();

        $this->assertEquals('2022-11-01', $period->startDate->toDateString());
        $this->assertEquals('2022-11-09', $period->endDate->toDateString());

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-01'));

        $period = Period::thisMonthExcludingToday();

        $this->assertEquals('2022-11-01', $period->startDate->toDateString());
        $this->assertEquals('2022-11-01', $period->endDate->toDateString());
    }

    public function test_last_month(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-03-31'));

        $period = Period::lastMonth();

        $this->assertEquals('2022-02-01', $period->startDate->toDateString());
        $this->assertEquals('2022-02-28', $period->endDate->toDateString());
    }

    public function test_last_months(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-03-31'));

        $period = Period::lastMonths(3);

        $this->assertEquals('2021-12-01', $period->startDate->toDateString());
        $this->assertEquals('2022-02-28', $period->endDate->toDateString());
    }

    public function test_this_year(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-10'));

        $period = Period::thisYear();

        $this->assertEquals('2022-01-01', $period->startDate->toDateString());
        $this->assertEquals('2022-10-10', $period->endDate->toDateString());
    }

    public function test_this_year_excluding_today(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-10-10'));

        $period = Period::thisYearExcludingToday();

        $this->assertEquals('2022-01-01', $period->startDate->toDateString());
        $this->assertEquals('2022-10-09', $period->endDate->toDateString());

        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-01-01'));

        $period = Period::thisYearExcludingToday();

        $this->assertEquals('2022-01-01', $period->startDate->toDateString());
        $this->assertEquals('2022-01-01', $period->endDate->toDateString());
    }

    public function test_last_year(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2020-02-29'));

        $period = Period::lastYear();

        $this->assertEquals('2019-01-01', $period->startDate->toDateString());
        $this->assertEquals('2019-12-31', $period->endDate->toDateString());
    }

    public function test_last_years(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2020-02-29'));

        $period = Period::lastYears(2);

        $this->assertEquals('2018-01-01', $period->startDate->toDateString());
        $this->assertEquals('2019-12-31', $period->endDate->toDateString());
    }

    public function test_current_calendar_quarter(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-24'));

        $period = Period::thisQuarter();

        $dateRange = $period->getDateRange();

        $this->assertInstanceOf(DateRange::class, $dateRange);

        $this->assertEquals('2022-10-01', $dateRange->getStartDate());
        $this->assertEquals('2022-11-24', $dateRange->getEndDate());
    }

    public function test_current_calendar_quarter_excluding_today(): void
    {
        CarbonImmutable::setTestNow(CarbonImmutable::parse('2022-11-24'));

        $period = Period::thisQuarterExcludingToday();

        $dateRange = $period->getDateRange();

        $this->assertInstanceOf(DateRange::class, $dateRange);

        $this->assertEquals('2022-10-01', $dateRange->getStartDate());
        $this->assertEquals('2022-11-23', $dateRange->getEndDate());
    }

    public function test_get_date_ranges(): void
    {
        $startDate = CarbonImmutable::parse('2022-10-01');
        $endDate = CarbonImmutable::parse('2022-10-31');

        $period = new Period($startDate, $endDate);

        $dateRange = $period->getDateRange();

        $this->assertInstanceOf(DateRange::class, $dateRange);

        $this->assertEquals($startDate->toDateString(), $dateRange->getStartDate());
        $this->assertEquals($endDate->toDateString(), $dateRange->getEndDate());
    }
}
