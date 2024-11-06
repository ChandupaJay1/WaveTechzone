<?php
require_once SERVER_ROOT . '/config.php';

// Check if the 'id' parameter is present in the URL
if (!isset($_GET['id'])) {
    echo "Product ID is missing.";
    exit;
}

// Get the product ID from the URL
$product_id = $_GET['id'];

try {
    // Connect to the database
    $pdo = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=utf8", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to fetch product details along with category name
    $stmt = $pdo->prepare("
        SELECT product.id, product.name, product.description, product.image, product.price, category.name AS category_name
        FROM product
        JOIN category ON product.category_id = category.id
        WHERE product.id = ?
    ");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the product was found
    if (!$product) {
        echo "Product not found.";
        exit;
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "./components/head.php" ?>

<body>
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <?php include('./components/header.php'); ?>

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Product Details</h3>
                    <span class="breadcrumb"><a href="#">Shop</a> > <?= htmlspecialchars($product['name']); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="section single-product">
        <div class="container">
            <div class="row d-flex align-items-start justify-content-between gap-4">
                <div class="col-lg-5 col-md-12">
                    <div class="product-image">
                        <img src="<?= ROOT ?>/assets/images/products/<?= htmlspecialchars($product['image']); ?>"
                            alt="<?= htmlspecialchars($product['name']); ?>"
                            class="img-fluid shadow-sm rounded-lg"
                            style="border-radius: 1em;" />
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 outline-danger">
                    <div class="product-details-content">
                        <h2 class="product-title"><?= htmlspecialchars($product['name']); ?></h2>
                        <span class="product-category">Category: <?= htmlspecialchars($product['category_name']); ?></span>
                        <h3 class="product-price">$<?= htmlspecialchars($product['price']); ?></h3>
                        <p class="product-description"><?= nl2br(htmlspecialchars($product['description'])); ?></p>
                        <a href="<?= ROOT ?>/cart?action=add&id=<?= htmlspecialchars($product['id']); ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('./components/footer.php'); ?>
    <?php include('./components/scripts.php'); ?>

</body>

</html>
