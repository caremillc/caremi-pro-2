<?php declare(strict_types=1); 
use Careminate\Http\Requests\Request;

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

// Then use it anywhere
$user = ['name' => 'John', 'age' => 30];
$data = new stdClass();
$data->items = [1, 2, 3];

dd($user, $data);

dd($request);
// perform some logic

// send response (string of content)
// echo 'Hello World';