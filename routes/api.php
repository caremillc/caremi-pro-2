<?php

use Careminate\Routing\Route;

Route::get('/users', fn() => response()->json(['users' => []]));