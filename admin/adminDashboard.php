<?php
session_start();
require_once __DIR__ . '/../config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: " . ROOT . "/admin");
    exit;
}

// Include admin header
include('adminHeader.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nerd Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link active text-white"  href="<?= ROOT ?>/admin" <?= (isset($path) && $path === '/admin') ? 'class="active"' : '' ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= ROOT ?>/adminAddProducts" <?= (isset($path) && $path === '/adminAddProducts') ? 'class="active"' : '' ?>">Products</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-white"  href="<?= ROOT ?>/handleProduct" <?= (isset($path) && $path === '/handleProduct') ? 'class="active"' : '' ?>">Handle Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="h2 my-4">Product Dashboard</h1>

                <?php
                // Set the current page number
                $page_no = isset($_GET['page_no']) ? (int)$_GET['page_no'] : 1;

                // Define records per page
                $total_records_per_page = 10;
                $offset = ($page_no - 1) * $total_records_per_page;

                try {
                    // Database connection
                    $conn = new mysqli(
                        $_ENV['DB_HOST'],
                        $_ENV['DB_USERNAME'],
                        $_ENV['DB_PASSWORD'],
                        $_ENV['DB_DATABASE']
                    );

                    // Calculate the total number of records and pages
                    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM `product`");
                    $stmt1->execute();
                    $stmt1->bind_result($total_records);
                    $stmt1->store_result();
                    $stmt1->fetch();

                    $total_no_of_pages = ceil($total_records / $total_records_per_page);

                    // Fetch the products for the current page
                    $stmt2 = $conn->prepare("SELECT * FROM `product` LIMIT ?, ?");
                    $stmt2->bind_param('ii', $offset, $total_records_per_page);
                    $stmt2->execute();
                    $products = $stmt2->get_result();
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    exit;
                }
                ?>

                <!-- Display the products in a styled table -->
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Featured</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $products->fetch_assoc()): ?>
                            <tr>
                                <td style="text-align: center;"><?= htmlspecialchars($row['id']); ?></td>
                                <td><?= htmlspecialchars($row['name']); ?></td>
                                <td><?= htmlspecialchars($row['description']); ?></td>
                                <td style="text-align: center;"><img src="<?= ROOT ?>/assets/images/products/<?= htmlspecialchars($row['image']); ?>" alt="Product Image" height="50"></td>
                                <td style="text-align: center;"><?= htmlspecialchars($row['price']); ?></td>
                                <td style="text-align: center;"><?= $row['featured'] ? 'Yes' : 'No'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav>
                    <ul class="pagination">
                        <?php for ($page = 1; $page <= $total_no_of_pages; $page++): ?>
                            <li class="page-item <?= $page_no == $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page_no=<?= $page; ?>"><?= $page; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </main>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/451b2ce250.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
