<?php
if (!defined('BASE_PATH')) {
    define('BASE_PATH', realpath(dirname(__DIR__)));
}

if (!defined('UTILS_PATH')) {
    define('UTILS_PATH', BASE_PATH . '/utils/');
}

require_once UTILS_PATH . 'envSetter.util.php';

$host = $pgConfig['host'];
$port = $pgConfig['port'];
$dbname = $pgConfig['db'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];

$conn_string = "host=$host port=$port dbname=$dbname user=$username password=$password";
$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    echo "❌ Connection Failed: " . pg_last_error() . "  <br>";
    exit();
} else {
    echo "✔️ PostgreSQL Connection Successful <br>";
    pg_close($dbconn);
}
