<?php declare(strict_types=1);

use Careminate\Http\Kernel;
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

define('CAREMI_START', microtime(true));  // Application start time
define('BASE_PATH', dirname(__DIR__));    // Base directory path
define('ROOT_PATH', dirname(__FILE__));   // Root directory path

// Composer autoload
require_once BASE_PATH . '/vendor/autoload.php';

// Bootstrapping
require BASE_PATH . '/bootstrap/app.php';
require BASE_PATH . '/bootstrap/performance.php';

// Request object
$request = Request::createFromGlobals();

// Container
$container = require BASE_PATH . '/config/container.php';

// Kernel resolved via container
/** @var Kernel $kernel */
$kernel = $container->get(Kernel::class);

// Boot kernel (loads routes from web.php, api.php, console.php)
$kernel->boot();

// Handle request
$response = $kernel->handle($request);

// Send response
$response->send();
