<?php declare(strict_types=1); // public/index.php

use Careminate\Http\Requests\Request;

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
// request received
$request = Request::createFromGlobals();

// Then use it anywhere
// $user = ['name' => 'John', 'age' => 30];
// $data = new stdClass();
// $data->items = [1, 2, 3];

// dd($user, $data);

dd($request);

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();
