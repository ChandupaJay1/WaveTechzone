<?php
session_start();

// Use absolute path to include config.php
require __DIR__ . '/../config.php';

if (isset($_POST['register_btn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: adminRegister.php?error=Invalid email format');
        exit;
    }

    // Validate mobile number (Sri Lanka format)
    if (!preg_match('/^07[0-9]{8}$/', $mobile)) {
        header('Location: adminRegister.php?error=Invalid mobile number');
        exit;
    }

    // Use prepared statements to prevent SQL injection
    $conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the insertion query
    $stmt = $conn->prepare("INSERT INTO `admin` (`fname`, `lname`, `email`, `mobile`, `password`) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('sssss', $fname, $lname, $email, $mobile, $password);
        if ($stmt->execute()) {
            header('Location: adminLogin.php?register_success=Registration successful! You can now log in.');
            exit;
        } else {
            header('Location: adminRegister.php?error=Something went wrong during registration');
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
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/wavetechzone/assets/css/style.css">
</head>
<body style="background-color: #F9EBEA">

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Admin Register</h2>
    </div>

    <div class="mx-auto container">
        <form id="register-form" action="adminRegister.php" method="POST">
            <p style="color: red;" class="text-center">
                <?php if (isset($_GET['error'])) echo htmlspecialchars($_GET['error']); ?>
            </p>
            <p style="color: green;" class="text-center">
                <?php if (isset($_GET['register_success'])) echo htmlspecialchars($_GET['register_success']); ?>
            </p>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" id="register-fname" name="fname" placeholder="First Name" required />
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" id="register-lname" name="lname" placeholder="Last Name" required />
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="register-email" name="email" placeholder="Email" required />
            </div>

            <div class="form-group">
                <label>Mobile</label>
                <input type="text" class="form-control" id="register-mobile" name="mobile" placeholder="Mobile Number" required />
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required />
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="register-btn" name="register_btn" value="Register" />
            </div>
        </form>
    </div>
</section>

<script src="/wavetechzone/assets/js/script.js"></script>
<script src="https://kit.fontawesome.com/451b2ce250.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
