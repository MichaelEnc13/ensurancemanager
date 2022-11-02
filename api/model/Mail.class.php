<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//include  file_exists("autoload.php") ? "autoload.php" : "../model/autoload.php"; //incluir clases
include  file_exists("../../vendor/autoload.php") ? "../../vendor/autoload.php" : "vendor/autoload.php"; //incluir librerias


class Mail
{


    public static function sendMail($email, $subject, $message)
    {

        try {

            //configuraciones del servidor de correo   
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "smtp.hostinger.com";
            $mail->SMTPAuth = true;
            $mail->Username = "notification@dotsellsolutions.com";
            $mail->Password = "DotsellSolPass2022@";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465; ///pierto de envios
            //receptores 
            $mail->setFrom("notification@dotsellsolutions.com", "Dotsell notification"); //definir quien es el que envia el mensaje
            $mail->addAddress($email, ""); //definir quien va a recibir el mensaje

            //contenido
            $mail->isHTML(true);
            $mail->Subject = $subject; //tema o asunto
            $mail->Body = $message; //Mensaje
            return $mail->send();
            echo true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
