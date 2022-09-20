<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Flash;
use App\Auth;

/**
 * * Logout function.
 */
class Mail
{
    /**
     * *Sending mail function.
     */
    public static function send($to, $subject, $text)
    {
        //Load Composer's autoloader
        include '../vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->setLanguage('pl');

        try {
            //SERVER SETTINGS
            //Enable verbose debug output
            $mail->SMTPDebug = 0;
            //Send using SMTP
            $mail->isSMTP();
            //Set the SMTP server to send through
            $mail->Host = 'mail.tomasznosol.pl';
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
            //SMTP username
            $mail->Username = "budget@tomasznosol.pl";
            //SMTP password
            $mail->Password = "gbdK?-lck_DM";
            //Enable implicit TLS encryption
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            //TCP port to connect to;
            // use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->Port = 465;

            //RECIPIENTS
            $mail->setFrom('budget@tomasznosol.pl', 'Tomek');
            $mail->addReplyTo('budget@tomasznosol.pl', 'Tomek');
            //Add a recipient
            $mail->addAddress($to);

            //CONTENT
            //Set email format to HTML
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $text;

            $mail->send();
            Flash::addMessage('Wiadomość została wysłana.');
        } catch (Exception $e) {
            Flash::addMessage("Mailer Error: {$mail->ErrorInfo}", Flash::WARNING);
        }
    }
}