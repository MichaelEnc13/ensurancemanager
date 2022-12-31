<?php
if (session_status() != 2) session_start();


if (isset($_SESSION['user'])   == true) :
    echo "<script>
            location.href = `dashboard`;
        </script>";

endif;

?>
   <script src="https://www.google.com/recaptcha/api.js?render=6LfnN7EjAAAAAHPNkMPeGzxKIJVHIVkb0kukYPuK"></script>

<div class="signup__container">

    <div class="signup signin">
        <div class="left_img">
            <div class="text">
                <h1>Iniciar sesión</h1>
                <!--    <p>Y empieza a administrar de forma sencilla los seguros de tus clientes con</p>
                <h3>EnsuranceManager </h3> -->
            </div>
        </div>

        <div class="form__container ">
            <form onsubmit="return false" class="form" id="registerUser">
                <div class="form__header">

                </div><!-- form__header -->

                <div class=" form__info">
                    <div class="form__input__control">
                        <label for="fname">E-mail </label>
                        <input class="email" type="text" name="mail" placeholder="Ingrese su correo">
                    </div>

                    <div class="form__input__control">
                        <label for="fname">Contraseña</label>
                        <input class="password" type="password" name="password" placeholder="**********">
                    </div>
                </div>



                <button id="login" class="btn form__btn">
                    Acceder
                </button>

            </form>
            <button id="loadRegister" class="btn g-recaptcha"  data-sitekey="6LfnN7EjAAAAAHPNkMPeGzxKIJVHIVkb0kukYPuK" data-callback='onSubmit' data-action='submit'> No tienes una cuenta?, Registrate</button>

        </div>
    </div>


</div>
<div class="branding">
    <p>Sistema desarrollado por <a href="https://dotsellsolutions.com" target="_blank">Dotsell Solutions</a></p>
</div>