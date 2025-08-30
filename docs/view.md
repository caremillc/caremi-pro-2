# Careminate PHP Framework – View System Documentation

## Overview

The Careminate PHP framework supports a flexible and extensible view system with multiple template engines: **Flint**, **Twig**, and **Plates**. The view system allows rendering HTML templates with dynamic data, sections, stacks, layouts, and reusable components.

The view system is powered by:

* **ViewManager** – Central interface to select the active template engine.
* **FlintCompiler** – Custom Flint template compiler with Blade-like syntax.
* **TwigEngine** – Twig template integration.
* **PlatesEngine** – Plates template engine integration.
* **View Helper** – Global `view()` helper for rendering views.

---

## Configuration

### File: `config/view.php`

```php
return [
    'engine' => 'flint', // Default engine: "flint", "twig", "plates"
    
    'paths' => [
        __DIR__ . '/../templates/views', // Path to your view files
    ],

    'compiled' => storage_path('views/compiled'), // Cache path for compiled Flint templates

    'extensions' => [
        '.flint.php', // Flint template extension
        '.php',       // Optional default PHP templates
    ],

    'cache' => __DIR__ . '/../storage/framework/views', // General cache path for engines
];
```

* **engine**: Default template engine.
* **paths**: Paths where the engine searches for templates.
* **compiled**: Only used for Flint engine; stores compiled PHP code.
* **extensions**: File extensions recognized by the Flint compiler.
* **cache**: Cache path for engines that support caching (e.g., Twig).

---

## Rendering Views

Use the global `view()` helper function to render templates:

```php
view('home.index', ['name' => 'Careminate']);
```

* First argument: View name using dot notation (e.g., `home.index` corresponds to `home/index.flint.php`).
* Second argument: Array of dynamic data.

### Example in a Controller

```php
namespace App\Http\Controllers;

use Careminate\Http\Controllers\AbstractController;
use Careminate\Http\Responses\Response;

class HomeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('home.index', [
            'name' => 'Careminate',
        ]);
    }
}
```

---

## Flint Template Engine

The **Flint engine** is Careminate's custom Blade-like template engine supporting:

* Layouts (`@extends`, `@section`, `@yield`)
* Stacks (`@push`, `@stack`)
* Control structures (`@if`, `@foreach`, `@for`, `@while`, `@switch`)
* Verbatim blocks (`@verbatim`)
* Custom directives (`@csrf`, `@auth`, `@guest`, `@error`, `@asset`, `@dump`, `@dd`)

### Layouts

#### Example: `layouts/app.flint.php`

```html
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Careminate')</title>
    <link rel="stylesheet" href="@asset('css/app.css')">
</head>
<body>
    @yield('main')
    @stack('scripts')
</body>
</html>
```

#### Extending a Layout

```php
@extends('layouts.app')

@section('title')
Welcome
@endsection

@section('main')
<h1>Hello, {{ $name }}!</h1>
@endsection
```

---

### Sections and Yields

* `@section('name') ... @endsection` – Define a section.
* `@yield('name')` – Render a section in the layout.
* `@push('name') ... @endpush` – Add content to a stack.
* `@stack('name')` – Render stacked content.

---

### Built-in Flint Directives

| Directive                    | Usage & Description                                         |
| ---------------------------- | ----------------------------------------------------------- |
| `@csrf`                      | Generates a CSRF hidden input field.                        |
| `@auth ... @endauth`         | Show content if user is logged in (`Session::get('user')`). |
| `@guest ... @endguest`       | Show content if user is a guest.                            |
| `@error('field')`            | Show validation error message for a field.                  |
| `@asset('path')`             | Generate a URL for an asset.                                |
| `@dump($var)`                | Debug dump variable.                                        |
| `@dd($var)`                  | Debug dump and die.                                         |
| `@verbatim ... @endverbatim` | Prevent parsing of template syntax inside block.            |

---

### Control Structures

```php
@if($condition)
@elseif($otherCondition)
@else
@endif

@foreach($items as $item)
@endforeach

@for($i = 0; $i < 5; $i++)
@endfor

@while($counter > 0)
@endwhile

@switch($status)
    @case('success')
    @break
    @default
@endswitch
```

### Output Variables

* Escaped output: `{{ $variable }}`
* Raw output: `{!! $variable !!}`

---

### Example Flint Template

`templates/views/test/flint_test.flint.php`

```php
@extends('layouts.app')

@section('title')
Flint Engine Test
@endsection

@section('main')
<p>Normal variable: {{ $name }}</p>
<p>Raw HTML: {!! $rawHtml !!}</p>

@foreach($items as $item)
    <p>Item: {{ $item }}</p>
@endforeach
@endsection

@push('scripts')
@verbatim
<script>console.log("Flint test script");</script>
@endverbatim
@endpush
```

---

## Twig Template Engine

To use **Twig**, set `engine` to `twig` in `config/view.php`:

```php
'engine' => 'twig',
```

### Example Twig Usage

```twig
{# templates/views/home/index.twig #}

{% extends 'layouts/app.twig' %}

{% block title %}Welcome{% endblock %}

{% block main %}
<h1>Hello, {{ name }}!</h1>
{% endblock %}
```

---

## Plates Template Engine

To use **Plates**, set `engine` to `plates` in `config/view.php`:

```php
'engine' => 'plates',
```

### Example Plates Usage

```php
<?php $this->layout('layouts/app'); ?>

<?php $this->start('title'); ?>Welcome<?php $this->stop(); ?>

<?php $this->start('main'); ?>
<h1>Hello, <?= $name ?>!</h1>
<?php $this->stop(); ?>
```

---

## Global Helpers

### `view($view, $data = [])`

Renders a template using the configured engine.

### `storage_path($path = '')`

Returns the storage directory path.

### `asset($path)`

Generates a full URL to an asset:

```php
<img src="@asset('images/logo.png')">
```

---

## Use Cases

### 1. Home Page

```php
return view('home.index', ['name' => 'Careminate']);
```

### 2. Authentication Pages

```php
return view('auth.login', [
    'errors' => $errors ?? [],
    'user'   => Session::get('user'),
]);
```

### 3. Passing Dynamic Data

```php
return view('test.flint_test', [
    'name' => 'John Doe',
    'rawHtml' => '<b>Bold Text</b>',
    'items' => ['One', 'Two', 'Three'],
    'counter' => 3,
    'status' => 'success',
    'showMessage' => true,
]);
```

### 4. Using Stacks for Scripts

```php
@push('scripts')
@verbatim
<script>
console.log('Script loaded for this page.');
</script>
@endverbatim
@endpush
```

---

## Best Practices

1. **Use layouts** to maintain consistent HTML structure.
2. **Escape variables** by default (`{{ $var }}`), use `{!! $var !!}` only for trusted content.
3. **Organize templates** using folders (`home`, `auth`, `layouts`, `test`).
4. **Use stacks** for scripts or CSS that should be injected into layouts.
5. **Leverage Flint directives** for common tasks (`@csrf`, `@auth`, `@guest`, `@error`, `@asset`).

---

## Conclusion

Careminate’s view system provides a modern, Blade-like templating experience with support for multiple engines. Flint is ideal for PHP developers wanting expressive templates without additional dependencies, while Twig and Plates provide compatibility with established template engines.

This system is fully integrated with the **Controller layer**, **CSRF protection**, **session management**, and **asset URL generation**.
