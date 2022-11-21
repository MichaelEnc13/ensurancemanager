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
