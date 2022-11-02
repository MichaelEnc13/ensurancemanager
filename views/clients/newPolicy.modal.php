<div class="modal  modal--newPolicy">

    <h3>Datos de la póliza</h3>

    <?php
    $module = "";

    if (isset($_GET['editPolicy'])) :
        $module = "editPolicyForm.php";
    elseif (isset($_GET['renew'])) :
        $module = "renewPolicyForm.php";
    else :
        $module = "newPolicyForm.php";
    endif;


    include $module;
    ?>


</div>