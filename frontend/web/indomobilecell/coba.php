<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "103.27.206.203";
$mail->Port = 25;
$mail->Username = "info@indomobilecell.com";
$mail->Password = "larismanis";
$mail->setFrom('info@indomobilecell.com', 'First Last');
$mail->addReplyTo('info@indomobilecell.com', 'First Last');
$mail->addAddress('yuliantofrandi@gmail.com', 'John Doe');
$mail->Subject = 'PHPMailer SMTP test';
$mail->Body = 'This is a plain-text message body';
if (!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "sent";
}
?>