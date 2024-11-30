<?php
require_once __DIR__ . '/../config.php';

// Database connection details from .env
$host = $_ENV['DB_HOST'];
$db = $_ENV['DB_DATABASE'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];

$data = [];

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get current page and limit (default values if not provided)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 8;
    $offset = ($page - 1) * $limit;

    // Fetch total product count for pagination
    $totalStmt = $pdo->prepare("SELECT COUNT(*) AS total FROM product");
    $totalStmt->execute();
    $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Prepare SQL query to fetch paginated products
    $stmt = $pdo->prepare(
        "SELECT product.id AS product_id,
        product.name AS product_name,
        product.image,
        product.price,
        category.name AS category_name
        FROM product
        INNER JOIN category ON product.category_id = category.id
        LIMIT :limit OFFSET :offset"
    );
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch products as an associative array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return data as an array
    $data = [
        'products' => $products,
        'total' => $total,
        'limit' => $limit,
        'page' => $page,
        'totalPages' => ceil($total / $limit)
    ];
} catch (PDOException $e) {
    // Handle errors by returning a JSON-encoded error message
    echo json_encode(["error" => $e->getMessage()]);
}

return $data;
?>
