<?php

namespace GarrettMassey\Analytics\Parameters;

use GarrettMassey\Analytics\Analytics;
use Google\Analytics\Data\V1beta\Dimension;
use Illuminate\Support\Collection;

class Dimensions
{

    private Collection $dimensions;

    public function __construct()
    {
        $this->dimensions = collect();
    }

    public function getDimensions(): Collection
    {
        return $this->dimensions;
    }

    public function eventName(): Dimensions
    {
        $this->dimensions->push(new Dimension(['name' => 'eventName']));
        return $this;
    }

    public function pageTitle(): Dimensions
    {

        $this->dimensions->push(new Dimension(['name' => 'pageTitle']));

        return $this;
    }

    public function pagePath(): Dimensions
    {

        $this->dimensions->push(new Dimension(['name' => 'pagePath']));

        return $this;
    }

}
