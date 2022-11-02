<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";

/* Manejar las peticiones  */
if (isset($_GET['editClient'])) :
    $clientInfo = Client::see_client_info($_GET['cid'])['data']->fetch();
elseif (isset($_GET['editCar'])) :
    $carInfo = Client::see_client_cars($_GET['cid'], $_GET['car_id'])['data']->fetch();
endif;

 
$fname = isset($clientInfo) ? $clientInfo['fname'] : "";
$lname = isset($clientInfo) ? $clientInfo['lname'] : "";
$cid = isset($clientInfo) ? $clientInfo['cid'] : "";
$address = isset($clientInfo) ? $clientInfo['address'] : "";
$tel = isset($clientInfo) ? $clientInfo['tel'] : "";
$email = isset($clientInfo) ? $clientInfo['email'] : "";


?>


<div class="modal">

    <form id="form" class="form form_new_register" onsubmit="return false">

        <?php if (!isset($_GET['newcar']) && !isset($_GET['editCar'])) : ?>
            <h3>Datos del conductor</h3>
            <div class="form__control form__control--newClient">
                <input type="text" class="form__input form__input--newClient" name="fname" value="<?php echo $fname ?>" placeholder="Nombre(s)">
                <input type="text" class="form__input form__input--newClient" name="lname" value="<?php echo $lname ?>" placeholder="Apellido(s)">
            </div>
            <div class="form__control form__control--newClient">
                <input type="hidden" class="form__input form__input--newClient" name="cid" value="<?php echo $cid ?>" placeholder="Cedula de identidad">
                <input type="text"  class="form__input form__input--newClient form__input--cid" name="newcid" value="<?php echo $cid ?>" placeholder="Cedula de identidad">
                <input type="text" class="form__input form__input--newClient" name="address" value="<?php echo $address ?>" placeholder="Dirección">
            </div>
            <div class="form__control form__control--newClient">
                <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form__input form__input--newClient form__input--tel" name="tel" value="<?php echo $tel ?>" placeholder="Telefono">
                <input type="email" class="form__input form__input--newClient" name="email" value="<?php echo $email ?>" placeholder="Correo electronico">
            </div>


        <?php endif; ?>

        <?php if (!isset($_GET['editClient'])) : ?>
            <?php include "newVehicle.modal.php" ?>
        <?php endif; ?>




        <?php if (!isset($_GET['newcar']) && !isset($_GET['editClient']) && !isset($_GET['editCar'])) : ?>
            <button id="registerNewClient" class="btn form__btn">Completar registro</button>
        <?php elseif (isset($_GET['editClient'])) : ?>
            <button id="saveClientInfo" class="btn form__btn">Guardar cambios</button>
        <?php elseif (isset($_GET['editCar'])) : ?>
            <button id="saveCarInfo" data-cid="<?php echo $_GET['cid'] ?>" class="btn form__btn">Guardar cambios del vehiculo</button>
        <?php else : ?>
            <button id="registerNewCar" class="btn form__btn">Agregar vehiculo</button>
        <?php endif; ?>
    </form>
</div>