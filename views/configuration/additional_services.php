<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";
$services = User::get_addtional_services()['data']->fetchAll();
if ($services) :
    foreach ($services as $service) :
?>

        <div class="services darked">
            <div class="service_name"><?php echo $service['name'] ?></div>
            <div class="service_price"><span class="currency">RD $</span><?php echo $service['price'] ?></div>
            <div class="service_action">
                <button class="btn btn--green-no-border" data-id="updateService" data-name="<?php echo $service['name'] ?>" data-value="<?php echo $service['price'] ?>" data-sid="<?php echo $service['id'] ?>">Editar</button>
                <button class="btn btn--red-no-border" data-id="deleteService" data-sid="<?php echo $service['id'] ?>">Quitar </button>
            </div>
        </div>
    <?php endforeach;
else : ?>
    <p>Sin servicios adicionales</p>
<?php endif; ?>