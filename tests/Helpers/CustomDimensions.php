<?php

namespace Gtmassey\LaravelAnalytics\Tests\Helpers;

use Google\Analytics\Data\V1beta\Dimension;
use Gtmassey\LaravelAnalytics\Request\Dimensions;

class CustomDimensions extends Dimensions
{
    public function customDimension(): self
    {
        $this->dimensions->push(new Dimension(['name' => 'customDimension']));

        return $this;
    }
}
