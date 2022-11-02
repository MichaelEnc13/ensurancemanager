<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";

include file_exists("../../config/session_control.php") ? "../../config/session_control.php" : "config/session_control.php";

if (session_status() != 2) session_start();
$cid = base64_decode(isset($_GET['cid']) ? $_GET['cid'] : $_SESSION['cid']);
$clients = Client::see_client_info($cid)['data']->fetch();
//usado para cargar el select con las matriculas
$clients_cars = Client::see_client_cars($cid, false)['data']->fetchAll();
//usado para extraer la inforamcion de un vehiculo
//Elegir si se quiere extraer la información con la matricula
$withPlate = isset($_SESSION['car_plate']) == true && $_SESSION['car_plate'] != false ? $_SESSION['car_plate'] : false;
$clients_car_info = Client::see_client_cars($cid, $withPlate)['data']->fetch();
//opciones para la matricula
//Si no existe una session de matricula, usará la que viene en la carga
$car_plate = isset($_SESSION['car_plate']) == true && $_SESSION['car_plate'] != false ? $_SESSION['car_plate'] : $clients_car_info['plate'];
$see_car_policy = Client::see_car_policy($car_plate, $cid)['data']->fetch();
$dueInfo = Client::dueInfo($see_car_policy['policynumber'], $cid)['data']->fetch();
$cantDues =  Client::dueInfo($see_car_policy['policynumber'], $cid)['data']->rowCount(); //cantidad de cuotas;

?>


