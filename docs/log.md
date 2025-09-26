# Careminate Logging & Alert System

This document provides a user-friendly guide for using the Careminate Logging & Alert system. It covers configuration, usage, log channels, exception handling, and alerts.

---

## Table of Contents

1. [Introduction](#introduction)
2. [Configuration](#configuration)
    - [.env Variables](#env-variables)
    - [log.php Configuration](#logphp-configuration)
3. [Logger Class](#logger-class)
4. [Log Levels](#log-levels)
5. [Using Log Channels](#using-log-channels)
6. [Exception Logging](#exception-logging)
7. [Alerts](#alerts)
8. [Examples](#examples)
9. [Log Storage](#log-storage)
10. [Quick Tips](#quick-tips)

---

## Introduction

The Careminate framework provides a flexible and robust logging system that supports:

- Multiple log channels (`default`, `errors`, `security`, etc.)
- Different log drivers (`single`, `daily`, `errorlog`, `syslog`)
- Log rotation and retention
- Exception mapping to channels and log levels
- Alert notifications via email and Slack

---

## Configuration

### .env Variables

The logging system is configurable via your `.env` file. Example:

```env
# Default application logging
LOG_CHANNEL=default
LOG_DRIVER_SINGLE=single
LOG_DRIVER_DAILY=daily
LOG_DRIVER_SYSLOG=syslog
LOG_DRIVER_ERRORLOG=errorlog

# Log file paths
LOG_PATH_DEFAULT=/storage/logs/app.log
LOG_PATH_ERRORS=/storage/logs/errors.log
LOG_PATH_SECURITY=/storage/logs/security.log

# Log levels
LOG_LEVEL_DEFAULT=debug
LOG_LEVEL_ERRORS=error
LOG_LEVEL_SECURITY=warning

# Log file size and retention
LOG_MAXSIZE_DEFAULT=5242880
LOG_RETENTION_DEFAULT=30

# Alerts
ALERTS_ENABLED=true
ALERT_THRESHOLD=error
ALERT_EMAIL_ENABLED=true
ALERT_EMAIL_RECIPIENTS=admin@example.com,ops@example.com
ALERT_EMAIL_PREFIX=[ALERT]
ALERT_SLACK_ENABLED=false
ALERT_SLACK_WEBHOOK_URL=
```

# config/log.php Configuration
```bash 
return [
    'default' => env('LOG_CHANNEL', 'default'), # default, errors, security

    'channels' => [
        'default' => [
            'driver'        => env('LOG_DRIVER_DAILY', 'daily'),
            'path'          => BASE_PATH . env('LOG_PATH_DEFAULT', '/storage/logs/app.log'),
            'level'         => env('LOG_LEVEL_DEFAULT', 'debug'),
            'max_file_size' => (int) env('LOG_MAXSIZE_DEFAULT', 5 * 1024 * 1024),
            'retention_days'=> (int) env('LOG_RETENTION_DEFAULT', 30),
        ],

        'errors' => [
            'driver' => env('LOG_DRIVER_ERRORLOG', 'errorlog'),
            'path'   => BASE_PATH . env('LOG_PATH_ERRORS', '/storage/logs/errors.log'),
            'level'  => env('LOG_LEVEL_ERRORS', 'error'),
        ],

        'security' => [
            'driver' => env('LOG_DRIVER_SINGLE', 'single'),
            'path'   => BASE_PATH . env('LOG_PATH_SECURITY', '/storage/logs/security.log'),
            'level'  => env('LOG_LEVEL_SECURITY', 'warning'),
        ],
    ],

    'exception_map' => [
        \RuntimeException::class         => ['error', 'errors', true],
        \LogicException::class           => ['critical', 'default', true],
        \InvalidArgumentException::class => ['notice', 'default', false],
        \Careminate\Exceptions\AuthException::class => ['warning', 'security', true],
    ],

    'alerts' => [
        'enabled' => filter_var(env('ALERTS_ENABLED', true), FILTER_VALIDATE_BOOLEAN),
        'threshold_level' => env('ALERT_THRESHOLD', 'error'),
        'email' => [
            'enabled' => filter_var(env('ALERT_EMAIL_ENABLED', true), FILTER_VALIDATE_BOOLEAN),
            'recipients' => array_map('trim', explode(',', env('ALERT_EMAIL_RECIPIENTS', 'admin@example.com'))),
            'subject_prefix' => env('ALERT_EMAIL_PREFIX', '[ALERT]'),
        ],
        'slack' => [
            'enabled' => filter_var(env('ALERT_SLACK_ENABLED', false), FILTER_VALIDATE_BOOLEAN),
            'webhook_url' => env('ALERT_SLACK_WEBHOOK_URL', ''),
        ],
    ],
];

```
--- 
# Logger Class

Located at: Careminate\Logging\Logger

Handles writing logs to multiple drivers (single, daily, errorlog, syslog)

Supports automatic rotation and retention

Integrates with AlertManager for high-severity logs

# Key Methods
```bash 
logger('channel')->debug('Debug message', ['context' => $data]);
logger('channel')->info('Info message');
logger('channel')->warning('Warning message');
logger('channel')->error('Error message', ['error_code' => 500]);
logger('channel')->critical('Critical message');

```
---

| Level     | Severity |
| --------- | -------- |
| debug     | 0        |
| info      | 1        |
| notice    | 2        |
| warning   | 3        |
| error     | 4        |
| critical  | 5        |
| alert     | 6        |
| emergency | 7        |
---

# Using Log Channels

Channels are separate log streams. Examples:
```bash 
logger('default')->info('Application booted');
logger('errors')->error('Database connection failed');
logger('security')->warning('Unauthorized login attempt');

```
---
default: General application logs

errors: Error-specific logs

security: Security-related events

# Exception Logging

All exceptions can be logged automatically via the Handler:
```bash
try {
    throw new RuntimeException("A runtime exception occurred!");
} catch (\Throwable $e) {
    logException($e); // Logs using exception mapping
}

try {
    throw new AuthException("Invalid credentials", 401, ['username'=>'john.doe']);
} catch (\Throwable $e) {
    logException($e); // Logs to 'security' channel
}
```
---

exception_map in config/log.php determines the channel and level per exception type.

# Alerts

High-severity logs (level ≥ threshold) trigger alerts:

Email: Configurable recipients, prefix, and enabled flag

Slack: Webhook notifications if enabled

Alerts use the AlertManager class
```bash
logger('errors')->critical('Critical system failure!', ['server' => 'web-01']);
```

---
If alerts are enabled, this will send email or Slack notifications automatically.

# Examples
```bash 
// Default channel
logger('default')->info('App booted');
logger('default')->debug('Debugging', ['uri' => $_SERVER['REQUEST_URI']]);

// Database channel
logger('errors')->info('Database connected');
logger('errors')->error('Query failed', ['sql' => 'SELECT * FROM users']);

// Security channel
logger('security')->warning('User login attempt failed');
logger('security')->info('User accessed dashboard', ['user_id' => 123]);

``` 

---

# Log Storage

All logs are stored in the storage/logs/ directory by default:
```bash 
storage/logs/
├─ app.log
├─ errors.log
├─ security.log
├─ default-YYYY-MM-DD.log
├─ errors-YYYY-MM-DD.log

``` 

Daily rotation is applied automatically for daily driver logs. Old logs are cleaned up after retention_days.

# Quick Tips

Use logger('channel')->level() to log messages.

Exceptions are automatically mapped using logException($e).

Configure alerts in .env and config/log.php.

For CLI output, exceptions are displayed in plain text; for web, they are wrapped in <pre> tags.

Check storage/logs/ regularly to ensure logs are being written and rotated correctly.

