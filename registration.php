<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $name = stripcslashes($_POST['name']);
    $email = stripcslashes($_POST['mail']); // Updated field name to 'mail'
    $phone = stripcslashes($_POST['phone']);
    $city = stripcslashes($_POST['city']);
    $occupation = stripcslashes($_POST['occupation']); // New field for occupation

    $subject = 'Skilz Learn Registration Form'; // Define your email subject

    // Email server settings
    // $mail->SMTPDebug = 2;
    // $mail->SMTPAuth = true;
    // $mail->IsSMTP();
    $mail->Host = 'mail.lizyweb.com';
    $mail->Username = 'smt@lizyweb.com';
    $mail->Password = 'Lizyweb@123';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port = 587;

    $mail->setFrom('smt@lizyweb.com', $name);
    $mail->addAddress('skilzlearn.gpc@gmail.com');
    $mail->Subject = $subject;

    // Create the HTML message
    $message = "Name: $name<br />";
    $message .= "Email: $email<br />";
    $message .= "Phone: $phone<br />";
    $message .= "City: $city<br />";
    $message .= "Occupation: $occupation<br />";

    $mail->MsgHTML($message);

    // Send the email
    if ($mail->Send()) {
        echo "<div id='success_page'>";
        echo "<h1>Your Registration Sent Successfully.</h1>";
        echo "<p>Thank you <strong>$name</strong>, your registration has been submitted to us. We will contact you shortly.</p>";
        echo "</div>";
        echo '<a href="index.html">Return to Home</a>';
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $e->getMessage();
}
?>
