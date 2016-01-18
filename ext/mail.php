<?php require_once('../PHPMailer-master/class.phpmailer.php');  ?>

<?php

$mail             = new PHPMailer(); // defaults to using php "mail()"

$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->AddReplyTo("kali.kiran@gmail.com","First Last");

$mail->SetFrom('kaali.kiran@gmail.com', 'First Last');

$mail->AddReplyTo("name@yourdomain.com","First Last");

$address = "whoto@otherdomain.com";
$mail->AddAddress($address, "John Doe");

$mail->Subject    = "PHPMailer Test Subject via mail(), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
    ?>