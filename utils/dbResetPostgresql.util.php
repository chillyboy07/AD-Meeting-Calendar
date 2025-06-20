<?php
declare(strict_types=1);

// 1) Composer autoload
require 'vendor/autoload.php';

// 2) Composer bootstrap (optional, only if you use it)
// require 'bootstrap.php';

// 3) Load environment variables
require_once __DIR__ . '/envSetter.util.php';

$pgConfig = $typeConfig['postgres'];

// ——— Connect to PostgreSQL ———
$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
try {
    $pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "✅ Connected to PostgreSQL.\n";
} catch (PDOException $e) {
    die("❌ PostgreSQL connection failed: " . $e->getMessage() . "\n");
}

// ——— Truncate tables ———
echo "Truncating tables…\n";
$tables = ['meeting_users', 'tasks', 'meetings', 'users'];

foreach ($tables as $table) {
    try {
        $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
        echo "✅ Truncated {$table}\n";
    } catch (PDOException $e) {
        echo "❌ Failed to truncate {$table}: " . $e->getMessage() . "\n";
    }
}

// ——— Apply SQL schema files ———
$schemas = [
    'database/user.model.sql',
    'database/meeting.model.sql',
    'database/meeting_users.model.sql',
    'database/tasks.model.sql',
];

foreach ($schemas as $schemaPath) {
    echo "Applying schema from {$schemaPath}…\n";
    $sql = file_get_contents($schemaPath);

    if ($sql === false) {
        echo "❌ Could not read {$schemaPath}\n";
        continue;
    }

    try {
        $pdo->exec($sql);
        echo "✅ Successfully applied {$schemaPath}\n";
    } catch (PDOException $e) {
        echo "❌ Error applying {$schemaPath}: " . $e->getMessage() . "\n";
    }
}
