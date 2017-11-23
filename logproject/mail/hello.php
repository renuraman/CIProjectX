<?php
require 'PHPMailerAutoload.php';
$id='renuraman1j@gmail.com';
$usid='Renuka';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'fabcodersmailer@gmail.com';                 // SMTP username
$mail->Password = 'fcMail#2016';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('fabcodersmailer@gmail.com', 'Mailer');
$mail->addAddress($id,$usid);     // Add a recipient
   // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Daily Logs';
$mail->Body    = 'Your Log entered for the day was less then minimum 6 hours limit ';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
