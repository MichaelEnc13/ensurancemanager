//carga de vistas
var globalTitle = "EnsuranceManage"

function viewLoader(viewData) {
    v = viewData
    var currentPage = location.pathname.substring(1);
    var title = v.title && v.modal != true ? v.title : currentPage;
    document.title = title ? "EnsuranceManage | " + title : "EnsuranceManage";
    var path = v.path ? v.path : console.warn("Se debe especificar la ruta de la vista");
    var params = v.params ? "?" + v.params : ""; //parametros si son necesarios
    var viewContainer = v.viewContainer ? v.viewContainer : "#viewLoader"; //Si no se especifica una vista, se carga por defecto
    var callback = v.callback; //funcion opcional 
    var modal = v.modal ? v.modal : false; //decidir si la vista es modal o no
    var modalTitle = v.modalTitle ? v.modalTitle : ""; //titulo de la vista modal

    if (modal) { //mostrar las modales si es necesario
        $("#modal__header__title").text(modalTitle);
        $("#modal_loader").css("display", "block");
        $(".overlay").css("display", "block");
    } else {
        $(".spinner").addClass("spinner-show");

    }


    $(viewContainer).load(`views/${path}${params}`, function(res) { //cargar la vista 
        if (typeof(callback) == "function") { callback(); }

        $(".spinner").removeClass("spinner-show");

    });

    //var query = params == "" && modal == true ? location.search : params;
    history.replaceState(null, "", title)


}

const start_session = (session_name, session_value) => {
    $.ajax({
        type: "POST",
        url: "api/controller/session.controller.php",
        data: { newSession: true, session_name: session_name, session_value: session_value }

    });

}

const stop_session = (session_name) => { //detiene las session especificada en el parametro
    $.ajax({
        type: "POST",
        url: "api/controller/session.controller.php",
        data: { stopSession: true, session_name: session_name }

    });

}

/* Con esta función se extran los servicios adicionales de las polizas registras
y las marca en la vista
*/
const get_additional_service = (car_plate, cid) => {
        $.ajax({
            type: "POST",
            url: "api/controller/client.controller.php",
            data: { additionalService: true, car_plate, cid },
            success: function(res) {
                var additionalService = JSON.parse(res); //parseo el JSON

                var asvalues = Object.keys(additionalService).values(); //Convierte el objeto en un array

                for (const iterator of asvalues) { //se leen los index
                    if (additionalService[iterator] != "") { //se verifica que lo index tenga algún valor
                        $(`input[type=checkbox][data-index=${iterator}]`).prop("checked", true)
                    }

                    //json[iterator] = $(`input[type=checkbox][data-index=${iterator}]`).val();
                    // console.log(json);
                    // console.log(additionalService[iterator]);
                }


            }

        });
    }
    /* 
        Elegir el vehiculo con su matricula,
        se inicia una session para mantener la informacion activa

    */
const findCarPlate = (car_plate) => {
    var car_plate = car_plate;
    start_session("car_plate", car_plate);
    viewLoader({
            title: "client",
            path: "clients/client.php"
        })
        // console.log(car_plate);
}

$(document).on("change", "#select-client-vehicle", function(e) { //select placas de clientes

    findCarPlate(e.target.value);

});



