<?php declare(strict_types=1);

use Careminate\Http\Kernel;
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

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
// Handle the request
// ---------------------------------------------------------
$request = Request::createFromGlobals();

// Initializes the application's kernel 
$kernel = new Kernel();

// Generate response
$response = $kernel->handle($request);


// For debugging (optional, remove in production)
dd($kernel, $request);

// Send the response to client
$response->send();

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();