<div class="client">

    <?php if ($clients != false) : ?>
        <div class="client__header">
            <h1 class="blue"><?php echo $clients['fname'] ?></h1>
            <span>Elige una matricula:</span>
            <select data-cid="><?php echo $clients['cid'] ?>" id="select-client-vehicle">
                <option style="color: var(--main-color)" value="<?php echo $car_plate ?>"><?php echo $car_plate ?>(mostrado)</option>
                <?php foreach ($clients_cars as $client_car) : ?>
                    <option value="<?php echo $client_car['plate'] ?>"><?php echo $client_car['plate'] ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn--blue" id="newCar" data-cid="<?php echo $cid ?>">Agregar vehículo</button>
        </div>

        <div class="client__info__container">
            <div class="client__info">
                <!-- Informacion del cliente -->
                <div class="client__info__widget client__info__personal">
                    <h3 class="blue">Información personal</h3>
                    <span class="editinfo"><img src=" src/img/icons/edit.png" id="editClient" data-cid="<?php echo $clients['cid'] ?>"> </span>
                    <div class="client__info__group">

                        <div class="client__info__group__data">
                            <h4>Cédula</h4>
                            <p><?php echo $clients['cid'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Telefono</h4>
                            <p><?php echo $clients['tel'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>E-mail</h4>
                            <p><?php echo $clients['email'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Dirección</h4>
                            <p><?php echo $clients['address'] ?></p>
                        </div>


                    </div>

                </div>
                <div class="client__info__widget client__info__vehicle">
                    <h3 class="blue">Datos del vehiculo</h3>
                    <span class="editinfo"><img src=" src/img/icons/edit.png" id="editCar" data-cid="<?php echo $cid ?>" data-car_plate="<?php echo $car_plate ?>"> </span>
                    <div class="client__info__group">

                        <div class="client__info__group__data">
                            <h4>Tipo</h4>
                            <p><?php echo $clients_car_info['type'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Servicio</h4>
                            <p><?php echo $clients_car_info['service'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Marca</h4>
                            <p><?php echo $clients_car_info['brand'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Modelo</h4>
                            <p><?php echo $clients_car_info['model'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Chasis</h4>
                            <p><?php echo $clients_car_info['chassis'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Año</h4>
                            <p><?php echo $clients_car_info['year'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Placa</h4>
                            <p><?php echo $clients_car_info['plate'] ?></p>
                        </div>
                        <div class="client__info__group__data">
                            <h4>Color</h4>
                            <p><?php echo $clients_car_info['color'] ?></p>
                        </div>


                    </div>
                    <?php if ($clients_car_info['ensured'] == 0) : ?>
                        <div class="client__info__vehicle__addEnsure">
                            <span>No asegurado </span>
                            <button data-cid_plate="<?php echo base64_encode($cid) ?>" data-car_plate="<?php echo $car_plate ?>" class="btn btn--blue" id="addPolicy">Agregar póliza</button>
                        </div>
                    <?php endif; ?>

                </div> 

            </div>

            <div class="client__info__widget client__ensurance">
                <!-- Informacion de la poliza -->
                <div class="client__ensurance__header">
                    <span title="Renovar póliza"><img src=" src/img/icons/renewable.png" id="renew" alt="Icono de renovación" data-car_plate="<?php echo $see_car_policy['car_plate'] ?>" data-policynumber="<?php echo $see_car_policy['policynumber'] ?>" data-paymethod="<?php echo $see_car_policy['payMethod'] ?>" data-type="<?php echo $see_car_policy['type'] ?>" data-value="<?php echo $see_car_policy['value'] ?>" data-valueserv="<?php echo $see_car_policy['totalAdditional'] ?>"  data-cid="<?php echo base64_encode($see_car_policy['cid']) ?> "></span>
                    <h3 class="blue" style="text-align: center;">Datos de la póliza</h3>
                </div>

                <span title="Editar datos de la póliza" class="editinfo"><img src="src/img/icons/edit.png" id="editPolicy" data-date_from="<?php echo $see_car_policy['date_from'] ?>" data-date_until="<?php echo $see_car_policy['date_until'] ?>" data-policynumber="<?php echo $see_car_policy['policynumber'] ?>" data-paymethod="<?php echo $see_car_policy['payMethod'] ?>" data-type="<?php echo $see_car_policy['type'] ?>" data-value="<?php echo $see_car_policy['value'] ?>" data-additional="<?php echo $see_car_policy['totalAdditional'] ?>" data-car_plate="<?php echo $see_car_policy['car_plate'] ?>" data-cid="<?php echo base64_encode($see_car_policy['cid'])?>"> </span>

                <div class="client__info__group">

                    <div class="client__info__group__data">
                        <!-- Numero de poliza -->
                        <h4>No. póliza</h4>
                        <p><?php echo $see_car_policy['policynumber'] ?></p>
                    </div>
                    <div class="client__info__group__data">
                        <!-- Tipo de seguro -->
                        <h4>Tipo de seguro</h4>
                        <p><?php
                            $type = "";
                            switch ($see_car_policy['type']):
                                case "0":
                                    $type = "De Ley";
                                    break;
                                case "1":
                                    $type = "Semi-full";
                                    break;
                                case "2":
                                    $type = "Full";
                                    break;
                            endswitch;

                            echo $type;

                            ?></p>
                    </div>
                    <div class="client__info__group__data">
                        <!-- Valor de la póliza -->
                        <h4>Valor</h4>
                        <p>RD $<?php echo number_format($see_car_policy['value']) ?></p>
                    </div>
                    <div class="client__info__group__data">
                        <!-- Valor de la póliza -->
                        <h4>Valor de serv. adicionales</h4>
                        <p>RD $<?php echo number_format($see_car_policy['totalAdditional']) ?></p>
                    </div>
                    <div class="client__info__group__data">
                        <!-- Vigencia -->
                        <h4>Vigencia</h4>
                        <p><?php echo $see_car_policy['date_from'] . " / " . $see_car_policy['date_until'];

                            $date = CalDate::diffDate(date("d-m-Y"), $see_car_policy['date_until']);
                            if ($date <= 0) :
                            ?></p>
                        <p style="color: red;">Esta póliza ha expirado. Tiene <?php echo substr($date, 1) . " Dia(s) de retraso"; ?></p>

                    <?php endif; ?>
                    </div>
                    <div class="client__info__group__data">



                        <h4>Cuotas restantes</h4>
                        <p><?php echo $cantDues ?></p>
                    </div>
                    <div class="client__info__group__data">



                        <h4>Monto a pagar</h4>
                        <p>RD $<?php echo number_format($dueInfo['amount'], 2) ?></p>
                    </div>


                </div>
                <div class="client__info__actions">
                    <button data-dueid="<?php echo $dueInfo['id'] ?>" data-policynumber="<?php echo $see_car_policy['policynumber'] ?>" data-paydue_cid="<?php echo base64_encode($cid) ?>" id="payDue" class="btn btn--blue">Pago cuota</button>
                    <button data-policynumber="<?php echo $see_car_policy['policynumber'] ?>" data-paydue_cid="<?php echo base64_encode($cid) ?>" class="btn btn--blue" id="payoff">Saldar</button>
                    <!--    <button class="btn btn--blue">Abonar</button> -->
                    <button id="printPolicy" data-policystatus="<?php echo $date ?>" data-policynumber="<?php echo $see_car_policy['policynumber'] ?>" data-car_plate="<?php echo $see_car_policy['car_plate'] ?>" data-cid="<?php echo base64_encode($cid) ?>" class="btn btn--blue">Imprimir</button>
                    <button id="deletePolicy" data-policystatus="<?php echo $date ?>" data-policynumber="<?php echo $see_car_policy['policynumber'] ?>" data-car_plate="<?php echo $see_car_policy['car_plate'] ?>" data-cid="<?php echo base64_encode($cid) ?>" class="btn btn--red">Eliminar</button>
                </div>
            </div>


            <div class="client__info__widget client__ensurance">
                <h4 class="blue" style="text-align: center;">Servicios adicionales</h4>
                <div class="client__info__group">


                    <div class="client__info__group__data">
                        <!-- Servicios adicionales -->
                        <ul class="aditional_service">
                            <?php if ($see_car_policy['aditionalService']) : $sv = json_decode($see_car_policy['aditionalService']);
                                foreach ($sv as $s) : if ($s != ""): ?>

                                    <li><?php echo $s; ?></li>

                                <?php endif; endforeach;

                            else : ?>
                                <p>Sin servicios adicionales</p>
                            <?php endif; ?>
                        </ul>
                    </div>


                </div>

            </div>


        </div>
    <?php else : ?>
        <div class="ilust">
            <h2>Debes elegir un cliente para acceder a esta información</h2>
            <img src="src/img/ilust/select.png" alt="">
        </div>
    <?php endif; ?>

</div>