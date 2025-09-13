<?php declare(strict_types=1); 
use Careminate\Http\Kernel;
use Careminate\Routing\Router;
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

define('CAREMI_START', microtime(true));  // Application start time for performance tracking
define('BASE_PATH', dirname(__DIR__));    // Base directory path
define('ROOT_PATH', dirname(__FILE__));   // Root directory path
define('ROOT_DIR', dirname(__FILE__));

// Include Composer autoload to load dependencies
require_once dirname(__DIR__) . '/vendor/autoload.php';

// bootstrapping
require BASE_PATH . '/bootstrap/app.php';
require BASE_PATH . '/bootstrap/performance.php';

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
// dd($response);

// send response (string of content)
// echo 'Hello World';

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();