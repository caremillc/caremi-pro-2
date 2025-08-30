<?php declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Default Template Engine
    |--------------------------------------------------------------------------
    | Supported: "flint", "caremi". "twig", "plates"
    */
    'engine' => 'flint',
 
    /*
    |--------------------------------------------------------------------------
    | View Paths
    |--------------------------------------------------------------------------
    */
    'paths' => [
        __DIR__ . '/../templates/views',
    ],

    'compiled' => storage_path('views/compiled'),

    // Supported view file extensions (in order of priority)
    'extensions' => [
        '.caremi.php', // can remove
        '.flint.php',
        '.php',         //can remove
    ],
    /*
    |--------------------------------------------------------------------------
    | Cache Path (for engines that compile)
    |--------------------------------------------------------------------------
    */
    'cache' => __DIR__ . '/../storage/framework/views',
];
