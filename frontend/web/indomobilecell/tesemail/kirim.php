<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "103.27.206.203";
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = "jagoan@indomobilecell.com";
$mail->Password = "jagoan";

$mail->setFrom('jagoan@indomobilecell.com', 'Noreply Indomobilecell');
$mail->addReplyTo('info@indomobilecell.com', 'Info Indomobilecell');
$mail->addAddress('yulianto@landa.co.id');
$mail->Subject = 'CCC Re: Pak bagaimana ?';
$mail->Body = 'dear admin baik, mohon dicek ya terima kasih';

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}