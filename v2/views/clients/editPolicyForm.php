<form id="form" class="form form_new_policy" onsubmit="return false">


    <div class="form__control">
        <input type="text" class="form__input" name="policy_number" value="<?php echo $_GET['policynumber'] ?>" placeholder="No. de póliza">

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
    </div>
    <div class="form__control form__control__selects">
        <input type="text" class="form__input" name="value" value="<?php echo $_GET['value'] ?>" placeholder="Valor ($ DOP)">
        <input type="text" class="form__input" id="additional-edit" value="<?php echo $_GET['additional'] ?>" placeholder="Valor ($ DOP)">
        <input type="hidden" class="form__input" name="totalAdditional" value="<?php echo $_GET['additional'] ?>" placeholder="Valor ($ DOP)">

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
        <input type="text" class="form__input form__input--initial" name="initial" placeholder="inicial ($ DOP)">
        <select name="time" class="form__input--time">
            <option value="0">Tiempo de pago</option>
            <option value="1">1 mes</option>
            <option value="2">2 meses</option>
            <option value="3">3 meses</option>
        </select>


    </div>
    <div class="form__control form__control--aditionalService">
    <div class="form__control__aditionalService__checkbox">
            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="520" data-index="0" value="Patria asistencia" class="aditional_service " disabled>
                <label>Patria asistencia (RD $520.00)</label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" id="checkbox" data-value="1500" data-index="1" value="Patria asistencia plus" class="aditional_service " disabled>
                <label>Patria asistencia plus (RD $ 1,500.00)</label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="1500" data-index="2" value="Casa del conductor" class="aditional_service" disabled>
                <label>Casa del conductor (RD $ 1,500)</label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="1300" data-index="3" value="Centro del automovilista" class="aditional_service" disabled>
                <label>Centro del automovilista (RD $ 1,300.00)</label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="1700" data-index="4" value="Servicio de averia mecánica" class="aditional_service" disabled>
                <label>Servicio de averia mecánica (RD $ 1,700.00) <label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="150" data-index="5" value="Gruas plus" class="aditional_service" disabled>
                <label>Gruas plus (RD $ 1500.00)</label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="900" data-index="6" value="Aero ambulancia" class="aditional_service" disabled>
                <label>Aero ambulancia (RD $ 900.00)</label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="100" data-index="7" value="Moto salud" class="aditional_service" disabled>
                <label>Moto salud (solo motores) (RD $ 100.00)</label>
            </div>


            <div class="form__control__checkbox__control">
                <input type="checkbox" data-value="90" data-index="8" value="Gastos funerarios al conductor" class="aditional_service" disabled>
                <label>Gastos funerarios al conductor (RD $ 90.00)</label>
            </div>


        </div>




    </div>

    <div class="client__info__group__container">
        <div class="client__info__group__data">
            <h4>Valor de la póliza</h4>
            <!-- <input type="text" class="form__input" name="policy_number" placeholder="No. de póliza"> -->
            <p id="value">RD $ 0 DOP</p>
        </div>
        <div class="client__info__group__data">
            <h4>Costo de servicios adicionales</h4>
            <!-- <input type="text" class="form__input" name="policy_number" placeholder="No. de póliza"> -->
            <p id="additionalValue">RD $ 0 DOP</p>
        </div>
        <div class="client__info__group__data">
            <h4>Deuda total</h4>

            <p id="debt">RD $ 0 DOP</p>
        </div>
        <div class="client__info__group__data">
            <h4>Próximo pago de:</h4>

            <p id="nextPay">RD $ 0 DOP</p>
        </div>
        <div class="client__info__group__data">
            <h4>Vigencia</h4>
            <!--             <p id="until"><span class="currentDate"><?php echo date("d-m-Y") ?></span> <span class="futureDate">/ xx-xx-xxxx</span></p>

 -->
            <div class="client__date__info">
                <label for="">Desde</label>
                <input type="text" name="date_from" id="date_from" class="date_info" value="<?php echo $_GET['date_from'] ?>" placeholder="xx-xx-xxxx">
                <label for="">Hasta</label>
                <input type="text" name="date_until" id="date_unt" class="date_info" value="<?php echo $_GET['date_until'] ?>" placeholder="xx-xx-xxxx">
            </div>
        </div>
        <div class="client__info__group__data">
            <h4>Total a pagar</h4>
            <p id="total">RD $ 0 DOP</p>
        </div>
    </div>

    <button class="btn btn--blue" id="savePolicy" data-cid="<?php echo $_GET['cid'] ?>" data-car_plate="<?php echo $_GET['car_plate'] ?>">Guardar cambios</button>

</form>