<?php

include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";
$cid = isset($_GET['cid']) ? $_GET['cid'] : "";
$car_id = isset($_GET['car_id']) ? $_GET['car_id'] : "";
$mantenaince = Client::see_car_mantenaince($car_id, $cid)['data']->fetch();

 
?>
<div class="mantenaince">
 
    <form onsubmit="return false" class="<?php echo !isset($_GET['edit'])?"add_mantenaince":"edit_mantenaince" ?>">

        <div class="form_grid">
            <div class="form_control">
                <label for="date">Fecha inicial</label>
                <input type="text" name="date_from" class="date" id="date_from" placeholder="xx/xx/xxxx" value="<?php echo $mantenaince['date_from'] ?>" autocomplete="off">
            </div>

            <div class="form_control">
                <label for="date">Fecha límite</label>
                <input type="text" name="date_until" class="date" id="date_until" placeholder="xx/xx/xxxx" value="<?php echo $mantenaince['date_until'] ?>" autocomplete="off">
            </div>
            <div class="form_control">
                <label for="date">Marca del aceite</label>
                <input type="text" name="oil_type" class="date"   placeholder="--------" value="<?php echo $mantenaince['oil_type'] ?>" autocomplete="off">
            </div>
            <div class="form_control">
                <label for="date">Grado del aceite</label>
                <input type="text" name="oil_grade" class="date"   placeholder="---------" value="<?php echo $mantenaince['oil_grade'] ?>" autocomplete="off">
            </div>
        </div>
        <?php if (!isset($_GET['edit'])) : ?>
            <button class="btn btn--blue" id="save_mantenaince">Agregar mantenimiento</button>
        <?php else : ?>
            <button class="btn btn--blue" id="edit_mantenaince_info" data-cid="<?php echo $cid ?>" data-car_id="<?php echo $car_id ?>">Editar fecha</button>
        <?php endif; ?>
    </form>
</div>