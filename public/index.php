<?php declare(strict_types=1); // public/index.php
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

define('CAREMI_START', microtime(true));
define('BASE_PATH', dirname(__DIR__));
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_PATH', dirname(__FILE__));

// Include Composer autoload to load dependencies
require_once dirname(__DIR__) . '/vendor/autoload.php';

// bootstrapping
require BASE_PATH . '/bootstrap/app.php';
require BASE_PATH . '/bootstrap/performance.php';

// request received
$request = Request::createFromGlobals();
// send response (string of content)
$content = '<h1>Hello World from index page</h1>';

$response = new Response(content: $content, status: 200, headers: []);

$response->send();

// perform some logic

// send response (string of content)
dd($response);