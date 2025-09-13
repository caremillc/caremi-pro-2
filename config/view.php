<?php declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Template Engine
    |--------------------------------------------------------------------------
    | Supported: "flint", "twig", "plates"
    */
    'engine' => 'flint',

    /*
    |--------------------------------------------------------------------------
    | View Paths
    |--------------------------------------------------------------------------
    */
    'paths' => [
        base_path('resources/views'),
    ],

    'compiled' => storage_path('resources/views'),

    // Supported view file extensions (in order of priority)
    'extensions' => [
        '.flint.php',
        '.php',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Cache Path (for engines that compile)
    |--------------------------------------------------------------------------
    */
    'cache' => storage_path('framework/views'),
];


