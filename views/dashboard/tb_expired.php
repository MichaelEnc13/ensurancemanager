<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";


$policies = Dashboard::get_policies()['data']->fetchAll();

?>

<style>
    #getExpired {
        border: 1px solid var(--main-color);
    }
</style>
<h2 class="blue">Expirados</h2>

<table id="table" class="table-hover display  dataTable dtr-inline collapsed">
    <thead>
        <tr>
            <td>id</td>
            <td>Cedula</td>
            <td>Nombre</td>
            <td>Apellido</td>

            <td>Matricula</td>
            <td>Desde</td>
            <td>Hasta</td>
            <td>Retraso </td>
            <td>Visualizar</td>
            <td>Notificar</td>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($policies  as $policies) :
            $client = Client::see_client_info($policies['cid'])['data']->fetch();
            $date = CalDate::diffDate(date("d-m-Y"), $policies['date_until']);
            $car_plate = Client::see_client_cars($client['cid'], $policies['car_plate'])['data']->fetch()['plate'];
            // Para ver si el que cliente expira pronto -->

            if ($date < 0) :
        ?>


                <!-- Buscar la cantidad de vehiculos de un cliente -->
                <?php $cant_car = Client::see_client_cars($policies['cid'], false)['data']->rowCount();
                  
                ?>
                <tr>
                    <td><?php echo $client['id'] ?></td>
                    <td><?php echo $client['cid'] ?></td>
                    <td><?php echo $client['fname'] ?></td>
                    <td><?php echo $client['lname'] ?></td>
                    <td><?php echo  $car_plate  ?></td>
                    <td><?php echo $policies['date_from'] ?></td>
                    <td><?php echo $policies['date_until'] ?></td>
                    <td><?php echo substr(CalDate::diffDate(date("d-m-Y"), $policies['date_until']), 1) . " día(s)" ?></td>
                    <td><button id="view-client-car-info" data-car_id="<?php echo $policies['car_plate'] ?>" data-car_plate="<?php echo  $car_plate ?>" data-cid="<?php echo $client['cid'] ?>" class="btn table__btn "><i class="fa-solid fa-arrow-right"></i></button></td>
                    <td>
                        <button class="btn table__btn "  id="notify-client" data-message="expired" data-car_plate="<?php echo $car_plate ?>" data-policynumber="<?php echo $policies['policynumber'] ?>" data-cname="<?php echo $client['fname'] . " " . $client['lname'] ?>" data-tel="<?php echo $client['tel'] ?>" data-date_from="<?php echo $policies['date_from'] ?>" data-date_until="<?php echo $policies['date_until'] ?>">
                            <img src="src/img/icons/whatsapp.png">
                           
                        </button>
                    </td>

                </tr>
        <?php endif;
        endforeach; ?>
    </tbody>

</table>