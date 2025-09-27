<?php declare(strict_types=1);

use Careminate\Routing\Route;
use Careminate\Http\Responses\Response;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvokeController;
use App\Http\Controllers\Post\PostController;

// Home route
Route::get('/', [HomeController::class, 'index']);

// Greeting route using a Closure
Route::get('/hello/{name}', function($name) {
    return new Response("Hello, {$name}");
});

//Single-action ContactController
Route::get('/contact', [InvokeController::class]);

// Post resource routes
Route::get('/posts', [PostController::class, 'index']);          // List posts
Route::get('/posts/create', [PostController::class, 'create']);  // Show create form
Route::post('/posts/store', [PostController::class, 'store']);         // Store new post
Route::get('/posts/{id}/show', [PostController::class, 'show']);  // Show single post
Route::get('/posts/{id}/edit', [PostController::class, 'edit']); // Show edit form
Route::put('/posts/{id}/update', [PostController::class, 'update']);     // Update post
Route::delete('/posts/{id}/destroy', [PostController::class, 'delete']);  // Delete post
