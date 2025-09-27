<?php declare(strict_types=1);

use Careminate\Http\Kernel;
use Careminate\Routing\Router;
use Careminate\Http\Requests\Request;

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require __DIR__ . '/../bootstrap/app.php';

try {
// ---------------------------------------------------------
// Handle the request (placeholder logic for now)
// ---------------------------------------------------------
// request received
$request = Request::createFromGlobals();

//instantiate router
$router = new Router();

// Initializes the application's kernel 
$kernel = new Kernel($router);

// send response (string of content)
$response = $kernel->handle($request);

$response->send();

// dd($response);

    // throw new RuntimeException("A runtime exception occurred!");
} catch (\Throwable $e) {
    logException($e); // Logs to errors channel
}

