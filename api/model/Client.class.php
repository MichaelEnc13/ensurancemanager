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
    public static function edit($fname, $lname, $cid, $newCid, $address, $tel, $email)
    {
        $values = array(
            $fname, $lname, $address, $tel, $email, $newCid, $cid, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE client SET 
        fname = ? , lname = ?,address = ? ,tel = ? ,email = ?, cid = ?
         WHERE cid = ? AND uid = ?", $values);
    }

    public static function editGlobalInfo($cid, $newCid)
    {
        $values = array($newCid, $cid, $_SESSION['user']['id']);


        Db::queries("UPDATE policy SET cid = ? WHERE cid = ? AND uid = ?", $values);
        Db::queries("UPDATE vehicles SET cid = ? WHERE cid = ? AND uid = ?", $values);
        Db::queries("UPDATE policy_dues SET cid = ? WHERE cid = ? AND uid = ?", $values);
        Db::queries("UPDATE mantenaince SET cid = ? WHERE cid = ? AND uid = ?", $values);
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
    public static function see_client_cars($cid, $car_id)
    {   //el parametro 2 es boleano y se usa para saber si se desea buscar el vehiculo tambien por su placa
        $values = array();
        if ($car_id == false) :
            $values = array($cid, $_SESSION['user']['id']);
        else :
            $values =  array($car_id, $cid, $_SESSION['user']['id']);
        endif;

        $query =
            $car_id == false ? "SELECT * FROM vehicles WHERE cid = ? AND uid = ?" : "SELECT * FROM vehicles WHERE id = ? AND cid =? AND uid = ?";

        return Db::queries($query, $values);
    }
    public static function remove_car($car_id, $cid)
    {
        $values = array($car_id, $cid, $_SESSION['user']['id']);
        //el ID usado es el ID de la cuota.
        $query =  "DELETE FROM vehicles WHERE id = ?  AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }
    public static function edit_car(
        $id,
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
        $newplate,
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
            $newplate,
            $plate,
            $cid,
            $id,
            $_SESSION['user']['id']
        );
        return Db::queries("UPDATE vehicles SET 
        type = ? , service = ?,chassis = ? ,brand = ? ,
        model = ? , year = ?, ciliders = ? ,
        passengers = ? ,color = ? , plate = ?
        WHERE plate  = ? AND cid = ? AND id = ? AND uid = ?", $values);
    }
    /* Datos del seguro */
    public static function new_policy($policynumber, $type, $value, $totalAdditional, $initial, $payMethod, $time, $aditionalService, $car_plate, $date_from, $date_until, $cid)
    {
        $values = array(
            $policynumber, $type, $value, $totalAdditional, $initial, $payMethod, $time, $aditionalService, $car_plate, $date_from, $date_until, $cid, $_SESSION['user']['id']
        );
        return Db::queries("INSERT INTO policy (policynumber,type,value,totalAdditional,initial,payMethod,time,aditionalService,car_plate,date_from,date_until,cid,uid	
        ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", $values);
    }

    public static function add_services($service_id, $policynumber)
    {
        $values = array(
            $service_id, $policynumber, $_SESSION['user']['id']
        );
        return Db::queries("INSERT INTO aditionalservice (service_id,policynumber,uid	
        ) VALUES(?,?,?  )", $values);
    }
    public static function delete_all_services_draft($policynumber_draft)
    {
        $values = array(
            $policynumber_draft, $_SESSION['user']['id']
        );
        return Db::queries("DELETE FROM aditionalservice WHERE policynumber = ?   AND uid = ?", $values);
    }
    public static function delete_services_draft($policynumber_draft, $service_id)
    {
        $values = array(
            $policynumber_draft, $service_id, $_SESSION['user']['id']
        );
        return Db::queries("DELETE FROM aditionalservice WHERE policynumber = ? AND service_id=? AND uid = ?", $values);
    }

    public static function update_services_draft($policynumber, $policynumber_draft)
    {
        $values = array(
            $policynumber, $policynumber_draft, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE aditionalservice SET policynumber =  ? WHERE policynumber = ?  AND uid = ?", $values);
    }

    public static function get_all_services($policynumber)
    {
        $values = array($policynumber, $_SESSION['user']['id']);
        $query = "SELECT * FROM aditionalservice WHERE policynumber = ? AND uid = ?";


        return Db::queries($query, $values);
    }

    public static function get_client_services($policynumber,$service_id)
    {
        $values = array($policynumber,$service_id, $_SESSION['user']['id']);
        $query = "SELECT * FROM aditionalservice WHERE policynumber = ? AND service_id = ? AND uid = ?";


        return Db::queries($query, $values);
    }

    public static function get_services_info($service_id)
    {
        $values = array($service_id, $_SESSION['user']['id']);
        $query = "SELECT * FROM policy_additional_services WHERE id = ? AND uid = ?";


        return Db::queries($query, $values);
    }
    public static function edit_policy($policynumber, $type, $value, $totalAdditional, $initial, $payMethod, $time, $aditionalService, $date_from, $date_until, $car_plate, $cid)
    {
        $values = array(
            $policynumber, $type, $value, $totalAdditional, $initial, $payMethod, $time, $aditionalService, $date_from, $date_until, $car_plate, $cid, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE policy SET policynumber = ?,type = ?,value = ?, totalAdditional = ?, initial = ?, payMethod = ?, time = ?,aditionalService = ?,

         date_from = ?, date_until = ? WHERE car_plate = ? AND cid = ? AND uid = ?", $values);
    }

    public static function deletePolicy($policynumber, $cid)
    { //elimina los datos del seguro
        $values = array(
            $policynumber, $cid, $_SESSION['user']['id']
        );
        return Db::queries("DELETE FROM policy WHERE policynumber = ? AND cid = ? AND uid = ?", $values);
    }
    public static function deletePolicyDue($policynumber, $cid)
    { //elimina las cuotas creadas para esa poliza
        $values = array(
            $policynumber, $cid, $_SESSION['user']['id']
        );
        return Db::queries("DELETE FROM policy_dues  WHERE policynumber = ? AND cid = ? AND uid = ?", $values);
    }
    public static function update_car_policy_status($car_id, $cid)
    { //actualiza el estado del vehiculo asegurado
        $values = array(
            $car_id, $cid, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE vehicles SET ensured =  0 WHERE id = ? AND cid = ? AND uid = ?", $values);
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

    public static function edit_policy_due($policynumber, $cid, $due, $validity, $amount)
    {
        $values = array(
            $due, $validity, $amount, $cid, $policynumber, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE policy_dues SET due = ?, validity = ? , amount = ? WHERE cid = ? AND  policynumber = ? AND uid = ?", $values);
    }
    public static function deleteDue($policynumber, $cid)
    { //pagar una cuota
        $values = array($policynumber, $cid, $_SESSION['user']['id']);
        //el ID usado es el ID de la cuota.
        $query =  "DELETE FROM policy_dues WHERE policynumber = ?  AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }
    //se usa para eliminar las cuotas con un valor diferente al momento de editarlas
    public static function deleteDue_diff_value($policynumber, $amount, $cid)
    { //pagar una cuota
        $values = array($policynumber, $amount, $cid, $_SESSION['user']['id']);
        //el ID usado es el ID de la cuota.
        $query =  "DELETE FROM policy_dues WHERE policynumber = ? AND amount != ?   AND cid = ? AND uid = ?";
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
        //$now = date("d-m-Y");
        $values = array($time, $policynumber, $cid, $_SESSION['user']['id']);
        $query =  "UPDATE policy SET date_until = ? WHERE  policynumber = ? AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }
    public static function change_policy_status($car_id, $cid)
    {
        $values = array(
            true, $cid, $car_id, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE vehicles SET ensured = ? WHERE cid = ? AND id = ? AND uid = ?", $values);
    }
    public static function see_car_policy($car_id, $cid)
    {
        $values = array(
            $cid, $car_id, $_SESSION['user']['id']
        );
        return Db::queries("SELECT * FROM policy WHERE cid = ? AND car_plate = ? AND uid = ?", $values);
    }

    public static function add_mantenaince_date($car_id, $cid, $date_from, $date_until, $oil_type, $oil_grade)
    {
        $values = array(
            $date_from, $date_until, $oil_type, $oil_grade, $car_id, $cid, $_SESSION['user']['id']
        );
        return Db::queries("INSERT INTO mantenaince (date_from,date_until,oil_type,oil_grade,car_id,cid,uid	
        ) VALUES(?,?,?,?,?,?,?)", $values);
    }

    public static function see_car_mantenaince($car_id, $cid)
    {
        $values = array(
            $cid, $car_id, $_SESSION['user']['id']
        );
        return Db::queries("SELECT * FROM mantenaince WHERE cid = ? AND car_id = ? AND uid = ?", $values);
    }

    public static function edit_mantenaince_date($car_id, $cid, $date_from, $date_until, $oil_type, $oil_grade)
    {
        $values = array(
            $date_from, $date_until, $oil_type, $oil_grade, $cid, $car_id, $_SESSION['user']['id']
        );
        return Db::queries("UPDATE mantenaince SET date_from = ?, date_until = ? ,oil_type = ?,oil_grade=? WHERE cid = ? AND car_id = ? AND uid = ?", $values);
    }

    public static function remove_mantenaince($car_id, $cid)
    { //pagar una cuota
        $values = array($car_id, $cid, $_SESSION['user']['id']);
        //el ID usado es el ID de la cuota.
        $query =  "DELETE FROM mantenaince WHERE car_id = ?  AND cid = ? AND uid = ?";
        return Db::queries($query, $values);
    }

    public static function settings($template_pos)
    {
        $values = array($template_pos, $_SESSION['user']['id']);
        /* Elegir el tipo de consulta que se va a ultilizar para la configuración */
        $addConfig = "INSERT INTO settings (template_pos,uid	
        ) VALUES(?,?)";
        $updateConfig = "UPDATE settings SET template_pos = ? WHERE uid = ?";
        $query = Client::see_settings("template_pos")['data']->fetch() ? $updateConfig : $addConfig;
        return Db::queries($query, $values);
    }

    public static function see_settings($config)
    {
        $values = array(
            $_SESSION['user']['id']
        );
        return Db::queries("SELECT $config FROM settings WHERE uid = ?", $values);
    }
}
