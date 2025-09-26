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