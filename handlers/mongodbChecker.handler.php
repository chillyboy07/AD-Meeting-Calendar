<?php

require_once __DIR__ . '/../utils/envSetter.util.php';

try {
    $mongoUri = "mongodb://{$typeConfig['mongo']['user']}:{$typeConfig['mongo']['pass']}@{$typeConfig['mongo']['host']}:{$typeConfig['mongo']['port']}/?authSource=admin";
    $manager = new MongoDB\Driver\Manager($mongoUri);

    $manager->executeCommand($typeConfig['mongo']['db'], new MongoDB\Driver\Command(['ping' => 1]));
    echo "✅ Connected to MongoDB successfully. <br>";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "❌ MongoDB connection failed: " . $e->getMessage();
}
