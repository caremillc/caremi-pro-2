# Careminate HTTP Request & Response Guide

In Careminate, every HTTP interaction is built on two core classes:

* `Careminate\Http\Requests\Request` → Represents the incoming HTTP request (data, query params, method, headers, files).
* `Careminate\Http\Responses\Response` → Represents the outgoing HTTP response (content, status, headers).

This document shows how they work together in a controller-style flow.

---

## 📥 Request Lifecycle

Every request is wrapped inside a Request object:

```php
use Careminate\Http\Request;

$request = Request::createFromGlobals(); // auto-populates from PHP globals
```

### From there you can access:

```php
$name   = $request->input('name');      // from $_POST / $_GET
$id     = $request->route('id');        // from route params
$agent  = $request->header('User-Agent');
$method = $request->method();           // GET / POST / PUT etc.
```

---

## 📤 Response Lifecycle

To reply to the client, you build a Response:

```php
use Careminate\Http\Responses\Response;

$response = new Response('Hello World', Response::HTTP_OK);
$response->send();
```

The response handles content, status codes, headers, JSON, redirects, and errors.

---

## 🔄 Typical Controller Flow

```php
use Careminate\Http\Request;
use Careminate\Http\Responses\Response;

class UserController
{
    public function show(Request $request, int $id)
    {
        $user = User::find($id);

        if (! $user) {
            return Response::notFound("User not found");
        }

        return Response::json([
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }
}
```

### Flow Breakdown

1. Request captures incoming data.
2. Controller action inspects the request.
3. A Response is returned with appropriate content.
4. The framework sends it to the browser/client.

---

## 📑 Examples

### 1. Handling a Form Submission

```php
public function store(Request $request)
{
    $name = $request->input('name');

    if (empty($name)) {
        return Response::badRequest("Name is required");
    }

    $user = User::create(['name' => $name]);

    return Response::redirect("/users/{$user->id}");
}
```

### 2. Returning an API JSON Response

```php
public function api(Request $request)
{
    $filters = $request->query(); // get all query params

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

## ⚡ Key Points

* Always capture the request via `Request::createFromGlobals()`.
* Always return a `Response` object from controllers.
* Responses can be HTML, JSON, redirect, text, or error.
* Use helpers like `Response::json()`, `Response::redirect()`, `Response::notFound()`, etc. for clarity.
* Controllers remain clean: they transform input (`Request`) → output (`Response`).
