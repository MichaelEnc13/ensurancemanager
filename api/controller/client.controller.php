<?php


include "../model/autoload.php";

if (isset($_POST['newClient'])) : //agrega un cliente y su vehiculo

    if ($_POST['email'] == "" || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) : //verificar correo valido

        $cr = Client::add(
            $_POST['fname'],
            $_POST['lname'],
            $_POST['newcid'],
            $_POST['address'],
            $_POST['tel'],
            $_POST['email']
        );

        if ($cr['status']) : //cliente registrado?

            $vr = Client::add_car(
                $_POST['type'],
                $_POST['service'],
                $_POST['chassis'],
                $_POST['brand'],
                $_POST['model'],
                $_POST['year'],
                $_POST['ciliders'],
                $_POST['passengers'],
                $_POST['color'],
                $_POST['newplate'],
                $_POST['newcid']
            );

            echo $vr['status'] ? $vr['status'] : "VD" . $vr['error'][1];

        else :
            echo "CD" . $cr['error'][1]; //error para ver porque no se registró
        // echo "CD" . $cr['error'][2]; //error para ver porque no se registró

        endif;

    else :

        echo "NV001"; // NV001 => correo no valido
    endif;
endif;

if (isset($_POST['saveClientInfo'])) : //edita la info de un cliente@@@

    if ($_POST['email'] == "" || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) : //verificar correo valido

        $cr = Client::edit(
            $_POST['fname'],
            $_POST['lname'],
            $_POST['cid'],
            $_POST['newcid'],
            $_POST['address'],
            $_POST['tel'],
            $_POST['email']
        );


        if ($_POST['cid'] != $_POST['newcid']) :
            Client::editGlobalInfo($_POST['cid'], $_POST['newcid']);
        endif;
        echo $cr['status'] ? $cr['status'] : "VD" . $cr['error'][1];

    else :
        echo "NV001"; // NV001 => correo no valido
    endif;


endif;

if (isset($_POST['deletecar'])) : //elimina la info de un vehiculo y elimina las polizas asociadas

    $cid = $_POST['cid'];
    $car_id = $_POST['car_id'];
    $policynumber = $_POST['policynumber'];
    $cr = Client::remove_car($car_id, $cid);
    Client::deletePolicy($policynumber, $cid);
    Client::deletePolicyDue($policynumber, $cid);
    echo $cr['status'] ? $cr['status'] : "VD" . $cr['error'][2];

endif;
if (isset($_POST['saveCarInfo'])) : //edita la info de un vehiculo


    $cr = Client::edit_car(
        $_POST['car_id'],
        $_POST['type'],
        $_POST['service'],
        $_POST['chassis'],
        $_POST['brand'],
        $_POST['model'],
        $_POST['year'],
        $_POST['ciliders'],
        $_POST['passengers'],
        $_POST['color'],
        $_POST['plate'],
        $_POST['newplate'],
        $_POST['cid']
    );
    echo $cr['status'] ? $cr['status'] : "VD" . $cr['error'][2];



endif;
if (isset($_POST['registerNewCar'])) : //registra un nuevo vehiculo
    $vr = Client::add_car(
        $_POST['type'],
        $_POST['service'],
        $_POST['chassis'],
        $_POST['brand'],
        $_POST['model'],
        $_POST['year'],
        $_POST['ciliders'],
        $_POST['passengers'],
        $_POST['color'],
        $_POST['newplate'],
        $_POST['cid']
    );

    echo $vr['status'] ? $vr['status'] : "VD" . $vr['error'][1];


endif;
$policyDraft;

if (isset($_POST['addService']) && $_POST['addService'] === "true") : //añade un servicio adicional a una poliza en proceso de registro
    if (session_status() != 2) session_start();
    $policyDraft = isset($_SESSION['policy_draft']) ? $_SESSION['policy_draft'] : $_SESSION['policy_draft'] = date("hms") . $_SESSION['user']['id'];

    Client::add_services($_POST['service_id'],  $_POST['policynumber'] != "" ? $_POST['policynumber'] : $policyDraft);

elseif (isset($_POST['addService']) && $_POST['addService'] === "false") :
    Client::delete_services_draft($_POST['policynumber'] != "" ? $_POST['policynumber'] : $_SESSION['policy_draft'], $_POST['service_id']);
endif;





