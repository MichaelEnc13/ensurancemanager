<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";

$clients = Client::see_all_client()['data'];

?>
<style>
#getClients{
    border: 1px solid var(--main-color);
}
</style>
<h2 class="blue">Todos los clientes</h2>

<table id="table" class="table-hover display  dataTable dtr-inline collapsed">
    <thead>
        <tr>
            <td>id</td>
            <td>Cedula</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>Direccion</td>
            <td>Telefono</td>
            <td>Correo</td>
            <td>Fecha de registro</td>
            <td>Cnt. vehiculos</td>
            <td>Visualizar</td>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($clients  as $client) : ?>
            <!-- Buscar la cantidad de vehiculos de un cliente -->
            <?php $cant_car = Client::see_client_cars($client['cid'], false)['data']->rowCount(); ?>
            <tr>
                <td><?php echo $client['id'] ?></td>
                <td><?php echo $client['cid'] ?></td>
                <td><?php echo $client['fname'] ?></td>
                <td><?php echo $client['lname'] ?></td>
                <td><?php echo $client['address'] ?></td>
                <td><?php echo $client['tel'] ?></td>
                <td><?php echo $client['email'] ?></td>
                <td><?php echo $client['date'] ?></td>
                <td><?php echo $cant_car ?></td>
                <td><button id="view-client-info" data-cid="<?php echo $client['cid'] ?>" class="btn table__btn "><i class="fa-solid fa-arrow-right"></i></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>