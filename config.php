<?php
require 'vendor/autoload.php';

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