$("body").on("click", function(e) {
    let cid = e.target.dataset.cid;
    let actionId = e.target.id ? e.target.id : e.target.parentElement.id
    switch (actionId) {
        case "loadLogin": ///cargar login
            viewLoader({
                title: "signin",
                path: "signin/signin.php",


            })
            break;
        case "loadRegister": //cargar registro

            viewLoader({
                title: "signup",
                path: "signup/signup.php",


            })
            break;
            /* Acciones para dashboard */
        case "backDashboard":
            viewLoader({
                title: "dashboard",
                path: "dashboard/dashboard.php",
                callback: () => {
                    init_table();
                    stop_session("cid");
                    stop_session("car_plate");
                }
            })
            break;
        case "getExpired":
            viewLoader({
                title: "dashboard",
                path: "dashboard/tb_expired.php",
                viewContainer: ".table_container",
                callback: () => {
                    init_table();

                }
            })
            break;
        case "getExpireSoon":
            viewLoader({
                title: "dashboard",
                path: "dashboard/tb_exp_soon.php",
                viewContainer: ".table_container",
                callback: () => {
                    init_table();

                }
            })
            break;
        case "getClients":

            viewLoader({
                title: "dashboard",
                path: "dashboard/tb_clients.php",
                viewContainer: ".table_container",
                callback: () => {
                    init_table();

                }
            })
            break;
        case "getActive":
            viewLoader({
                title: "dashboard",
                path: "dashboard/tb_active.php",
                viewContainer: ".table_container",
                callback: () => {
                    init_table();

                }
            })
            break;
        case "modal__header__close": //cerrar las modales
            $("#modal__header__title").text("");
            $("#modal_loader,.overlay").css("display", "none");

            break;
        case "overlay": //cerrar las modales y overlay
            $("#modal__header__title").text("");
            $("#modal_loader,.overlay").css("display", "none");

            break;
        case "newClient": //agregar nuevo cliente
            viewLoader({
                title: "Nuevo cliente",
                viewContainer: "#modal__loader__body",
                path: "clients/new_client.modal.php",
                modal: true,
                modalTitle: "Nuevo cliente"


            })

            break;
        case "sendAlert": //Enviar alerta a clientes
            viewLoader({
                title: "Enviar alerta",
                viewContainer: "#modal__loader__body",
                path: "clients/sendAlert.php",
                modal: true,
                modalTitle: "Enviar alerta a clientes"


            })

            break;
            /* ACCIONES PARA LA INFORMACION DEL CLIENTE */
        case "view-client-info":
            viewLoader({
                title: "client",
                path: "clients/client.php",
                params: `cid=${cid}`,
                callback: start_session("cid", cid)
            })
            break;
        case "newCar":
            viewLoader({
                title: "Nuevo vehiculo",
                viewContainer: "#modal__loader__body",
                path: "clients/new_client.modal.php",
                modal: true,
                params: "newcar",
                modalTitle: "Agregar nuevo vehiculo",
                callback: () => {
                    $("#registerNewCar").attr("data-cid", cid);
                }

            })





            break;
        case "addPolicy":
            viewLoader({
                title: "new policy",
                path: "clients/newPolicy.modal.php",
                viewContainer: "#modal__loader__body",
                modal: true,
                modalTitle: "Activar póliza de seguro",
                callback: () => {
                    let cid = e.target.dataset.cid_plate
                    let car_plate = e.target.dataset.car_plate
                    $("#createPolicy").attr("data-cid_plate", cid);
                    $("#createPolicy").attr("data-car_plate", car_plate);
                }
            })
            break;
        case "editClient": //editar la informacion del cliente
            cid = e.target.dataset.cid;

            viewLoader({
                title: "Edit vehicle",
                path: "clients/new_client.modal.php",
                modal: true,
                viewContainer: "#modal__loader__body",
                params: `editClient&cid=${cid}&carPlate=${car_plate}`
            })
            break;
        case "editCar": //editar la informacion del vehiculo
            cid = e.target.dataset.cid;
            car_plate = e.target.dataset.car_plate;
            viewLoader({
                title: "Edit vehicle",
                path: "clients/new_client.modal.php",
                modal: true,
                viewContainer: "#modal__loader__body",
                params: `editCar&cid=${cid}&car_plate=${car_plate}`
            })
            break;
        case "editPolicy":
            var policynumber = e.target.dataset.policynumber
            var car_plate = e.target.dataset.car_plate
            var paymethod = e.target.dataset.paymethod
            var type = e.target.dataset.type
            var value = e.target.dataset.value
            var additional = e.target.dataset.additional
            var date_from = e.target.dataset.date_from
            var date_until = e.target.dataset.date_until

            if (policynumber == "") { //asegurarse de que existe la póliza
                Swal.fire(
                    'No se pudo realizar esta acción',
                    'Asegurate de que esta póliza esté registrada',
                    'info'
                )
                return false;
            }
            //    console.log(policynumber, paymethod, type, value);
            viewLoader({
                title: "edit policy",
                path: "clients/newPolicy.modal.php",
                viewContainer: "#modal__loader__body",
                modal: true,
                params: `editPolicy=true&policynumber=${policynumber}&paymethod=${paymethod}&type=${type}&value=${value}&additional=${additional}&cid=${cid}&car_plate=${car_plate}&date_from=${date_from}&date_until=${date_until}`,
                modalTitle: "Editar póliza de seguro",
                callback: () => {
                    var valueInInput = parseInt($("#additional-edit").val());
                    // cal_amount(valueInInput);
                    $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", false);
                    get_additional_service(car_plate, cid)

                }

            })

            break;
        case "renew":
            cid = e.target.dataset.cid
            var policynumber = e.target.dataset.policynumber
            car_plate = e.target.dataset.car_plate
            var paymethod = e.target.dataset.paymethod
            var type = e.target.dataset.type
            var value = e.target.dataset.value
            var valueserv = e.target.dataset.valueserv
            if (policynumber == "") { //asegurarse de que existe la póliza
                Swal.fire(
                    'No se pudo realizar esta acción',
                    'Asegurate de que esta póliza esté registrada',
                    'info'
                )
                return false;
            }

            viewLoader({
                title: "renew policy",
                path: "clients/newPolicy.modal.php",
                viewContainer: "#modal__loader__body",
                modal: true,
                params: `renew=true&policynumber=${policynumber}&paymethod=${paymethod}&type=${type}&value=${value}&valueserv=${valueserv}`,
                modalTitle: "Renovar póliza de seguro",
                callback: () => {
                    var valueInInput = parseInt($("#additional-edit").val());

                    cal_amount(valueInInput);
                    get_additional_service(car_plate, cid)
                    $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", true);
                    $("#renewPolicy").attr("data-policynumber", policynumber);
                    $("#renewPolicy").attr("data-cid", cid.trim());

                }
            })

            break;
        case "printPolicy":
            var car_plate = e.target.dataset.car_plate
            var policynumber = e.target.dataset.policynumber
            var policystatus = parseInt(e.target.dataset.policystatus)
            if (policystatus > 0) {


                if (policynumber == "") { //asegurarse de que existe la póliza
                    Swal.fire(
                        'No se pudo realizar esta acción',
                        'Asegurate de que este vehiculo posea una póliza registrada',
                        'info'
                    )
                    return false;
                }
                viewLoader({
                    viewContainer: "#globalPrinting",
                    path: "clients/print.policy.php",
                    params: `cid=${cid}&car_plate=${car_plate}&policynumber=${policynumber}`,
                    callback: () => {
                        print();

                    }
                })

            } else {
                Swal.fire(
                    'No se pudo realizar esta acción',
                    'Las pólizas expiradas no pueden ser impresas',
                    'info'
                )


            }
            break;
        case "view-client-car-info":

            viewLoader({
                    title: "client",
                    path: "clients/client.php",
                    params: `cid=${cid}`,
                    callback: () => {
                        start_session("cid", cid)
                        findCarPlate(e.target.dataset.car_plate)
                    }


                })
                //start_session("cid", cid)


            break;

    }


});

/*
window.addEventListener("afterprint", function(event) {
    console.log(event);
}); */