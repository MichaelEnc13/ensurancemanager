 <div class="signup__container">

     <div class="signup">
         <div class="left_img">
             <div class="text">
                 <h1>Registrate</h1>
                 <p>Y empieza a administrar de forma sencilla los seguros de tus clientes con</p>
                 <h3>EnsuranceManager   </h3>
             </div>
         </div>
         <div class="form__container">
             <form onsubmit="return false" class="form" id="registerUser">
                 <div class="form__header">


                     <div class="form__header__select">
                         <label for="select_ensurance">Selecciona una aseguradora</label>
                         <select name="ensurance" id="select_ensurance">
                             <option value="">Aseguradora</option>

                             <option value="0">Seguros Patria, S. A.
                             </option>
                             <option value="1">Atlántica Seguros, S.A.
                             </option>
                             <option value="2">General de Seguros, S.A.
                             </option>
                             <option value="3">Humano Seguros, S.A.
                             </option>
                             <option value="4">Seguros Pepín, S. A.
                             </option>


                         </select>

                     </div><!-- form__header__select -->
                     <div class="form__header__brand">
                         <img src="" " alt="">
                    </div>
                </div><!-- form__header -->
    
                <div class=" form__info">
                         <div class="form__input__control">
                             <label class="fname">Nombre(s)</label>
                             <input class="input" type="text" name="fname" placeholder="Ingrese su nombre">
                         </div>

                         <div class="form__input__control">
                             <label for="fname">Apellido(s)</label>
                             <input class="input" type="text" name="lname" placeholder="Ingrese su apellido">
                         </div>
                     </div>

                     <div class="form__info">
                         <div class="form__input__control">
                             <label for="fname">Representante</label>
                             <input class="input" type="text" name="representant" placeholder="ingrese su ID de representante">
                         </div>

                         <div class="form__input__control">
                             <label for="fname">Ubicación</label>
                             <input class="input" type="text" name="address" placeholder="Ingrese su dirección">

                         </div>
                     </div>

                     <div class="form__info">
                         <div class="form__input__control">
                             <label for="fname">E-mail</label>
                             <input class="email" type="text" name="email" placeholder="Ingrese su correo">
                         </div>

                         <div class="form__input__control">
                             <label for="fname">Contraseña</label>
                             <input class="password" type="password" name="password" placeholder="**********">
                         </div>


                     </div>

                     <div class="form__info">
                         <div class="form__input__control">
                             <label for="fname">Repita su contraseña</label>
                             <input class="input" type="password" name="rPassword" placeholder="*********">
                         </div>

                         <div class="form__info">
                             <div class="form__input__control form__input__control--check">
                                 <input class="input input--checkbox" type="checkbox" name="confirmInfo" value="true">
                                 <label for="fname">Confirmo que toda la información es correcta</label>
                             </div>
                             <div class="form__input__control form__input__control--check">
                                 <input class="input input--checkbox " type="checkbox" name="accept" value="true">
                                 <label for="fname">Acepto los terminos y condiciones</label>
                             </div>
                         </div>
                     </div>



                     <button id="register" class="btn form__btn">
                         Completar registro
                     </button>



             </form>
             <button id="loadLogin" class="btn"> Ya tienes una cuenta?, inicia sesión</button>

         </div>

     </div>


 </div>

 <div class="branding">
     <p>Sistema desarrollado por <a href="https://dotsellsolutions.com" target="_blank">Dotsell Solutions</a></p>
 </div>