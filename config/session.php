<?php

return [

    'default' => env('SESSION_DRIVER', 'database'),

    'stores' => [

        'array' => [
            'driver' => 'array',
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('SESSION_CONNECTION', null),
            'table' => env('SESSION_TABLE', 'sessions'),
            'cookie' => env('SESSION_COOKIE', str()->slug(env('APP_NAME', 'laravel'), '_').'_session'),
            'path' => env('SESSION_PATH', '/'),
            'domain' => env('SESSION_DOMAIN', null),
            'lifetime' => env('SESSION_LIFETIME', 120),
            'lottery' => [2, 100],
            'encrypt' => env('SESSION_ENCRYPT', false),
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/sessions'),
            'cookie' => env('SESSION_COOKIE', str()->slug(env('APP_NAME', 'laravel'), '_').'_session'),
            'path' => env('SESSION_PATH', '/'),
            'domain' => env('SESSION_DOMAIN', null),
            'lifetime' => env('SESSION_LIFETIME', 120),
            'lottery' => [2, 100],
            'encrypt' => env('SESSION_ENCRYPT', false),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('SESSION_REDIS_CONNECTION', 'default'),
            'cookie' => env('SESSION_COOKIE', str()->slug(env('APP_NAME', 'laravel'), '_').'_session'),
            'path' => env('SESSION_PATH', '/'),
            'domain' => env('SESSION_DOMAIN', null),
            'lifetime' => env('SESSION_LIFETIME', 120),
            'lottery' => [2, 100],
            'encrypt' => env('SESSION_ENCRYPT', false),
        ],

    ],

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    'encrypt' => env('SESSION_ENCRYPT', false),

    'lottery' => [2, 100],

    'cookie' => env('SESSION_COOKIE', str()->slug(env('APP_NAME', 'laravel'), '_').'_session'),

    'path' => env('SESSION_PATH', '/'),

    'domain' => env('SESSION_DOMAIN', null),

    'secure' => env('SESSION_SECURE_COOKIE'),

    'http_only' => env('SESSION_HTTP_ONLY', true),

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
