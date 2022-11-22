<?php

namespace GarrettMassey\Analytics;

use Carbon\CarbonImmutable;
use GarrettMassey\Analytics\Parameters\Dimensions;
use GarrettMassey\Analytics\Parameters\Metrics;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Illuminate\Support\Collection;

class Analytics {
	//TODO: clean up class, add comments
	//TODO: add support for remaining metrics and dimensions
	//TODO: add generic report generation (i.e. things like getUsersAndPageViews($period) )
	public string $viewId;
	public string $propertyID;
	public Collection $dimensions;
	public Collection $metrics;
	public Collection $dateRanges;
	public string $dimensionsFilter;
	public string $metricsFilter;
	public string $orderBys;
	public string $limit;
	public string $offset;
	public string $currencyCode;
	public string $cohortSpec;
	public bool $keepEmptyRows;
	public bool $returnPropertyQuota;
	public BetaAnalyticsDataClient $client;

	public function __construct()
	{
		putenv('GOOGLE_APPLICATION_CREDENTIALS=' . config('analytics.credentials_path') . config('analytics.credentials_file'));
		$this->client = resolve(BetaAnalyticsDataClient::class);
		$this->propertyID = config('analytics.property_id');
		$this->dimensions = collect([]);
		$this->metrics = collect([]);
		$this->dateRanges = collect([]);

		return $this;
	}

	public static function query()
	{
		return new Analytics();
	}

	public function getClient(): BetaAnalyticsDataClient
	{
		return $this->client;
	}

	/****************************************
	 * Pre-Built Reports and Queries
	 ****************************************/

	/**
	 * return a collection of the top events for the last 30 days
	 * along with the count of each event, ordered in descending order
	 *
	 * @return void
	 */
	public static function getTopEvents()
	{
		$query = Analytics::query();
		$query->setMetrics(function (Metrics $metric) {
			return $metric->eventCount();
		})->setDimensions(function (Dimensions $dimension) {
			return $dimension->eventName();
		})->forPeriod(
			Period::create(
				CarbonImmutable::now()->subDays(30),
				CarbonImmutable::now()
			)
		);

		return $query->run();
	}

	/****************************************
	 * Query Builders
	 ****************************************/

	/**
	 * Ability to add metrics to the query using a callback method
	 * for example:
	 * $query->setMetrics(function ($q) { $q->sessions(); $q->bounceRate(); });
	 *
	 * @param    callable    $callback
	 *
	 * @return $this
	 */
	public function setMetrics(callable $callback)
	{
		$metrics = $callback(new Metrics());
		$this->metrics = $metrics->getMetrics();

		return $this;
	}

	/**
	 * Ability to add dimensions to the query using a callback method
	 * for example:
	 * $query->setDimensions(function ($q) { $q->pageTitle(); $q->pagePath(); });
	 *
	 * @param    callable    $callback
	 *
	 * @return $this
	 */
	public function setDimensions(callable $callback)
	{
		$dimensions = $callback(new Dimensions());
		$this->dimensions = $dimensions->getDimensions();

		return $this;
	}

	/**
	 * Ability to add multiple metrics at a time in an array format
	 * for example:
	 * $query->metrics(['totalUsers', 'newUsers']);
	 *
	 * @param    array    $metrics
	 *
	 * @return $this
	 */
	public function metrics(array $metrics): static
	{
		$metricObj = new Metrics();
		foreach ($metrics as $metric) {
			$metricObj->$metric();
		}
		$this->metrics = $metricObj->getMetrics();

		return $this;
	}

	/**
	 * Ability to add multiple metrics at a time in an array format
	 * for example:
	 * $query->metrics(['totalUsers', 'newUsers']);
	 *
	 * @param    array    $dimensions
	 *
	 * @return $this
	 */
	public function dimensions(array $dimensions): static
	{
		$dimensionsObj = new Dimensions();
		foreach ($dimensions as $dimension) {
			$dimensionsObj->$dimension();
		}
		$this->dimensions = $dimensionsObj->getDimensions();

		return $this;
	}

	public function forPeriod(Period $period)
	{
		$this->dateRanges->push($period->getDateRanges());

		return $this;
	}

	/****************************************
	 * Process and Run Query
	 ****************************************/

	public function run()
	{
		return $this->buildQueryArray();
	}

	private function buildQueryArray()
	{
		$dimensions = collect(['dimensions' => $this->dimensions]);
		$metrics = collect(['metrics' => $this->metrics]);
		$dateRanges = collect(['dateRanges' => $this->dateRanges]);
		$resource = collect(
			$dateRanges->merge(
				$dimensions->merge(
					$metrics
				)
			)
		);
		$request = collect(['property' => 'properties/' . $this->propertyID]);
		$request = $request->merge($resource);
		//get the last error message from json
		//ddd($request->toArray());
		$results = $this->client->runReport($request->toArray());

		return self::toCollection($results);
	}

	//TODO: clean up the data structure of $results, convert to collection
	private static function toCollection($results)
	{
		return $results;
		dd($results);
	}
}
