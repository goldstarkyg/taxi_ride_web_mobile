<?php
session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
header('Content-type: application/json');
require_once('lib/php-mailer/PHPMailerAutoload.php');
$mail = new PHPMailer();
$mail->IsHTML(true);                                    // Set email format to HTML
$mail->CharSet = 'UTF-8';
	
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$comment = $_POST["comment"];
	
$mail->From = 'office@okayswiss.ch';
$mail->FromName = $name;
$mail->AddAddress('airport.taxi.swiss@gmail.com');								  
$mail->AddReplyTo($email, $name);
$mail->Subject = $comment;

	$name = isset($name) ? "Name: $name<br><br>" : '';
	$email = isset($email) ? "Email: $email<br><br>" : '';
	$phone = isset($phone) ? "Phone: $phone<br><br>" : '';
	// $company = isset($company) ? "Company: $company<br><br>" : '';
	// $service = isset($service) ? "Service: $service<br><br>" : '';
	$comment = isset($comment) ? "Message: $comment<br><br>" : '';
	$mail->Body = $name . $email . $phone . $comment . '<br><br><br>This email was sent from: ' . $_SERVER['HTTP_REFERER'];


	/* $transport = Swift_SmtpTransport::newInstance('mail.okay.studiowebdemo.com', 26)
	  ->setUsername('office@okay.studiowebdemo.com')
	  ->setPassword('1q2w3e4r'); */

	
	if(!$mail->Send()) {
	   $response = array ('response'=>'error', 'message'=> $mail->ErrorInfo);  
		
	}else {
	   $response = array ('response'=>'success');  
	}
print json_encode($response);
// }
?>