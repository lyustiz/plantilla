<?php

/*return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', ''),
        'host'           => env('DB_HOST', ''),
        'port'           => env('DB_PORT', '1521'),
        'database'       => env('DB_DATABASE', ''),
        'username'       => env('DB_USERNAME', ''),
        'password'       => env('DB_PASSWORD', ''),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
];*/

return [
    'oracle' => [
        'driver' => 'oracle',
        'host' => env('OCI_DB_HOST', ''),
        'port' => env('OCI_DB_PORT', ''),
        'database' => env('OCI_DB_DATABASE', ''),
        'tns' => env('OCI_DB_SID', ''),
        'username' => env('OCI_DB_USERNAME', ''),
        'password' => env('OCI_DB_PASSWORD', ''),
        'charset' => '',
        'prefix' => '',
    ]
];
