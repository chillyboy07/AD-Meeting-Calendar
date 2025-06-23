<?php
// Define BASE_PATH if not already defined
if (!defined('BASE_PATH')) {
    define('BASE_PATH', realpath(dirname(__DIR__)));
}

// Define UTILS_PATH based on BASE_PATH
define('UTILS_PATH', BASE_PATH . '/utils/');

// Load environment and configuration
require_once UTILS_PATH . 'envSetter.util.php';

try {
    // Create MongoDB Manager instance using env config
    $mongo = new MongoDB\Driver\Manager($mongoConfig['uri']);

    // Run a ping to test connection
    $command = new MongoDB\Driver\Command(["ping" => 1]);
    $mongo->executeCommand("admin", $command);

    echo "✅ Connected to MongoDB successfully.  <br>";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "❌ MongoDB connection failed: " . $e->getMessage() . "  <br>";
}
