<?php

define('BASE_PATH', realpath(__DIR__ . '/../') . '/');
define('UTILS_PATH', BASE_PATH . 'utils');

require_once BASE_PATH . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// Override PG host to localhost if on Windows
$pgHost = PHP_OS_FAMILY === 'Windows' ? 'localhost' : $_ENV['PG_HOST'];

$typeConfig = [
    'postgres' => [
        'host' => $pgHost,
        'port' => $_ENV['PG_PORT'],
        'user' => $_ENV['PG_USER'],
        'pass' => $_ENV['PG_PASS'],
        'db'   => $_ENV['PG_DB'],
    ],
    'mongo' => [
        'host' => $_ENV['MONGO_HOST'],
        'port' => $_ENV['MONGO_PORT'],
        'user' => $_ENV['MONGO_USER'],
        'pass' => $_ENV['MONGO_PASS'],
        'db'   => $_ENV['MONGO_DB'],
    ],
    'key' => $_ENV['ENV_NAME'],
];
