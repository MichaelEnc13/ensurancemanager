 <nav id="nav" class="nav darked">

     <span  data-action="Configuración" class="toggle" id="toggle">
         <i class="fa-solid fa-gears"></i>
     </span>
     <span class="refill"></span>
     <div class="nav__control blue">
         <span id="backDashboard"   data-action="Regresar al dashboard" class="clikable">
             <i class="fa-solid fa-arrow-left"></i>
         </span>


     </div>

     <div class="nav__company__logo">
         <img src="src/img/ensurances/<?php echo $_SESSION['user']['company_logo'] ?>" alt="">
     </div>
     <div class="nav__user">
         <?php echo $_SESSION['user']['fname'] ?>
     </div>

     <div class="notification"data-action="Notificaciones">
         <!-- <span class="notification_badge"></span> -->
         <span style="cursor: pointer;" ><i id="notification" class="fa-regular fa-bell"></i></span>
     </div>
     <div class="nav__loguot" >
         <span style="cursor: pointer;" data-action="Salir del sistema"><i id="logout" class="fa-solid fa-arrow-right-from-bracket"></i></span>
     </div>




 </nav>

 <div class="notification_block">
     <h2 class="title">Notificaciones</h2>
     <div class="notifications_containter">
         <div class="notifications">
             <div class="notifications_title">NUEVA ACTUALIZACIÓN</div>
             <div class="notifications_body">
                 <b>Se ha agregado las funciones de:</b><br><br>
                 -Agregar mantenimiento. <br><br>
                 -Tipo de aceite usado y el grado del mismo. <br><br>
                 -Puedes configurar la plantilla de póliza respecto a la hoja de forma manual.<br><br>
                 -Nueva adaptación del modo oscuro.<br><br>
             </div>
             <div class="notifications_footer">30/11/2022</div>
         </div>


     </div>
 </div>