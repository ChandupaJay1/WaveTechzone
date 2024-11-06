<?php
session_start();

// Redirect if admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: " . ROOT . "/adminDashboard");
    exit;
}

// Check if login form has been submitted
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if required environment variables are set
    if (!isset($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE'])) {
        die("Database connection variables are not set.");
    }

    // Establish a database connection using environment variables
    $conn = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_DATABASE']
    );

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT `id`, `fname`, `lname`, `email`, `password` FROM `admin` WHERE `email` = ? LIMIT 1");

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user was found with the given email
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($admin_id, $admin_fname, $admin_lname, $admin_email, $admin_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $admin_password)) {
                // Store user data in session variables
                $_SESSION['id'] = $admin_id;
                $_SESSION['fname'] = $admin_fname;
                $_SESSION['lname'] = $admin_lname;
                $_SESSION['email'] = $admin_email;
                $_SESSION['admin_logged_in'] = true;

                header("Location: " . ROOT . "/adminDashboard?login_success=Logged in successfully!");

                exit;
            } else {
                header("Location: " . ROOT . "/admin?error=Incorrect password");
                exit;
            }
        } else {
            header("Location: " . ROOT . "/admin?error=Email not found");
            exit;
        }

        $stmt->close();
    } else {
        die("Failed to prepare statement: " . $conn->error);
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nerd Admin - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/nerdtech.png" />
</head>

<body style="background-color: #F9EBEA">

    <section class="my-5 py-5">

        <div class="container text-center mt-3 pt-5">
            <img src="<?= ROOT ?>/assets/images/nerdtech.png" alt="NerdTech Logo" class="mb-3" style="height: 60px;">
            <h2 class="font-weight-bold">Welcome To Nerd Admin Panel</h2>
        </div>


        <div class="mx-auto container">
            <form id="login-form" action="" method="POST">
                <p style="color: red;" class="text-center">
                    <?php if (isset($_GET['error'])) echo htmlspecialchars($_GET['error']); ?>
                </p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required />
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="login-btn" name="login_btn" value="Login" />
                </div>

                <div class="form-group">
                    <a href="<?= ROOT ?>" class="btn btn-secondary">Back To Home</a>
                </div>
            </form>
        </div>

        <p class="m-lg-3 d-flex justify-content-center align-items-center position-fixed bottom-0 w-100 text-dark p-3">
            <a rel="nofollow" href="https://www.facebook.com/nerdtechinfo" target="_blank" class="text-decoration-none text-dark bg-gradient">
                Nerd Admin Panel Powered By NerdTech Software Company.
                <img src="<?= ROOT ?>/assets/images/nerdtech.png" alt="NerdTech Logo" class="ft-logo">
            </a>
        </p>


    </section>



    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    <script src="https://kit.fontawesome.com/451b2ce250.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
