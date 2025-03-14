<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer Autoload

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];

    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP Server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // SMTP username
        $mail->Password = 'your-app-password'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Settings
        $mail->setFrom('your-email@gmail.com', 'Shail Infra Build');
        $mail->addAddress('recipient-email@example.com'); // Admin's email

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Booking Request';
        $mail->Body    = "
            <h2>New Booking Request</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Mobile:</strong> $mobile</p>
        ";

        $mail->send();
        header("Location: thank-you.html");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
