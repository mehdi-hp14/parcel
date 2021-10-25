<?php

require_once(LIB_PATH."mailer". DIRECTORY_SEPARATOR ."PHPMailerAutoload.php");
class MailerClass
{
    public function SendMail($from=array('email'=>'', 'name'=>''), $to=array('email'=>'', 'name'=>''), $subject="", $content="", $attachments=array(), $CCs=array())
	{
		$mail = new PHPMailer;
		//$mail->IsSMTP();
		//$mail->isMail();
		$mail->Host = "mail.bookingparcel.com";
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
		
		$mail->setFrom($from['email'], $from['name']);
		$mail->addReplyTo($from['email'], $from['name']);
		$mail->addAddress($to['email'], $to['name']);
		
		$mail->AddCC('backup1@bookingparcel.com', "BookingParcel(CP Agent)");

		$mail->CharSet ="utf-8";
		$mail->isHTML(true);
		$mail->Subject = $subject;
		
		if(!empty($CCs)){
			foreach($CCs as $id => $email)
			{
				$mail->AddCC($email, $from['name']);
			}
		}
		if(!empty($attachments)){
			foreach($attachments as $id => $path)
			{
				$mail->addAttachment($path);
			}
		}
		
		$mail->Body = $content;
		
		
		if (!$mail->send()) 
		{
			return array('status'=>false, 'message'=>"Mailer Error: " . $mail->ErrorInfo ."<br>");
		} 
		else 
		{
			return array('status'=>true, 'message'=>"Sent Successfully<br>");
		}
	}
}
