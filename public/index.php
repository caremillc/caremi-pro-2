<?php declare(strict_types=1); // public/index.php

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
// Handle the request (placeholder logic for now)
// ---------------------------------------------------------
// request received
$request = Request::createFromGlobals();

// send response (string of content)
$content = '<h1>Hello World from index page</h1>';

$response = new Response(content: $content, status: 200, headers: []);

$response->send();

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();


