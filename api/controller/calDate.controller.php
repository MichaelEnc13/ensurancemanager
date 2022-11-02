 
<?php
include "../model/autoload.php";
if (isset($_POST['calDate'])) :
    //Calcular fecha dentro de 30 dias
    switch ($_POST['days']):
        case 360:
            echo CalDate::in1Year();
            break;
        case 30:
            echo CalDate::in30Days();
            break;
    endswitch;

endif;
