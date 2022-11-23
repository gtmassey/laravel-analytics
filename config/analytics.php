<?php

return [
    //the type of year to use for Quarter, fiscal or calendar
    'year_type'   => env('ANALYTICS_YEAR_TYPE', 'fiscal'),
    'property_id' => env('ANALYTICS_PROPERTY_ID'),

	'credentials' => [
		'use_env' => env('ANALYTICS_CREDENTIALS_USE_ENV', true),

		'file' => env('ANALYTICS_CREDENTIALS_FILE'),

		'json' => env('ANALYTICS_CREDENTIALS_JSON'),

		'array' => env('ANALYTICS_CREDENTIALS_ARRAY', [
			'type' => env('ANALYTICS_CREDENTIALS_TYPE'),
			'project_id' => env('ANALYTICS_CREDENTIALS_PROJECT_ID'),
			'private_key_id' => env('ANALYTICS_CREDENTIALS_PRIVATE_KEY_ID'),
			'private_key' => env('ANALYTICS_CREDENTIALS_PRIVATE_KEY'),
			'client_email' => env('ANALYTICS_CREDENTIALS_CLIENT_EMAIL'),
			'client_id' => env('ANALYTICS_CREDENTIALS_CLIENT_ID'),
			'auth_uri' => env('ANALYTICS_CREDENTIALS_AUTH_URI'),
			'token_uri' => env('ANALYTICS_CREDENTIALS_TOKEN_URI'),
			'auth_provider_x509_cert_url' => env('ANALYTICS_CREDENTIALS_AUTH_PROVIDER_X509_CERT_URL'),
			'client_x509_cert_url' => env('ANALYTICS_CREDENTIALS_CLIENT_X509_CERT_URL'),
		]),
	]
];
