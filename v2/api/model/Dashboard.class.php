<?php
 
//include file_exists("autoload.php") ? "autoload.php" : "api/model/autoload.php";
if (file_exists("autoload.php")) :
    include "autoload.php";
elseif (file_exists("../api/model/autoload.php")) :
    include "../api/model/autoload.php";
elseif (file_exists("api/model/autoload.php")) :
    include "api/model/autoload.php";
endif;

if (session_status() != 2) session_start();
class Dashboard
{

    public static function get_clients()
    {

        $values = array($_SESSION['user']['id']);
        return Db::queries("SELECT * FROM client WHERE uid = ?", $values);
    }
    public static function get_vehicles()
    {

        $values = array($_SESSION['user']['id']);
        return Db::queries("SELECT * FROM vehicles WHERE uid = ?", $values);
    }


    public static function get_policies()
    {

        $values = array($_SESSION['user']['id']);
        return Db::queries("SELECT * FROM policy WHERE uid = ?", $values);
    }

    public static function get_policies_status()
    {
        $active = 0;
        $inactive = 0;
        $date1 = "";
        $date2 = "";
        $values = array($_SESSION['user']['id']);
        $status = Db::queries("SELECT * FROM policy WHERE uid = ?", $values)['data']->fetchAll();

        foreach ($status as $st) :
            $date1 = date_create(date("d-m-Y"));
            $date2 = date_create($st['date_until']);
            $diff = date_diff($date1, $date2);
            $diff = intval($diff->format("%R%a"));
            
            if ($diff >= 0) :
                $active++;
            else :
                $inactive++;
            endif;
        endforeach;
  
         return array(
            "active" => $active,
            "inactive" => $inactive
        );   

        /* return $diff; */
    }
    public static function get_policies_expireSoon()
    {
        $expireSoon = 0;
        $date1 = "";
        $date2 = "";
        $values = array($_SESSION['user']['id']);
        $status = Db::queries("SELECT * FROM policy WHERE uid = ?", $values)['data']->fetchAll();

        foreach ($status as $st) :
            $date1 = date_create(date("d-m-Y"));
            $date2 = date_create($st['date_until']);
            $diff = date_diff($date1, $date2);
            $diff = intval($diff->format("%R%a"));
            if ($diff <= 7 && $diff >= 0) :
                $expireSoon++;

            endif;
        endforeach;

        return  $expireSoon;
    }
}
