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
