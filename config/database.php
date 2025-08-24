<?php declare(strict_types=1);

return [
    'default' => env('DB_DRIVER', 'sqlite'),

    'drivers' => [
        'sqlite' => [
            'driver' => 'pdo_sqlite',
            'path' => BASE_PATH . '/' . env('DB_SQLITE', 'storage/database.sqlite'),
        ],

        'mysql' => [
            'driver'   => 'pdo_mysql',
            'host'     => env('DB_HOST', '127.0.0.1'),
            'port'     => (int)env('DB_PORT', 3306),
            'dbname'   => env('DB_DATABASE', 'framework'),
            'user'     => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8mb4',
        ],

        'pgsql' => [
            'driver'   => 'pdo_pgsql',
            'host'     => env('DB_HOST', '127.0.0.1'),
            'port'     => (int)env('DB_PORT', 5432),
            'dbname'   => env('DB_DATABASE', 'framework'),
            'user'     => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
        ],
    ],
];


