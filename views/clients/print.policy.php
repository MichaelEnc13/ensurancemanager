 <?php
    include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";
    $cid = base64_decode($_GET['cid']);
    $car_id = $_GET['car_id'];
    $policynumber = Client::see_car_policy($car_id, $cid)['data']->fetch();
    $car_info = Client::see_client_cars($cid, $policynumber['car_plate'])['data']->fetch();
    $client = Client::see_client_info($cid)['data']->fetch();


    ?>

 
 <div class="policy_container">
     <div class="policy__print">
         <div class="policy__print__info policy__print__info--maininfo">
             <span>Cliente:</span>
             <p><?php echo $client['fname'] . " " . $client['lname'] ?></p>
         </div>
         <div class="policy__print__info policy__print__info--maininfo">
             <span>Póliza:</span>
             <p><?php echo $policynumber['policynumber'] ?></p>
         </div>

         <div class="policy__print__grid">

             <div class="policy__print__order ">
                 <div class="policy__print__info policy__print__info--data">
                     <span>Tipo:</span>
                     <p><?php echo $car_info['type'] ?></p>
                 </div>
                 <div class="policy__print__info policy__print__info--first policy__print__info--data">
                     <span>Chasis:</span>
                     <p><?php echo $car_info['chassis'] ?></p>
                 </div>
                 <div class="policy__print__info policy__print__info--data">
                     <span>Placa:</span>

                     <p><?php echo $car_info['plate'] ?></p>

                 </div>



             </div>


             <div class="policy__print__order">
                 <div class="policy__print__info policy__print__info--second  policy__print__info__data">
                     <span>Servicio:</span>
                     <p><?php echo $car_info['service'] ?></p>
                 </div>
                 <div class="policy__print__info policy__print__info--second  policy__print__info__data">
                     <span>Marca:</span>

                     <p><?php echo $car_info['brand'] ?></p>

                 </div>
                 <div class="policy__print__info policy__print__info--second  policy__print__info__data">
                     <span>Año:</span>

                     <p><?php echo $car_info['year'] ?></p>

                 </div>
             </div>

         </div>

         <div class="policy__print__info policy__print__info--maininfo policy__print__info__data">
             <span>Vigencia:</span>
             <p><?php echo $policynumber['date_from'] . " / " . $policynumber['date_until'] ?></p>
         </div>
         <div class="policy__print__info policy__print__info--maininfo policy__print__info__data">
             <span><?php echo $_SESSION['user']['representant'] ?></span>
             <p><?php echo $_SESSION['user']['fname'] . " " . $_SESSION['user']['lname'] ?></p>
         </div>

         <?php
            $as = json_decode($policynumber['aditionalService'], true);

            $pa = isset($as[0]) ? $as[0] : "";
            $cc = isset($as[2]) ? $as[2] : "";
            $ca = isset($as[3]) ? $as[3] : "";
            if ($pa != "" && $cc != "") :   ?>
             <p>PATRIA ASISTENCIA TEL: 809-908-1234</p>
             <p>CASA DEL CONDUCTOR TEL: 809-381-2424</p>
         <?php elseif ($pa != "" && $ca != "") : ?>
             <p>PATRIA ASISTENCIA TEL: 809-908-1234</p>
             <p>CENTRO DEL AUTOMOVILISTA TEL: 809-565-8222</p>
         <?php elseif ($ca != "") : ?>
             <p>CENTRO DEL AUTOMOVILISTA TEL: 809-565-8222</p>

         <?php elseif ($pa != "") : ?>
             <p>PATRIA ASISTENCIA TEL: 809-908-1234</p>
         <?php elseif ($cc != "") : ?>
             <p>CASA DEL CONDUCTOR TEL: 809-381-2424</p>
         <?php endif; ?>
     </div>
 </div>