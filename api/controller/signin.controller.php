<?php
include "../model/autoload.php";


if(isset($_POST['login'])):

   echo  Signin::login($_POST['mail'],$_POST['password']);

endif; 