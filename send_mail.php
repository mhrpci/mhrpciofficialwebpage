<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to autoload.php of PHPMailer

// Function to redirect with query parameter
function redirectWithStatus($status) {
    header("Location: contact.html?status=$status");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mhrpciofficial@gmail.com'; // SMTP username
        $mail->Password   = 'bshnsqzniienbxeg';     // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;                 // SMTP port

        // Sender and recipient settings
        $mail->setFrom('mhrpciofficial@gmail.com', 'MHRPCI-PH');
        $mail->addAddress('mhrpciofficial@gmail.com', 'MHRPCI-PH');

        // Email content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\nEmail: $email\n\n$message";

        // Send email
        $mail->send();
        redirectWithStatus('success'); // Redirect with success status
    } catch (Exception $e) {
        redirectWithStatus('error'); // Redirect with error status
    }
} else {
    // Redirect to the form page if accessed directly
    header("Location: your_form_page.html");
    exit();
}
?>
