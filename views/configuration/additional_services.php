<table id="table" class="table-hover display  dataTable dtr-inline collapsed">
    <thead>
        <tr>
            <td>Id</td>
            <td>Servicio</td>
            <td>Costo </td>
            <td>Editar</td>

            <td>Eliminar</td>

        </tr>
    </thead>

    <tbody>

        <?php
        include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";
        $services = User::get_addtional_services()['data']->fetchAll();

        foreach ($services as $service) :
        ?>


            <tr>
                <td><?php echo $service['id'] ?></td>
                <td><?php echo $service['name'] ?></td>
                <td>RD $<?php echo $service['price'] ?></td>
                <td>
                    <button class="btn btn--green-no-border" data-id="updateService" data-name="<?php echo $service['name'] ?>" data-value="<?php echo $service['price'] ?>" data-sid="<?php echo $service['id'] ?>">Editar</button>
                </td>
                <td> <button class="btn btn--red-no-border" data-id="deleteService" data-sid="<?php echo $service['id'] ?>">Quitar </button></td>
            </tr>

        <?php endforeach; ?>



    </tbody>

</table>