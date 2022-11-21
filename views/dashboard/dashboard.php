<?php
include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";

include file_exists("../../config/session_control.php")?"../../config/session_control.php":"config/session_control.php"; 

include "widgets.php" ?>
<div class="table_container darked">
    <?php include "tb_clients.php" ?>
</div>