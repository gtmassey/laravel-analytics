<?php

namespace Gtmassey\LaravelAnalytics\Request\Filters;

use Google\Analytics\Data\V1beta\Filter\BetweenFilter as BaseBetweenFilter;
use Google\Analytics\Data\V1beta\Filter\InListFilter as BaseInListFilter;
use Google\Analytics\Data\V1beta\Filter\NumericFilter as BaseNumericFilter;
use Google\Analytics\Data\V1beta\Filter\StringFilter as BaseStringFilter;

interface FilterContract
{
    public function field(): FilterField;

    public function toRequest(): BaseStringFilter|BaseInListFilter|BaseNumericFilter|BaseBetweenFilter;
}
