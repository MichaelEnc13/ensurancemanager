 <?php
    include file_exists("api/model/autoload.php") ? "api/model/autoload.php" : "../../api/model/autoload.php";
    $cid = base64_decode($_GET['cid']);
    $car_id = $_GET['car_id'];
    $policynumber = Client::see_car_policy($car_id, $cid)['data']->fetch();
    $car_info = Client::see_client_cars($cid, $policynumber['car_plate'])['data']->fetch();
    $client = Client::see_client_info($cid)['data']->fetch();
    $services = Client::get_additional_services_actives($policynumber['policynumber'])['data']->fetchAll();
 
    /* Controla el posicionamiento de la informacion del carnet en la plantilla */
    $template_pos = Client::see_settings("template_pos")['data']->fetch();
    $positions = json_decode($template_pos['template_pos'],true);
    $posX = $positions['posX']."cm";
    $posY = $positions['posY']."cm";

    ?>


 <div class="policy_container" style="padding-left:<?php echo  $posX?>;padding-top:<?php echo  $posY?>">
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
//Si estos valores no se actualizan, significa que esos servicios no están en la póliza
$cc = false;
$ca = false;
$pa = false;
 
                foreach($services as $service ):

                    $serviceActive = Client::get_services_info($service['service_id'])['data']->fetch()['name']; 
                    if($serviceActive == "Patria asistencia" || $serviceActive == "PATRIA ASISTENCIA"  && $pa == false ): $pa = true;  ?>
                    
                        <p>PATRIA ASISTENCIA TEL: 809-908-1234</p>
                    <?php   endif; endforeach;?>



                    <?php foreach($services as $service ):
                      $serviceActive = Client::get_services_info($service['service_id'])['data']->fetch()['name']; 
                         if($serviceActive == "Casa del conductor" || $serviceActive == "CASA DEL CONDUCTOR" && $cc == false ): $cc = true; ?>
                            
                        <p>CASA DEL CONDUCTOR TEL: 809-381-2424</p>
                    
                    <?php   endif; endforeach; ?>



                        <?php foreach($services as $service ):
                          $serviceActive = Client::get_services_info($service['service_id'])['data']->fetch()['name']; 
                         if($serviceActive == "Centro del automovilista" || $serviceActive == "CENTRO DEL AUTOMOVILISTA"  && $ca == false && $cc == false  ):   $ca = true  ?>
                         
                        
                            <p>CENTRO DEL AUTOMOVILISTA TEL: 809-565-8222</p>

                            <?php endif;  endforeach; ?>
            

     
     </div>
 </div>