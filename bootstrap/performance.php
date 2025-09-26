<?php declare(strict_types=1);

if (!function_exists('logExecutionTime')) {
    function logExecutionTime(): void
    {
        $executionTime = microtime(true) - CAREMI_START;
        echo "Request processed in " . number_format($executionTime, 4) . " seconds.<br>";
    }
}