if (isset($_POST['newPolicy'])) : //registra la nueva poliza
    $policynumber = $_POST['policy_number'];
    $cid = $_POST['cid'];
    $value = $_POST['value'];
    $initial = isset($_POST['initial']) ? $_POST['initial'] : 0;
    $car_id = $_POST['car_id'];
    $futureDate = $_POST['pay_method'] == "0" ? CalDate::some_months(12) : CalDate::some_months(1);
    $totalAditional =  $_POST['totalAdditional'];
    $done = Client::new_policy(
        $policynumber,
        $_POST['type'],
        $value,
        $totalAditional,
        $initial,
        $_POST['pay_method'],
        isset($_POST['time']) ? $_POST['time'] : 0,
        $_POST['aditional'],
        $car_id,
        $_POST['date_from'],
        $_POST['date_until'],
        $cid,


    );

    if ($done['status']) :
        Client::update_services_draft($policynumber, $_SESSION['policy_draft']);

        unset($_SESSION['policy_draft']);
        $ensured = Client::change_policy_status($car_id, $cid);

        if ($ensured['status']) :


            //Se verifica si el tipo de pago es total o inicial para poder aplicarle las cuotas
            if ($_POST['pay_method'] == "1") :
                $time = $_POST['time'];
                $month = 1;
                $amount = floatval(($value - $initial) + $totalAditional / $time);
                for ($i = 0; $i < $time; $i++) :
                    Client::add_policy_due(
                        $policynumber,
                        $cid,
                        $month,
                        CalDate::some_months($month),
                        $amount

                    );
                    $month++;
                endfor;
            endif;
            echo $done['status'];
        else :
            echo $ensured['error']['1'];
        endif;



    else :
        echo "DP" . $done['error'][2];
    endif;

/*   $tas = $_POST['totalAdditionalService'];

    $i = 1;
    for ($i; $i <= $tas; $i++) :
        $as = $_POST['aditionalService_' . $i];
        $asv = $_POST['aditionalService_value_' . $i];
        if ($as != "") :

            echo $as;
            echo $asv;
        endif;
    endfor; */




endif;

if (isset($_POST['paydue'])) : //pagar cuota
    $done = Client::payDue(
        $_POST['policynumber'],
        $_POST['dueid'],
        $_POST['cid'],

    );

    if ($done['status']) :

        $updated = Client::updatePolicyDate($_POST['policynumber'], $_POST['cid'], CalDate::in30Days());
        echo $updated['status'] == true ? $updated['status'] : $updated['error'][1];
        if (!Client::dueInfo($_POST['policynumber'], $_POST['cid'])['data']->fetch()) :
            Client::updatePolicyDate($_POST['policynumber'], $_POST['cid'], CalDate::in1Year());
        endif;
    else :

        echo $done['error'][1];
    endif;

endif;
if (isset($_POST['partialPay'])) : //pago parcial de cuota
    $done = Client::payDue(
        $_POST['policynumber'],
        $_POST['dueid'],
        $_POST['cid']

    );

    if ($done['status']) :
     
         Client::partialPay(
            
            $_POST['policynumber'],
            $_POST['dueid'] +1,
            $_POST['cid'],
            $_POST['amount']
    
        );
        $updated = Client::updatePolicyDate($_POST['policynumber'], $_POST['cid'], CalDate::in30Days());
        echo $updated['status'] == true ? $updated['status'] : $updated['error'][1];
        if (!Client::dueInfo($_POST['policynumber'], $_POST['cid'])['data']->fetch()) :
            Client::updatePolicyDate($_POST['policynumber'], $_POST['cid'], CalDate::in1Year());
        endif;
    else :

        echo $done['error'][1];
    endif;
 
endif;
if (isset($_POST['payoff'])) : //salda todas las cuotas
    $done = Client::payOff(
        $_POST['policynumber'],
        $_POST['cid'],
    );

    if ($done['status']) :

        $updated = Client::updatePolicyDate($_POST['policynumber'], $_POST['cid'], CalDate::in1Year());
        echo $updated['status'] == true ? $updated['status'] : $updated['error'][1];

    else :

        echo $done['error'][1];
    endif;

endif;

if (isset($_POST['renewPolicy'])) : //renueva las polizas

    $cid = $_POST['cid'];
    $futureDate = $_POST['pay_method'] == "0" ? CalDate::some_months(12) : CalDate::some_months(1);
    $done = Client::renew(
        $_POST['type'],
        intval($_POST['value']),
        $_POST['pay_method'],
        isset($_POST['time']) ? $_POST['time'] : 0,
        $_POST['date_from'],
        $_POST['date_until'],
        $_POST['policy_number'],
        $cid
    );

    if ($done['status']) :
        //Se verifica si el tipo de pago es total o inicial para poder aplicarle las cuotas
        if ($_POST['pay_method'] == "1") :
            $time = $_POST['time'];
            $month = 1;
            $amount = intval($_POST['value'] / $time);
            for ($i = 0; $i < $time; $i++) :
                Client::add_policy_due(
                    $_POST['policynumber'],
                    $cid,
                    $month,
                    CalDate::some_months($month),
                    $amount

                );
                $month++;
            endfor;
            echo $done['status'];
        else :
            Client::payOff(
                $_POST['policynumber'],
                $cid
            );
            $updated = Client::updatePolicyDate($_POST['policynumber'], $cid, CalDate::in1Year());

            echo $updated['status'] == true ? $updated['status'] : $updated['error'][1];
        endif;





    else :
        echo "DP" . $done['error'][2];
    endif;
