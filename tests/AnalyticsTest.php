<?php

namespace GarrettMassey\Analytics\Tests;

use Exception;
use GarrettMassey\Analytics\Analytics;

class AnalyticsTest extends TestCase
{
    public function test_default_constructor(): void
    {
        $this->assertInstanceOf(Analytics::class, new Analytics());
    }

    public function test_property_string_is_empty_exception(): void
    {
        config()->set('analytics.credentials.file');
        config()->set('analytics.credentials.json', json_encode($this->credentials()));
        config()->set('analytics.property_id', null);

        $this->expectException(Exception::class);

        Analytics::query();
    }

    public function test_property_string_is_not_string_exception(): void
    {
        config()->set('analytics.credentials.file');
        config()->set('analytics.credentials.json', json_encode($this->credentials()));
        config()->set('analytics.property_id', 1234);

        $this->expectException(Exception::class);

        Analytics::query();
    }
}
