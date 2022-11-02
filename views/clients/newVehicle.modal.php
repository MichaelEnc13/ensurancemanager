<?php
    $car_id = isset($carInfo)?$carInfo['id']:"";
    $type = isset($carInfo)?$carInfo['type']:"";
    $service = isset($carInfo)?$carInfo['service']:"";
    $chassis = isset($carInfo)?$carInfo['chassis']:"";
    $brand = isset($carInfo)?$carInfo['brand']:"";
    $model = isset($carInfo)?$carInfo['model']:"";
    $year = isset($carInfo)?$carInfo['year']:"";
    $ciliders = isset($carInfo)?$carInfo['ciliders']:"";
    $passengers = isset($carInfo)?$carInfo['passengers']:"";
    $color = isset($carInfo)?$carInfo['color']:"";
    $plate = isset($carInfo)?$carInfo['plate']:"";

?>
 
<h3>Datos del vehiculo</h3>

<div class="form__control form_control--newVehicle">
    <input type="hidden" title="Tipo" class="form__input" value="<?php echo $car_id?>" name="car_id" placeholder="Tipo" >
    <input type="text" title="Tipo" class="form__input" value="<?php echo $type?>" name="type" placeholder="Tipo" >
    <input type="text" title="Servicio" class="form__input" value="<?php echo $service?>" name="service" placeholder="Servicio" >
    <input type="text" title="Chasis" class="form__input" value="<?php echo $chassis?>" name="chassis" placeholder="Chasis" >
</div> 
<div class="form__control form_control--newVehicle">
    <input type="text" title="Marca" class="form__input" value="<?php echo $brand?>" name="brand" placeholder="Marca">
    <input type="text" title="Modelo" class="form__input" value="<?php echo $model?>" name="model" placeholder="Modelo">
    <input type="text" title="año" class="form__input" value="<?php echo $year?>" name="year" placeholder="año">
    <input type="text" title="Ton. / Cil." class="form__input" value="<?php echo $ciliders?>" name="ciliders" placeholder="Ton. / Cil.">
</div>
<div class="form__control form_control--newVehicle">
    <input type="text" title="Pasajeros" class="form__input" value="<?php echo $passengers?>" name="passengers" placeholder="Pasajeros">
    <input type="text" title="Color" class="form__input" value="<?php echo $color?>" name="color" placeholder="Color">
    <input type="text" title="Placa" class="form__input" value="<?php echo $plate?>" name="newplate" placeholder="Placa ">
    <input type="hidden" title="Placa" class="form__input" value="<?php echo $plate?>" name="plate" placeholder="Placa ">
</div>