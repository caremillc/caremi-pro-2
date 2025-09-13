<?php declare(strict_types=1);

// Load Composer's autoloader (if available)
$autoloadPath = BASE_PATH . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require $autoloadPath;
}

// Future: load environment variables, config, service providers, etc.
// For now, just a silent bootstrap placeholder.
