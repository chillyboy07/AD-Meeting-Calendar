<?php

require_once __DIR__ . '/../utils/envSetter.util.php';

$pgConfig = $typeConfig['postgres'];

// Use localhost when running outside Docker (Windows)
$host = PHP_OS_FAMILY === 'Windows' ? 'localhost' : $pgConfig['host'];

$conn = pg_connect("host={$host} port={$pgConfig['port']} dbname={$pgConfig['db']} user={$pgConfig['user']} password={$pgConfig['pass']}");

if ($conn) {
    echo "✅ PostgreSQL Connection";
} else {
    echo "❌ Connection Failed: " . pg_last_error();
}
