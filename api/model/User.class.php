<?php

if (file_exists("autoload.php")) :
    include "autoload.php";
elseif (file_exists("../api/model/autoload.php")) :
    include "../api/model/autoload.php";
elseif (file_exists("api/model/autoload.php")) :
    include "api/model/autoload.php";
endif;

if (session_status() != 2) session_start();

class User extends Db
{

    public static function editUser($fname, $lname, $representant, $adress, $email, $id)
    {
        $query = "UPDATE users  SET fname = ?, lname = ?, representant = ?, address = ?, email = ? WHERE id = ?";
        $values = array($fname, $lname, $representant, $adress, $email, $id);
        $execData = User::queries($query, $values);
        return $execData;
    }

    public static function change_pass($pass, $id)
    {
        $query = "UPDATE users  SET password = ? WHERE id = ?";
        $values = array($pass, $id);
        $execData = User::queries($query, $values);
        return $execData;
    }
    public static function get_user_info($id)
    {

        $query = "SELECT * FROM users WHERE id = ?";
        $values = array($id);
        $execData = User::queries($query, $values);
        return $execData;
    }

    public static function add_addtional_services($service_name, $service_price)
    {
        $query = "INSERT INTO policy_additional_services (name, price,uid) VALUES(?,?,?)";
        $values = array($service_name, $service_price, $_SESSION['user']['id']);
        $execData = User::queries($query, $values);
        return $execData;
    }
    public static function get_addtional_services()
    {
        $query = "SELECT * FROM policy_additional_services WHERE uid = ?";
        $values = array($_SESSION['user']['id']);
        $execData = User::queries($query, $values);
        return $execData;
    }
    public static function update_addtional_services($service_name, $service_price, $service_id)
    {
        $query = "UPDATE policy_additional_services  SET name = ?, price=? WHERE id = ? AND uid = ?";
        $values = array($service_name, $service_price, $service_id, $_SESSION['user']['id']);
        $execData = User::queries($query, $values);
        return $execData;
    }
    public static function delete_addtional_services($service_id)
    {
        $query = "DELETE FROM policy_additional_services WHERE id = ? AND uid = ?";
        $values = array($service_id, $_SESSION['user']['id']);
        $execData = User::queries($query, $values);
        return $execData;
    }
}
