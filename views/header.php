<?php
include "config/date.php";

$img_uri = "";
if (session_status() != 2) : session_start();
endif;
$v = "1.1"
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/libs/css/spinner.css">
    <link rel="stylesheet" href="src/css/style.css?version=<?php echo $v?>">
    <link rel="stylesheet" href="src/libs/css/dt.css">
    <link rel="shortcut icon" href="src/img/icons/pwa_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="src/libs/css/icons.css">
    <link rel="manifest" href="manifest.json">

    <title>EnsuranManage</title>
</head>
 
<body> 

    <?php if (isset($_SESSION['user'])) :
     
        include "nav.php";
        include "sidebar.php";
        include "modal.php";
        include "globalPrinting.php";
        include "spinner.php";
        include "overlay.php";
        
     
    endif; ?>

    

    <div class="globalContainer">
        <div class="viewLoader " id="viewLoader">