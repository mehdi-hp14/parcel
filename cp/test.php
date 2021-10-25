<?php

require(__DIR__ ."". DIRECTORY_SEPARATOR ."Core". DIRECTORY_SEPARATOR ."boot.php");
require_once(APP_PATH."Mailer.php");


							$mail = new MailerClass();

							$mail->isSendmail();
							$mail->setFrom('quote1@bookingparcel.com', 'BookingParcel');
							$mail->addAddress('cargo@europostexpress.co.uk', 'EuroPost Express');
							$mail->Subject = "test";
							$mail->Body ="test";
							if (!$mail->send()) {
								echo "Mailer Error: " . $mail->ErrorInfo;
							} else {
								echo "Message sent!";
							}