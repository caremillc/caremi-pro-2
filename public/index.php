<?php declare(strict_types=1); 

use Careminate\Http\Requests\Request;

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require __DIR__ . '/../bootstrap/app.php';

// ---------------------------------------------------------
// Handle the request (placeholder logic for now)
// ---------------------------------------------------------
// request received
$request = Request::createFromGlobals();

// Then use it anywhere
$user = ['name' => 'John', 'age' => 30];
$data = new stdClass();
$data->items = [1, 2, 3];

dd($user, $data);

dd($request);

// ---------------------------------------------------------
// Log performance after response
// ---------------------------------------------------------
logExecutionTime();
