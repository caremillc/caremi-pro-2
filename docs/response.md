# Careminate HTTP Response Guide

The Careminate\Http\Responses\Response class provides a unified way to construct, manipulate, and send HTTP responses. It supports content handling, headers, status codes, and common response patterns like JSON, redirects, and error pages.

# 📌 Creating a Response

You can create a response manually by passing content, status code, and optional headers:
```php 
use Careminate\Http\Responses\Response;

$response = new Response('<h1>Hello World</h1>', Response::HTTP_OK, [
    'X-App' => 'Careminate'
]);

$response->send();
```

# 🔑 Content & Status
Set or Get Content
Set or Get Status Code
```php 
$response->setStatus(Response::HTTP_CREATED);
$status = $response->getStatus(); // 201
$text   = $response->getStatusText(); // "Created"
```

# 📂 Headers
Set a single header
```php 
$response->setHeader('X-Powered-By', 'Careminate');
```

# Set multiple headers
```php 
$response->setHeaders([
    'Cache-Control' => 'no-cache',
    'X-Frame-Options' => 'DENY',
]);

```

# Get or remove headers
```php 
$agent = $response->getHeader('X-Powered-By');
$response->removeHeader('X-Frame-Options');
$allHeaders = $response->getHeaders();
```

# 🧾 Built-in Response Types
JSON Response
```php 
$data = ['name' => 'John', 'age' => 30];

$response = Response::json($data);
$response->send();
```
# HTML Response
```php 
$html = "<h1>Welcome</h1>";
$response = Response::html($html);
```

# Plain Text Response
```php 
$response = Response::text("Just plain text");
```

# Redirect Response
```php 
$response = Response::redirect('/login');
``` 

# ⚠️ Error Helpers

Quickly return common error responses:
```php 
return Response::notFound();        // 404
return Response::badRequest();      // 400
return Response::unauthorized();    // 401
return Response::forbidden();       // 403
return Response::serverError();     // 500
```

# Or customize the message:
```php 
return Response::notFound("User not found");
```

# ✅ Special Responses
No Content (204)
```php 
return Response::noContent();
```

This is often used in APIs where the request succeeded but has no body to return.

# 🔀 Status Checking Helpers
```php 
$response->isSuccessful();  // true if 2xx
$response->isRedirection(); // true if 3xx
$response->isClientError(); // true if 4xx
$response->isServerError(); // true if 5xx
```

# 📡 Sending the Response

When ready, call send() to output the headers and content:
```php 
$response->send();
```

# ⚠️ If you’re writing to the output buffer yourself, send() should be called last to avoid duplicate output.

✅ Example Use Cases
1. Basic page response
```php 
$content = "<h1>Hello World</h1>";
$response = new Response($content, Response::HTTP_OK);
$response->send();
```

2. Returning JSON API data
```php 
$data = ['status' => 'ok', 'user' => ['id' => 1, 'name' => 'Jane']];
$response = Response::json($data, Response::HTTP_OK);
$response->send();
```
3. Redirect after form submission
```php 
$response = Response::redirect('/dashboard', Response::HTTP_FOUND);
$response->send();
```

4. Error response
```php 
if (! $user) {
    $response = Response::notFound("User profile not found");
    $response->send();
}
```
5. Response message
```php
// Plain text response
return response('Hello World', 200);

// JSON response automatically
return response(['success' => true, 'message' => 'Data saved'], 201);

// Create empty response and chain methods
return response()->setContent('<h1>Hello HTML</h1>')->setStatus(200)->setHeader('X-Test', 'value');

```

# Response Helper Use Cases

You've created a global `response()` helper that quickly instantiates
your framework's `Response` class. Here are the **use cases** showing
how a developer (using your Careminate framework) might use it in
controllers or routes:

------------------------------------------------------------------------

### 1. **Plain Text Response**

``` php
Route::get('/hello', function () {
    return response('Hello World');
});
```

👉 Returns:\
- Status: `200 OK`\
- Content: `"Hello World"` (as plain text)

------------------------------------------------------------------------

### 2. **Custom Status Code**

``` php
Route::get('/not-found', function () {
    return response('Page not found', 404);
});
```

👉 Returns:\
- Status: `404 Not Found`\
- Content: `"Page not found"`

------------------------------------------------------------------------

### 3. **JSON Response (Array Auto-Detection)**

``` php
Route::get('/user', function () {
    return response(['name' => 'Caremi', 'role' => 'admin']);
});
```

👉 Returns:\
- Status: `200 OK`\
- Headers: `Content-Type: application/json`\
- Body: `{"name":"Caremi","role":"admin"}`

