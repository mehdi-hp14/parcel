<?php
//echo phpinfo();


require 'mailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;
 
//$mail->IsSMTP();
$mail->Host = 'server.myluckybaby.co.uk';
$mail->SMTPAuth = true;
$mail->Username = 'cargo@europostexpress.co.uk';
$mail->Password = '02May1964@5017';
$mail->SMTPSecure = 'tls';
$mail->Port = 465;
 
$mail->From = 'cargo@europostexpress.co.uk';
$mail->FromName = 'Cargo EuroPostExpress';
$mail->addAddress('e.fakhimi@esmaielfakhimi.ir', 'Esmaiel Fakhimi');
 
$mail->addReplyTo('cargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
 
$mail->WordWrap = 50;
$mail->isHTML(true);
 
$mail->Subject = 'Using PHPMailer';
$mail->Body    = 'Hi Iam using PHPMailer library to sent SMTP mail from localhost';
 
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
echo 'Message has been sent';

/*



require 'mailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('cargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
//Set an alternative reply-to address
$mail->addReplyTo('cargo@europostexpress.co.uk', 'Cargo EuroPostExpress');
//Set who the message is to be sent to
//$mail->addAddress('whoto@example.com', 'John Doe');
$mail->addAddress('e.fakhimi@esmaielfakhimi.ir', 'Esmaiel Fakhimi');
//Set the subject line
$mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
$mail->Body    = 'Hi Iam using PHPMailer library to sent SMTP mail from localhost';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
*/