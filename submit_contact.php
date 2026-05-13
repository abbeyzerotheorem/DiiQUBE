<?php
// Email contact form handler with PHPMailer fallback to PHP mail()

// Try to load PHPMailer if available
$usePHPMailer = false;
if (file_exists(__DIR__ . '/PHPMailer/src/PHPMailer.php')) {
    require __DIR__ . '/PHPMailer/src/Exception.php';
    require __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require __DIR__ . '/PHPMailer/src/SMTP.php';
    $usePHPMailer = true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect & sanitize input
    $fullname = trim($_POST['fullname'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $subject  = trim($_POST['subject'] ?? '');
    $message  = trim($_POST['message'] ?? '');

    // Basic validation
    if (!$fullname || !$email || !$subject || !$message) {
        http_response_code(400);
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        die("Invalid email address.");
    }

    // Try PHPMailer first if available
    if ($usePHPMailer) {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nworatochi755@gmail.com';
            $mail->Password   = 'qduxrowwodjjxcnu';
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Sender
            $mail->setFrom('nworatochi755@gmail.com', 'Website Contact Form');

            // Receivers
            $mail->addAddress('info@diiqube.com');
            $mail->addAddress('nworatochi755@gmail.com');

            // Reply to client
            $mail->addReplyTo($email, $fullname);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = "Contact Form: " . htmlspecialchars($subject);
            $mail->Body = "
                <h3>New Contact Form Submission</h3>
                <p><strong>Full Name:</strong> " . htmlspecialchars($fullname) . "</p>
                <p><strong>Email:</strong> <a href=\"mailto:" . htmlspecialchars($email) . "\">" . htmlspecialchars($email) . "</a></p>
                <p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>
                <hr>
                <p><strong>Message:</strong></p>
                <p>" . nl2br(htmlspecialchars($message)) . "</p>";

            $mail->send();
            http_response_code(200);
            die("Thank you! Your message has been sent successfully. We'll be in touch soon.");

        } catch (\PHPMailer\PHPMailer\Exception $e) {
            // Fall through to PHP mail fallback
        }
    }

    // Fallback: Use PHP's built-in mail() function
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . htmlspecialchars($email) . "\r\n";
    $headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";

    $mailBody = "
        <h3>New Contact Form Submission</h3>
        <p><strong>Full Name:</strong> " . htmlspecialchars($fullname) . "</p>
        <p><strong>Email:</strong> <a href=\"mailto:" . htmlspecialchars($email) . "\">" . htmlspecialchars($email) . "</a></p>
        <p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>
        <hr>
        <p><strong>Message:</strong></p>
        <p>" . nl2br(htmlspecialchars($message)) . "</p>";

    $recipientEmail = 'info@diiqube.com';
    $emailSubject = "Contact Form: " . htmlspecialchars($subject);

    if (mail($recipientEmail, $emailSubject, $mailBody, $headers)) {
        http_response_code(200);
        die("Thank you! Your message has been sent successfully. We'll be in touch soon.");
    } else {
        http_response_code(500);
        die("Error sending message. Please try again later or contact us directly.");
    }
}

// If not POST, redirect to contact page
header("Location: contact.html");
exit;
?>
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
