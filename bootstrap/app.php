<?php declare(strict_types=1);

// ---------------------------------------------------------
// Define application constants
// ---------------------------------------------------------
define('CAREMI_START', microtime(true));  // Application start time
define('BASE_PATH', dirname(__DIR__));    // Project base directory
define('BOOTSTRAP_PATH', __DIR__);        // Bootstrap directory
define('PUBLIC_PATH', BASE_PATH . '/public'); // Public directory

// ---------------------------------------------------------
// Load Composer's autoloader (if available)
// ---------------------------------------------------------
$autoloadPath = BASE_PATH . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require $autoloadPath;
}

// ---------------------------------------------------------
// Load core bootstrap files
// ---------------------------------------------------------
require BOOTSTRAP_PATH . '/env.php';         // Load environment handling
require BOOTSTRAP_PATH . '/performance.php'; // Load performance tracking

// ---------------------------------------------------------
// Register shutdown function to log performance automatically
// ---------------------------------------------------------
if (function_exists('logExecutionTime')) {
    register_shutdown_function('logExecutionTime');
}

// ---------------------------------------------------------
// Error & Exception Handling
// ---------------------------------------------------------
set_error_handler(function ($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        return false; // respect @ suppression
    }

    throw new ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function ($exception) {
    $debug = env('APP_DEBUG', false);

    if ($debug) {
        // Developer-friendly error output
        http_response_code(500);
        echo "<h1>Uncaught Exception</h1>";
        echo "<p><strong>Message:</strong> " . htmlspecialchars($exception->getMessage()) . "</p>";
        echo "<p><strong>File:</strong> " . $exception->getFile() . "</p>";
        echo "<p><strong>Line:</strong> " . $exception->getLine() . "</p>";
        echo "<pre>" . htmlspecialchars($exception->getTraceAsString()) . "</pre>";
    } else {
        // Production-safe message
        http_response_code(500);
        echo "Something went wrong. Please try again later.";
    }
});


// ---------------------------------------------------------
// Future: Load config, service providers, error handlers, etc.
// ---------------------------------------------------------
