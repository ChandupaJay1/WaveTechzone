<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: " . ROOT . "/admin");
    exit;
}

// Include admin header
include('adminHeader.php');

// Database connection
try {
    $conn = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_DATABASE']
    );

    // Fetch categories and products
    $category_stmt = $conn->prepare("SELECT id, name FROM `category`");
    $category_stmt->execute();
    $categories = $category_stmt->get_result();

    $product_stmt = $conn->prepare("SELECT id, name FROM `product`");
    $product_stmt->execute();
    $products = $product_stmt->get_result();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

// Handle Add Category
if (isset($_POST['add_category'])) {
    $category_name = $_POST['category_name'];
    $add_category_stmt = $conn->prepare("INSERT INTO `category` (name) VALUES (?)");
    $add_category_stmt->bind_param('s', $category_name);
    $add_category_stmt->execute();
    echo "<p class='alert alert-success'>Category added successfully.</p>";
}

// Handle Delete Category
if (isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];
    // Check if the category is associated with any products
    $product_check_stmt = $conn->prepare("SELECT COUNT(*) AS product_count FROM `product` WHERE category_id = ?");
    $product_check_stmt->bind_param('i', $category_id);
    $product_check_stmt->execute();
    $result = $product_check_stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['product_count'] > 0) {
        echo "<p class='alert alert-danger'>Category cannot be deleted because it is associated with products.</p>";
    } else {
        $delete_stmt = $conn->prepare("DELETE FROM `category` WHERE id = ?");
        $delete_stmt->bind_param('i', $category_id);
        if ($delete_stmt->execute()) {
            echo "<p class='alert alert-success'>Category deleted successfully.</p>";
        } else {
            echo "<p class='alert alert-danger'>Error deleting category: " . $conn->error . "</p>";
        }
    }
}

// Handle Update Product
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $featured = isset($_POST['featured']) ? $_POST['featured'] : 0;

    // Handle image upload
    $target_dir = __DIR__ . "/../assets/images/products/";
    $image = $_FILES['image'];
    if ($image["name"]) {
        $target_file = $target_dir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_file);
        $image_name = $image["name"];
    } else {
        // Keep the existing image if none is uploaded
        $product_image_stmt = $conn->prepare("SELECT image FROM `product` WHERE id = ?");
        $product_image_stmt->bind_param('i', $product_id);
        $product_image_stmt->execute();
        $product_result = $product_image_stmt->get_result();
        $row = $product_result->fetch_assoc();
        $image_name = $row['image'];
    }

    $update_stmt = $conn->prepare("UPDATE `product` SET name=?, category_id=?, description=?, image=?, price=?, featured=?, updated_at=NOW() WHERE id=?");
    $update_stmt->bind_param('sissdii', $name, $category_id, $description, $image_name, $price, $featured, $product_id);
    if ($update_stmt->execute()) {
        echo "<p class='alert alert-success'>Product updated successfully.</p>";
    } else {
        echo "<p class='alert alert-danger'>Error updating product: " . $conn->error . "</p>";
    }
}

// Handle Delete Product
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $delete_stmt = $conn->prepare("DELETE FROM `product` WHERE id=?");
    $delete_stmt->bind_param('i', $product_id);
    if ($delete_stmt->execute()) {
        echo "<p class='alert alert-success'>Product deleted successfully.</p>";
    } else {
        echo "<p class='alert alert-danger'>Error deleting product: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Products and Categories</title>
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
                            <a class="nav-link active text-white" href="<?= ROOT ?>/admin" <?= (isset($path) && $path === '/admin') ? 'class="active"' : '' ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= ROOT ?>/adminAddProducts" <?= (isset($path) && $path === '/adminAddProducts') ? 'class="active"' : '' ?>">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= ROOT ?>/handleProduct" <?= (isset($path) && $path === '/handleProduct') ? 'class="active"' : '' ?>">Handle Product</a>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <form method="POST" class="my-4">
                    <h1 class="h2 my-4">Handle Products</h1>
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <button type="submit" name="add_category" class="btn btn-success">Add Category</button>
                </form>

                <!-- Delete Category Form -->
                <form method="POST" class="my-4">
                    <h4>Delete Category</h4>
                    <div class="mb-3">
                        <label for="category_id_delete" class="form-label">Select Category</label>
                        <select class="form-select" id="category_id_delete" name="category_id" required>
                            <option value="" disabled selected>Select a category to delete</option>
                            <?php
                            $category_stmt->execute();
                            $categories = $category_stmt->get_result();
                            while ($category = $categories->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($category['id']); ?>"><?= htmlspecialchars($category['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="delete_category" class="btn btn-danger">Delete Category</button>
                </form>

                <!-- Update Product Form -->
                <form method="POST" enctype="multipart/form-data" class="my-4" id="update-product-form">
                    <h4>Update Product</h4>
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Select Product</label>
                        <select class="form-select" id="product_id" name="product_id" required>
                            <option value="" disabled selected>Select a product to update</option>
                            <?php
                            $product_stmt->execute();
                            $products = $product_stmt->get_result();
                            while ($product = $products->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($product['id']); ?>"><?= htmlspecialchars($product['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
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
                        <input type="file" class="form-control" id="image" name="image">
                        <img id="product-image-preview" src="" alt="Product Image" class="mt-2" style="max-width: 150px; display: none;">
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
                    <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
                </form>


                <!-- Delete Product Form -->
                <form method="POST" class="my-4">
                    <h4>Delete Product</h4>
                    <div class="mb-3">
                        <label for="product_id_delete" class="form-label">Select Product</label>
                        <select class="form-select" id="product_id_delete" name="product_id" required>
                            <option value="" disabled selected>Select a product to delete</option>
                            <?php
                            // Fetch products again for the delete dropdown
                            $product_stmt->execute();
                            $products = $product_stmt->get_result();
                            while ($product = $products->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($product['id']); ?>"><?= htmlspecialchars($product['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="delete_product" class="btn btn-danger">Delete Product</button>
                </form>

            </main>


        </div>
    </div>

    <script src="https://kit.fontawesome.com/451b2ce250.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>