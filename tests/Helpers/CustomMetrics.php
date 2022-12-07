<?php

namespace Gtmassey\LaravelAnalytics\Tests\Helpers;

use Google\Analytics\Data\V1beta\Metric;
use Gtmassey\LaravelAnalytics\Request\Metrics;

class CustomMetrics extends Metrics
{
	public function customMetric(): self
	{
		$this->metrics->push(new Metric(['name' => 'customMetric']));

		return $this;
	}
}
