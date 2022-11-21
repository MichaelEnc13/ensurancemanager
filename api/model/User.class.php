<?php

if (file_exists("autoload.php")) :
    include "autoload.php";
elseif (file_exists("../api/model/autoload.php")) :
    include "../api/model/autoload.php";
elseif (file_exists("api/model/autoload.php")) :
    include "api/model/autoload.php";
endif;

if (session_status() != 2) session_start();

class User extends Db{ 

    public static function editUser($fname, $lname, $representant, $adress, $email, $id)
    {
        $query = "UPDATE users  SET fname = ?, lname = ?, representant = ?, address = ?, email = ? WHERE id = ?";
        $values = array($fname, $lname, $representant, $adress, $email,$id);
        $execData = User::queries($query, $values);
        return $execData;
    }

    public static function change_pass($pass,$id){
        $query = "UPDATE users  SET password = ? WHERE id = ?";
        $values = array($pass,$id);
        $execData = User::queries($query, $values);
        return $execData;
    }
    public static function get_user_info($id){
        
        $query = "SELECT * FROM users WHERE id = ?";
        $values = array($id);
        $execData = User::queries($query, $values);
        return $execData;
    }
    
}
