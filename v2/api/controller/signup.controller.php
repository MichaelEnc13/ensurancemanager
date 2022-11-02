<?php
include "../model/autoload.php";

if (isset($_POST['register'])) :
    $exist = Signup::checkIfExist($_POST['representant'], $_POST['email']);
    switch ($exist):
        case false:

            if (Signup::checkPass($_POST['password'], $_POST['rPassword'])) :
                echo Signup::newProfile(
                    $_POST['fname'],
                    $_POST['lname'],
                    $_POST['company'],
                    $_POST['company_logo'],
                    $_POST['representant'],
                    $_POST['address'],
                    $_POST['email'],
                    $_POST['password']
                );

                $mailTitle = "Tu cuenta ha sido registrada";
                $mailMessage = "Para activar tu cuenta, debes acceder al enlace debajo.";
                include "../../views/mail_templates/register.php";
                $message = ob_get_contents();
                Mail::sendMail($_POST['email'], "Confirmación de correo", $message);
                ob_clean();
            else :
                echo "A201";

            endif;


            break;
        case true:
            echo "A200";
            break;
    endswitch;

endif;
