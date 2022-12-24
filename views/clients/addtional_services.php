<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";
$services = User::get_addtional_services()['data'];
//if (isset($_GET['editPolicy'])) :
?>
<input type="hidden" name="totalAdditionalService" value="<?php echo $services->rowCount(); ?>">
<?php
if ($services) :
    foreach ($services->fetchAll() as $service) :
   
    $policynumber = Client::get_client_services($_GET['policynumber'],$service['id'])['data']->fetch()['policynumber'];
       // var_dump($policynumber);
?>

 
        <div class="form__control__checkbox__control">
            <input type="checkbox"  data-policynumber="<?php echo $policynumber?>" data-value="<?php echo $service['price'] ?>" data-index="<?php echo $service['id'] ?>" value="<?php echo $service['name'] ?>" name="aditionalService_1" class="aditional_service " <?php echo $policynumber!=""?"checked":"" ?> disabled>

            <label><?php echo $service['name'] ?> (<span class="currency">RD $</span> <?php echo $service['price'] ?>)</label>
        </div>

    <?php endforeach;
else : ?>
    <p>El sistema no tiene servicios adicionales registrados</p>
<?php endif; ?>