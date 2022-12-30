<?php

namespace Gtmassey\LaravelAnalytics\Tests;

use Gtmassey\LaravelAnalytics\Analytics;
use Gtmassey\LaravelAnalytics\Request\Filters\Filter;
use Gtmassey\LaravelAnalytics\Request\Filters\FilterExpression;
use Gtmassey\LaravelAnalytics\Request\Filters\FilterExpressionList;
use Gtmassey\LaravelAnalytics\Request\RequestData;
use ReflectionProperty;

class FiltersTest extends TestCase
{
    public function testFilters(): void
    {
		$this->markTestSkipped();
        $analytics = Analytics::query()
//			->dimensionFilter(fn(FilterExpression $filterExpression) => $filterExpression
//				->not(fn(FilterExpression $filterExpression) => $filterExpression
//					->filter('browser', fn(Filter $filter) => $filter
//						->contains('safari')
//					)
//				)
//			)
            ->dimensionFilter(fn (FilterExpression $filterExpression) => $filterExpression
                ->andGroup(fn (FilterExpressionList $filterExpressionList) => $filterExpressionList
                    ->filter()
                )
                ->not(fn (FilterExpression $filterExpression) => $filterExpression
                    ->filter('browser', fn (Filter $filter) => $filter
                        ->contains('safari')
                    )
                )
            );

        /** @var RequestData $requestData */
        $requestData = (new ReflectionProperty(Analytics::class, 'requestData'))->getValue($analytics);
        dd(json_decode($requestData->dimensionFilter?->toRequest()->serializeToJsonString()));

        //			->setFilters(function (FilterExpression $filterExpression) {
        //				return $filterExpression->orGroup(fn(OrGroup $orGroup) => $orGroup
        //					->addFilter(fn(FilterExpression $filterExpression) => $filterExpression
        //						->not(fn(FilterExpression $filterExpression) => $filterExpression
        //							->filter($dimension, fn(Filter $filter) => $filter
        //								->contains('Chrome')
        //							)
        //						)
        //					)
        //					->addFilter(fn(FilterExpression $filterExpression) => $filterExpression
        //						->filter($dimension)->contains('Chrome')
        //					)
        //				);
        //			})

        //			->run();
    }
}
