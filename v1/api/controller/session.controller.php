<?php 

if (session_status() != 2) session_start();
if(isset($_POST['newSession'])):
    $_SESSION[$_POST['session_name']] = $_POST['session_value'];
endif;

if(isset($_POST['stopSession'])):
   unset( $_SESSION[$_POST['session_name']]);
endif;

if(isset($_POST['logout'])):
    $_SESSION = array();
   return true;
endif;