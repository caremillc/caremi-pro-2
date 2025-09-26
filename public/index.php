<?php declare(strict_types=1);

use Careminate\Exceptions\Handler;
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;
use Careminate\Exceptions\AuthException;

// ---------------------------------------------------------
// Bootstrap the framework
// ---------------------------------------------------------
require __DIR__ . '/../bootstrap/app.php';


// ---------------------------------------------------------
// Exception handling examples
// ---------------------------------------------------------
try {
    // ---------------------------------------------------------
// Handle the request (placeholder)
// ---------------------------------------------------------
$request = Request::createFromGlobals();

// send response (string of content)
$content = '<h1>Hello World from index page</h1>';

$response = new Response(content: $content, status: 200, headers: []);

$response->send();

    // throw new RuntimeException("A runtime exception occurred!");
} catch (\Throwable $e) {
    logException($e); // Logs to errors channel
}

// // Custom AuthException
// try {
//     throw new AuthException("Invalid credentials", 401, ['username' => 'john.doe']);
// } catch (\Throwable $e) {
//     logException($e); // Logs to security channel
// }

// // ---------------------------------------------------------
// // High-severity log triggers alerts
// // ---------------------------------------------------------
// logger('errors')->critical('Critical system failure!', ['server' => 'web-01']);

// // ---------------------------------------------------------
// // Logging examples
// // ---------------------------------------------------------

// // Default channel
// logger('default')->info('Application booted successfully');
// logger('default')->debug('Debugging information', ['request_uri' => $_SERVER['REQUEST_URI']]);

// // Database channel
// logger('errors')->info('Database connected');
// logger('errors')->error('Query failed', ['sql' => 'SELECT * FROM users']);

// // Security channel
// logger('security')->warning('User login attempt failed', ['user' => 'guest']);
// logger('security')->info('User accessed dashboard', ['user_id' => 123]);

// // ---------------------------------------------------------
// // Output debug info
// // ---------------------------------------------------------
// echo "<h2>Logger & Exception Test Completed</h2>";
// echo "<pre>Request Data:\n";
// print_r($request->all());
// echo "</pre>";

// echo "<pre>Check 'storage/logs/' for log files and alerts (emails/Slack) if configured.</pre>";


