<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title><?= htmlspecialchars($product['name']); ?> - Product Details</title>
    <link rel="icon" href="assets/images/logo-tp-orange.ico">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

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
                        <img src="assets/images/products/<?= htmlspecialchars($product['image']); ?>"
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
                        <a href="cart.php?action=add&id=<?= htmlspecialchars($product['id']); ?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('./components/footer.php'); ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
