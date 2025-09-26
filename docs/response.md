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

