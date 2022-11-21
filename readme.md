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

## Setup

To use this package, you must have a Google Cloud Service Accounts Credential.

If you do not have a project set up on Google Cloud Platform, visit [console.cloud.google.com/projectcreate](https://console.cloud.google.com/projectcreate) to create a new project.

Once you have a project, make sure you have selected that project in the top left corner of the console.

//PIC

Select APIs & Services from the quick access cards on the dashboard.

//PIC

Make sure you have Google Analytics Data API enabled. NOTE: this is NOT the same API as Google Analytics API. The Data API is the required API for this package.

//PIC

Once enabled, select the Google Analytics Data API from the list of APIs, and click the Credentials tab. 

//PIC

Click the Create Credentials button, and select Service Account.

//PIC

Select the role you want to assign to the service account. For this package, the minimum role is the Viewer role.

//PIC

Once the service account is created, add a new key to the service account. Select JSON as the key type.

Once the key is created, download the JSON file and save it somewhere safe. You will need this file to use this package. If you lose this file, you will have to create a new service account. Google does not let you re-issue keys.

Move the `JSON` key file to your project's `root/analyticsAPI` directory. Name the file `credentials.json`. 

//PIC

Finally, open Google Analytics, and copy the property ID for the property you want to query. You will need this ID to use this package.

//PIC

Set the property ID in your `.env` file, along with the year type (either fiscal or calendar).

``` bash
ANALYTICS_YEAR_TYPE="fiscal|calendar"
ANALYTICS_PROPERTY_ID="XXXXXXXXX"
```

where the year type is whether you consider Quarter 1 to be January-March (calendar) or July-September (fiscal).

Now you're ready to start!

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
