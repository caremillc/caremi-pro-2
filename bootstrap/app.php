<?php declare(strict_types=1);
// ---------------------------------------------------------
// Define application constants
// ---------------------------------------------------------
define('CAREMI_START', microtime(true));  // Application start time for performance tracking
define('BASE_PATH', dirname(__DIR__));    // Base directory path
define('ROOT_PATH', dirname(__FILE__));   // Root directory path
define('ROOT_DIR', dirname(__FILE__));

// Load Composer's autoloader (if available)
$autoloadPath = BASE_PATH . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require $autoloadPath;
}

// Future: load environment variables, config, service providers, etc.
// For now, just a silent bootstrap placeholder.

require  'env.php';  // load env file
require  'performance.php'; // load performance file