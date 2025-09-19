<?php declare(strict_types=1); 

use Careminate\Http\Kernel;
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require __DIR__ . '/../bootstrap/app.php';

// ---------------------------------------------------------
// Handle the request (placeholder logic for now)
// ---------------------------------------------------------
// request received
$request = Request::createFromGlobals();

// ---------------------------------------------------------
// Handle the request
// ---------------------------------------------------------
$request = Request::createFromGlobals();

// Initializes the application's kernel 
$kernel = new Kernel();

// Generate response
$response = $kernel->handle($request);


// For debugging (optional, remove in production)
// dd($kernel, $request);

// Send the response to client
$response->send();

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();