# Analytics

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Build Google Analytics queries in Laravel with ease.

## Installation

Via Composer

``` bash
$ composer require garrettmassey/analytics
```

To use this package, you must have a Google Cloud Service Accounts Credential.

Go to the [Google Cloud Console](https://console.cloud.google.com/apis/credentials/), create a new project, and enable the Google Analytics API.

On the top of the screen, there is a button to create a new service account key. Create a new `json` key and download it.

Once downloaded, upload the key to the `app/analyticsAPI` directory in your Laravel project.

Finally, copy the Google Analytics Property ID and set the environment variables:

``` bash
ANALYTICS_YEAR_TYPE="fiscal|calendar"
ANALYTICS_PROPERTY_ID="XXXXXXXXX"
```

where the year type is whether you consider Quarter 1 to be January-March (calendar) or July-September (fiscal).

From there, you can use the `Analytics` facade to access the API.

## Usage

Once installation is complete, you can run Google Analytics Data API queries in your application.

All Google Analytics Data API queries require a date range to be run. Use the `Period` or `Quarter` classes to generate a period of time for the query.

You can use two approaches to add query parameters to the request. 

### 1. Callbacks
``` php
use GarrettMassey\Analytics\Facades\Analytics;
use GarrettMassey\Analytics\Period;

$period = Period::create(
    Carbon::create('2020', '01', '01'),
    Carbon::create('2020', '01', '31')
);

$report = Analytics::query();
$report->setMetrics(function ($q) {
    $q->totalUsers();
})->setDimensions(function ($q) {
    $q->pagePath();
})->forPeriod($period)->run();
```

This will return a collection of rows with additional fields for the metrics and dimensions.

### 2. Arrays
``` php
use GarrettMassey\Analytics\Facades\Analytics;
use GarrettMassey\Analytics\Period;

$period = Period::create(
    Carbon::create('2020', '01', '01'),
    Carbon::create('2020', '01', '31')
);

$report = Analytics::query();
$report->metrics([
    'totalUsers'
])->dimensions([
    'pagePath'
])->forPeriod($period)->run();
```

This will return the same collection as the callback example. The two methods exist as a way to help build different queries based on user preference.

## Change log

To Be Completed

## Testing

TODO: write tests

``` bash
$ composer test
```

## Contributing

To Be Completed

## Security

If you discover any security related issues, please email contact@garrettmassey.net instead of using the issue tracker.

## Credits

- [Garrett Massey][https://www.garrettmassey.net/]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/garrettmassey/analytics.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/garrettmassey/analytics.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/garrettmassey/analytics/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/garrettmassey/analytics
[link-downloads]: https://packagist.org/packages/garrettmassey/analytics
[link-travis]: https://travis-ci.org/garrettmassey/analytics
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/garrettmassey
[link-contributors]: ../../contributors
