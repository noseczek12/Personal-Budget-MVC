<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use \App\Flash;
use \App\Auth;

//mail

class Mail
{
	//funkcja wysyłająca maila
	public static function send($to, $subject, $text)
	{
			//Load Composer's autoloader
			require '../vendor/autoload.php';

			//Create an instance; passing `true` enables exceptions
			$mail = new PHPMailer(true);

			try {
				//Server settings
				$mail->SMTPDebug = 0;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = '';                     //SMTP username
				$mail->Password   = '';                               //SMTP password
				$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
				$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('tomasz.nosol.programista@gmail.com', 'Tomek');
				$mail->addReplyTo('reply@gmail.com', 'Tomek');
				$mail->addAddress($to);     //Add a recipient

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $text;

				$mail->send();
				Flash::addMessage('Wiadomość została wysłana.');
			} catch (Exception $e) {
				Flash::addMessage("Mailer Error: {$mail->ErrorInfo}" , Flash::WARNING);
			}
	}
}