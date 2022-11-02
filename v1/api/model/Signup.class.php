<?php

//include file_exists("autoload.php") ? "autoload.php" : "api/model/autoload.php";
if (file_exists("autoload.php")) :
    include "autoload.php";
elseif (file_exists("../model/autoload.php")) :
    include "../model/autoload.php";
else :
    include "api/model/autoload.php";
endif; 


class Signup extends Db
{
    //verifica la existencia de un usuario
    public static function checkIfExist($representant, $email)
    {
        $query = "SELECT * FROM users WHERE representant = ? || email = ?";
        $values = array($representant, $email);
        $execData = Signup::queries($query, $values);
        return $execData['data']->fetch();
    }
    public static function checkPass($pass, $cPass)
    {
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        return  password_verify($cPass, $hash);
    }
    public static function encode64($info)
    {
        return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($info)))));
    }
    public static function decode64($info)
    {
        return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($info)))));
    }
    //se crea un nuevo perfil de usuario
    public static function newProfile($fname, $lname, $company,$company_logo, $representant, $adress, $email, $password)
    {
        $query = "INSERT INTO users (fname,lname,company,company_logo,representant,address,email,password)VALUES(?,?,?,?,?,?,?,?)";
        $values = array($fname, $lname, $company,$company_logo, $representant, $adress, $email, password_hash($password, PASSWORD_BCRYPT));
        $execData = Signup::queries($query, $values);
        return $execData['status'];
    }
    public static function confirm_email($email)
    {
        return Signup::queries("UPDATE users SET status = ? WHERE email = ?", array(1, $email))['status'];
    }
    public static function error_email($email)
    {
        Signup::queries("DELETE FROM users WHERE email = ?", array($email));
    }
}
