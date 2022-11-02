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

class Client
{
 
    /* Datos del cliente */
    public static function add($fname, $lname, $cid, $address, $tel, $email)
    {
        $values = array($fname, $lname, $cid, $address, $tel, $email, date("d/m/y"),  $_SESSION['user']['id']);
        return Db::queries("INSERT INTO client (fname,lname,cid,address,tel,email,date,uid) VALUES(?,?,?,?,?,?,?,?)", $values);
    }
    public static function see_all_client()
    {

        $values = array($_SESSION['user']['id']);
        return Db::queries("SELECT * FROM client WHERE uid = ?", $values);
    }
    public static function see_client_info($cid)
    {

        $values = array($cid, $_SESSION['user']['id']);
        return Db::queries("SELECT * FROM client WHERE cid = ? and uid = ?", $values);
    }
    public static function remove()
    {
    }
    public static function edit($fname, $lname, $cid, $address, $tel, $email)
    {
        $values = array(
            $fname, $lname, $address, $tel, $email, $cid, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE client SET 
        fname = ? , lname = ?,address = ? ,tel = ? ,email = ? 
         WHERE cid = ? AND uid = ?", $values);
    }
    /* DATOS DEL VEHICULO */
    public static function add_car(
        $type,
        $service,
        $chassis,
        $brand,
        $model,
        $year,
        $ciliders,
        $passengers,
        $color,
        $plate,
        $cid
    ) {
        $values = array(
            $type, $service, $chassis, $brand, $model, $year, $ciliders, $passengers, $color, $plate,
            date("d/m/y"), $cid, $_SESSION['user']['id']
        );
        return Db::queries("INSERT INTO vehicles (type,service,chassis,brand,model,year,ciliders,passengers,color,plate,date,cid,uid	
        ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?  )", $values);
    }
    public static function see_client_cars($cid, $car_plate)
    {   //el parametro 2 es boleano y se usa para saber si se desea buscar el vehiculo tambien por su placa
        $values = $car_plate == false ?
            array($cid, $_SESSION['user']['id']) :
            array($car_plate, $cid, $_SESSION['user']['id']);
        $query =
            $car_plate == false ? "SELECT * FROM vehicles WHERE cid =? AND uid = ?"
            : "SELECT * FROM vehicles WHERE plate = ? AND cid =? AND uid = ?";
        return Db::queries($query, $values);
    }
    public static function remove_car()
    {
    }
    public static function edit_car(
        $type,
        $service,
        $chassis,
        $brand,
        $model,
        $year,
        $ciliders,
        $passengers,
        $color,
        $plate,
        $cid
    ) {
        $values = array(
            $type,
            $service,
            $chassis,
            $brand,
            $model,
            $year,
            $ciliders,
            $passengers,
            $color,
            $cid,
            $_SESSION['user']['id']
        );
        return Db::queries("UPDATE vehicles SET 
        type = ? , service = ?,chassis = ? ,brand = ? ,
        model = ? , year = ?, ciliders = ? ,
        passengers = ? ,color = ? 
        WHERE cid = ? AND uid = ?", $values);
    }
    /* Datos del seguro */
    public static function new_policy($policynumber, $type, $value,$totalAdditional, $payMethod, $time, $aditionalService, $car_plate, $date_from, $date_until, $cid)
    {
        $values = array(
            $policynumber, $type, $value,$totalAdditional, $payMethod, $time, $aditionalService, $car_plate, $date_from, $date_until, $cid, $_SESSION['user']['id']
        );
        return Db::queries("INSERT INTO policy (policynumber,type,value,totalAdditional,payMethod,time,aditionalService,car_plate,date_from,date_until,cid,uid	
        ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)", $values);
    }
    public static function edit_policy($policynumber, $type, $value,$totalAdditional, $payMethod, $time, $aditionalService,$date_from,$date_until, $car_plate, $cid)
    {
        $values = array(
            $policynumber, $type, $value,$totalAdditional, $payMethod, $time, $aditionalService,$date_from,$date_until, $car_plate, $cid, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE policy SET policynumber = ?,type = ?,value = ?, totalAdditional = ?, payMethod = ?, time = ?,aditionalService = ?,

         date_from = ?, date_until = ? WHERE car_plate = ? AND cid = ? AND uid = ?", $values);
    }

    public static function deletePolicy($policynumber,$cid){//elimina los datos del seguro
        $values = array(
            $policynumber,$cid,$_SESSION['user']['id']
        );
        return Db::queries("DELETE FROM policy WHERE policynumber = ? AND cid = ? AND uid = ?",$values);
    }
    public static function deletePolicyDue($policynumber,$cid){//elimina las cuotas creadas para esa poliza
        $values = array(
            $policynumber,$cid,$_SESSION['user']['id']
        );
        return Db::queries("DELETE FROM policy_due   WHERE policynumber = ? AND cid = ? AND uid = ?",$values);
    }
    public static function update_car_policy_status($car_plate,$cid){//actualiza el estado del vehiculo asegurado
        $values = array(
            $car_plate,$cid,$_SESSION['user']['id']
        );
        return Db::queries("UPDATE vehicles SET ensured =  0 WHERE plate = ? AND cid = ? AND uid = ?",$values);
    }
    public static function add_policy_due($policynumber, $cid, $due, $validity, $amount)
    {
        $values = array(
            $policynumber, $cid, $due, 0, $validity, $amount, $_SESSION['user']['id']
        );
        return Db::queries("INSERT INTO policy_dues (policynumber,cid,due,paid,validity,amount,uid	
        ) VALUES(?,?,?,?,?,?,? )", $values);
    }
    public static function dueInfo($policynumber, $cid)
    {
        $values = array(
            $policynumber,
            $cid,
            $_SESSION['user']['id']

        );
        $query =  "SELECT * FROM policy_dues WHERE  policynumber = ? AND cid = ? AND uid = ? AND paid = 0 ORDER BY id DESC";
        return Db::queries($query, $values);
    }
    public static function payDue($policynumber, $id, $cid)
    { //pagar una cuota
        $values = array($policynumber, $id, $cid, $_SESSION['user']['id']);
        //el ID usado es el ID de la cuota.
        $query =  "UPDATE policy_dues SET paid = 1 WHERE policynumber = ? AND id = ? AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }
    public static function payOff($policynumber, $cid)
    { //saldar deuda
        $values = array($policynumber, $cid, $_SESSION['user']['id']);
        $query =  "UPDATE policy_dues SET paid = 1 WHERE paid = 0 AND policynumber = ?  AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }
    public static function renew($type, $value, $payMethod, $time, $date_from, $date_until, $policynumber, $cid)
    { //saldar deuda
        $values = array($type, $value, $payMethod, $time, $date_from, $date_until, $policynumber, $cid, $_SESSION['user']['id']);


        $query =  "UPDATE policy SET 
        type = ?, value = ?, payMethod = ?, time = ?,date_from = ?, date_until = ?
        WHERE  policynumber = ?  AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }
    public static function updatePolicyDate($policynumber, $cid, $time)
    { //se actuliza la fecha de la poliza a futuro
        $now = date("d-m-Y");
        $values = array($now, $time, $policynumber, $cid, $_SESSION['user']['id']);
        $query =  "UPDATE policy SET date_from = ?, date_until = ? WHERE  policynumber = ? AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }
    public static function change_policy_status($car_plate, $cid)
    {
        $values = array(
            true, $cid, $car_plate, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE vehicles SET ensured = ? WHERE cid = ? AND plate = ? AND uid = ?", $values);
    }
    public static function see_car_policy($car_plate, $cid)
    {
        $values = array(
            $cid, $car_plate, $_SESSION['user']['id']
        );
        return Db::queries("SELECT * FROM policy WHERE cid = ? AND car_plate = ? AND uid = ?", $values);
    }
}
