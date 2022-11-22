<?php

namespace Tests;

use GarrettMassey\Analytics\Parameters\Dimensions;
use Orchestra\Testbench\TestCase as Orchestra;

class DimensionsTest extends Orchestra
{
    /*
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'GarrettMassey\\Analytics\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AnalyticsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
    */

    /** @test */
    public function assert_get_dimensions_returns_collection()
    {
        $dimensions = new Dimensions();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $dimensions->getDimensions());
    }

}
