<?php
echo phpinfo();
/*
require 'admin/mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
//$mail->IsSMTP();
$mail->Host = "mail.bookingparcel.com";
//$mail->Port = 25;
$mail->Port = 587;
$mail->SMTPOptions = array(
	'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
	)
);
//$mail->SMTPDebug = 2;
$mail->SMTPAuth = true;
$mail->Username = "quote1@bookingparcel.com";
$mail->Password = "02May1964@5017@anitapouya";
$mail->setFrom('quote1@bookingparcel.com', 'Booking Parcel');


$mail->addAddress("traviamt@gmail.com", "Esmaiel");

$mail->CharSet ="utf-8";
$mail->isHTML(true);
$mail->Subject = "Test";
$mail->Body = "Test smtp";


if (!$mail->send()) {
	echo "Quote Mail Not sent<br>";
echo 'Mailer Error: ' . $mail->ErrorInfo;
}
*/