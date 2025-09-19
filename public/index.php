<?php declare(strict_types=1); 

use Careminate\Http\Kernel;
use Careminate\Routing\Router;
use Careminate\Http\Requests\Request;

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require __DIR__ . '/../bootstrap/app.php';

require route_path('web.php');

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

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();