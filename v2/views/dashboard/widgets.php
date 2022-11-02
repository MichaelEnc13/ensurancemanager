<style>
    .nav__control span {
        display: none;
    }
</style>

<?php
$clients = Dashboard::get_clients()['data']->rowCount();
$vehicles = Dashboard::get_vehicles()['data']->rowCount();
$policies = Dashboard::get_policies()['data']->rowCount();
$status = Dashboard::get_policies_status();
$expireSoon = Dashboard::get_policies_expireSoon();


?>


<div class="widgets">

    <div class="widgets__item widgets__item--actions widgets__item--actived" id="getClients">
        <span class="widgets__item__title">Clientes</span>
        <span class="widgets__item__body"><?php echo $clients ?></span>
    </div>
    <div class="widgets__item">
        <span class="widgets__item__title">Vehiculos</span>
        <span class="widgets__item__body"><?php echo $vehicles ?></span>
    </div>
    <div class="widgets__item widgets__item--actions widgets__item--actived" id="getActive">
        <span class="widgets__item__title">Vigentes</span>
        <span class="widgets__item__body widgets__item__body--active"><?php echo $status['active'] ?></span>
    </div>
    <div class="widgets__item widgets__item--actions widgets__item--actived" id="getExpireSoon">
        <span class="widgets__item__title">Vence pronto</span>
        <span class="widgets__item__body widgets__item__body--soon"><?php echo $expireSoon ?></span>
    </div>
    <div class="widgets__item widgets__item--actions widgets__item--actived" id="getExpired">
        <span class="widgets__item__title">Vencidos</span>
        <span class="widgets__item__body widgets__item__body--expired"><?php echo $status['inactive'] ?></span>
    </div>

    <div class="widgets__item">
        <span class="widgets__item__title">Seguros</span>
        <span class="widgets__item__body"><?php echo $policies ?></span>
    </div>
    <div class="widgets__item widgets__item--actions">
        <button id="newClient" class="btn widgets__item__btn">Nuevo registro</button>
       <!--  <button id="sendAlert" class="btn widgets__item__btn">Enviar alerta</button> -->
    </div>

</div>