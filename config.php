<?php

// TEST:
//
// $trace = debug_backtrace();
// if (isset($trace[0]['file'])) {
//     echo "<br><br>Current file: " . $trace[0]['file'] . " : line " . $trace[0]['line'] . "<br>";
// }
// if (isset($trace[1]['file'])) {
//     echo "Included by: " . $trace[1]['file']. " : line " . $trace[1]['line'] . "<br><br>";
// }
// var_dump(__FILE__ . ' -> start<br>');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$appMode = $_ENV['APP_MODE'];

// Use online database settings
$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbName = $_ENV['DB_DATABASE'];
$dbUser = $_ENV['DB_USERNAME'];
$dbPass = $_ENV['DB_PASSWORD'];

// Debugging output
if (empty($dbHost) || empty($dbName) || empty($dbUser) || empty($dbPass)) {
    die("Database configuration variables are not set.");
}

define("SERVER_ROOT", __DIR__);

$dirArr = explode("/", str_replace("\\", "/", __DIR__));
$rootDirName = $server->rootDirName ?? $dirArr[count($dirArr) - 1];
$rootHasDirName = str_contains(strtolower($_SERVER["REQUEST_URI"]), strtolower($rootDirName));
define("ROOT", $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["SERVER_NAME"] . ($rootHasDirName ? "/" . strtolower($rootDirName) : ''));
