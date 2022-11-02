<div class="confirmMail">
    <h1>Ensurance Manage</h1>

    <?php
    include "api/model/autoload.php";

    if (isset($_GET['uid'])  && $_GET['uid'] != "") :
        $email = Signup::decode64($_GET['uid']);
        $checked = Signup::checkIfExist("", $email);
        $confirmed;
        if ($checked) :
            $confirmed = Signup::confirm_email($email);
        endif;

    ?>


        <?php if ($checked) : ?>
            <div class="confirmMail__img">
                <img src="src/img/ilust/confirmed.png" alt="">
            </div>
            <h2>Tu cuenta ha sido activada</h2>
            <p>Ya puedes acceder al sistema </p>
            <button id="loadLogin" class="btn">Inciar session</button>
        <?php else : ?>
            <div class="confirmMail__img">
                <img src="src/img/ilust/nomail.png" alt="">
            </div>
            <h2>Tú cuenta cuenta no pudo ser encontrada</h2>
            <p>Al parecer hubo un error con la informacion que ingresaste.</p>
            <p>Intenta realizar el registro nuevamente</p>
             
                <button id="loadRegister" class="btn">Ir al registro</button>
           
        <?php endif; ?>






    <?php

    else : ?>

        <div class="confirmMail__img">
            <img src="src/img/ilust/lost.png" alt="">
        </div>

        <h2>Al parecer has llegado aquí por error</h2>
        <p>Te vamos a enviar a otro sitio</p>

    <?php endif; ?>
</div>