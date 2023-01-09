<?php

namespace Gtmassey\LaravelAnalytics\Request\Filters;

use Google\Analytics\Data\V1beta\Filter as BaseFilter;
use Google\Analytics\Data\V1beta\FilterExpression as BaseFilterExpression;
use Google\Analytics\Data\V1beta\FilterExpressionList as BaseFilterExpressionList;

interface FilterExpressionContract
{
    public function field(): FilterExpressionField;

    public function toRequest(): BaseFilter|BaseFilterExpression|BaseFilterExpressionList;
}
