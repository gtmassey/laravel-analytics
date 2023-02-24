<?php

namespace Gtmassey\LaravelAnalytics\Request\Filters;

use Closure;
use Google\Analytics\Data\V1beta\FilterExpression as BaseFilterExpression;
use Gtmassey\LaravelAnalytics\Exceptions\InvalidFilterException;
use Gtmassey\LaravelAnalytics\Request\Dimensions;
use Gtmassey\LaravelAnalytics\Request\Metrics;

class FilterExpression
{
    private FilterExpressionContract $expression;

    /**
     * @param  Closure(FilterExpressionList): FilterExpressionList  $filterExpressionList
     */
    public function andGroup(Closure $filterExpressionList): static
    {
        $this->expression = new AndGroup($filterExpressionList);

        return $this;
    }

    /**
     * @param  Closure(FilterExpressionList): FilterExpressionList  $filterExpressionList
     */
    public function orGroup(Closure $filterExpressionList): static
    {
        $this->expression = new OrGroup($filterExpressionList);

        return $this;
    }

    /**
     * @param  Closure(FilterExpression): FilterExpression  $filterExpression
     */
    public function not(Closure $filterExpression): static
    {
        $this->expression = new NotExpression($filterExpression);

        return $this;
    }

    /**
     * @param  Closure(Filter): Filter  $filter
     */
    public function filter(string $dimension, Closure $filter): static
    {
        $this->expression = $filter(new Filter($dimension));

        return $this;
    }

    /**
     * @param  Closure(Filter): Filter  $filter
     *
     * @throws InvalidFilterException
     */
    public function filterDimension(Closure $dimensionsCallback, Closure $filter): static
    {
        /** @var Dimensions $dimensions */
        $dimensions = $dimensionsCallback(resolve(Dimensions::class));

        $firstDimension = $dimensions->first();

        if ($firstDimension === null) {
            throw InvalidFilterException::noDimensionFilter();
        }

        return $this->filter($firstDimension->getName(), $filter);
    }

    /**
     * @param  Closure(Filter): Filter  $filter
     *
     * @throws InvalidFilterException
     */
    public function filterMetric(Closure $metricsCallback, Closure $filter): static
    {
        /** @var Metrics $metrics */
        $metrics = $metricsCallback(resolve(Metrics::class));

        $firstMetric = $metrics->first();

        if ($firstMetric === null) {
            throw InvalidFilterException::noMetricFilter();
        }

        return $this->filter($firstMetric->getName(), $filter);
    }

    public function toRequest(): BaseFilterExpression
    {
        return new BaseFilterExpression([
            $this->expression->field()->value => $this->expression->toRequest(),
        ]);
    }
}
