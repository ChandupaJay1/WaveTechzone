<?php
require 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Check if we are in 'online' or 'offline' mode
$appMode = $_ENV['APP_MODE'];

if ($appMode === 'online') {
  $dbHost = $_ENV['DB_HOST_ONLINE'];
  $dbPort = $_ENV['DB_PORT_ONLINE'];
  $dbName = $_ENV['DB_DATABASE_ONLINE'];
  $dbUser = $_ENV['DB_USERNAME_ONLINE'];
  $dbPass = $_ENV['DB_PASSWORD_ONLINE'];
} else {
  $dbHost = $_ENV['DB_HOST_OFFLINE'];
  $dbPort = $_ENV['DB_PORT_OFFLINE'];
  $dbName = $_ENV['DB_DATABASE_OFFLINE'];
  $dbUser = $_ENV['DB_USERNAME_OFFLINE'];
  $dbPass = $_ENV['DB_PASSWORD_OFFLINE'];
}

// Database connection
try {
  $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die(json_encode(["error" => $e->getMessage()]));
}

// SQL query to fetch products along with their categories
$sql = "
  SELECT product.id, product.name, product.description, product.image, product.price, category.name AS category_name
  FROM product
  JOIN category ON product.category_id = category.id
";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch products as an associative array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if products are fetched
if (empty($products)) {
  // echo "SORRY!.. No products found.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <title>Our Shop</title>
  <link rel="icon" href="assets/images/logo-tp-orange.ico">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-lugx-gaming.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>

  <?php include('./components/header.php'); ?>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>Our Shop</h3>
          <span class="breadcrumb"><a href="#">Home</a> > Our Shop</span>
        </div>
      </div>
    </div>
  </div>

  <div class="section trending">
    <div class="container">
      <ul class="trending-filter">
        <li><a class="is_active" href="#!" data-filter="*">Show All</a></li>
        <li><a href="#!" data-filter=".adv">Mother Boards</a></li>
        <li><a href="#!" data-filter=".str">Graphic Card</a></li>
        <li><a href="#!" data-filter=".rac">RAM</a></li>
        <li><a href="#!" data-filter=".ssd">SSD</a></li>
        <li><a href="#!" data-filter=".mouse">Mouse</a></li>
        <li><a href="#!" data-filter=".keyboard">Keyboards</a></li>
      </ul>

      <div class="row trending-box">
        <?php if (!empty($products)): ?>
          <?php foreach ($products as $product): ?>
            <div class="col-lg-3 col-md-6 mb-30 trending-items <?php echo htmlspecialchars($product['category_name']); ?>">
              <div class="item">
                <div class="thumb">
                  <a href="product-details.php?id=<?php echo $product['id']; ?>">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                  </a>
                  <span class="price"><em>$<?php echo htmlspecialchars($product['price']); ?></em></span>
                </div>
                <div class="down-content">
                  <span class="category"><?php echo htmlspecialchars($product['category_name']); ?></span>
                  <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                  <a href="product-details.php?id=<?php echo $product['id']; ?>"><i class="fa fa-shopping-bag"></i></a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>SORRY!.. No products found.</p>
        <?php endif; ?>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <ul class="pagination">
            <li><a href="#"> &lt; </a></li>
            <li><a href="#">1</a></li>
            <li><a class="is_active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"> &gt; </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?php include('./components/footer.php'); ?>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    // Filter function
    $('.trending-filter a').click(function() {
      var filterValue = $(this).attr('data-filter');

      // Remove 'is_active' class from all links and add to the clicked one
      $('.trending-filter a').removeClass('is_active');
      $(this).addClass('is_active');

      // Show all items if the filter is '*', else filter by class
      if (filterValue === '*') {
        $('.trending-items').show();
      } else {
        $('.trending-items').hide();
        $(filterValue).show();
      }
    });
  });
</script>

</html>