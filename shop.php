<?php
require_once __DIR__ . '/config.php';

$data = require(__DIR__ . "/db_connections/get_all_products.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Our Shop</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/logo-tp-orange.ico">
    <link href="<?= ROOT ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= asset('css/fontawesome.css') ?>" />
    <link rel="stylesheet" href="<?= asset('css/templatemo-lugx-gaming.css') ?>" />
    <link rel="stylesheet" href="<?= asset('css/owl.css') ?>" />
    <link rel="stylesheet" href="<?= asset('css/animate.css') ?>" />
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
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <div class="col-lg-3 col-md-6 mb-30 trending-items <?= htmlspecialchars($row['category_name']); ?>">
                            <div class="item">
                                <div class="thumb">
                                    <a href="<?= ROOT ?>/product-details?id=<?= $row['product_id']; ?>">
                                        <img src='<?= asset("images/products/" . htmlspecialchars($row["image"])) ?>' alt="Product Image">
                                    </a>
                                    <span class="price"><em>$<?= htmlspecialchars($row['price']); ?></em></span>
                                </div>
                                <div class="down-content">
                                    <span class="category"><?= htmlspecialchars($row['category_name']); ?></span>
                                    <h4><?= htmlspecialchars($row['product_name']); ?></h4>
                                    <a href="<?= ROOT ?>/product-details?id=<?= $row['product_id']; ?>"><i class="fa fa-shopping-bag"></i></a>
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
<script src="<?= ROOT ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= ROOT ?>/assets/js/isotope.min.js"></script>
<script src="<?= ROOT ?>/assets/js/custom.js"></script>
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
