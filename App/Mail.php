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
			$mail->setLanguage('pl');

			try {
				//Server settings
				$mail->SMTPDebug = 0;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'mail.tomasznosol.pl';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = "budget@tomasznosol.pl";                     //SMTP username
				$mail->Password   = "gbdK?-lck_DM";                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('budget@tomasznosol.pl', 'Tomek');
				$mail->addReplyTo('budget@tomasznosol.pl', 'Tomek');
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