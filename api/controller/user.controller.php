<?php
include "../model/autoload.php";

if (isset($_POST['save_config'])) :
    $id =  base64_decode($_POST['id']);
    $done = User::editUser(
        $_POST['fname'],
        $_POST['lname'],
        $_POST['representant'],
        $_POST['address'],
        $_POST['email'],
        $id
    );

    $posX = $_POST['pos_x'];
    $posY = $_POST['pos_y'];
    $pos = array(
        "posX" => $posX,
        "posY" => $posY
    );
    $json_pos = json_encode($pos);
     Client::settings($json_pos )['status'];
    //Modificar contraseña si existe la petición
    if ($_POST['change_pass'] != "") :
        $newPass = password_hash($_POST['change_pass'],PASSWORD_BCRYPT);
        User::change_pass($newPass, $id);
    endif;

    if ($done['status']) : //modificar el estado de la sessión
        $user = User::get_user_info($id)['data']->fetch();
        $_SESSION['user'] = $user;
        $res = array(
            "status"=>$done['status'],
            "fname" =>  $_SESSION['user']['fname']
        );
        echo json_encode($res);
    else :
        echo $done['error'][1];
    endif;
endif;


if (isset($_POST['addNewService'])) :
    $done = User::add_addtional_services($_POST['service_name'], $_POST['service_price']);
    if($done['status']) echo $done['status'];
    if(!$done['status']) echo $done['error'][2];
 
endif;
if (isset($_POST['saveUpdateService'])) :
    $done = User::update_addtional_services($_POST['service_name'], $_POST['service_price'],$_POST['sid']);
    if($done['status']) echo $done['status'];
 
endif;
if (isset($_POST['deleteService'])) :
    $done = User::delete_addtional_services($_POST['sid']);
    if($done['status']) echo $done['status'];
 
endif;