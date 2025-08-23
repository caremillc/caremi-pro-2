# Str.md


# Careminate\Support\Str

String manipulation helper class providing formatting, case conversions, and random string generation.

## Namespace
```bash
`Careminate\Support`
```
## Class: Str

---

## Methods

### `camel(string $value): string`

Convert a string to camelCase.

**Example:**
```php
Str::camel('hello_world'); // 'helloWorld'
Str::camel('my-function-name'); // 'myFunctionName'
```

# snake(string $value, string $delimiter = '_'): string

Convert a string to snake_case.

Example:
```php 
Str::snake('HelloWorld'); // 'hello_world'
Str::snake('MyFunction', '-'); // 'my-function'
```

# kebab(string $value): string

Convert a string to kebab-case (alias for snake with -).

Example:
```php 
Str::kebab('HelloWorld'); // 'hello-world'
```

# title(string $value): string

Convert a string to Title Case.

Example:
```php 
Str::title('hello_world'); // 'Hello World'
```

# limit(string $value, int $limit = 100, string $end = '...'): string

Limit string length and append suffix if exceeded.

Example:
```php 
Str::limit('Hello World', 5); // 'Hello...'
```

# contains(string $haystack, string|array $needles): bool

Check if string contains one or more substrings.

Example:
```php 
Str::contains('Hello World', 'World'); // true
Str::contains('Hello World', ['Foo', 'World']); // true
```

# startsWith(string $haystack, string|array $needles): bool

Check if string starts with substring(s).

Example:
```php 
Str::startsWith('Hello World', 'Hello'); // true
```

# endsWith(string $haystack, string|array $needles): bool

Check if string ends with substring(s).

Example:
```php 
Str::endsWith('Hello World', 'World'); // true
```

# replaceArray(string $search, array $replace, string $subject): string

Sequentially replace occurrences of a string using an array of replacements.

Example:
```php 
Str::replaceArray('?', ['one', 'two'], '?, ?'); // 'one, two'
```

# after(string $subject, string $search): string

Return substring after first occurrence of $search.

Example:
```php 
Str::after('Hello World', 'Hello '); // 'World'
```

# before(string $subject, string $search): string

Return substring before first occurrence of $search.

Example:
```php 

Str::before('Hello World', ' World'); // 'Hello'
```

# random(int $length = 16): string

Generate a random string of given length.

Example:
```php 
Str::random(8); // 'a3f7c1b2' (random)
```

# lower(string $value): string

Convert string to lowercase.

Example:
```php 
Str::lower('Hello World'); // 'hello world'
```

# upper(string $value): string

Convert string to uppercase.

Example:
```php 
Str::upper('Hello World'); // 'HELLO WORLD'
``` 

# slug(string $title, string $separator = '-'): string

Convert string to URL-friendly slug (kebab-case).

Example:
```php 
Str::slug('Hello World!'); // 'hello-world'
```
