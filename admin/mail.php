<?php

require 'mailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;
 
//$mail->IsSMTP();
$mail->Host = 'server.myluckybaby.co.uk';
$mail->SMTPAuth = true;
$mail->Username = 'cargo@europostexpress.co.uk';
$mail->Password = '02May1964@5017';
//$mail->SMTPSecure = 'ssl';
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Port = 25;
 
$mail->setFrom('cargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
$mail->addAddress('e.fakhimi@esmaielfakhimi.ir', 'Esmaiel Fakhimi');
 
$mail->addReplyTo('cargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
 
$mail->WordWrap = 50;
$mail->isHTML(true);
 
$mail->Subject = 'Using PHPMailer test';
$mail->Body    = 'Hi Iam using PHPMailer library to sent SMTP mail from localhost';

$mail->addAttachment('/home/europost/public_html/bookingparcel.com/admin/attachments/Farassoo_Logo.png');
$mail->addAttachment('/home/europost/public_html/bookingparcel.com/admin/attachments/Ekalamarket-120.gif');
 
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
}
else{
echo 'Message has been sent';
}
 
