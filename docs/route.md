# Careminate Routing Guide

## Table of Contents

1. [Introduction](#introduction)
2. [Registering Routes](#registering-routes)

   * [Basic Routes](#basic-routes)
   * [Route Parameters](#route-parameters)
   * [Route with Regular Expression Constraints](#route-with-regular-expression-constraints)
   * [Resourceful Routes](#resourceful-routes)
   * [HTTP Method Specific Routes](#http-method-specific-routes)
   * [Catch-All Routes](#catch-all-routes)
3. [Route Handlers](#route-handlers)
4. [Route Helpers](#route-helpers)
5. [Example `web.php`](#example-webphp)

---

## Introduction

The Careminate routing system allows you to define clean, expressive routes for your application. Routes can be defined in `routes/web.php` using the static `Route` class. FastRoute handles matching and dispatching efficiently.

---

## Registering Routes

Routes are registered using the static methods of the `Route` class:

```php
use Careminate\Routing\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\PostController;
use Careminate\Http\Responses\Response;
```

---

### Basic Routes

```php
Route::get('/', [HomeController::class, 'index']);
Route::get('/hello', function() {
    return new Response('Hello World');
});
```

* `Route::get($uri, $handler)` – Responds to `GET` requests.
* `$handler` can be a Closure or `[ControllerClass::class, 'method']`.

---

### Route Parameters

Dynamic parameters are supported:

```php
Route::get('/hello/{name}', function($name) {
    return new Response("Hello, {$name}");
});
```

* Parameters are passed as arguments to the handler.
* `{param}` – required parameter
* `{param?}` – optional parameter (not yet implemented in this version)

---

### Route with Regular Expression Constraints

```php
Route::get('/posts/{id:\d+}/show', [PostController::class, 'show']);
```

* FastRoute supports regex constraints in parameters.
* In the example above, `{id:\d+}` ensures the `id` is numeric.

---

### Resourceful Routes

Instead of defining all CRUD routes manually, you can define your own resourceful routes like:

```php
Route::get('/posts', [PostController::class, 'index']);          // List posts
Route::get('/posts/create', [PostController::class, 'create']);  // Show create form
Route::post('/posts/store', [PostController::class, 'store']);   // Store new post
Route::get('/posts/{id:\d+}/show', [PostController::class, 'show']);  // Show single post
Route::get('/posts/{id:\d+}/edit', [PostController::class, 'edit']); // Show edit form
Route::put('/posts/{id:\d+}/update', [PostController::class, 'update']); // Update post
Route::delete('/posts/{id:\d+}/destroy', [PostController::class, 'delete']); // Delete post
```

* Naming convention used: `/store`, `/show`, `/update`, `/destroy`
* Supports all CRUD HTTP methods: GET, POST, PUT, DELETE

---

### HTTP Method Specific Routes

```php
Route::get('/users', fn() => 'GET users');
Route::post('/users', fn() => 'POST users');
Route::put('/users/{id}', fn($id) => "PUT user $id");
Route::delete('/users/{id}', fn($id) => "DELETE user $id");
```

* You can define routes per HTTP method (`GET`, `POST`, `PUT`, `DELETE`, `PATCH`)

---

### Catch-All Routes

```php
Route::any('/ping', fn() => 'pong');
```

* Responds to **any HTTP method**.

---

## Route Handlers

Routes support two types of handlers:

### 1. Closure (Anonymous Function)

```php
Route::get('/hello', function() {
    return new Response('Hello World');
});
```

### 2. Controller Method

```php
Route::get('/', [HomeController::class, 'index']);
Route::get('/posts/{id:\d+}/show', [PostController::class, 'show']);
```

* The framework automatically instantiates the controller and calls the specified method.
* Route parameters are passed as method arguments.

---

## Route Helpers

* `route_path($file = null)` – Returns the path to the route folder:

```php
echo route_path(); // /path/to/project/routes
echo route_path('web.php'); // /path/to/project/routes/web.php
```

* `base_path($file = null)` – Returns the base path of the project.

---

## Example `web.php`

```php
<?php declare(strict_types=1);

use Careminate\Routing\Route;
use Careminate\Http\Responses\Response;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\HomeController;

// Home route
Route::get('/', [HomeController::class, 'index']);

// Greeting route using a Closure
Route::get('/hello/{name}', function($name) {
    return new Response("Hello, {$name}");
});

// Post resource routes
Route::get('/posts', [PostController::class, 'index']);          
Route::get('/posts/create', [PostController::class, 'create']);  
Route::post('/posts/store', [PostController::class, 'store']);   
Route::get('/posts/{id:\d+}/show', [PostController::class, 'show']);  
Route::get('/posts/{id:\d+}/edit', [PostController::class, 'edit']);
Route::put('/posts/{id:\d+}/update', [PostController::class, 'update']);
Route::delete('/posts/{id:\d+}/destroy', [PostController::class, 'delete']);  
```
📚 Start with the [Routing Guide](route.md) or explore the [Request & Response Lifecycle](request-response.md).
---