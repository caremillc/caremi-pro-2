# Careminate\Http\Responses\Response

The `Careminate\Http\Responses\Response` class provides a unified way to construct, manipulate, and send HTTP responses. It supports content handling, headers, status codes, JSON responses, redirects, and error helpers.

---

## Table of Contents

* [Creating a Response](#creating-a-response)
* [Content & Status](#content--status)
* [Headers](#headers)
* [Built-in Response Types](#built-in-response-types)
* [Error Helpers](#error-helpers)
* [Special Responses](#special-responses)
* [Status Checking Helpers](#status-checking-helpers)
* [Sending the Response](#sending-the-response)
* [Response Helper Use Cases](#response-helper-use-cases)
* [redirect() Helper](#redirect-helper)
* [json() Helper](#json-helper)
* [html() Helper](#html-helper)
* [text() Helper](#text-helper)
* [abort() Helper](#abort-helper)
* [noContent() Helper](#nocontent-helper)
* [Summary of Helpers](#summary-of-helpers)

---

## Creating a Response

```php
use Careminate\Http\Responses\Response;

$response = new Response('<h1>Hello World</h1>', Response::HTTP_OK, [
    'X-App' => 'Careminate'
]);

$response->send();
```

---

## Content & Status

```php
$response->setStatus(Response::HTTP_CREATED);
$status = $response->getStatus(); // 201
$text   = $response->getStatusText(); // "Created"
```

---

## Headers

```php
$response->setHeader('X-Powered-By', 'Careminate');
$response->setHeaders([
    'Cache-Control' => 'no-cache',
    'X-Frame-Options' => 'DENY',
]);
$agent = $response->getHeader('X-Powered-By');
$response->removeHeader('X-Frame-Options');
$allHeaders = $response->getHeaders();
```

---

## Built-in Response Types

### JSON

```php
$data = ['name' => 'John', 'age' => 30];
$response = Response::json($data);
$response->send();
```

### HTML

```php
$html = "<h1>Welcome</h1>";
$response = Response::html($html);
```

### Plain Text

```php
$response = Response::text("Just plain text");
```

### Redirect

```php
$response = Response::redirect('/login');
```

---

## Error Helpers

```php
return Response::notFound();        // 404
return Response::badRequest();      // 400
return Response::unauthorized();    // 401
return Response::forbidden();       // 403
return Response::serverError();     // 500
```

Custom message:

```php
return Response::notFound("User not found");
```

---

## Special Responses

### No Content (204)

```php
return Response::noContent();
```

---

## Status Checking Helpers

```php
$response->isSuccessful();  // 2xx
$response->isRedirection(); // 3xx
$response->isClientError(); // 4xx
$response->isServerError(); // 5xx
```

---

## Sending the Response

```php
$response->send();
```

---

## Response Helper Use Cases

Quick instantiation and auto-detection:

```php
return response('Hello World', 200);
return response(['success' => true], 201);
return response()->setContent('<h1>HTML</h1>')->setStatus(200)->setHeader('X-Test', 'value');
```

### Examples

* Plain Text Response
* Custom Status Code
* JSON Response
* Chained JSON Response
* Custom Headers
* Empty Response (204)

---

## redirect() Helper

```php
return redirect('/home');
return redirect('/dashboard', Response::HTTP_FOUND, ['X-Custom' => 'Caremi']);
```

---

## json() Helper

```php
return json(['success' => true, 'message' => 'Done']);
```

---

## html() Helper

```php
return html('<h1>Welcome to Careminate</h1>');
```

---

## text() Helper

```php
return text('Plain text response');
```

---

## abort() Helper

```php
abort(404);
abort(403, 'You cannot access this page');
```

---

## noContent() Helper

```php
return noContent();
```

---

## Summary of Helpers

| Helper      | Description                                   |
| ----------- | --------------------------------------------- |
| response()  | General-purpose (text/json/empty auto-detect) |
| redirect()  | Redirection responses                         |
| json()      | JSON responses                                |
| html()      | HTML responses                                |
| text()      | Plain text responses                          |
| abort()     | Quick error responses                         |
| noContent() | 204 empty response                            |

---

✅ The Response class ensures consistent, standard-compliant HTTP responses for web apps, APIs, or CLI servers.




step 6: \docs\request-response.md
# Careminate Framework Documentation

---

## Table of Contents

1. [HTTP Request](#http-request)

   * [Overview](#overview)
   * [Namespace](#namespace)
   * [Creating a Request Instance](#creating-a-request-instance)
   * [HTTP Method Utilities](#http-method-utilities)
   * [Retrieving Request Data](#retrieving-request-data)

     * [All Input](#all-input)
     * [GET Parameters](#get-parameters)
     * [POST Parameters](#post-parameters)
     * [JSON Input](#json-input)
     * [Cookies](#cookies)
   * [File Uploads](#file-uploads)
   * [Headers](#headers)
   * [Raw Input](#raw-input)
   * [Usage Examples](#usage-examples)
   * [Additional Features](#additional-features)
   * [Summary of Methods](#summary-of-methods)
   * [Recommended Usage](#recommended-usage)
   * [Example — API Endpoint Handling](#example---api-endpoint-handling)
2. [Request Helper Functions](#request-helper-functions)
3. [Arr Helper](#careminatesupportarr)
4. [Str Helper](#careminatesupportstr)
5. [HTTP Response](#careminate-http-response-guide)
6. [Request & Response Guide](#careminate-http-request--response-guide)

---

## HTTP Request

### Overview

The `Careminate\Http\Requests\Request` class is an **optimized HTTP request handler**.

It provides methods to access:

* GET/POST parameters
* JSON payloads
* Headers, cookies, and uploaded files
* Server variables and client info

It supports **spoofed HTTP methods**, **raw input**, and **unified access** to all input data.

### Namespace

```php
namespace Careminate\Http\Requests;
```

### Creating a Request Instance

```php
use Careminate\Http\Requests\Request;

$request = Request::createFromGlobals();
```

* Parses `$_GET`, `$_POST`, JSON input, cookies, files, and server variables.
* Recommended over manually using PHP superglobals.

### HTTP Method Utilities

```php
$request->getMethod();  
$request->isMethod('POST');
$request->isPost();
$request->isGet();
$request->isPut();
$request->isPatch();
$request->isDelete();
$request->isHead();
$request->isOptions();
```

**Spoofed Methods**: `_method` in POST data or `X-HTTP-Method-Override` header.

### Retrieving Request Data

#### All Input

```php
$request->all();
$request->only(['name','email']);
$request->except(['password']);
```

#### GET Parameters

```php
$page = $request->query('page', 1);
$request->get('key', 'default');
$request->has('key');
```

#### POST Parameters

```php
$username = $request->post('username', 'guest');
$username = $request->input('username', 'guest');
```

#### JSON Input

```php
$data = $request->json();
$request->isJson();
$request->wantsJson();
```

#### Cookies

```php
$session = $request->cookie('session_id', null);
```

### File Uploads

```php
$file = $request->file('avatar');
$request->hasFile('avatar');
$request->allFiles();
```

### Headers

```php
$userAgent = $request->header('User-Agent');
$headers   = $request->headers();
$request->isSecure();
$request->ip();
$request->userAgent();
$request->fullUrl();
```

### Raw Input

```php
$raw = $request->getRawInput();
```

### Usage Examples

```php
$request = Request::createFromGlobals();
$page = $request->query('page', 1);
```

```php
if ($request->isJson()) {
    $data = $request->json();
    $name = $data['name'] ?? 'Guest';
}
```

```php
if ($request->hasFile('avatar')) {
    $file = $request->file('avatar');
    move_uploaded_file($file['tmp_name'], '/uploads/' . $file['name']);
}
```

```php
if ($request->isPost()) { /* Handle POST */ }
if ($request->wantsJson()) { /* Respond JSON */ }
```

### Additional Features

* Immutable
* Supports Spoofed Methods
* Unified Input Access via `all()`
* Convenience Shortcuts like `isPost()`

### Summary of Methods

| Method                   | Description              |
| ------------------------ | ------------------------ |
| createFromGlobals()      | Instantiate from globals |
| getMethod()              | Returns HTTP method      |
| isMethod(\$method)       | Checks method            |
| isPost(), isGet(), etc.  | Shortcut methods         |
| all()                    | All input data           |
| only(\$keys)             | Only specified keys      |
| except(\$keys)           | Exclude keys             |
| query(\$key, \$default)  | GET param                |
| post(\$key, \$default)   | POST param               |
| input(\$key, \$default)  | POST/JSON input          |
| json()                   | JSON body as array       |
| isJson()                 | Content-Type JSON check  |
| wantsJson()              | Accept JSON check        |
| cookie(\$key, \$default) | Cookie value             |
| file(\$key)              | Uploaded file            |
| hasFile(\$key)           | Check file exists        |
| allFiles()               | All files                |
| header(\$name)           | Single header            |
| headers()                | All headers              |
| isSecure()               | HTTPS check              |
| ip()                     | Client IP                |
| userAgent()              | User-Agent               |
| fullUrl()                | Full URL                 |
| getRawInput()            | Raw input                |

### Recommended Usage

1. Use `Request::createFromGlobals()`
2. Use `input()` for POST/JSON handling
3. Use `json()` and `wantsJson()` for APIs
4. Use `hasFile()` and `file()` for uploads

### Example — API Endpoint Handling

```php
$request = Request::createFromGlobals();

if ($request->isPost() && $request->wantsJson()) {
    $data = $request->json();
    $name = $data['name'] ?? 'Guest';
    $email = $data['email'] ?? null;

    dd($name, $email, $request->ip());
}
```

---

## Request Helper Functions

* `request()`
* `request_only()`
* `request_except()`
* `request_all()`
* `request_json()`
* `request_has()`
* `request_cookie()`
* `request_header()`

Usage examples are as in the previous sections above.

---

## Careminate\Support\Arr

Array manipulation helper.

* `only($array, $keys)`
* `accessible($value)`
* `exists($array, $key)`
* `set(&$array, $key, $value)`
* `get($array, $key, $default)`
* `add($array, $key, $value)`
* `except($array, $keys)`
* `has($array, $key)`
* `forget(&$array, $key)`
* `first($array, $callback, $default)`
* `last($array, $callback, $default)`
* `flatten($array, $depth)`

---

## Careminate\Support\Str

String manipulation helper.

* `camel($value)`
* `snake($value, $delimiter)`
* `kebab($value)`
* `title($value)`
* `limit($value, $limit, $end)`
* `contains($haystack, $needles)`
* `startsWith($haystack, $needles)`
* `endsWith($haystack, $needles)`
* `replaceArray($search, $replace, $subject)`
* `after($subject, $search)`
* `before($subject, $search)`
* `random($length)`
* `lower($value)`
* `upper($value)`
* `slug($title, $separator)`

---

## Careminate HTTP Response Guide

* `Response::json($data)`
* `Response::html($html)`
* `Response::text($text)`
* `Response::redirect($url)`
* `Response::noContent()`
* `Response::notFound()`, `badRequest()`, `unauthorized()`, `forbidden()`, `serverError()`

Helpers: `response()`, `json()`, `html()`, `text()`, `redirect()`, `abort()`, `noContent()`

Examples are as in the previous section above.

---

## Careminate HTTP Request & Response Guide

In controllers, typical flow:

```php
$request  = Request::createFromGlobals();
$response = Response::json(['hello' => 'world']);
$response->send();
```

Controllers:

```php
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
```

Key Points:

* Capture request via `Request::createFromGlobals()`
* Return `Response` object
* Responses: HTML, JSON, redirect, text, error
* Use `Response` helpers
* Controllers: Input → Output
