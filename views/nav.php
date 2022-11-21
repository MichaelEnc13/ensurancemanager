 
<nav id="nav" class="nav darked">

    <span class="toggle" id="toggle">
        <i class="fa-solid fa-gears"></i>
    </span>
    <div class="nav__control blue">
        <span id="backDashboard">
            <i class="fa-solid fa-caret-left"></i> Regresar
        </span>
    </div>

    <div class="nav__company__logo">
        <img src="src/img/ensurances/<?php echo $_SESSION['user']['company_logo'] ?>" alt="">
    </div>
    <div class="nav__user">
        <?php echo $_SESSION['user']['fname'] ?>
    </div>

    <div class="nav__loguot">
        <span style="cursor: pointer;"><i id="logout"  class="fa-solid fa-arrow-right-from-bracket"></i></span>
    </div>




</nav>

