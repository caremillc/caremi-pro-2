<?php declare(strict_types=1);

use Careminate\Http\Kernel;
use Careminate\Routing\Router;
use Careminate\Http\Requests\Request;

define('BASE_PATH', dirname(__DIR__));
define('CAREMI_START', microtime(true));
define('ROOT_DIR', dirname(__FILE__));

require dirname(__DIR__) . '/vendor/autoload.php';
require BASE_PATH . '/bootstrap/app.php';
require BASE_PATH . '/bootstrap/performance.php';

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