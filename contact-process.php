<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Initialize variables
$name = $surname = $email = $subject = $message = "";
$errors = array();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($surname) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        $errors[] = "Please fill in all required fields and provide a valid email address.";
    }

    // If no errors, send the email
    if (empty($errors)) {
        try {
            // Create PHPMailer instance
            $mail = new PHPMailer(true);

            // SMTP configuration for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['GMAIL_USERNAME']; // Your Gmail address
            $mail->Password = $_ENV['GMAIL_APP_PASSWORD']; // Your Google App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email content
            $mail->setFrom($_ENV['FROM_EMAIL'], $_ENV['FROM_NAME']);
            $mail->addAddress($_ENV['TO_EMAIL']); // Recipient's email address
            $mail->Subject = $subject;
            $mail->Body = "Message from $name $surname ($email):\n\n" . $message;
            $mail->addReplyTo($email); // Reply-to

            if ($mail->send()) {
                header("Location: contact.php?status=success");
                exit();
            } else {
                header("Location: contact.php?status=error");
                exit();
            }
        } catch (Exception $e) {
            $errors[] = "Mailer Error: " . $mail->ErrorInfo;
        }
    }
}

// If validation fails, redirect back with error
if (!empty($errors)) {
    header("Location: contact.php?status=validation_error&message=" . urlencode(implode(", ", $errors)));
}
