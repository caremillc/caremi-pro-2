<?php declare(strict_types=1);

use Careminate\Http\Kernel;
use Careminate\Http\Requests\Request;

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require __DIR__ . '/../bootstrap/app.php';

try {
    $request = Request::createFromGlobals();

    // Get container
    $container = require BASE_PATH . '/config/container.php';

    // Resolve kernel (with router injected automatically)
    $kernel = $container->get(Kernel::class);

    // Handle request
    $response = $kernel->handle($request);
    
    $response->send();

} catch (\Throwable $e) {
    logException($e);
}