------------------------------------------------------------------------

### 4. **Explicit JSON Response with Chaining**

``` php
Route::get('/data', function () {
    return response()->json([
        'success' => true,
        'message' => 'Data retrieved successfully'
    ]);
});
```

👉 Returns JSON with chainable control over content, headers, and
status.

------------------------------------------------------------------------

### 5. **Custom Headers**

``` php
Route::get('/download', function () {
    return response('File content here', 200, [
        'Content-Disposition' => 'attachment; filename="file.txt"'
    ]);
});
```

👉 Returns a file download with headers applied.

------------------------------------------------------------------------

### 6. **Empty Response (Useful for Redirects / No Content)**

``` php
Route::delete('/user/{id}', function ($id) {
    User::destroy($id);

    return response(null, 204); // No Content
});
```

👉 Returns `204 No Content` with an empty body.

------------------------------------------------------------------------

⚡ Essentially, your helper allows: - **Quick inline responses** (no
need to `new Response` manually).\
- **Smart defaults**: array → JSON, string → plain text, null → empty.\
- **Chainable control** for JSON/XML/redirect responses.



# redirect() Helper

Since Response::redirect() already exists, the global helper just forwards to it:
```php
if (!function_exists('redirect')) {
    function redirect(string $url, int $status = Response::HTTP_FOUND, array $headers = []): Response
    {
        return Response::redirect($url, $status, $headers);
    }
}
```

## Usage
```php 
return redirect('/home');

// With custom status
return redirect('/moved-permanently', Response::HTTP_MOVED_PERMANENTLY);

// With extra headers
return redirect('/dashboard', Response::HTTP_FOUND, ['X-Custom' => 'Caremi']);
```

# json() Helper

Shortcut for JSON responses:
```php 
if (!function_exists('json')) {
    function json(mixed $data, int $status = Response::HTTP_OK, array $headers = []): Response
    {
        return Response::json($data, $status, $headers);
    }
}
```

# Usage
```php 
return json(['success' => true, 'message' => 'Done']);

```

# html() Helper

Shortcut for HTML output:
```php 
if (!function_exists('html')) {
    function html(string $content, int $status = Response::HTTP_OK, array $headers = []): Response
    {
        return Response::html($content, $status, $headers);
    }
}

```

# Usage
```php 
return html('<h1>Welcome to Careminate</h1>');
```

# text() Helper

For plain text responses:
```php 
if (!function_exists('text')) {
    function text(string $content, int $status = Response::HTTP_OK, array $headers = []): Response
    {
        return Response::text($content, $status, $headers);
    }
}

```

# Usage
```php 
return text('Plain text response');
```

# abort() Helper

This is super useful for errors (404, 403, 500, etc.):
```php 
if (!function_exists('abort')) {
    function abort(int $status, string $message = ''): Response
    {
        return match ($status) {
            Response::HTTP_NOT_FOUND => Response::notFound($message ?: 'Not Found'),
            Response::HTTP_BAD_REQUEST => Response::badRequest($message ?: 'Bad Request'),
            Response::HTTP_UNAUTHORIZED => Response::unauthorized($message ?: 'Unauthorized'),
            Response::HTTP_FORBIDDEN => Response::forbidden($message ?: 'Forbidden'),
            Response::HTTP_INTERNAL_SERVER_ERROR => Response::serverError($message ?: 'Server Error'),
            default => Response::text($message ?: 'Error', $status),
        };
    }
}

```

# Usage
```php 
abort(404);
abort(403, 'You cannot access this page');

```


# noContent() Helper

For APIs when you want an empty body but valid status:
```php 
if (!function_exists('noContent')) {
    function noContent(array $headers = []): Response
    {
        return Response::noContent($headers);
    }
}


```

# Usage
```php 
return noContent();
```

# ✅ Summary of Helpers

response() → general-purpose (text/json/empty auto-detect).

redirect() → redirection responses.

json() → JSON responses.

html() → HTML responses.

text() → plain text responses.

abort() → quick error responses.

noContent() → 204 empty response.



🧩 Internals

Status Codes: Includes a full map of HTTP codes + convenience constants (e.g., HTTP_OK, HTTP_NOT_FOUND).

Charset: Defaults to UTF-8.

JSON Encoding: Uses strict encoding with JSON_THROW_ON_ERROR.

Headers: Normalized to lowercase internally for consistency.

✅ The Response class ensures your Careminate framework outputs consistent, standard-compliant HTTP responses, whether you’re building a web app, REST API, or CLI-backed server.

