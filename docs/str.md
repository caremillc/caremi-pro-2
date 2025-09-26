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
