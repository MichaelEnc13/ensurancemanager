<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";


$mantenainces = Dashboard::get_mantenaince()['data']->fetchAll();

?>

<style>
#getMantenaince{
    border: 1px solid var(--main-color);
}
</style>
<h2 class="blue">Requiere mantenimiento</h2>

<table id="table"  class="table-hover display  dataTable dtr-inline collapsed">
    <thead>
        <tr>
            <td>id</td>
            <td>Cedula</td>
            <td>Nombre</td>
            <td>Apellido</td>

            <td>Desde</td>
            <td>Hasta</td>
            <td>Retraso </td>
            <td>Visualizar</td>
          
        </tr>
    </thead>

    <tbody>
        <?php foreach ($mantenainces  as $mantenaince) :
            $client = Client::see_client_info($mantenaince['cid'])['data']->fetch();
            $date = CalDate::diffDate(date("d-m-Y"), $mantenaince['date_until']);
            $car_plate = Client::see_client_cars($client['cid'], $mantenaince['car_id'])['data']->fetch()['id'];
            // Para ver si el que cliente expira pronto -->
            echo $date;
            if ($date < 8) :
        ?>


                <!-- Buscar la cantidad de vehiculos de un cliente -->
                <?php $cant_car = Client::see_client_cars($mantenaince['cid'], false)['data']->rowCount(); ?>
                <tr>
                    <td><?php echo $client['id'] ?></td>
                    <td><?php echo $client['cid'] ?></td>
                    <td><?php echo $client['fname'] ?></td>
                    <td><?php echo $client['lname'] ?></td>
                    <td><?php echo $mantenaince['date_from'] ?></td>
                    <td><?php echo $mantenaince['date_until'] ?></td>
                    <td>
                        <?php 
                        $days = CalDate::diffDate(date("d-m-Y"), $mantenaince['date_until']);
                        echo $days<0?$days." día(s)":"Sin retrasos" ?>
                    
                    </td>
                    <td><button id="view-client-car-info" data-car_id="<?php echo $mantenaince['car_id'] ?>" data-car_plate="<?php echo  $car_plate ?>" data-cid="<?php echo $client['cid'] ?>" class="btn table__btn ">Ver</button></td> 
     

                </tr>
        <?php endif;
        endforeach; ?>
    </tbody>

</table>