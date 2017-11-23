<?php 
require 'PHPMailerAutoload.php';
$con=mysqli_connect('localhost','root','','logger');
$qu="SELECT username, mail, type,block FROM users";
$run=mysqli_query($con,$qu);

if ($run==True) {

	while ($data=mysqli_fetch_assoc($run)) {
		$type=$data['type'];
		$block=$data['block'];

		if ($type=='user' && $block=='0') {
			$email=$data['mail'];
			$username=$data['username'];
			$date=date('d/m/Y') ;
			$ql="SELECT duration FROM `log` WHERE date='01/08/2017' AND username='$username'";
			$run2=mysqli_query($con,$ql);
			$total='0';
			while ($durdata=mysqli_fetch_assoc($run2)) {
				$duration=$durdata['duration'];
				$total += $duration;

			}
			if ($total<'360') {
				

				$mail = new PHPMailer;

				//$mail->SMTPDebug = 3;                               // Enable verbose debug output

				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'fabcodersmailer@gmail.com';                 // SMTP username
				$mail->Password = 'fcMail#2016';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to

				$mail->setFrom('fabcodersmailer@gmail.com', 'FabCoders');
				$mail->addAddress($email, $username);     // Add a recipient
				   // Optional name
				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Daily Logs';
				$mail->Body    = 'Your Log entered for the day was less then minimum 6 hours limit ';

				if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
			}

		}
		
		
	}

} 


