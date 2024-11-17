<?php
require_once SERVER_ROOT . '/config.php';

$data = require(SERVER_ROOT . "/db_connections/get_all_products.php");

$products = $data['products'] ?? [];
$total = $data['total'] ?? 0;
$limit = $data['limit'] ?? 10;
$page = $data['page'] ?? 1;
$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<?php include "./components/head.php" ?>

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
                <?php if (!empty($products) && is_array($products)): ?>
                    <?php foreach ($products as $row): ?>
                        <div class="col-lg-3 col-md-6 mb-30 trending-items <?= htmlspecialchars($row['category_name'] ?? 'uncategorized'); ?>">
                            <div class="item">
                                <div class="thumb">
                                    <a href="<?= ROOT ?>/product-details?id=<?= htmlspecialchars($row['product_id'] ?? 0); ?>">
                                        <img src='<?= asset("images/products/" . htmlspecialchars($row["image"] ?? "default.jpg")) ?>' alt="Product Image">
                                    </a>
                                    <span class="price">Rs.<?= htmlspecialchars($row['price'] ?? '0.00'); ?></span>
                                </div>
                                <div class="down-content">
                                    <span class="category"><?= htmlspecialchars($row['category_name'] ?? 'Uncategorized'); ?></span>
                                    <h4><?= htmlspecialchars($row['product_name'] ?? 'Unknown Product'); ?></h4>
                                    <a href="<?= ROOT ?>/product-details?id=<?= htmlspecialchars($row['product_id'] ?? 0); ?>"><i class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                        <p class="text-center text-muted fs-4">SORRY!.. No products found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                            <li><a href="?page=<?= $page - 1; ?>&limit=<?= $limit; ?>"> &lt; </a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li><a class="<?= $i == $page ? 'is_active' : ''; ?>" href="?page=<?= $i; ?>&limit=<?= $limit; ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                            <li><a href="?page=<?= $page + 1; ?>&limit=<?= $limit; ?>"> &gt; </a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include('./components/footer.php'); ?>
    <?php include('./components/scripts.php'); ?>
</body>

</html>
