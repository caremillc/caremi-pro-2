# Careminate Framework — Request Class Documentation

[Back to Top](#careminate-framework---request-class-documentation)

---

## **Table of Contents**

1. [Overview](#overview)
2. [Namespace](#namespace)
3. [Creating a Request Instance](#creating-a-request-instance)
4. [HTTP Method Utilities](#http-method-utilities)
5. [Retrieving Request Data](#retrieving-request-data)

   * [All Input](#all-input)
   * [GET Parameters](#get-parameters)
   * [POST Parameters](#post-parameters)
   * [JSON Input](#json-input)
   * [Cookies](#cookies)
6. [File Uploads](#file-uploads)
7. [Headers](#headers)
8. [Raw Input](#raw-input)
9. [Usage Examples](#usage-examples)
10. [Additional Features](#additional-features)
11. [Summary of Methods](#summary-of-methods)
12. [Recommended Usage](#recommended-usage)
13. [Example — API Endpoint Handling](#example---api-endpoint-handling)
14. [Request Helper Links](#request-helper-links)

---

## **Overview**

The `Careminate\Http\Requests\Request` class is an **optimized HTTP request handler**.

It provides methods to access:

* GET/POST parameters
* JSON payloads
* Headers, cookies, and uploaded files
* Server variables and client info

It supports **spoofed HTTP methods**, **raw input**, and **unified access** to all input data.

---

## **Namespace**

```php
namespace Careminate\Http\Requests;
```

---

## **Creating a Request Instance**

```php
use Careminate\Http\Requests\Request;

$request = Request::createFromGlobals();
```

* Parses `$_GET`, `$_POST`, JSON input, cookies, files, and server variables.
* Recommended over manually using PHP superglobals.

---

## **HTTP Method Utilities**

```php
$request->getMethod();   // GET, POST, PUT, PATCH, DELETE (spoofed if applicable)
$request->isMethod('POST'); // Check method
$request->isPost();      // Shortcut
$request->isGet();
$request->isPut();
$request->isPatch();
$request->isDelete();
$request->isHead();
$request->isOptions();
```

**Spoofed Methods**:

* `_method` in POST data
* `X-HTTP-Method-Override` header

Allows simulation of PUT, PATCH, DELETE.

---

## **Retrieving Request Data**

### **All Input**

```php
$request->all();               // All GET, POST, JSON combined
$request->only(['name','email']); // Only specified keys
$request->except(['password']);   // Exclude keys
```

### **GET Parameters**

```php
$page = $request->query('page', 1);  // Default value 1
$request->get('key', 'default');     // GET, POST, or input
$request->has('key');                // Check if exists
```

### **POST Parameters**

```php
$username = $request->post('username', 'guest');
$username = $request->input('username', 'guest'); // Handles POST or JSON
```

### **JSON Input**

```php
$data = $request->json();       // Decoded JSON as array
$request->isJson();             // Content-Type contains 'json'
$request->wantsJson();          // Accept header contains 'json'
```

### **Cookies**

```php
$session = $request->cookie('session_id', null);
```

---

## **File Uploads**

```php
$file = $request->file('avatar');  // Returns file array
$request->hasFile('avatar');       // Check if uploaded
$request->allFiles();              // Returns all uploaded files
```

File array structure:

```php
[
    'name' => 'example.png',
    'type' => 'image/png',
    'tmp_name' => '/tmp/phpYzdqkD',
    'error' => 0,
    'size' => 12345
]
```

---

## **Headers**

```php
$userAgent = $request->header('User-Agent'); // Single header
$headers = $request->headers();             // All headers
```

**Helpers:**

* `$request->isSecure()` — HTTPS check
* `$request->ip()` — Client IP
* `$request->userAgent()` — User-Agent
* `$request->fullUrl()` — Full request URL

---

## **Raw Input**

```php
$raw = $request->getRawInput(); // Raw php://input content
```

Useful for webhooks or raw JSON payloads.

---

## **Usage Examples**

### Basic GET Request

```php
$request = Request::createFromGlobals();
$page = $request->query('page', 1);
```

### Handling POST JSON Payload

```php
if ($request->isJson()) {
    $data = $request->json();
    $name = $data['name'] ?? 'Guest';
}
```

### File Upload

```php
if ($request->hasFile('avatar')) {
    $file = $request->file('avatar');
    move_uploaded_file($file['tmp_name'], '/uploads/' . $file['name']);
}
```

### Checking Request Type

```php
if ($request->isPost()) { /* Handle POST */ }
if ($request->wantsJson()) { /* Respond JSON */ }
```

---

## **Additional Features**

* **Immutable**: Request properties cannot be modified directly
* **Supports Spoofed Methods**: `_method` and `X-HTTP-Method-Override`
* **Unified Input Access**: GET, POST, JSON combined via `all()`
* **Convenience Shortcuts**: `isPost()`, `isGet()`, etc.

---

## **Summary of Methods**

| Method                      | Description              |
| --------------------------- | ------------------------ |
| `createFromGlobals()`       | Instantiate from globals |
| `getMethod()`               | Returns HTTP method      |
| `isMethod($method)`         | Checks method            |
| `isPost()`, `isGet()`, etc. | Shortcut methods         |
| `all()`                     | All input data           |
| `only($keys)`               | Only specified keys      |
| `except($keys)`             | Exclude keys             |
| `query($key, $default)`     | GET param                |
| `post($key, $default)`      | POST param               |
| `input($key, $default)`     | POST/JSON input          |
| `json()`                    | JSON body as array       |
| `isJson()`                  | Content-Type JSON check  |
| `wantsJson()`               | Accept JSON check        |
| `cookie($key, $default)`    | Cookie value             |
| `file($key)`                | Uploaded file            |
| `hasFile($key)`             | Check file exists        |
| `allFiles()`                | All files                |
| `header($name)`             | Single header            |
| `headers()`                 | All headers              |
| `isSecure()`                | HTTPS check              |
| `ip()`                      | Client IP                |
| `userAgent()`               | User-Agent               |
| `fullUrl()`                 | Full URL                 |
| `getRawInput()`             | Raw input                |

---

## **Recommended Usage**

1. Use `Request::createFromGlobals()` instead of superglobals.
2. Use `input()` for POST/JSON handling.
3. Use `json()` and `wantsJson()` for API endpoints.
4. Use `hasFile()` and `file()` for file uploads.

---

## **Example — API Endpoint Handling**

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

## **Request Helper Links**

* [Request Helper Functions](./request_helper.md)
* [Array Utilities](./arr.md)
* [String Utilities](./str.md)

[Back to Top](#careminate-framework---request-class-documentation)




step 6.1: \docs\request_helper.md
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



step 7: docs\arr.md
# Careminate\Support\Arr

A helper class providing array utilities for manipulation, access, and retrieval.

## Namespace

`Careminate\Support`

## Class: Arr

---

## Methods

### `only(array $array, array|string $keys): array`

Returns only the specified keys from the array.

**Example:**

```php
use Careminate\Support\Arr;

$array = ['name' => 'John', 'age' => 30, 'role' => 'admin'];
$result = Arr::only($array, ['name', 'role']); // ['name' => 'John', 'role' => 'admin']
```

### `accessible(mixed $value): bool`

Check if the given value is an array or implements ArrayAccess.

**Example:**

```php
Arr::accessible(['a' => 1]); // true
Arr::accessible(new ArrayObject()); // true
```

### `exists(array|ArrayAccess $array, string|int $key): bool`

Check if a key exists in the array or ArrayAccess object.

**Example:**

```php
Arr::exists(['a' => 1], 'a'); // true
```

### `set(array &$array, string|int $key, mixed $value): void`

Set a value within a nested array using dot notation.

**Example:**

```php
$array = [];
Arr::set($array, 'user.name', 'John');
// $array = ['user' => ['name' => 'John']]
```

### `get(array $array, string|int|null $key, mixed $default = null): mixed`

Retrieve a value using dot notation; returns default if not found.

**Example:**

```php
$array = ['user' => ['name' => 'John']];
Arr::get($array, 'user.name'); // 'John'
Arr::get($array, 'user.age', 25); // 25
```

### `add(array $array, string|int $key, mixed $value): array`

Add a value if it does not exist already.

**Example:**

```php
$array = ['user' => ['name' => 'John']];
Arr::add($array, 'user.age', 30);
// $array = ['user' => ['name' => 'John', 'age' => 30]]
```

### `except(array $array, array|string $keys): array`

Return the array without the specified keys.

**Example:**

```php
$array = ['name' => 'John', 'age' => 30, 'role' => 'admin'];
Arr::except($array, ['age']); // ['name' => 'John', 'role' => 'admin']
```

### `has(array $array, string|int $key): bool`

Check if a key exists using dot notation.

**Example:**

```php
$array = ['user' => ['name' => 'John']];
Arr::has($array, 'user.name'); // true
```

### `forget(array &$array, string|int $key): void`

Remove a key from an array using dot notation.

**Example:**

```php
$array = ['user' => ['name' => 'John']];
Arr::forget($array, 'user.name');
// $array = ['user' => []]
```

### `first(array $array, ?callable $callback = null, mixed $default = null): mixed`

Return the first element of the array or first matching callback result.

**Example:**

```php
$array = [1, 2, 3];
Arr::first($array); // 1
Arr::first($array, fn($v) => $v > 1); // 2
```

### `last(array $array, ?callable $callback = null, mixed $default = null): mixed`

Return the last element of the array or last matching callback result.

**Example:**

```php
$array = [1, 2, 3];
Arr::last($array); // 3
```

### `flatten(array $array, int $depth = PHP_INT_MAX): array`

Flatten a multi-dimensional array up to a given depth.

**Example:**

```php
$array = [1, [2, [3, 4]]];
Arr::flatten($array); // [1, 2, 3, 4]
Arr::flatten($array, 1); // [1, 2, [3, 4]]
```



step 8: str.md 

# Careminate\Support\Str

String manipulation helper class providing formatting, case conversions, and random string generation.

---

## Namespace

```php
Careminate\Support
```

---

## Class: `Str`

### Table of Contents

* [Method Signatures](#method-signatures-cheatsheet)
* [Quick Reference](#quick-reference)
* [Methods (Detailed)](#methods-detailed)

  * [camel](#camelstring-value-string)
  * [snake](#snakestring-value-string-delimiter-_-string)
  * [kebab](#kebabstring-value-string)
  * [title](#titlestring-value-string)
  * [limit](#limitstring-value-int-limit-100-string-end---string)
  * [contains](#containsstring-haystack-stringarray-needles-bool)
  * [startsWith](#startswithstring-haystack-stringarray-needles-bool)
  * [endsWith](#endswithstring-haystack-stringarray-needles-bool)
  * [replaceArray](#replacearraystring-search-array-replace-string-subject-string)
  * [after](#afterstring-subject-string-search-string)
  * [before](#beforestring-subject-string-search-string)
  * [random](#randomint-length-16-string)
  * [lower](#lowerstring-value-string)
  * [upper](#upperstring-value-string)
  * [slug](#slugstring-title-string-separator---string)

---

### Method Signatures (Cheatsheet)

```php
public static function camel(string $value): string
public static function snake(string $value, string $delimiter = '_'): string
public static function kebab(string $value): string
public static function title(string $value): string
public static function limit(string $value, int $limit = 100, string $end = '...'): string
public static function contains(string $haystack, string|array $needles): bool
public static function startsWith(string $haystack, string|array $needles): bool
public static function endsWith(string $haystack, string|array $needles): bool
public static function replaceArray(string $search, array $replace, string $subject): string
public static function after(string $subject, string $search): string
public static function before(string $subject, string $search): string
public static function random(int $length = 16): string
public static function lower(string $value): string
public static function upper(string $value): string
public static function slug(string $title, string $separator = '-'): string
```

---

### Quick Reference

| Method                                      | Description                                               |
| ------------------------------------------- | --------------------------------------------------------- |
| `camel($value)`                             | Convert a string to camelCase                             |
| `snake($value, $delimiter = '_')`           | Convert a string to snake\_case                           |
| `kebab($value)`                             | Convert a string to kebab-case                            |
| `title($value)`                             | Convert a string to Title Case                            |
| `limit($value, $limit = 100, $end = '...')` | Limit string length and append suffix if exceeded         |
| `contains($haystack, $needles)`             | Check if string contains one or more substrings           |
| `startsWith($haystack, $needles)`           | Check if string starts with substring(s)                  |
| `endsWith($haystack, $needles)`             | Check if string ends with substring(s)                    |
| `replaceArray($search, $replace, $subject)` | Replace occurrences sequentially using replacements array |
| `after($subject, $search)`                  | Return substring after first occurrence of `$search`      |
| `before($subject, $search)`                 | Return substring before first occurrence of `$search`     |
| `random($length = 16)`                      | Generate a random string of given length                  |
| `lower($value)`                             | Convert string to lowercase                               |
| `upper($value)`                             | Convert string to uppercase                               |
| `slug($title, $separator = '-')`            | Convert string to URL-friendly slug                       |

---

### Methods (Detailed)

#### `camel(string $value): string`

Convert a string to `camelCase`.

```php
Str::camel('hello_world');      // 'helloWorld'
Str::camel('my-function-name'); // 'myFunctionName'
```

#### `snake(string $value, string $delimiter = '_'): string`

Convert a string to `snake_case`.

```php
Str::snake('HelloWorld');       // 'hello_world'
Str::snake('MyFunction', '-');  // 'my-function'
```

#### `kebab(string $value): string`

Convert a string to `kebab-case`.

```php
Str::kebab('HelloWorld'); // 'hello-world'
```

#### `title(string $value): string`

Convert a string to **Title Case**.

```php
Str::title('hello_world'); // 'Hello World'
```

#### `limit(string $value, int $limit = 100, string $end = '...'): string`

Limit string length and append suffix.

```php
Str::limit('Hello World', 5); // 'Hello...'
```

#### `contains(string $haystack, string|array $needles): bool`

Check if string contains one or more substrings.

```php
Str::contains('Hello World', 'World');           // true
Str::contains('Hello World', ['Foo', 'World']); // true
```

#### `startsWith(string $haystack, string|array $needles): bool`

Check if string starts with substring(s).

```php
Str::startsWith('Hello World', 'Hello'); // true
```

#### `endsWith(string $haystack, string|array $needles): bool`

Check if string ends with substring(s).

```php
Str::endsWith('Hello World', 'World'); // true
```

#### `replaceArray(string $search, array $replace, string $subject): string`

Sequentially replace occurrences using an array of replacements.

```php
Str::replaceArray('?', ['one', 'two'], '?, ?'); // 'one, two'
```

#### `after(string $subject, string $search): string`

Return substring after first occurrence of `$search`.

```php
Str::after('Hello World', 'Hello '); // 'World'
```

#### `before(string $subject, string $search): string`

Return substring before first occurrence of `$search`.

```php
Str::before('Hello World', ' World'); // 'Hello'
```

#### `random(int $length = 16): string`

Generate a random string of given length.

```php
Str::random(8); // 'a3f7c1b2' (random)
```

#### `lower(string $value): string`

Convert string to lowercase.

```php
Str::lower('Hello World'); // 'hello world'
```

#### `upper(string $value): string`

Convert string to uppercase.

```php
Str::upper('Hello World'); // 'HELLO WORLD'
```

#### `slug(string $title, string $separator = '-'): string`

Convert string to URL-friendly slug.

```php
Str::slug('Hello World!'); // 'hello-world'
```
