<?php declare(strict_types=1); // public/index.php

// Define application constants
define('CAREMI_START', microtime(true));  // Application start time for performance tracking
define('BASE_PATH', dirname(__DIR__));    // Base directory path
define('ROOT_PATH', dirname(__FILE__));   // Root directory path
define('ROOT_DIR', dirname(__FILE__));


// bootstrapping
require BASE_PATH . '/bootstrap/app.php';
require BASE_PATH . '/bootstrap/performance.php';


// request received

// perform some logic

// send response (string of content)
echo 'Hello World';