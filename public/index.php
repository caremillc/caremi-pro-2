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
// Then use it anywhere
$user = ['name' => 'John', 'age' => 30];
$data = new stdClass();
$data->items = [1, 2, 3];

// dump everything at once (single dd stops execution)
dd($user, $data, $request);