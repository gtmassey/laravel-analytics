# Analytics

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Tests][ico-tests]][link-tests]

Build Google Analytics Data API queries in Laravel with ease!

Methods currently return an instance of `Gtmassey\LaravelAnalytics\ResponseData`, containing the dimension and metric headers, and results in `rows`.

**Table of Contents:**

* [Installation](#instal)
* [Setup](#setup)
    * [As ENV file (default)](#env)
    * [Separate JSON File](#json)
    * [JSON String](#jsonString)
    * [Separate Values](#vals)
* [Usage](#usage)
    * [Query Builder](#querybuilder)
    * [Default Reports](#defaultreports)
* [Changelog](#changelog)
* [Testing](#testing)

## <a name="instal">Installation</a>

Via Composer

```SHELL
composer require gtmassey\laravel-analytics
```

## <a name="setup">Setup</a>

To use this package, you must have a Google Cloud Service Accounts Credential.

If you do not have a project set up on Google Cloud Platform, visit [console.cloud.google.com/projectcreate](https://console.cloud.google.com/projectcreate) to create a new project.

Once you have a project, make sure you have selected that project in the top left corner of the console.

![Screen Shot 2022-11-30 at 2 22 35 PM](https://user-images.githubusercontent.com/109831143/204912891-624b9403-12f4-484a-8d12-368d8b56a805.png)

Select APIs & Services from the quick access cards on the dashboard.

![Screen Shot 2022-11-30 at 2 22 54 PM](https://user-images.githubusercontent.com/109831143/204912927-8acb75be-f92e-451c-8e06-cae33430425a.png)

Make sure you have Google Analytics Data API enabled. NOTE: this is NOT the same API as Google Analytics API. The Data API is the required API for this package. If you do not have the Google Analytics Data API enabled, you can add it to your Cloud Console account by clicking "enable APIs and Services"

![Screen Shot 2022-11-30 at 2 23 25 PM](https://user-images.githubusercontent.com/109831143/204913094-e8967a6b-fed8-43c1-afbc-fafa3c6d0907.png)

You can search for the Google Analytics Data API and enable it through the Google API Library

![Screen Shot 2022-11-30 at 2 24 09 PM](https://user-images.githubusercontent.com/109831143/204913299-365425cb-b71e-41fe-aa55-fbefcb7c6b6f.png)

![Screen Shot 2022-11-30 at 2 24 21 PM](https://user-images.githubusercontent.com/109831143/204913340-17655e94-8233-404d-9c29-ed100273453c.png)

Once enabled, select the Google Analytics Data API from the list of APIs, and click the Credentials tab.

![Screen Shot 2022-11-30 at 2 24 48 PM](https://user-images.githubusercontent.com/109831143/204913379-d751a05f-5884-4f8e-a952-845312f1cad5.png)

If you already have a service account set up with this API, you can skip the next step.

Click the Create Credentials button, and select Service Account.

![Screen Shot 2022-11-30 at 2 26 24 PM](https://user-images.githubusercontent.com/109831143/204913480-2eaa83e4-f786-4815-9848-d533587d0a51.png)

Select the role you want to assign to the service account. For this package, the minimum role is the Viewer role.

Once your service account has been created, click on the account to go to the IAM & Admin section of Google Cloud Console.

In the Service Accounts section of the IAM & Admin page, select the appropriate service account, and create a new JSON key for the account:

![Screen Shot 2022-11-30 at 2 27 01 PM](https://user-images.githubusercontent.com/109831143/204913731-8907f7ec-17ad-453e-8721-7098d71e3ab9.png)

![Screen Shot 2022-11-30 at 2 27 14 PM](https://user-images.githubusercontent.com/109831143/204913810-41a9739b-fdb9-4500-8e81-aaf083bb873c.png)

Once the key is created, download the JSON file and save it somewhere safe. You will need this file to use this package. If you lose this file, you will have to create a new service account. Google does not let you re-issue keys.

You can use these credentials in several ways:

### <a name="env">As ENV value (default)</a>
This is ideal setup if you're using only one service account for your application.

Specify the path to the JSON file in your .env file:
```dotenv
GOOGLE_APPLICATION_CREDENTIALS=/path/to/credentials.json
```

### <a name="json">As a separate JSON file</a>
If you have multiple service accounts, you can instruct this package to use a specific one:

```dotenv
ANALYTICS_CREDENTIALS_USE_ENV=false
ANALYTICS_CREDENTIALS_FILE=/path/to/credentials.json
```

### <a name="jsonString">As a JSON string</a>
If you don't want to store the credentials in a file, you can specify the JSON string directly in your .env file:

```dotenv
ANALYTICS_CREDENTIALS_USE_ENV=false
ANALYTICS_CREDENTIALS_JSON="{type: service_account, project_id: ...}"
```

### <a name="vals">As separate values</a>
You can also specify the credentials as separate values in your .env file:

```dotenv
ANALYTICS_CREDENTIALS_USE_ENV=false
ANALYTICS_CREDENTIALS_TYPE=service_account
ANALYTICS_CREDENTIALS_PROJECT_ID=...
ANALYTICS_CREDENTIALS_PRIVATE_KEY_ID=...
ANALYTICS_CREDENTIALS_PRIVATE_KEY=...
ANALYTICS_CREDENTIALS_CLIENT_EMAIL=...
ANALYTICS_CREDENTIALS_CLIENT_ID=...
ANALYTICS_CREDENTIALS_AUTH_URI=...
ANALYTICS_CREDENTIALS_TOKEN_URI=...
ANALYTICS_CREDENTIALS_AUTH_PROVIDER_X509_CERT_URL=...
ANALYTICS_CREDENTIALS_CLIENT_X509_CERT_URL=...
```

> **Warning**
> Package will always prioritize `GOOGLE_APPLICATION_CREDENTIALS` env value over other options. If you want to use a separate service account, make sure to set `ANALYTICS_CREDENTIALS_USE_ENV=false`.

Finally, open Google Analytics, and copy the property ID for the property you want to query. You will need this ID to use this package.

![Screen Shot 2022-11-30 at 2 40 42 PM](https://user-images.githubusercontent.com/109831143/204914645-385e0b5c-f248-4dad-b99c-2064f5ca8be6.png)

Set the property ID in your `.env` file.

```dotenv
ANALYTICS_PROPERTY_ID="XXXXXXXXX"
```

Now you're ready to start!

## Usage

Once installation is complete, you can run Google Analytics Data API queries in your application.

All Google Analytics Data API queries require a date range to be run. Use the `Period` class to generate a period of time for the query.

### <a name="querybuilder">Query Builder:</a>
```php
use Gtmassey\LaravelAnalytics\Request\Dimensions;
use Gtmassey\LaravelAnalytics\Request\Metrics;
use Gtmassey\LaravelAnalytics\Analytics;
use Gtmassey\LaravelAnalytics\Period;
use Carbon\Carbon;

$report = Analytics::query()
     ->setMetrics(function (Metrics $metrics) {
         return $metrics->active1DayUsers()
             ->active7DayUsers()
             ->active28DayUsers();
     })->forPeriod(Period::defaultPeriod())
     ->run();

 $report2 = Analytics::query()
     ->setMetrics(function (Metrics $metrics) {
         return $metrics->sessions();
     })->setDimensions(function (Dimensions $dimensions) {
         return $dimensions->pageTitle();
     })->forPeriod(Period::create(Carbon::now()->subDays(30), Carbon::now()))
     ->run();
```

### <a name="defaultreports">Default Reports:</a>

#### getTopEvents()
```php
$report = Analytics::getTopEvents();
```

This method returns the top events for the given period. It accepts a `Period` object as an optional parameter.

If a `Period` object is not passed, it will use the default period set in `Period::defaultPeriod()`.

The method will return an instance of `Gtmassey\LaravelAnalytics\Response\ResponseData`, which contains `DimensionHeaders`, `MetricHeaders`, `Rows`, and additional metadata.

example output:
```bash
Gtmassey\LaravelAnalytics\Response\ResponseData {
  +dimensionHeaders: Spatie\LaravelData\DataCollection {
    +items: array:1 [
      0 => Gtmassey\LaravelAnalytics\Response\DimensionHeader {
        +name: "eventName"
      }
    ]
  }
  +metricHeaders: Spatie\LaravelData\DataCollection {
    +items: array:1 [
      0 => Gtmassey\LaravelAnalytics\Response\MetricHeader {
        +name: "eventCount"
        +type: "TYPE_INTEGER"
      }
    ]
  }
  +rows: Spatie\LaravelData\DataCollection {
    +items: array:6 [
      0 => Gtmassey\LaravelAnalytics\Response\Row {
        +dimensionValues: Spatie\LaravelData\DataCollection {
          +items: array:1 [
            0 => Gtmassey\LaravelAnalytics\Response\DimensionValue {
              +value: "page_view"
            }
          ]
        }
        +metricValues: Spatie\LaravelData\DataCollection {
          +items: array:1 [
            0 => Gtmassey\LaravelAnalytics\Response\MetricValue {
              +value: "1510"
            }
          ]
        }
      }
      1 => Gtmassey\LaravelAnalytics\Response\Row {}
      2 => Gtmassey\LaravelAnalytics\Response\Row {}
      3 => Gtmassey\LaravelAnalytics\Response\Row {}
      4 => Gtmassey\LaravelAnalytics\Response\Row {}
      5 => Gtmassey\LaravelAnalytics\Response\Row {}
    ]
  }
  +totals: null
  +rowCount: 6
  +metadata: Gtmassey\LaravelAnalytics\Response\Metadata {}
  +propertyQuota: null
  +kind: "analyticsData#runReport"
}
```

#### getTopPages()

```php
$report = Analytics::getTopPages();
```

This method returns the top pages for the given period. It accepts a `Period` object as an optional parameter.

The pages along with the sessions for that page are listed in the `Rows` property of the response.

#### getUserAcquisitionOverview()

```php
$report = Analytics::getUserAcquisitionOverview();
```

This method returns the user acquisition overview for the given period. It accepts a `Period` object as an optional parameter.

The method will return a `ResponseData` object with the number of sessions by the session's primary acquisition source. Primary acquisition sources are either "direct", "Referral", "Organic Search", and "Organic Social".

#### getUserEngagement()

```php
$report = Analytics::getUserEngagement();
```

This method returns a `ResponseData` object without dimensions. The query only contains metrics. The `ResponseData` object will contain:

* average session duration, in seconds
* number of engaged sessions
* number of sessions per user
* total number of sessions

## <a name="changelog">Change log</a>

Read [CHANGELOG.md](changelog.md)

## <a name="testing">Testing</a>

To run tests, run:

```bash
composer test
```

Note that this command also runs code coverage analysis.

## Contributing

Check out [the contributing guide](contributing.md)

## Security

If you discover any security related issues, please email contact@garrettmassey.net instead of using the issue tracker.

## Credits

- [Garrett Massey](https://www.garrettmassey.net/)
- [All Contributors][link-contributors]

Special thanks to [Plytas](https://github.com/Plytas) for their early and significant contributions to the project. Without their help setting things up and their willingness to teach me new tools and techniques, this project would be dead in its tracks.

And a huge thanks to the team over at [Spatie](https://github.com/spatie) for their continued contributions to the open source community! Some of their work is used in this project, and I have used their packages as a foundation for projects for years.

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/gtmassey/laravel-analytics.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/gtmassey/laravel-analytics.svg?style=flat-square
[ico-tests]: https://github.com/gtmassey/Analytics/actions/workflows/run-tests.yml/badge.svg

[link-packagist]: https://packagist.org/packages/gtmassey/laravel-analytics
[link-downloads]: https://packagist.org/packages/gtmassey/laravel-analytics
[link-tests]: https://github.com/gtmassey/Analytics/actions/workflows/run-tests.yml
[link-author]: https://github.com/gtmassey
[link-contributors]: ../../contributors
