<style>
    .nav__control span {
        display: none;
    }
</style>

<?php
$clients = Dashboard::get_clients()['data']->rowCount();
$vehicles = Dashboard::get_vehicles()['data']->rowCount();
$policies = Dashboard::get_policies()['data']->rowCount();
$mantenaince = Dashboard::get_mantenaince_soon();
$status = Dashboard::get_policies_status();
$expireSoon = Dashboard::get_policies_expireSoon();


?>


<div class="widgets">

    <div class="widgets__item darked widgets__item--actions widgets__item--actived" id="getClients">
        <div class="widget__icon"><i class="fa-solid fa-user-check"></i></div>
        <div class="widget__info">
            <span class="widgets__item__title">Clientes</span>
            <span class="widgets__item__body"><?php echo $clients ?></span>
        </div>
    </div>
    <div class="widgets__item darked">
        <div class="widget__icon"><i class="fa-solid fa-car"></i></div>
        <div class="widget__info">
            <span class="widgets__item__title">Vehiculos</span>
            <span class="widgets__item__body"><?php echo $vehicles ?></span>
        </div>
    </div>
    <div class="widgets__item darked widgets__item--actions widgets__item--actived" id="getActive">
        <div class="widget__icon">
            <i class="fa-regular fa-circle-check"></i>
        </div>
        <div class="widget__info">
            <span class="widgets__item__title">Vigentes</span>
            <span class="widgets__item__body widgets__item__body--active"><?php echo $status['active'] ?></span>
        </div>

    </div>
    <div class="widgets__item darked widgets__item--actions widgets__item--actived" id="getExpireSoon">
        <div class="widget__icon">
            <i class="fa-regular fa-clock"></i>
        </div>
        <div class="widget__info">
            <span class="widgets__item__title">Vence pronto</span>
            <span class="widgets__item__body widgets__item__body--soon"><?php echo $expireSoon ?></span>
        </div>

    </div>
    <div class="widgets__item darked widgets__item--actions widgets__item--actived" id="getExpired">
        <div class="widget__icon">
            <i class="fa-regular fa-calendar-xmark"></i>
        </div>
        <div class="widget__info">
            <span class="widgets__item__title">Vencidos</span>
            <span class="widgets__item__body widgets__item__body--expired"><?php echo $status['inactive'] ?></span>
        </div>

    </div>

    <div class="widgets__item darked">
        <div class="widget__icon">
            <i class="fa-regular fa-address-card"></i>
        </div>
        <div class="widget__info">
            <span class="widgets__item__title ">Seguros</span>
            <span class="widgets__item__body"><?php echo $policies ?></span>
        </div>

    </div>
    <div class="widgets__item darked widgets__item--actions widgets__item--actived" id="getMantenaince">
        <div class="widget__icon">
            <i class="fa-solid fa-screwdriver-wrench"></i>
        </div>

        <div class="widget__info">
            <span class="widgets__item__title ">Mantenimiento</span>
            <span class="widgets__item__body"><?php echo $mantenaince ?></span>
        </div>

    </div>
    <div class="widgets__item darked widgets__item--actions ">
        <div class="widget__icon">
            <i class="fa-solid fa-user-plus"></i>
        </div>
        <div class="widget__info">
            <button id="newClient" class="btn widgets__item__btn">Nuevo registro</button>
            <span></span>
            <!--  <button id="sendAlert" class="btn widgets__item__btn">Enviar alerta</button> -->
        </div>

    </div>

</div>