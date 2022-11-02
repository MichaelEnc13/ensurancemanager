<?php
include "../model/autoload.php";

if (isset($_POST['newClient'])) :

    if ($_POST['email'] == "" || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) : //verificar correo valido

        $cr = Client::add(
            $_POST['fname'],
            $_POST['lname'],
            $_POST['cid'],
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
                $_POST['plate'],
                $_POST['cid']
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

if (isset($_POST['saveClientInfo'])) :

    if ($_POST['email'] == "" || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) : //verificar correo valido

        $cr = Client::edit(
            $_POST['fname'],
            $_POST['lname'],
            $_POST['cid'],
            $_POST['address'],
            $_POST['tel'],
            $_POST['email']
        );
        echo $cr['status'] ? $cr['status'] : "VD" . $cr['error'][1];

    else :
        echo "NV001"; // NV001 => correo no valido
    endif;


endif;

if (isset($_POST['saveCarInfo'])) :


    $cr = Client::edit_car(
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
        $_POST['cid']
    );
    echo $cr['status'] ? $cr['status'] : "VD" . $cr['error'][2];



endif;
if (isset($_POST['registerNewCar'])) :
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
        $_POST['plate'],
        $_POST['cid']
    );

    echo $vr['status'] ? $vr['status'] : "VD" . $vr['error'][1];


endif;

if (isset($_POST['newPolicy'])) :

    $cid = base64_decode($_POST['cid']);
    $futureDate = $_POST['pay_method'] == "0" ? CalDate::some_months(12) : CalDate::some_months(1);
    $done = Client::new_policy(
        $_POST['policy_number'],
        $_POST['type'],
        $_POST['value'],
        $_POST['totalAdditional'],
        $_POST['pay_method'],
        $_POST['time'],
        $_POST['aditional'],
        $_POST['car_plate'],
        $_POST['date_from'],
        $_POST['date_until'],
        $cid,


    );

    if ($done['status']) :
        $ensured = Client::change_policy_status($_POST['car_plate'], $cid);

        if ($ensured['status']) :


            //Se verifica si el tipo de pago es total o inicial para poder aplicarle las cuotas
            if ($_POST['pay_method'] == "1") :
                $time = $_POST['time'];
                $month = 1;
                $amount = intval($_POST['value'] / $time);
                for ($i = 0; $i < $time; $i++) :
                    Client::add_policy_due(
                        $_POST['policy_number'],
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
        echo "DP" . $done['error'][1];
    endif;
endif;

if (isset($_POST['paydue'])) : //pagar cuota
    $done = Client::payDue(
        $_POST['policynumber'],
        $_POST['dueid'],
        base64_decode($_POST['cid']),

    );

    if ($done['status']) :

        $updated = Client::updatePolicyDate($_POST['policynumber'], base64_decode($_POST['cid']), CalDate::in30Days());
        echo $updated['status'] == true ? $updated['status'] : $updated['error'][1];

    else :

        echo $done['error'][1];
    endif;

endif;

if (isset($_POST['payoff'])) :
    $done = Client::payOff(
        $_POST['policynumber'],
        base64_decode($_POST['cid']),
    );

    if ($done['status']) :

        $updated = Client::updatePolicyDate($_POST['policynumber'], base64_decode($_POST['cid']), CalDate::in1Year());
        echo $updated['status'] == true ? $updated['status'] : $updated['error'][1];

    else :

        echo $done['error'][1];
    endif;

endif;

if (isset($_POST['renewPolicy'])) :

    $cid = base64_decode($_POST['cid']);
    $futureDate = $_POST['pay_method'] == "0" ? CalDate::some_months(12) : CalDate::some_months(1);
    $done = Client::renew(
        $_POST['type'],
        intval($_POST['value']),
        $_POST['pay_method'],
        $_POST['time'],
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
        echo "DP" . $done['error'][1];
    endif; 
endif;

if (isset($_POST['additionalService'])) :

    $car_plate = $_POST['car_plate'];
    $cid = base64_decode($_POST['cid']);
    $done = Client::see_car_policy($car_plate, $cid)['data']->fetch();
    echo $done['aditionalService'];


endif;


if (isset($_POST['savePolicy'])) :

    $cid = base64_decode($_POST['cid']);

    $done = Client::edit_policy(
        $_POST['policy_number'],
        $_POST['type'],
        $_POST['value'],
        $_POST['totalAdditional'],
        $_POST['pay_method'],
        $_POST['time'],
        $_POST['aditional'],
        $_POST['date_from'],
        $_POST['date_until'],
        $_POST['car_plate'],
        $cid,


    );


    echo $done['status'] ? $done['status'] : "DP" . $done['error'][2];

endif;

if (isset($_POST['deletePolicy'])) :
    $cid = base64_decode($_POST['cid']);

    $done = Client::deletePolicy(

        $_POST['policynumber'],
        $cid


    );
    Client::deletePolicyDue($_POST['policynumber'], $cid);
    Client::update_car_policy_status($_POST['car_plate'], $cid);
    echo $done['status'] ? $done['status'] : "DP" . $done['error'][1];

endif;
