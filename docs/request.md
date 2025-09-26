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


