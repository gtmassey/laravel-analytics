<?php

namespace Gtmassey\LaravelAnalytics\Request\Filters;

enum FilterExpressionField: string
{
    case AND_GROUP = 'and_group';
    case OR_GROUP = 'or_group';
    case NOT_EXPRESSION = 'not_expression';
    case FILTER = 'filter';
}
