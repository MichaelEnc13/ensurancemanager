<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";
if (session_status() != 2) session_start();
$template_pos = Client::see_settings("template_pos")['data']->fetch();
$positions = json_decode($template_pos['template_pos'], true);
$posX = $positions['posX'];
$posY = $positions['posY'];

?>
<style>
    .toggle {
        display: none;
    }

    .refill {
        display: block;
    }
</style>
<div class="config_container">
    <div class="config_header">
        <h2>Configuración </h2>

        <button id="save_config" class="btn btn--blue" data-id="<?php echo base64_encode($_SESSION['user']['id']) ?>">Guardar cambio </button>
        <span class="dot-spin saving"></span>
    </div>


    <form class="form save_config" onsubmit="return false">
        <div class="configs">
            <div class="main_config ">
                <div class="user_config widget darked">
                    <div class="user_config_personal">
                        <h3><i class="fa-regular fa-user"></i> Configuración de la cuenta</h3>
                        <label>Nombre</label>
                        <input autocomplete="off" type="text" value="<?php echo $_SESSION['user']['fname'] ?>" name="fname" class="input">
                        <label>Apellido</label>
                        <input autocomplete="off" type="text" value="<?php echo $_SESSION['user']['lname'] ?>" name="lname" class="input">
                        <label>Correo eléctronico</label>
                        <input autocomplete="off" type="text" value="<?php echo $_SESSION['user']['email'] ?>" name="email" class="input">
                        <label>ID de representante</label>
                        <input autocomplete="off" type="text" value="<?php echo $_SESSION['user']['representant'] ?>" name="representant" class="input">
                        <label>Dirección</label>
                        <input autocomplete="off" type="text" value="<?php echo $_SESSION['user']['address'] ?>" name="address" class="input">

                    </div><!-- user_config_personal -->
                    <div class="user_config_pass">
                        <h3><i class="fa-solid fa-key"></i> Cambiar contraseña</h3>
                        <label for="">Nueva contraseña</label>
                        <input type="password" name="change_pass" class="input" placeholder="********">
                        <label for="">Repetir contraseña</label>
                        <input type="password" name="change_pass_r" class="input" placeholder="********">


                    </div><!-- user_config_pass -->
                </div>
                <div class="system_config widget darked">
                    <h3><i class="fa-solid fa-sitemap"></i> Configuración del sistema</h3>
                    <p>Modo oscuro</p>
                    <div class="system_config_darkmode">
                        <i class="fa-regular fa-sun"></i>
                        <div class="dark_toggle darked">
                            <div class="dark_toggle_switch"></div>
                        </div>
                        <i class="fa-regular fa-moon"></i>
                    </div>
                    <h4>Ajustar plantilla de poliza en la hoja <i><i class="fa-solid fa-circle-question"></i></i></h4>
                    <div class="group_temple_pos">
                        <div class="form_control">
                            <label for="">Arriba hacia abajo <i class="fa-solid fa-up-down"></i></label>
                            <input type="text" name="pos_y" value="<?php echo $posY ?>" class="input" placeholder="Por defecto: 3.3cm">

                        </div>
                        <div class="form_control">
                            <label for="">Izquierda a derecha <i class="fa-solid fa-left-right"></i></label>
                            <input type="text" name="pos_x" value="<?php echo $posX ?>" class="input" placeholder="Por defecto: 2.3cm">
                        </div>
                    </div>

                    <p>Version</p>
                    <span><?php echo $_SESSION['version'] ?></span>

                </div>
            </div><!-- Configuración del usuario -->

            <div class="second_config widget darked">
                <h3>Facturación</h3>
                <div class="billing_info">
                    <p>Monto total</p>
                    <span>USD $25.00</span>
                </div>
                <div class="billing_info">
                    <p>Proxima fecha de pago</p>
                    <span>15/12/2022</span>
                </div>
                <div class="billing_info">
                    <p>Plan</p>
                    <span>Active</span>
                </div>
                <h3>Método de pago</h3>

                <button class="btn btn--blue" id="payPal"><i class="fa-brands fa-paypal"></i> PayPal</button>
                <?php include 'paypal.php'?>

            </div><!-- Opciones de pago -->

    </form>
    <div class="second_config additional_service widget darked">
        <h3>Servicios adicionales</h3>


        <form onsubmit='return false' class='form addtionalServices'>
            <div class="addNewService">
                <div class="form_control">
                    <label for="">Nombre del servicio</label>
                    <input type="text" name="service_name" placeholder="....."  >
                </div>

                <div class="form_control">
                    <label for="">Costo del servicio</label>
                    <input type="text" name="service_price" placeholder="....."  >
                </div>
                <button class="btn btn--blue" id="addNewService">Agregar servicio</button>
                <button class="btn btn--green" id="saveUpdateService">Guardar</button>
            </div><!-- addNewService -->
        </form>


        <h4>Servicios agregados</h4>
        <div class="serviceAdded">
            <?php include "additional_services.php" ?>   
        </div>

    </div><!-- Servicios adicionales -->

</div>


</div>