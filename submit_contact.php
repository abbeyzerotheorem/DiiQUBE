<?php
// Load PHPMailer classes
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect & sanitize input
    $fullname = trim($_POST['fullname'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $subject  = trim($_POST['subject'] ?? '');
    $message  = trim($_POST['message'] ?? '');

    // Basic validation
    if (!$fullname || !$email || !$subject || !$message) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';             // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nworatochi755@gmail.com';    // Your Gmail
        $mail->Password   = 'qduxrowwodjjxcnu';          // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender
        $mail->setFrom('nworatochi755@gmail.com', 'Website Contact');

        // Receivers
        $mail->addAddress('info@yourdomain.com');        // Your webmail
        $mail->addAddress('nworatochi755@gmail.com');    // Your Gmail inbox

        // Reply to client
        $mail->addReplyTo($email, $fullname);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Contact Form: $subject";
        $mail->Body = "
            <strong>Full Name:</strong> $fullname<br>
            <strong>Email:</strong> $email<br><br>
            <strong>Message:</strong><br>
            " . nl2br($message);

        // Send the email
        $mail->send();
        echo "Thank you, your message has been sent.";

    } catch (Exception $e) {
        // Display error if email fails
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
