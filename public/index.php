<?php declare(strict_types=1); // public/index.php

// ---------------------------------------------------------
// Define application constants
// ---------------------------------------------------------
define('CAREMI_START', microtime(true));  // Application start time for performance tracking
define('BASE_PATH', dirname(__DIR__));    // Base directory path
define('ROOT_PATH', __DIR__);             // Public root path

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require BASE_PATH . '/bootstrap/app.php';
require BASE_PATH . '/bootstrap/performance.php';

// ---------------------------------------------------------
// Handle the request (placeholder logic for now)
// ---------------------------------------------------------
echo 'Hello World from index.php'."</br>";

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();

