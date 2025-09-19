<?php declare(strict_types=1); 

use Careminate\Http\Kernel;
use Careminate\Routing\Router;
use Careminate\Http\Requests\Request;

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require __DIR__ . '/../bootstrap/app.php';

// request received
$request = Request::createFromGlobals();

$container = require BASE_PATH . '/config/container.php';

require route_path('web.php');
//instantiate router
$router = new Router();


// Initializes the application's kernel 
//$kernel = new Kernel($router);
$kernel = $container->get(Kernel::class);


// send response (string of content)
$response = $kernel->handle($request);

$response->send();

// send response (string of content)
dd($response);

// send response (string of content)
// echo 'Hello World';

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();
