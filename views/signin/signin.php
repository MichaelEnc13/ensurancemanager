<?php  
    if (session_status() != 2) session_start();

   
    if ( isset($_SESSION['user'])   == true)  :
        echo "<script>
            location.href = `dashboard`;
        </script>";
   
    endif;
     
?>

<div class="signup__container">

    <div class="form__container">
        <form onsubmit="return false" class="form" id="registerUser"> 
            <div class="form__header">
                <h1>Iniciar sesión</h1>

  
                <div class="form__header__brand">
                    <img src="" " alt="">
                </div>
            </div><!-- form__header -->
 
            <div class="form__info">
                <div class="form__input__control">
                    <label for="fname">E-mail </label>
                    <input class="email" type="text" name="mail" placeholder="Ingrese su correo">
                </div>
            </div>
            <div class="form__info">
                <div class="form__input__control">
                    <label for="fname">Contraseña</label>
                    <input class="password" type="text" name="password" placeholder="**********">
                </div>
            </div>
 

            <button id="login"  class="btn form__btn">
                Acceder
            </button>

        </form>
        <button id="loadRegister" class="btn"> No tienes una cuenta?, Registrate</button>

    </div>


</div>