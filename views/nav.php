<nav class="nav">
 
    <span class="toggle" id="toggle">
        <i class="fa-solid fa-bars"></i>
    </span> 
    <div class="nav__control blue">
        <span id="backDashboard">
            <i class="fa-solid fa-caret-left"></i> Regresar
        </span>
    </div>

    <div class="nav__company__logo">
        <img src="src/img/ensurances/patria.png" alt="">
    </div>
    <div class="nav__user">
        <?php echo $_SESSION['user']['fname'] ?>
    </div>

    <div class="nav__loguot">
        <button id="logout" class="btn nav__loguot__btn">Cerrar sesión</button>
    </div>




</nav>