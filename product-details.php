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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <title><?php echo htmlspecialchars($name); ?> - Product Details</title>
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
        <?php
        // Loop through each product and display
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $category = $row['category'];
            $image = $row['image'];
            $price = number_format($row['price'], 2); // Format price to 2 decimal places

            echo "<div class='col-lg-3 col-md-6 mb-30 trending-items {$category}'>
                            <div class='item'>
                                <div class='thumb'>
                                    <a href='product-details.php?id={$id}'><img src='{$image}' alt='Product Image'></a>
                                    <span class='price'><em>\${$price}</em>\${$price}</span>
                                </div>
                                <div class='down-content'>
                                    <span class='category'>{$category}</span>
                                    <h4>{$name}</h4>
                                    <a href='product-details.php?id={$id}'><i class='fa fa-shopping-bag'></i></a>
                                </div>
                            </div>
                        </div>";
          }
        } else {
          echo "<p>No products found.</p>";
        }

        // Free result set
        $result->free();
        $connection->close();
        ?>
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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>