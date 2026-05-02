<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

'serper' => [
        'api_key' => env('SERPER_API_KEY'),
        'endpoint' => env('SERPER_ENDPOINT', 'https://google.serper.dev/search'),
        // Rate limiting - limits untuk mencegah exceed quota
        'daily_limit' => env('SERPER_DAILY_LIMIT', 100),     // Max 100/hari (free tier: 2500/bulan)
        'monthly_limit' => env('SERPER_MONTHLY_LIMIT', 2000),  // Max 2000/bulan (safety margin)
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
