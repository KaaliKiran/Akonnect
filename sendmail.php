<?php
ini_set( 'sendmail_from', "kaali.kiran@gmail.com" ); 
ini_set( 'SMTP', "smtp.gmail.com" );  
ini_set( 'smtp_port', 465 );
$to = 'kali.kiran@gmail.com';
$subject = 'Hello from XAMPP!';
$message = 'This is a test';
$headers = "From: kaali.kiran@gmail.com\r\n";
if (mail($to, $subject, $message, $headers)) {
   echo "SUCCESS";
} else {
   echo "ERROR";
}