endif;

if (isset($_POST['additionalService'])) : //extrae los servicios adicionales marcados

    $car_plate = $_POST['car_plate'];
    $cid = $_POST['cid'];
    $done = Client::see_car_policy($car_plate, $cid)['data']->fetch();
    echo $done['aditionalService'];


endif;


if (isset($_POST['savePolicy'])) : //edita una poliza
    $value = $_POST['value'];
    $initial =  isset($_POST['initial']) ? $_POST['initial'] : 0;
    $totalAditional = $_POST['totalAdditional'];
    $aditional = $_POST['aditional'];
    $cid = $_POST['cid'];
    $policynumber =  $_POST['policy_number'];
    $done = Client::edit_policy(
        $policynumber,
        $_POST['type'],
        $value,
        $totalAditional,
        $initial,
        $_POST['pay_method'],
        isset($_POST['time']) ? $_POST['time'] : 0,
        $aditional,
        $_POST['date_from'],
        $_POST['date_until'],
        $_POST['car_plate'],
        $cid,


    );

    $existDue = Client::dueInfo($policynumber, $cid)['data']->fetch();

    if ($_POST['pay_method'] == "1") :

        $time = $_POST['time'];
        $month = 1;
        $amount = floatval((($value - $initial) + $totalAditional) / $time);
        //verificar cuantas filas hay para determinar cuantas se van a agregar
        $cantDues =  Client::dueInfo($policynumber, $cid)['data']->rowCount(); //cantidad de cuotas;
        $cantDues = $cantDues != false ? $cantDues : 0;
        $newDues;

        if ($cantDues < $time) : //verifica que las cuotas sean menores al nuevo tiempo de pago

            $newDues =   $time - $cantDues;
            for ($i = 0; $i < $newDues; $i++) :
                Client::add_policy_due(
                    $policynumber,
                    $cid,
                    $month,
                    CalDate::some_months($month),
                    $amount

                );
                $month++;
            endfor;
        elseif ($cantDues > $time) :  //verfica que sean mayores

            $newDues =   $cantDues - $time;
            for ($i = 0; $i < $time; $i++) :
                Client::add_policy_due(
                    $policynumber,
                    $cid,
                    $month,
                    CalDate::some_months($month),
                    $amount

                );

                $month++;
            endfor;
            echo Client::deleteDue_diff_value($policynumber, $amount, $cid)['error'][2];

        endif;




        for ($i = 0; $i < $time; $i++) :

            Client::edit_policy_due(
                $policynumber,
                $cid,
                $month,
                CalDate::some_months($month),
                $amount

            );
            $month++;
        endfor;




    elseif ($_POST['pay_method'] == 0) :
        Client::deleteDue($policynumber, $cid);
    endif;


    echo $done['status'] ? $done['status'] : "DP" . $done['error'][2];

endif;

if (isset($_POST['deletePolicy'])) : //elimina la poliza
    $cid = base64_decode($_POST['cid']);

    $done = Client::deletePolicy(

        $_POST['policynumber'],
        $cid


    );
    Client::delete_all_services_draft($_POST['policynumber']);
    Client::deletePolicyDue($_POST['policynumber'], $cid);
    Client::update_car_policy_status($_POST['car_id'], $cid);
    echo $done['status'] ? $done['status'] : "DP" . $done['error'][1];

endif;

if (isset($_POST['save_mantenaince'])) :
    $done = Client::add_mantenaince_date(
        $_POST['car_id'],
        $_POST['cid'],
        $_POST['date_from'],
        $_POST['date_until'],
        $_POST['oil_type'],
        $_POST['oil_grade']
    );

    if ($done['status']) :
        echo $done['status'];
    else :
        echo $done['error'][1];
    endif;
endif;

if (isset($_POST['edit_mantenaince'])) :
    $done = Client::edit_mantenaince_date(
        $_POST['car_id'],
        $_POST['cid'],
        $_POST['date_from'],
        $_POST['date_until'],
        $_POST['oil_type'],
        $_POST['oil_grade']

    );

    if ($done['status']) :
        echo $done['status'];
    else :
        echo $done['error'][1];
    endif;
endif;

if (isset($_POST['remove_mantenaince'])) :
    $done = Client::remove_mantenaince(
        $_POST['car_id'],
        $_POST['cid'],

    );

    if ($done['status']) :
        echo $done['status'];
    else :
        echo $done['error'][1];
    endif;
endif;
