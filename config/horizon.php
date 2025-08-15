<?php

return [
    'domain' => env('HORIZON_DOMAIN'),

    'path' => env('HORIZON_PATH', 'horizon'),

    'middleware' => ['web'],

    'waits' => [
        'redis:default' => 60,
    ],

    'trim' => [
        'recent' => 60,
        'pending' => 60,
        'completed' => 60,
        'recent_failed' => 60,
        'failed' => 10080,
        'monitored' => 60,
    ],
];
