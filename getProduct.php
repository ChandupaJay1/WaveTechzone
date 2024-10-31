<?php
require 'vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database connection details from .env
$host = $_ENV['HOST'];
$db = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];


try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL query to fetch all products
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();

    // Fetch products as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON-encoded product data
    echo json_encode($products);

} catch (PDOException $e) {
    // Handle errors by returning a JSON-encoded error message
    echo json_encode(["error" => $e->getMessage()]);
}
