<?php declare(strict_types=1);

return [

    'default' => env('LOG_CHANNEL', 'default'),  # default, errors, security

    'channels' => [
        'default' => [
            'driver'        => env('LOG_DRIVER_DAILY', 'daily'),
            'path'          => BASE_PATH . env('LOG_PATH_DEFAULT', '/storage/logs/app.log'),
            'level'         => env('LOG_LEVEL_DEFAULT', 'debug'),
            'max_file_size' => (int) env('LOG_MAXSIZE_DEFAULT', 5 * 1024 * 1024),
            'retention_days'=> (int) env('LOG_RETENTION_DEFAULT', 30),
        ],

        'errors' => [
            'driver' => env('LOG_DRIVER_ERRORLOG', 'errorlog'),
            'path'   => BASE_PATH . env('LOG_PATH_ERRORS', '/storage/logs/errors.log'),
            'level'  => env('LOG_LEVEL_ERRORS', 'error'),
        ],

        'security' => [
            'driver' => env('LOG_DRIVER_SINGLE', 'single'),
            'path'   => BASE_PATH . env('LOG_PATH_SECURITY', '/storage/logs/security.log'),
            'level'  => env('LOG_LEVEL_SECURITY', 'warning'),
        ],
    ],

    'exception_map' => [
        \RuntimeException::class         => ['error', 'errors', true],
        \LogicException::class           => ['critical', 'default', true],
        \InvalidArgumentException::class => ['notice', 'default', false],
        \Careminate\Exceptions\AuthException::class => ['warning', 'security', true],
    ],

    'alerts' => [
        'enabled' => filter_var(env('ALERTS_ENABLED', true), FILTER_VALIDATE_BOOLEAN),
        'threshold_level' => env('ALERT_THRESHOLD', 'error'),
        'email' => [
            'enabled' => filter_var(env('ALERT_EMAIL_ENABLED', true), FILTER_VALIDATE_BOOLEAN),
            'recipients' => array_map('trim', explode(',', env('ALERT_EMAIL_RECIPIENTS', 'admin@example.com'))),
            'subject_prefix' => env('ALERT_EMAIL_PREFIX', '[ALERT]'),
        ],
        'slack' => [
            'enabled' => filter_var(env('ALERT_SLACK_ENABLED', false), FILTER_VALIDATE_BOOLEAN),
            'webhook_url' => env('ALERT_SLACK_WEBHOOK_URL', ''),
        ],
    ],
];

