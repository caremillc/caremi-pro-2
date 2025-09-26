<?php declare(strict_types=1);

use Dotenv\Dotenv;

// ---------------------------------------------------------
// Load environment variables from .env (if it exists)
// ---------------------------------------------------------
if (file_exists(BASE_PATH . '/.env')) {
    $dotenv = Dotenv::createImmutable(BASE_PATH);
    $dotenv->safeLoad(); // loads variables into $_ENV without throwing if missing
}
