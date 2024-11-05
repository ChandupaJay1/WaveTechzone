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
                            <a class="nav-link text-white" href="<?= ROOT ?>/handleProduct" <?= (isset($path) && $path === '/handleProduct') ? 'class="active"' : '' ?>">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <form method="POST" class="my-4">
                    <h4>Add New Category</h4>
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <button type="submit" name="add_category" class="btn btn-success">Add Category</button>
                </form>

                <!-- Update Product Form -->
                <form method="POST" enctype="multipart/form-data" class="my-4">
                    <h4>Update Product</h4>
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Select Product</label>
                        <select class="form-select" id="product_id" name="product_id" required>
                            <option value="" disabled selected>Select a product to update</option>
                            <?php while ($product = $products->fetch_assoc()): ?>
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
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="featured" class="form-label">Featured</label>
                        <select class="form-select" id="featured" name="featured" required>
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