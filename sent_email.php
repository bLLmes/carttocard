<?php
include 'db.php';
session_start();

if(isset($_POST['btn-customer-request'])){
	echo $get_name = $_POST['name'];
	echo $get_email = $_POST['email'];
	echo $get_comment = $_POST['comment'];
	echo "Yeah";

	// $to      = 'martebillyjames@gmail.com';
	// $subject = 'Feed back from website';
	// $message = $get_comment;
	// $headers = 'From: '.$get_email . "\r\n" .
	//     'Reply-To: martebillyjames@gmail.com' . "\r\n" .
	//     'X-Mailer: PHP/' . phpversion();

	// mail($to, $subject, $message, $headers);
}


if(isset($_POST['submit'])){

// $email and $message are the data that is being
// posted to this page from our html contact form
	$email = $_POST['email'] ;
	$message = $_POST['message'] ;

	// When we unzipped PHPMailer, it unzipped to
	// public_html/PHPMailer_5.2.0

	include 'PHPMailer/PHPMailerAutoload.php';

	$mail->SMTPDebug = 2;

	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'smtp.gmail.com:465'; 
	$mailer->SMTPAuth = TRUE;
	$mailer->Port = 465;
	$mailer->mailer="smtp";
	$mailer->SMTPSecure = 'ssl'; 
	$mailer->IsHTML(true);
	$mailer->SMTPOptions = array('ssl' => array(
							'verify_peer' => false, 
							'verify_peer_name' => false, 
							'allow_self_signed' => true)
							);
	$mailer->Username = 'martebillyjames@gmail.com';
	$mailer->Password = 'iluvumeemeeko419';
	$mailer->From = 'renzpelegrino@yahoo.com'; 
	$mailer->FromName = 'Demonstration';
	$mailer->Body =  'Hello james your activation code is '.rand(111111,999999);
	$mailer->Subject = 'Demonstration';
	$mailer->AddAddress('renzpelegrino@yahoo.com');
	if(!$mailer->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mailer->ErrorInfo;
	} else {
	echo 'Successfully Sent';
	}
}
?>