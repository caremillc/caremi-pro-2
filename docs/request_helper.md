# Request Helper Functions

The Careminate framework provides a set of **global helper functions** to easily access HTTP request data. These helpers wrap the `Request` class and provide a convenient syntax for retrieving input, headers, cookies, and JSON payloads.

---

## Table of Contents

* [request()](#request)
* [request\_only()](#request_only)
* [request\_except()](#request_except)
* [request\_all()](#request_all)
* [request\_json()](#request_json)
* [request\_has()](#request_has)
* [request\_cookie()](#request_cookie)
* [request\_header()](#request_header)

---

## `request()`

```php
request(string|array|null $key = null, mixed $default = null): mixed
```

Returns the current `Request` instance or retrieves a specific input value.

### Parameters

* `$key`

  * `string` - a specific input key
  * `array` - multiple input keys (returns subset)
  * `null` - returns the `Request` object

* `$default` *(mixed)* – Default value if the input key does not exist.

### Usage

```php
// Get the Request instance
$req = request();

// Get a single input value
$name = request('name', 'Guest');

// Get multiple input values
$data = request(['name', 'email']);
```

---

## `request_only()`

```php
request_only(array|string ...$keys): array
```

Retrieve only the specified input keys from the request.

### Usage

```php
$data = request_only(['name', 'email']);
```

---

## `request_except()`

```php
request_except(array|string ...$keys): array
```

Retrieve all input data **except** the specified keys.

### Usage

```php
$data = request_except('password');
```

---

## `request_all()`

```php
request_all(): array
```

Retrieve **all input data**, including GET, POST, JSON payloads, and raw input.

### Usage

```php
$allData = request_all();
```

---

## `request_json()`

```php
request_json(): array
```

Retrieve **JSON payload** from the request body as an associative array.

### Usage

```php
$jsonData = request_json();
```

---

## `request_has()`

```php
request_has(string $key): bool
```

Check if a specific input key exists in the request.

### Usage

```php
if (request_has('token')) {
    // process token
}
```

---

## `request_cookie()`

```php
request_cookie(string $key, mixed $default = null): mixed
```

Retrieve a cookie value from the request.

### Usage

```php
$sessionId = request_cookie('SESSIONID');
```

---

## `request_header()`

```php
request_header(string $key, mixed $default = null): mixed
```

Retrieve a specific HTTP header from the request.

### Usage

```php
$userAgent = request_header('User-Agent');
```

---

### Notes

* All helpers are **lazy-loaded**; the `Request` instance is created once and reused.
* The `request()` helper can handle both **single key retrieval** and **subset arrays**.
* JSON payloads are automatically parsed and accessible via `request_json()`.
* Convenient shorthand functions make it easy to write concise request-handling code.

🔗 [← Response Class](response.md) | [Back to Index](index.md)

