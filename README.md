# Careminate Framework — HTTP Request & Response Guide

In Careminate, every HTTP interaction is built on two core classes:

- `Careminate\Http\Requests\Request` → Represents the incoming HTTP request (data, query params, method, headers, files).
- `Careminate\Http\Responses\Response` → Represents the outgoing HTTP response (content, status, headers).

This document shows how they work together in a controller-style flow.

---

## 📌 Table of Contents

1. [Overview](#overview)  
2. [Kernel & Front Controller](#kernel--front-controller)  
3. [Request Lifecycle](#request-lifecycle)  
4. [Response Lifecycle](#response-lifecycle)  
5. [Typical Controller Flow](#typical-controller-flow)  
6. [Examples](#examples)  
7. [Request Helper Functions](#request-helper-functions)  
8. [Response Helper Functions](#response-helper-functions)  
9. [Key Points](#key-points)  

---

## Overview

Careminate provides a **structured HTTP handling system**, separating the incoming request (`Request`) from the outgoing response (`Response`).  
Controllers, middleware, and route handlers operate on these objects rather than PHP superglobals.

---

## Kernel & Front Controller

### `ramework\Careminate\Http\Kernel.php`

```php
<?php declare(strict_types=1);

namespace Careminate\Http;

use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

class Kernel
{
    public function handle(Request $request): Response
    {
        $content = '<h1>Hello World</h1>';
        return new Response($content);
    }
}
```

---

### `public/index.php`

```php
<?php declare(strict_types=1);

use Careminate\Http\Kernel;
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

define('CAREMI_START', microtime(true));
define('BASE_PATH', dirname(__DIR__));
define('ROOT_PATH', __DIR__);

require BASE_PATH . '/bootstrap/app.php';
require BASE_PATH . '/bootstrap/performance.php';

$request = Request::createFromGlobals();
$kernel = new Kernel();
$response = $kernel->handle($request);

// Optional debugging (remove in production)
dd($kernel, $request);

$response->send();
logExecutionTime();
```

---

## 📥 Request Lifecycle

```php
use Careminate\Http\Request;

$request = Request::createFromGlobals();
```

### Accessing request data:

```php
$name   = $request->input('name');      // POST / GET
$id     = $request->route('id');        // Route params
$agent  = $request->header('User-Agent');
$method = $request->method();           // HTTP method
```

### Unified Input Access

```php
$request->all();            // GET + POST + JSON
$request->only(['name']);   // Subset
$request->except(['password']);
$request->json();           // JSON payload
$request->cookie('SESSIONID');
$request->file('avatar');
$request->hasFile('avatar');
```

---

## 📤 Response Lifecycle

```php
use Careminate\Http\Responses\Response;

$response = new Response('Hello World', Response::HTTP_OK);
$response->send();
```

### Helpers for common response types:

```php
Response::json([...]);
Response::redirect('/login');
Response::notFound('User not found');
Response::noContent();
```

---

## 🔄 Typical Controller Flow

```php
class UserController
{
    public function show(Request $request, int $id)
    {
        $user = User::find($id);

        if (! $user) {
            return Response::notFound("User not found");
        }

        return Response::json([
            'id' => $user->id,
            'name' => $user->name
        ]);
    }
}
```

---

## 📁 Examples

### 1. Handling a Form Submission

```php
public function store(Request $request)
{
    $name = $request->input('name');
    if (empty($name)) return Response::badRequest("Name is required");

    $user = User::create(['name' => $name]);
    return Response::redirect("/users/{$user->id}");
}
```

### 2. Returning an API JSON Response

```php
public function api(Request $request)
{
    $filters = $request->query();
    $users = User::filter($filters)->get();

    return Response::json([
        'count' => count($users),
        'data'  => $users
    ]);
}
```

### 3. Middleware-like Usage

```php
public function index(Request $request)
{
    if (! $request->hasHeader('Authorization')) {
        return Response::unauthorized("Missing API token");
    }

    return Response::json(['message' => 'Authorized']);
}
```

---

## Request Helper Functions

- `request($key = null, $default = null)` → Retrieve input or request instance  
- `request_only(['name', 'email'])` → Only specified keys  
- `request_except('password')` → Exclude keys  
- `request_all()` → All input data  
- `request_json()` → JSON payload  
- `request_has('token')` → Check key existence  
- `request_cookie('SESSIONID')` → Cookie value  
- `request_header('User-Agent')` → Header value  

---

## Response Helper Functions

- `response($content = null, $status = 200, $headers = [])` → General-purpose  
- `json($data, $status = 200)` → JSON response  
- `html($content)` → HTML response  
- `text($content)` → Plain text response  
- `redirect($url, $status = 302)` → Redirect  
- `abort($status, $message = '')` → Error response  
- `noContent()` → 204 No Content  

---

## ⚡ Key Points

- Always capture requests via `Request::createFromGlobals()`.  
- Always return a `Response` object from controllers.  
- Use Response helpers for clarity (`json()`, `redirect()`, `notFound()`).  
- Controllers remain clean: input (`Request`) → output (`Response`).  
- Kernel centralizes request handling, and the front controller initializes the framework, handles the request, and sends the response.  

---

🔗 [← Response Class](response.md) |  [← Resquest Class](request.md) | [Back to Index](index.md)
