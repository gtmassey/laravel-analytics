<?php

return [
    //the type of year to use for Quarter, fiscal or calendar
    'year_type'   => env('ANALYTICS_YEAR_TYPE', 'fiscal'),
    'property_id' => env('ANALYTICS_PROPERTY_ID'),
    'api_key'     => [
        'type' => env('ANALYTICS_TYPE'),
        'project_id' => env('ANALYTICS_PROJECT_ID'),
        'private_key_id' => env('ANALYTICS_PRIVATE_KEY_ID'),
        'private_key' => env('ANALYTICS_PRIVATE_KEY'),
        'client_email' => env('ANALYTICS_CLIENT_EMAIL'),
        'client_id' => env('ANALYTICS_CLIENT_ID'),
        'auth_uri' => env('ANALYTICS_AUTH_URI'),
        'token_uri' => env('ANALYTICS_TOKEN_URI'),
        'auth_provider_x509_cert_url' => env('ANALYTICS_AUTH_PROVIDER'),
        'client_x509_cert_url' => env('ANALYTICS_CERT_URL'),
    ],
];
