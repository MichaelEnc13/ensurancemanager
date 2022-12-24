<form id="form" class="form form_new_policy" onsubmit="return false">


    <div class="main__form__control">
        <div class="form_control">
            <label for="">No. póliza</label>
            <input type="text" class="form__input" name="policy_number" value="<?php echo $_GET['policynumber'] ?>" placeholder="No. de póliza">
        </div><!-- No. de póliza -->
        <div class="form_control">
            <label for="">Tipo de seguro</label>
            <select name="type">
                <option value="<?php echo $_GET['type'] ?>">
                    <?php
                    switch ($_GET['type']):
                        case "0":
                            echo "De ley";
                            break;
                        case "1":
                            echo "Semi-full";
                            break;
                        case "2":
                            echo "Full";
                            break;

                    endswitch;
                    ?>
                </option>
                <option value="">Tipo de seguro</option>
                <option value="0">De ley</option>
                <option value="1">semi-full</option>
                <option value="2">Full</option>
            </select>
        </div><!-- Tipo de seguro -->
        <div class="form_control">
            <label for="">Valor póliza</label>
            <input type="text" class="form__input" name="value" value="<?php echo $_GET['value'] ?>" placeholder="Valor ($ DOP)">
        </div><!-- Valor de poliza -->
        <div class="form_control">
            <label for="">Tipo de pago</label>
            <select name="pay_method">
                <option value="<?php echo $_GET['paymethod'] ?>">
                    <?php
                    switch ($_GET['paymethod']):
                        case "0":
                            echo "Total";
                            break;
                        case "1":
                            echo "Inicial";
                            break;


                    endswitch;
                    ?>
                </option>
                <option value="2">Tipo de pago</option>
                <option value="0">Total</option>
                <option value="1">Inicial</option>
            </select>
        </div><!-- Tipo de pago -->
        <div class="form_control form_control--initial">
            <label for="">Inicial</label>
            <input type="text" class="form__input form__input--initial" name="initial" value="<?php echo $_GET['initial'] ?>" placeholder="inicial ($ DOP)">
        </div><!-- Inicial -->
        <div class="form_control form_control--time">
            <label for="">Tiempo de pago</label>
            <select name="time" class="form__input--time">
                <option value="<?php echo $_GET['time'] ?>"> <?php
                                                                switch ($_GET['time']):
                                                                    case "0":
                                                                        echo "Tiempo de pago";
                                                                        break;
                                                                    case "1":
                                                                        echo "1 mes";
                                                                        break;
                                                                    case "2":
                                                                        echo "2 meses";
                                                                        break;
                                                                    case "3":
                                                                        echo "3 meses";
                                                                        break;


                                                                endswitch;
                                                                ?></option>
                <option value="0">Tiempo de pago</option>
                <option value="1">1 mes</option>
                <option value="2">2 meses</option>
                <option value="3">3 meses</option>
            </select>
        </div><!-- Tiempo de pago -->

  <!--       <div class="form__control form__control__selects">
            <input type="hidden" class="form__input" id="additional-edit" value="<?php echo $_GET['additional'] ?>" placeholder="Valor ($ DOP)">
            <input type="hidden" class="form__input" name="totalAdditional" value="<?php echo $_GET['additional'] ?>" placeholder="Valor ($ DOP)">
        </div> -->
    </div><!-- main__form__control -->


    <div class="form__control form__control--aditionalService">
        <div class="form__control__aditionalService__checkbox">
            <?php include "addtional_services.php" ?>
        </div>




    </div>

    <div class="client__info__group__container">
        <div class="client__info__group__data">
            <h4>Valor de la póliza</h4>
            <!-- <input type="text" class="form__input" name="policy_number" placeholder="No. de póliza"> -->
            <p id="value">RD $ 0 DOP</p>
        </div>
        <div class="client__info__group__data">
            <h4>Serv. adicionales</h4>
            <!-- <input type="text" class="form__input" name="policy_number" placeholder="No. de póliza"> -->
            <p id="additionalValue">RD $ 0 DOP</p>
        </div>
        <div class="client__info__group__data">
            <h4>Deuda total</h4>

            <p id="debt">RD $ 0 DOP</p>
        </div>
        <div class="client__info__group__data">
            <h4>Próximo pago:</h4>

            <p id="nextPay">RD $ 0 DOP</p>
        </div>

        <div class="client__info__group__data">
            <h4>Total a pagar</h4>
            <p id="total">RD $ 0 DOP</p>
        </div>

        <div class="client__info__group__data">
            <h4>Vigencia</h4>
            <!--             <p id="until"><span class="currentDate"><?php echo date("d-m-Y") ?></span> <span class="futureDate">/ xx-xx-xxxx</span></p>

 -->
            <div class="client__date__info">
                <div class="form_control">
                    <label for="">Desde</label>
                    <input type="text" name="date_from" id="date_from" class="date_info" value="<?php echo $_GET['date_from'] ?>" placeholder="xx-xx-xxxx">
                </div>
                <div class="form_control">
                    <label for="">Hasta</label>
                    <input type="text" name="date_until" id="date_unt" class="date_info" value="<?php echo $_GET['date_until'] ?>" placeholder="xx-xx-xxxx">

                </div>
            </div>
        </div>
    </div>

    <button class="btn btn--blue" id="savePolicy" data-cid="<?php echo $_GET['cid'] ?>" data-car_plate="<?php echo $_GET['car_plate'] ?>">Guardar cambios</button>

</form>