<?php declare(strict_types=1);

use Careminate\Exceptions\Handler;

// Constants
define('CAREMI_START', microtime(true));
define('BASE_PATH', dirname(__DIR__));
define('BOOTSTRAP_PATH', __DIR__);
define('PUBLIC_PATH', BASE_PATH . '/public');

// Composer autoload
$autoloadPath = BASE_PATH . '/vendor/autoload.php';
if (file_exists($autoloadPath)) require $autoloadPath;

// Core bootstrap
require BOOTSTRAP_PATH . '/env.php';
require BOOTSTRAP_PATH . '/performance.php';
//require BASE_PATH . '/framework-pro-2/Careminate/Support/Helpers/functions.php';

// Initialize all log channels
foreach (config('log.channels', []) as $channel => $settings) logger($channel);

// Set global exception handler
set_exception_handler([new Handler(), 'handle']);

// Shutdown function
if (function_exists('logExecutionTime')) register_shutdown_function('logExecutionTime');
