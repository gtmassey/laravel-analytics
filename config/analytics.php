<?php

return [
    //the type of year to use for Quarter, fiscal or calendar
    'year_type' => env('ANALYTICS_YEAR_TYPE', 'fiscal'),
    'property_id' => env('ANALYTICS_PROPERTY_ID'),
    'credentials_path' => env('ANALYTICS_CREDENTIALS_PATH'),
    'credentials_file' => env('ANALYTICS_CREDENTIALS_FILE'),
];
