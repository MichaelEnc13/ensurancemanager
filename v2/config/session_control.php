<?php
if (session_status() != 2) session_start();
$currrent =  $_SERVER['SCRIPT_NAME'];
$protocol = isset($_SERVER['HTTPS']) ? "https://" : "http://";
$url_login = $protocol . $_SERVER['SERVER_NAME'] . $currrent;
$url_dashboard = $protocol . $_SERVER['SERVER_NAME'] . "/dashboard";
/*  var_dump($_SESSION['user']);
 var_dump(isset($_SESSION['user'])); */

if ( isset($_SESSION['user'])==false  )  :
    header("location: signin");
endif;
 
 
 