<?php

namespace Gtmassey\LaravelAnalytics\Request\Filters;

enum NumericValueType: string
{
    case INTEGER = 'int64_value';
    case FLOAT = 'double_value';
}
