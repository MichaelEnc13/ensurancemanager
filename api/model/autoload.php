<?php
error_reporting(0);
spl_autoload_register(function($class){
    include $class.".class.php";
});
