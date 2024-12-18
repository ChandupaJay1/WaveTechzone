<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <title>Admin</title> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/nerdtech.png" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">

        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="<?= ROOT ?>/assets\images\nerdtech.png" alt="Logo" height="35" class="d-inline-block align-text-top">
                <span class="font ms-3">Nerd Admin Panel</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <?php if (isset($_SESSION['admin_logged_in'])) { ?>

                        <li class="nav-item">
                            <a href="<?= ROOT ?>/adminLogout" class="nav-link btn btn-outline-dark">Logout</a>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
