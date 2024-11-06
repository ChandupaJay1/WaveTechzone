<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: " . ROOT . "/admin");
    exit;
}

// Include admin header
include('adminHeader.php');

// Fetch categories from the category table
try {
    $conn = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_DATABASE']
    );

    $category_stmt = $conn->prepare("SELECT id, name FROM `category`");
    $category_stmt->execute();
    $categories = $category_stmt->get_result();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : 0;

    // Handle image upload
    $target_dir = SERVER_ROOT . "/assets/images/products/";
    $image = $_FILES['image'];
    $target_file = $target_dir . basename($image["name"]);
    $msg = "";
    $success = false;

    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Insert product data into database
        $stmt = $conn->prepare("INSERT INTO `product` (name, category_id, description, image, price, featured) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sissdi', $name, $category_id, $description, $image["name"], $price, $featured);

        if ($stmt->execute()) {
            $msg = "Product added successfully.";
            $success = true;
        } else {
            $msg = "Error adding product: " . $conn->error;
        }
    } else {
        $msg = "Error uploading image.";
    }

    $_SESSION["result"] = ["success" => $success, "msg" => $msg];

    header("Location: " . ROOT . "/adminAddProducts");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style.css">
</head>

<body>
    <div id="result">
        <?php $result = $_SESSION['result'] ?? []; ?>
        <?php if (!empty($result) && !empty($result['msg'] && !empty($result['success']))): ?>
            <?php
            $msg = $result['msg'];
            $success = $result['success'];
            $_SESSION["result"] = null;
            ?>
            <p class='alert alert-<?= $success ? "success" : "danger" ?>'>
                <?= $result["msg"] ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="<?= ROOT ?>/admin" <?= (isset($path) && $path === '/admin') ? 'class="active"' : '' ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= ROOT ?>/adminAddProducts" <?= (isset($path) && $path === '/adminAddProducts') ? 'class="active"' : '' ?>">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= ROOT ?>/handleProduct" <?= (isset($path) && $path === '/handleProduct') ? 'class="active"' : '' ?>">Handle Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <h1 class="h2 my-4">Add Product</h1>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Select a category</option>
                            <?php while ($category = $categories->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($category['id']); ?>"><?= htmlspecialchars($category['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="featured" class="form-label">Featured</label>
                        <select class="form-select mt-0" id="featured" name="featured" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>


            </main>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/451b2ce250.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
