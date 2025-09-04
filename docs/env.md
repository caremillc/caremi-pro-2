# Environment Configuration Guide

## Overview
The Caremi framework uses environment variables to manage application configuration across different environments. This guide explains how to properly set up and use environment variables in your Caremi application.

## File Structure

### `.env` File
The `.env` file contains your actual environment-specific configuration values.  
This file should **never** be committed to version control as it may contain sensitive information.

### `.env.example` File
The `.env.example` file serves as a template for your environment configuration.  
It contains all the necessary environment variables with example or default values.  
This file **should** be committed to version control.

---

## Environment Variables Reference

### Application Configuration
| Variable     | Description                                      | Default         | Required |
|--------------|--------------------------------------------------|-----------------|----------|
| `APP_NAME`   | Your application name                            | `Caremi`        | Yes      |
| `APP_ENV`    | Application environment (`dev`, `local`, `test`, `production`) | `dev` | Yes |
| `APP_VERSION`| Application version                              | `1.0.0`         | Yes      |
| `APP_DEBUG`  | Enable debug mode                                | `true`          | Yes      |
| `ASSET_URL`  | Base URL for assets (CSS, JS, images)            | Empty           | No       |
| `APP_KEY`    | Application encryption key                       | Random string   | Yes      |
| `APP_URL`    | Base URL of your application                     | `http://localhost` | Yes |

### Database Configuration
| Variable           | Description                                | Default                | Required |
|--------------------|--------------------------------------------|------------------------|----------|
| `DB_DRIVER`        | Database driver (`sqlite`, `mysql`, `pgsql`) | `sqlite`              | Yes      |
| `DB_HOST`          | Database host                              | `127.0.0.1`           | Yes (MySQL/PostgreSQL) |
| `DB_PORT`          | Database port                              | `3306`                | Yes (MySQL/PostgreSQL) |
| `DB_DATABASE`      | Database name                              | `framework`           | Yes (MySQL/PostgreSQL) |
| `DB_SQLITE`        | SQLite database file path                  | `storage/database.sqlite` | Yes (SQLite) |
| `DB_USERNAME`      | Database username                          | `root`                | Yes (MySQL/PostgreSQL) |
| `DB_PASSWORD`      | Database password                          | Empty                 | Yes (MySQL/PostgreSQL) |
| `MYSQL_ATTR_SSL_CA`| MySQL SSL CA certificate path              | Empty                 | No       |

### Email Service Configuration
| Variable                | Description                  | Default | Required |
|--------------------------|------------------------------|---------|----------|
| `EMAIL_SERVICE_API_KEY`  | API key for email service    | Empty   | No       |
| `EMAIL_SERVICE_ENDPOINT` | Endpoint for email service   | Empty   | No       |

---

## Setup Instructions

### 1. Initial Setup
1. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Generate a secure application key:
```php
echo bin2hex(random_bytes(32));
```
### Replace the APP_KEY value in .env with the generated string.

3. Configure your environment-specific values:

Set APP_ENV to match your environment (dev, test, production)

Update database credentials

Set APP_URL to your application’s base URL

2. Environment-Specific Examples
```env
Development 
APP_ENV=dev
APP_DEBUG=true
DB_DRIVER=sqlite
```

## Production
```env
APP_ENV=production
APP_DEBUG=false
DB_DRIVER=mysql
DB_HOST=production-db.example.com
DB_DATABASE=my_app
DB_USERNAME=app_user
DB_PASSWORD=secure_password
```

## Testing
```env
APP_ENV=test
APP_DEBUG=true
DB_DRIVER=sqlite
DB_SQLITE=storage/testing.sqlite
```

# Using Environment Variables in Code
The env() Helper Function

The framework provides an env() helper function to access environment variables with proper type conversion:
```php 
// Basic usage
$appName = env('APP_NAME', 'Default App Name');

// Type conversion
$debug   = env('APP_DEBUG', false);   // boolean
$port    = env('DB_PORT', 3306);      // integer
$version = env('APP_VERSION', '1.0'); // string
```
# Supported automatic conversions:

'true' → true (boolean)

'false' → false (boolean)

'null' → null

'empty' → '' (empty string)

Numeric strings → integers or floats

JSON strings → arrays or objects

# Accessing via Dependency Injection
```php 
use Psr\Container\ContainerInterface;

class MyService
{
    public function __construct(
        private ContainerInterface $container
    ) {
        $appEnv = $this->container->get('APP_ENV');
        $appKey = $this->container->get('APP_KEY');
    }
}

```
# Security Considerations

Never commit .env to version control (add it to .gitignore)

Use unique APP_KEY per environment

Keep sensitive data secure (database passwords, API keys, etc.)

Use environment-specific configurations (dev/test/prod should differ)

# Troubleshooting
Common Issues

“.env file is missing or not readable”

Ensure .env exists in the project root

Check file permissions:

```bash 
chmod 644 .env
```
“Required environment variables are missing”

Verify all required variables are set

Check for typos in variable names

Environment variables not loading

Ensure symfony/dotenv is installed

Verify .env is in the correct location

# Debugging
```php 
// Dump all environment variables
var_dump($_ENV);

// Check specific variable
echo env('APP_ENV'
```

## Best Practices

Provide sensible defaults when using env()

Validate that required variables are set

Group related variables in .env

Always update .env.example when adding new variables

Add inline comments in .env.example for clarity

## Production Deployment

Set environment variables directly on the server

Use platform-specific env management tools

Consider a secrets management service for sensitive data

Ensure APP_DEBUG=false in production

Ensure APP_ENV=production

## Apache Example (.htaccess)
```bash
SetEnv APP_ENV production
SetEnv APP_DEBUG false
SetEnv APP_KEY your_secure_key_here
```

## Nginx Example
```bash 
fastcgi_param APP_ENV production;
fastcgi_param APP_DEBUG false;
fastcgi_param APP_KEY your_secure_key_here;
```
