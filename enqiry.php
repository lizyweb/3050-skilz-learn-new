<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Sanitize and assign form inputs to variables
    $name = stripcslashes($_POST['name']);
    $phone = stripcslashes($_POST['number']);
    $email = stripcslashes($_POST['email']);
    $course = stripcslashes($_POST['course']);

    $subject = 'Skilz Learn Enquiry Form'; // Set your email subject

    // Configure SMTP server settings
    // Uncomment and configure these if you need to use SMTP
    // $mail->IsSMTP();
    // $mail->SMTPAuth = true;
    // $mail->SMTPDebug = 2; 
    $mail->Host = 'mail.lizyweb.com';
    $mail->Username = 'smt@lizyweb.com';
    $mail->Password = 'Lizyweb@123';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port = 587;

    $mail->setFrom('smt@lizyweb.com', 'Website Enquiry');
    $mail->addAddress('skilzlearn.gpc@gmail.com'); // Add recipient's email address
    $mail->Subject = $subject;

    // Construct the email message body
    $message = "Name: $name<br /><br />";
    $message .= "Phone: $phone<br /><br />";
    $message .= "Email: $email<br /><br />";
    $message .= "Course: $course";

    $mail->isHTML(true); // Set email format to HTML
    $mail->Body = $message;

    // Send the email
    if ($mail->send()) {
        echo "<div id='success_page'>";
        echo "<h1>Your Message Sent Successfully.</h1>";
        echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us. We will contact you shortly.</p>";
        echo "<a href='index.html'>Return to Home</a>";
        echo "</div>";
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $e->getMessage();
}
?>