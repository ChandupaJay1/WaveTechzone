<?php
require 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Debugging: Output environment variables to verify they are set correctly
echo "<pre>";
print_r($_ENV); // Check all environment variables
echo "</pre>";

// Check if we are in 'online' or 'offline' mode
$appMode = $_ENV['APP_MODE'];

if ($appMode === 'online') {
    // Use online database settings
    $dbHost = $_ENV['DB_HOST_ONLINE'];
    $dbPort = $_ENV['DB_PORT_ONLINE'];
    $dbName = $_ENV['DB_DATABASE_ONLINE'];
    $dbUser = $_ENV['DB_USERNAME_ONLINE'];
    $dbPass = $_ENV['DB_PASSWORD_ONLINE'];
} else {
    // Use offline database settings
    $dbHost = $_ENV['DB_HOST_OFFLINE'];
    $dbPort = $_ENV['DB_PORT_OFFLINE'];
    $dbName = $_ENV['DB_DATABASE_OFFLINE'];
    $dbUser = $_ENV['DB_USERNAME_OFFLINE'];
    $dbPass = $_ENV['DB_PASSWORD_OFFLINE'];
}

// Debugging output
if (empty($dbHost) || empty($dbName) || empty($dbUser) || empty($dbPass)) {
    die("Database configuration variables are not set.");
}

// Database connection
$connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

echo "Connected successfully in $appMode mode!";

// Fetch products from the Products table
$query = "SELECT * FROM Products";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-lg-3 col-md-6 mb-30 trending-items'>";
        echo "<div class='item'>";
        echo "<div class='thumb'>";
        echo "<a href='product-details.php?id=" . $row['id'] . "'><img src='" . $row['image'] . "' alt='Product Image'></a>";
        echo "<span class='price'><em>$" . $row['price'] . "</em>$" . $row['price'] . "</span>";
        echo "</div>";
        echo "<div class='down-content'>";
        echo "<span class='category'>" . $row['category'] . "</span>";
        echo "<h4>" . $row['name'] . "</h4>";
        echo "<a href='product-details.php?id=" . $row['id'] . "'><i class='fa fa-shopping-bag'></i></a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No products found.";
}

// Close the database connection
$connection->close();
?>
