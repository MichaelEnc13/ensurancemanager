<?php
if (file_exists("autoload.php")) :
    include "autoload.php";
elseif (file_exists("../model/autoload.php")) :
    include "../model/autoload.php";
else :
    include "api/model/autoload.php";
endif;

if (session_status() != 2): session_start(); endif;

class Signin
{

    public static function login($user, $pass)
    {

        $uInfo =  Signup::checkIfExist("", $user);
        if ($uInfo) :

            if (password_verify($pass, $uInfo['password'])) :
                
                $_SESSION['user'] =  $uInfo;
                echo true;
            else :
                echo "A201";
            endif;
        else :
            echo "A200";
        endif;
    }
}
