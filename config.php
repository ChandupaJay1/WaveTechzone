<?php
require 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Check if we are in 'online' or 'offline' mode
$appMode = $_ENV['APP_MODE'];

if ($appMode === 'online') {
    // Use online database settings
    $dbHost = $_ENV['DB_HOST_ONLINE'];
    $dbPort = $_ENV['DB_PORT_ONLINE'];
    $dbName = $_ENV['DB_DATABASE_ONLINE'];
    $dbUser = $_ENV['DB_USERNAME_ONLINE'];
    $dbPass = $_ENV['DB_PASSWORD_ONLINE'];
    $apiKey = $_ENV['API_KEY_ONLINE'];
} else {
    // Use offline database settings
    $dbHost = $_ENV['DB_HOST_OFFLINE'];
    $dbPort = $_ENV['DB_PORT_OFFLINE'];
    $dbName = $_ENV['DB_DATABASE_OFFLINE'];
    $dbUser = $_ENV['DB_USERNAME_OFFLINE'];
    $dbPass = $_ENV['DB_PASSWORD_OFFLINE'];
    $apiKey = $_ENV['API_KEY_OFFLINE'];
}

// Example: Database connection (same structure, different values)
$connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

echo "Connected successfully in $appMode mode!";
