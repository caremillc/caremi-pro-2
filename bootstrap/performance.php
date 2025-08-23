<?php declare(strict_types=1);

// Capture the current timestamp to calculate the processing time
$requestStartTime = microtime(true);

// Perform some logic here (e.g., request handling, database query, etc.)
usleep(100000); // Simulate some processing delay (e.g., database query)

// Calculate the total processing time
$requestEndTime = microtime(true);
$executionTime = $requestEndTime - $requestStartTime;


// Log the execution time (this could be saved to a file or monitored)
//echo"<pre>";
echo "Request processed in " . number_format($executionTime, 4) . " seconds.\n"."</br>";
