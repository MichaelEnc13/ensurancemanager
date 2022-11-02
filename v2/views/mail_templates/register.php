<?php 

include "../../api/model/autoload.php";
$hashMail = Signup::encode64($_POST['email']);
$uri = $_SERVER['HTTP_HOST']."/e-confirm?uid=".$hashMail ;
$errormail = $_SERVER['HTTP_HOST']."/errormail?id=".$hashMail ;
 

ob_start(); ?>



<div class='mail' 
        style=" width: 90%;
        margin: auto;
        background: rgba(220, 214, 255, 0.46);
        text-align: center;  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 30px;">
    <h1  style=" color: #3f4452;">EnsuranManage</h1>
    <h2 style=" color: #3f4452;"><?Php echo isset($mailTitle)?$mailTitle:"" ?></h2>
    <p style="  font-size: 20px;
        color: #838791;"><?Php echo isset($mailMessage)?$mailMessage:"" ?></p>

    <a href='<?php echo $uri?>' style="  font-size: 20px;">
        <button style="border: none;
        font-weight: bold;
        color: #3f4452;
        cursor: pointer;
        padding: 10px;
        font-size: 20px;
        box-shadow: 5px 5px 10px #83879169;
        border-radius: 5px;
        border: 1px solid #3f4452;">Activar cuenta</button>
    </a>
    <br><br><br>
    <p  style=" color: #3f4452;">Si has recibido este mensaje por error, accede al enlace debajo.</p>

    <a href='<?php echo $errormail?>' style="color: #838791;">No he sido yo</a>

</div>