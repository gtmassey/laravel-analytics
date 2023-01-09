<?php

namespace Gtmassey\LaravelAnalytics\Request\Filters;

enum FilterField: string
{
    case STRING_FILTER = 'string_filter';
    case IN_LIST_FILTER = 'in_list_filter';
    case NUMERIC_FILTER = 'numeric_filter';
    case BETWEEN_FILTER = 'between_filter';
}
