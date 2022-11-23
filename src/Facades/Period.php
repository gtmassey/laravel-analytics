<?php

namespace GarrettMassey\Analytics\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GarrettMassey\Analytics\Analytics
 */
class Period extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \GarrettMassey\Analytics\Period::class;
    }
}
