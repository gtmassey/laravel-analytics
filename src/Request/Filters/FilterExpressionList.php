<?php

namespace Gtmassey\LaravelAnalytics\Request\Filters;

use Closure;
use Google\Analytics\Data\V1beta\FilterExpressionList as BaseFilterExpressionList;
use Gtmassey\LaravelAnalytics\Exceptions\InvalidFilterException;
use Illuminate\Support\Collection;

class FilterExpressionList
{
    public function __construct(
        /** @var Collection<int, FilterExpression> */
        private readonly Collection $expressions = new Collection(),
    ) {
    }

    /**
     * @param  Closure(FilterExpressionList): FilterExpressionList  $filterExpressionList
     * @return static
     */
    public function andGroup(Closure $filterExpressionList): static
    {
        $this->expressions->push((new FilterExpression())->andGroup($filterExpressionList));

        return $this;
    }

    /**
     * @param  Closure(FilterExpressionList): FilterExpressionList  $filterExpressionList
     * @return static
     */
    public function orGroup(Closure $filterExpressionList): static
    {
        $this->expressions->push((new FilterExpression())->orGroup($filterExpressionList));

        return $this;
    }

    /**
     * @param  Closure(FilterExpression): FilterExpression  $filterExpression
     * @return static
     */
    public function not(Closure $filterExpression): static
    {
        $this->expressions->push((new FilterExpression())->not($filterExpression));

        return $this;
    }

    /**
     * @param  string  $dimension
     * @param  Closure(Filter): Filter  $filter
     * @return static
     */
    public function filter(string $dimension, Closure $filter): static
    {
        $this->expressions->push((new FilterExpression())->filter($dimension, $filter));

        return $this;
    }

    /**
     * @param  Closure  $dimensionsCallback
     * @param  Closure(Filter): Filter  $filter
     * @return static
     *
     * @throws InvalidFilterException
     */
    public function filterDimension(Closure $dimensionsCallback, Closure $filter): static
    {
        $this->expressions->push((new FilterExpression())->filterDimension($dimensionsCallback, $filter));

        return $this;
    }

    /**
     * @param  Closure  $metricsCallback
     * @param  Closure(Filter): Filter  $filter
     * @return static
     *
     * @throws InvalidFilterException
     */
    public function filterMetric(Closure $metricsCallback, Closure $filter): static
    {
        $this->expressions->push((new FilterExpression())->filterMetric($metricsCallback, $filter));

        return $this;
    }

    public function toRequest(): BaseFilterExpressionList
    {
        return new BaseFilterExpressionList([
            'expressions' => $this->expressions
                ->map(fn (FilterExpression $filterExpression) => $filterExpression->toRequest())
                ->toArray(),
        ]);
    }
}
