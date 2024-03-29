//animacion de los label en el formulario de registro principal
/* $("input").focus(function(e) {
        $(`.${e.target.parentElement.classList[0] } label`).css("top", "0%");
        console.log(e.target.parentElement.classList[0]);
    });

    $(".form__input__control").focusout(function(e) {
        $(".form__input__control label").css("top", "37%");

    }); 
*/


$(document).on("mouseenter", ".client__header button,#backDashboard,.toggle,.notification,.nav__loguot span", function (e) {


    tippy(e.target, {
        content: e.target.dataset.action,
        placement: "bottom",
        theme: 'material',
    });

});

let init_table = () => {
    $("#table").DataTable({
        destroy: true,
        scrollY: 200,
        order: [
            [0, 'desc']
        ],
        language: {
            url: `${location.origin}/src/js/datatable.spanish.json`
        }

    });
}

let init_date_picker = () => {
    $("#date_from,#date_until,#date_unt").datepicker({
        dateFormat: "dd-mm-yy",
        changeYear: true,
        changeMonth: true,
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"]
    });
}

init_table();

const baseUri = location.protocol + "//" + location.hostname + "/";
/* Registrar nuevos usuarios */

$(document).on("click", "#register", function (e) {
    var form = document.querySelector("body .form#registerUser");
    var data = new FormData(form);
    var company_code = $("#select_ensurance").val();
    if (!company_code) {
        Swal.fire({
            title: 'No ha elegido una empresa aseguradora',
            text: 'Por favor elija a que empresa de seguros representa.',
            icon: 'info',

        })
        return false;
    }
    data.append("company", company[company_code].company)
    data.append("company_logo", company[company_code].url)
    data.append("register", true)
    var empty = 0;
    $("#registerUser input").each(function (index, element) {

        if (element.type == "text" && element.value == "") {
            element.style.border = "1px solid red";
            empty++;
            return false
        } else {
            element.style.border = "1px solid #83879157";
        }

        if (element.type == "checkbox" && element.checked == false) {
            Swal.fire({
                title: 'Revise la información',
                text: 'Debe confirmar que toda su información es correcta y que ha leido los terminos de uso',
                icon: 'info',

            })
            empty++;
            return false;
        }
    });



    grecaptcha.ready(function () {

        grecaptcha.execute('6LfnN7EjAAAAAHPNkMPeGzxKIJVHIVkb0kukYPuK', { action: 'submit' }).then(function (token) {
            if (empty == 0) {
                $.ajax({
                    type: "POST",
                    url: "api/controller/signup.controller.php",
                    data,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                      //  console.log(res);
                        switch (res) {
                            case "1" || true:
                                $("#modal_loader").css("display", "none");
                                $(".overlay").css("display", "none");
                                Swal.fire({
                                    title: 'Tu registro ha sido exitoso',
                                    text: 'Se ha enviado un mensaje de confirmacion a tu dirección de correo',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {

                                    if (result.isConfirmed) {
                                        //cargar el loger
                                        location.href = baseUri + "signin"

                                    }
                                })




                                break;
                            case "A200":
                                Swal.fire({
                                    title: 'No se ha registrado tu cuenta',
                                    text: 'Al parecer los datos ya están registrados.',
                                    icon: 'info',
                                    footer: '<a href="">Crees que es un error?</a>'
                                })
                                break;
                            case "A201":
                                Swal.fire({
                                    title: 'Contraseña incorrecta',
                                    text: 'Por favor verifica los campos.',
                                    icon: 'error'

                                })
                                break;
                        }

                    }
                });
            }
        });
    });


});

//iniciar sesion
$(document).on("click", "#login", function (e) {
    var form = document.querySelector("body .form#registerUser");
    var data = new FormData(form);
    data.append("login", true)

    $.ajax({
        type: "POST",
        url: "api/controller/signin.controller.php",
        data,
        processData: false,
        contentType: false,
        success: function (res) {
            console.log(res);
            switch (res) {
                case "1" || true:
                    $("#modal_loader").css("display", "none");
                    $(".overlay").css("display", "none");

                    location.href = baseUri + "dashboard"




                    break;
                case "A201":
                    Swal.fire({
                        title: 'Información incorrecta',
                        text: 'La combinación de correo y contraseña no es válida',
                        icon: 'error',
                        footer: '<a href="">Olvidaste tu contraseña?</a>'
                    })
                    break;
                case "A200":
                    Swal.fire({
                        title: 'El usuario no existe',
                        text: 'Por favor verifica los campos.',
                        icon: 'error'

                    })
                    break;
            }

        }
    });


});

//para guardar los servicios adicionales
/* function(aditionalServices){

} */
var json = {};

/* $(document).on("click", "input.aditional_service", function(e) { //obtener la información del checkbox

    let val = $(e.target).val();

    if ($(e.target).prop("checked")) {
        var index = e.target.dataset.index
        json[index] = val;

    } else {

        var index = e.target.dataset.index
        json[index] = "";



    }


    // console.log(json); // ver INFO json

}); */

/* Calcula la fecha futura de la poliza */
function cal_date(days) {



    $.ajax({
        type: "POST",
        url: "api/controller/calDate.controller.php",
        data: {
            calDate: true,
            days

        },
        success: (res) => {
            //console.log(res);
            $("#date_until").val(res.trim());
        }

    });
}
/* Se añaden los guiones a la fecha */
$(document).on("keyup", ".date_info", function (e) {
    var text = $(e.target).val();
    var chars = text.length;
    var last = text[chars - 1];
    var key = e.keyCode;
    if (chars == 2 && last != "-" || chars == 5 && last != "-") {
        text += "-";
    }

    if (key != 8 && chars != 10) {
        $(e.target).val(text.substring(-1))
    }

});
/* Se añaden los guiones a la cedula */
$(document).on("keyup", ".form__input--cid", function (e) {
    var text = $(e.target).val();
    var chars = text.length;
    var last = text[chars - 1];
    var key = e.keyCode;
    if (chars == 3 && last != "-" || chars == 11 && last != "-") {
        text += "-";
    }

    var nextElement = e.target.nextElementSibling;

    if (key != 9) {
        $(e.target).val(text.substring(-1))
    }

    if (chars == 13) {
        $(nextElement).focus()
    }
});

/* Se añaden los guiones al telefono */
$(document).on("keyup", "input[type=tel]", function (e) {
    var text = $(e.target).val();
    var chars = text.length;
    var last = text[chars - 1];
    var key = e.keyCode;
    if (chars == 3 && last != "-" || chars == 7 && last != "-") {
        text += "-";
    }

    var nextElement = e.target.nextElementSibling;


    if (key != 9) { //verificar que LA TECLA NO SEA TAB
        $(e.target).val(text.substring(-1))
    }

    if (chars == 12) {
        $(nextElement).focus()
    }
});

function cal_amount(additional) { //se realizan los calculos las polizas
    var value = $("input[name=value]").val();
    var method = $("select[name=pay_method]").val();
    var time = $("select[name=time]").val();
    var initial = $("input[name=initial]").val() ? $("input[name=initial]").val() : 0;
    value = parseInt(value);
    initial = parseInt(initial);
    method = parseInt(method);
    time = parseInt(time);
    var added = check_additional_value();
    // console.log(additional);
    if (!isNaN(value) && !isNaN(method) && !isNaN(time)) {
        var total = 0
        var diff = 0
        var next = 0;

        switch (method) { //intercambiar total con el metodo
            case 1: //inicial 
                total = initial
                diff = parseInt((value - initial) + added);
                $(".form_control--initial,.form_control--time").css("display", "block");
                $(" .form_control--initial input.form__input--initial, .form_control--time select.form__input--time").attr("disabled", false);
                $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", false);
                if (time != 0) { next = parseFloat(diff / time); } else { next = parseFloat(diff) }
                cal_date(30);
                console.log("object");
                break;
            case 0: //total
                $("  .form_control--initial,.form_control--time").css("display", "none");
                $(" .form_control--initial input.form__input--initial, .form_control--time select.form__input--time").attr("disabled", true);
                $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", false);
                initial = 0;
                total = parseInt((value - initial) + added);
                diff = 0
                cal_date(360);
                break;
            case 2:
                $("  .form_control--initial,.form_control--time").css("display", "none");
                $(" .form_control--initial input.form__input--initial, .form_control--time select.form__input--time").attr("disabled", true);
                $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", true);
                //$(".form__control__checkbox__control input[type=checkbox]").prop("checked", false);



                break;
        }

        var formated_value = new Intl.NumberFormat('do-DO', { style: "currency", currency: "DOP" }).format(value)
        var formated_added = new Intl.NumberFormat('do-DO', { style: "currency", currency: "DOP" }).format(added) //adicional
        var formated_total = new Intl.NumberFormat('do-DO', { style: "currency", currency: "DOP" }).format(total)
        var formated_diff = new Intl.NumberFormat('do-DO', { style: "currency", currency: "DOP" }).format(diff)
        var formated_next = new Intl.NumberFormat('do-DO', { style: "currency", currency: "DOP" }).format(next)
        $("#value").text(`RD $ ${formated_value}`);
        $("#additionalValue").text(`RD $ ${formated_added}`);
        $("#total").text(`RD $ ${formated_total}`);
        $("#debt").text(`RD $ ${formated_diff}`);
        $("#nextPay").text(`RD $ ${formated_next}`);


    }


}

/* Se usa para calcular los valores adicionales seleccionados */

function check_additional_value() {
    var value = 0;
    $(".form__control__checkbox__control input[type='checkbox']").each(function (index, element) {
        if (element.checked) {
            value += parseInt(element.dataset.value);
        }


    });
    return value;
}

function verifyFormFields(form) {
    var count = 0;
    var done = true;
    $(form).each(function (index, element) {
        var value = element.value;
        var name = element.name;


        if (value == "" && name != "cid" && name != "car_id" && name != "plate" && name != "email") {

            $(element).css("border", "1px solid red");
            count++;
            done = false;
            return false;

        } else {
            $(element).css("border", "1px solid #83879157");
            done = true
            count--
        }


    });
    return done;
}

var totalAdditional = 0;
var additional = 0;
$(document).on("click", ".form__control__checkbox__control input[type=checkbox]", function (e) {
    var valueInData = e.target.dataset.value; //obtiene el precio
    var valueInInput = parseInt($("#additional-edit").val());
    additional = parseInt(valueInData ? valueInData : valueInInput)
    if (e.target.checked == true) {

        totalAdditional = totalAdditional + additional
    } else {
        totalAdditional = totalAdditional - additional
    }
    //console.log(totalAdditional);
    cal_amount(totalAdditional)
});


$(document).on("keyup", ".form__input", function (e) {
    var valueInInput = parseInt($("#additional-edit").val());
    var added = parseInt(totalAdditional != 0 ? totalAdditional : valueInInput)
    cal_amount(added)

});
$(document).on("change", "select", function (e) {
    /* Este se usa en caso de que la pagina sea recagada y necesite el valor adicional para editar o renovar */
    var valueInInput = parseInt($("#additional-edit").val());
    var added = parseInt(totalAdditional != 0 ? totalAdditional : valueInInput)
    cal_amount(added);

})
// se usar para asegurarse de que no se activen los checkbox sin numero de poliza
$(document).on("keyup", "input[name=policy_number]", function (e) {
    if (e.target.value == "") {
        $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", true);
    } else {
        $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", false);
    }



});

$(document).on("change", ".form__control__checkbox__control input[type=checkbox]", function (e) {

    var policynumber = $("input[name=policy_number]").val();
    var name = e.target.value;
    var value = e.target.dataset.value;
    var service_id = e.target.dataset.index;
    var data = {
        policynumber,
        name,
        value,
        service_id,
        addService: e.target.checked
    }
    //console.log(data);

    $.ajax({
        type: "POST",
        url: "api/controller/client.controller.php",
        data,
        success: function (res) {
            // console.log(res);
        }
    });
});

$(document).on("keypress", "form.addtionalServices", function (e) {

    if (e.keyCode == 13) { e.preventDefault(); }

});


$(document).on("click", function (e) {


    let cid;
    let car_plate;

    let target = e.target.id ? e.target.id : e.target.dataset.id;
    switch (target) {
        case "registerNewClient": //registrar nuevo cliente y su vehiculo
            var form = document.querySelector("body .form_new_register");
            var data = new FormData(form);
            data.append("newClient", true)
            var done = verifyFormFields("body .form_new_register input")

            if (done) {
                $.ajax({
                    type: "POST",
                    url: "api/controller/client.controller.php",
                    data,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        //     console.log(res);
                        switch (res) {
                            case "1" || true:
                                $("#modal_loader").css("display", "none");
                                $(".overlay").css("display", "none");

                                Swal.fire({
                                    title: 'Registro completado',
                                    text: '',
                                    icon: 'success'

                                })
                                viewLoader({
                                    title: "dashboard",
                                    path: "dashboard/dashboard.php",
                                    callback: init_table
                                })
                                $("#modal_loader").css("display", "none");
                                break;
                            case "CD1062":
                                Swal.fire({
                                    title: 'No se registró el cliente',
                                    text: 'Al parecer ya existe una persona registrada con esa cedula o correo que ingresaste',
                                    icon: 'info'
                                })
                                break;
                            case "VD1062":
                                Swal.fire({
                                    title: 'No se registró el vehiculo',
                                    text: 'Al parecer ya existe un vehiculo registrado con esa placa',
                                    icon: 'error',
                                    footer: `<a href="">Registra vehiculo a ${data.get('fname')} </a>`

                                })
                                break;
                            case "NV001":
                                Swal.fire({
                                    title: 'Error en el correo',
                                    text: 'Debe ingresar una dirección de correo válida',
                                    icon: 'error',


                                })
                                break;
                            case "CD1048":
                                Swal.fire({
                                    title: 'Error 1048',
                                    text: 'Intente reiniciar el sistema, si persiste el error comuniquese con soporte.',
                                    icon: 'error',


                                })
                                break;
                        }

                    }
                });
            }

            break;
        case "registerNewCar": //registrar nuevo vehiculo a un cliente

            var form = document.querySelector("body .form_new_register");
            var data = new FormData(form);
            cid = e.target.dataset.cid;
            data.append("cid", cid)
            data.append("registerNewCar", true)
            var done = verifyFormFields("body .form_control--newVehicle input")
            console.log(done);

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Registro completado',
                                text: '',
                                icon: 'success'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php"
                            })
                            break;
                        case "CD1062":
                            Swal.fire({
                                title: 'No se registró el cliente',
                                text: 'Al parecer ya existe una persona registrada con esa cedula o correo que ingresaste',
                                icon: 'info'
                            })
                            break;
                        case "VD1062":
                            Swal.fire({
                                title: 'No se registró el vehiculo',
                                text: 'Al parecer ya existe un vehiculo registrado con esa placa',
                                icon: 'error',
                                footer: `<a href="">Registra vehiculo a ${data.get('fname')} </a>`

                            })
                            break;
                        case "NV001":
                            Swal.fire({
                                title: 'Error en el correo',
                                text: 'Debe ingresar una dirección de correo válida',
                                icon: 'error',


                            })
                            break;
                        case "CD1048":
                            Swal.fire({
                                title: 'Error 1048',
                                text: 'Intente reiniciar el sistema, si persiste el error comuniquese con soporte.',
                                icon: 'error',


                            })
                            break;
                    }

                }
            });

            break;
        case "createPolicy": //registrar nueva poliza

            var form = document.querySelector("body form.form_new_policy");
            var data = new FormData(form);
            cid = e.target.dataset.cid_plate
            car_id = e.target.dataset.car_id
            var policynumber = data.get("policy_number");

            if (policynumber == "") {
                Swal.fire({
                    title: 'Error',
                    text: 'No se puede realizar esta acción sin numero de póliza',
                    icon: 'error'

                })
                return false;
            }
            // var done = verifyFormFields("body form.form_new_policy input")
            // var aditional = JSON.stringify(json, true)
            //console.log(aditional);
            data.append("car_id", car_id)
            data.append("cid", cid)
            data.append("aditional", "")



            data.set("totalAdditional", totalAdditional) //costo de los servicios adicionales
            data.append("newPolicy", true)

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Póliza registrada',
                                text: 'Ya el vehículo está asegurado',
                                icon: 'success'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",
                                params: `cid=${cid}`
                            })
                            break;

                        case "DP1062" || true: //poliza duplicada

                            Swal.fire({
                                title: 'Esta póliza o el vehiculo  ya están registrados',
                                text: 'Por favor verifica la información suministrada',
                                icon: 'info'

                            })

                            break;

                    }

                }
            });

            break;
        case "payDue": //pagar una cuota
            cid = e.target.dataset.paydue_cid;
            var dueid = e.target.dataset.dueid;
            var policynumber = e.target.dataset.policynumber;
            var data = {
                cid,
                dueid,
                policynumber,
                paydue: true
            }
            Swal.fire({
                title: 'Se aplicará un pago de una cuota',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aplicar pago'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "api/controller/client.controller.php",
                        data,

                        success: function (res) {
                            console.log(res);
                            switch (res) {
                                case "1":
                                    $("#modal_loader").css("display", "none");
                                    $(".overlay").css("display", "none");
                                    //se actualiza la vista de los clientes
                                    viewLoader({
                                        title: "client",
                                        path: "clients/client.php",
                                        params: `cid=${cid}`
                                    })
                                    break;
                            }
                        }
                    });

                    Swal.fire(
                        'Pago aplicado con éxito',
                        'Ya puedes imprimir la nueva póliza',
                        'success'
                    )
                }
            })
            break;
        case "partialPay": //pagar una parte de una cuota y poner el resto en la siguiente
            cid = e.target.dataset.paydue_cid;
            var dueid = e.target.dataset.dueid;
            var policynumber = e.target.dataset.policynumber;
            var data;
            Swal.fire({
                title: 'Ingresa el monto recibido',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Aplicar',
                showLoaderOnConfirm: true,
                preConfirm: (amount) => {
                    if (amount == "") {

                        Swal.showValidationMessage(
                            `Este campo no puede estar vacío`
                        )
                    }
                    data = {
                        cid,
                        dueid,
                        policynumber,
                        amount,
                        partialPay: true
                    }
                },

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "api/controller/client.controller.php",
                        data,

                        success: function (res) {
                            // console.log(res);

                            switch (res) {
                                case "1":
                                    $("#modal_loader").css("display", "none");
                                    $(".overlay").css("display", "none");
                                    //se actualiza la vista de los clientes
                                    viewLoader({
                                        title: "client",
                                        path: "clients/client.php",
                                        params: `cid=${cid}`
                                    })
                                    break;
                            }
                            Swal.fire(
                                'Pago parcial efectuado',
                                `El total pagado fue: RD $${data.amount}`,
                                'success'
                            )

                        }
                    });
                }
            })

            break;
        case "payoff": //saldar deudas
            cid = e.target.dataset.paydue_cid;
            var policynumber = e.target.dataset.policynumber;
            var data = {
                cid,
                policynumber,
                payoff: true
            }
            Swal.fire({
                title: 'Se saldán las deudas de la póliza',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Saldar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "api/controller/client.controller.php",
                        data,

                        success: function (res) {
                            switch (res) {
                                case "1":
                                    $("#modal_loader").css("display", "none");
                                    $(".overlay").css("display", "none");
                                    //se actualiza la vista de los clientes
                                    viewLoader({
                                        title: "client",
                                        path: "clients/client.php",
                                        params: `cid=${cid}`
                                    })
                                    break;
                            }
                        }
                    });

                    Swal.fire(
                        'El saldo fue realizado con éxito',
                        'Ya puedes imprimir la nueva póliza',
                        'success'
                    )
                }
            })
            break;
        case "savePolicy":
            var form = document.querySelector("body form.form_new_policy");
            var data = new FormData(form);
            cid = e.target.dataset.cid
            car_plate = e.target.dataset.car_plate


            // var aditional = JSON.stringify(json, true)
            //console.log(aditional);
            data.append("car_plate", car_plate)
            data.append("cid", cid)
            data.append("aditional", "")


            data.set("totalAdditional", check_additional_value()) //costo de los servicios adicionales
            data.append("savePolicy", true)
            var policy = data.get("policy_number");
            // console.log(totalAdditional);

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function (res) {
                    mustSave = false;

                    //console.log(res);
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Cambios realizados',
                                text: `La póliza numero ${policy} ha sido modificada`,
                                icon: 'success'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",
                                params: `cid=${cid}`,
                                callback: start_session("cid", cid)
                            })
                            break;

                        case "DP1062" || true: //poliza duplicada

                            Swal.fire({
                                title: 'Esta póliza o el vehiculo  ya están registrados',
                                text: 'Por favor verifica la información suministrada',
                                icon: 'info'

                            })

                            break;

                    }

                }
            });
            break;
        case "renewPolicy": //registrar nueva poliza
            var form = document.querySelector("body form.form_new_policy");
            var data = new FormData(form);
            policynumber = e.target.dataset.policynumber
            cid = e.target.dataset.cid
            data.append("cid", cid)
            data.append("policynumber", policynumber)
            data.append("renewPolicy", true)
            var done = verifyFormFields("body form.form_new_policy input")

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function (res) {
                    mustSave = false;
                    console.log(res);
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Póliza renovada',
                                text: 'Ya puedes imprimir el nuevo carnet',
                                icon: 'success'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",
                                params: `cid=${cid}`
                            })
                            break;

                        case "DP1062" || true: //poliza duplicada

                            Swal.fire({
                                title: 'Esta póliza o el vehiculo  ya están registrados',
                                text: 'Por favor verifica la información suministrada',
                                icon: 'info'

                            })

                            break;

                    }

                }
            });

            break;
        case "saveClientInfo": //editar informacion del cliente
            var form = document.querySelector("body .form_new_register");
            var data = new FormData(form);
            var newcid = data.get("newcid");
            // console.log(newcid);
            data.append("saveClientInfo", true)

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    mustSave = false;

                    switch (res) {
                        case "1":
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Cambios realizados',
                                text: '',
                                icon: 'success'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",
                                params: `cid=${newcid}`,
                                callback: start_session("cid", newcid)
                            })
                            break;
                        default:

                            Swal.fire({
                                title: 'Cambios no realizados',
                                text: 'Ha ocurrido un error, inténtalo de nuevo',
                                footer: 'Si el error persiste, contacta a soporte',
                                icon: 'error'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",

                            })
                            break;

                    }

                }
            });
            break
        case "saveCarInfo": //editar informacion del vehiculo

            var form = document.querySelector("body .form_new_register");
            var data = new FormData(form);
            cid = e.target.dataset.cid;
            data.append("cid", cid)
            data.append("saveCarInfo", true)

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function (res) {
                    console.log(res);
                    mustSave = false;
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Cambios realizados',
                                text: '',
                                icon: 'success'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",

                            })
                            break;

                        default:

                            Swal.fire({
                                title: 'Cambios no realizados',
                                text: 'Ha ocurrido un error, por favor verifica la información e inténtalo de nuevo',
                                footer: 'Si crees que se trata de un error, contacta a soporte',
                                icon: 'error'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",

                            })
                            break;

                    }

                }
            });
            break
        case "deletePolicy":
            cid = e.target.dataset.cid;
            var policynumber = e.target.dataset.policynumber;
            var policystatus = e.target.dataset.policystatus;
            var car_id = e.target.dataset.car_id;
            /* 
                        if (policystatus == 0) {
                            Swal.fire(
                                'Imposible realizar esta acción',
                                'No se puede eliminar una póliza que no existe.',
                                'info'
                            )
                            return false;
                        } */
            var data = {
                cid,
                policynumber,
                car_id,
                deletePolicy: true
            }

            Swal.fire({
                title: 'Seguro que quieres eliminar esta póliza?',
                text: "Esto no puede ser revertido a menos que la registres otra vez",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "api/controller/client.controller.php",
                        data: data,
                        //processData: false,
                        //contentType: false,
                        success: function (res) {
                            //    console.log(res);
                            switch (res) {
                                case "1" || true:
                                    $("#modal_loader").css("display", "none");
                                    $(".overlay").css("display", "none");

                                    Swal.fire({
                                        title: 'Póliza eliminada',
                                        text: '',
                                        icon: 'success'

                                    })
                                    viewLoader({
                                        title: "client",
                                        path: "clients/client.php",

                                    })
                                    break;

                                default:

                                    Swal.fire({
                                        title: "Acción no realizada",
                                        text: 'Ha ocurrido un error, inténtalo de nuevo',
                                        footer: 'Si el error persiste, contacta a soporte',
                                        icon: 'error'

                                    })
                                    viewLoader({
                                        title: "client",
                                        path: "clients/client.php",

                                    })
                                    break;

                            }

                        }
                    });

                    Swal.fire(
                        'Eliminada!',
                        'Todos los datos relacionados a esta póliza ha sido eliminados',
                        'success'
                    )
                }
            })



            break;

        case "deletecar":

            cid = e.target.dataset.cid;
            var policynumber = e.target.dataset.policynumber
            var car_id = e.target.dataset.car_id;
            /* 
                        if (policystatus == 0) {
                            Swal.fire(
                                'Imposible realizar esta acción',
                                'No se puede eliminar una póliza que no existe.',
                                'info'
                            )
                            return false;
                        } */
            var data = {
                cid,
                policynumber,
                car_id,
                deletecar: true
            }

            Swal.fire({
                title: 'Seguro que quieres eliminar este vehiculo?',
                text: "Esto no puede ser revertido a menos que la registres otra vez.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "api/controller/client.controller.php",
                        data: data,

                        success: function (res) {
                            //console.log(res);
                            switch (res) {
                                case "1" || true:
                                    $("#modal_loader").css("display", "none");
                                    $(".overlay").css("display", "none");

                                    Swal.fire({
                                        title: 'vehiculo eliminado',
                                        text: '',
                                        icon: 'success'

                                    })
                                    start_session("car_id", false)
                                    viewLoader({
                                        title: "client",
                                        path: "clients/client.php",
                                        params: `cid=${cid}`,


                                    })
                                    break;

                                default:

                                    Swal.fire({
                                        title: "Acción no realizada",
                                        text: 'Ha ocurrido un error, inténtalo de nuevo',
                                        footer: 'Si el error persiste, contacta a soporte',
                                        icon: 'error'

                                    })
                                    viewLoader({
                                        title: "client",
                                        path: "clients/client.php",

                                    })
                                    break;

                            }

                        }
                    });

                    Swal.fire(
                        'Eliminada!',
                        'Todos los datos relacionados a esta póliza ha sido eliminados',
                        'success'
                    )
                }
            })



            break;
        case "save_mantenaince":


            var form = document.querySelector("body form.add_mantenaince");
            var data = new FormData(form);
            cid = e.target.dataset.cid;
            var car_id = e.target.dataset.car_id;
            data.append("cid", cid)
            data.append("car_id", car_id)
            data.append("save_mantenaince", true)


            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data: data,
                processData: false,
                contentType: false,


                success: function (res) {
                    //console.log(res);
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Se agregó la fecha de mantenimiento',
                                text: '',
                                icon: 'success'

                            })
                            start_session("car_id", false)
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",
                                params: `cid=${cid}`,


                            })
                            break;

                        default:

                            Swal.fire({
                                title: "Acción no realizada",
                                text: 'Ha ocurrido un error, inténtalo de nuevo',
                                footer: 'Si el error persiste, contacta a soporte',
                                icon: 'error'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",

                            })
                            break;

                    }

                }
            });

            break;
        case "edit_mantenaince_info":
            var form = document.querySelector("body form.edit_mantenaince");
            var data = new FormData(form);
            cid = e.target.dataset.cid;
            var car_id = e.target.dataset.car_id;
            data.append("cid", cid)
            data.append("car_id", car_id)
            data.append("edit_mantenaince", true)


            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data: data,
                processData: false,
                contentType: false,


                success: function (res) {
                  //  console.log(res);
                    mustSave = false;
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Se ha editado la fecha de mantenimiento',
                                text: '',
                                icon: 'success'

                            })
                            start_session("car_id", false)
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",
                                params: `cid=${cid}`,


                            })
                            break;

                        default:

                            Swal.fire({
                                title: "Acción no realizada",
                                text: 'Ha ocurrido un error, inténtalo de nuevo',
                                footer: 'Si el error persiste, contacta a soporte',
                                icon: 'error'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",

                            })
                            break;

                    }

                }
            });


            break;
        case "remove_mantenaince":

            cid = e.target.dataset.cid;
            var car_id = e.target.dataset.car_id;

            var data = {
                cid,
                car_id,
                remove_mantenaince: true
            }

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data: data,


                success: function (res) {
                   // console.log(res);
                    switch (res) {
                        case "1" || true:
                            $("#modal_loader").css("display", "none");
                            $(".overlay").css("display", "none");

                            Swal.fire({
                                title: 'Se ha quitado la fecha de mantenimiento',
                                text: '',
                                icon: 'success'

                            })
                            start_session("car_id", false)
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",
                                params: `cid=${cid}`,


                            })
                            break;

                        default:

                            Swal.fire({
                                title: "Acción no realizada",
                                text: 'Ha ocurrido un error, inténtalo de nuevo',
                                footer: 'Si el error persiste, contacta a soporte',
                                icon: 'error'

                            })
                            viewLoader({
                                title: "client",
                                path: "clients/client.php",

                            })
                            break;

                    }

                }
            });


            break;
        case "notify-client":
            var cname = e.target.dataset.cname;
            car_plate = e.target.dataset.car_plate;
            var tel = "1" + e.target.dataset.tel;
            var message = e.target.dataset.message;
            var date_from = e.target.dataset.date_from;
            var date_until = e.target.dataset.date_until;
            var policynumber = e.target.dataset.policynumber;
            var msgType = message == "expired" ? "ha expirado" : "expira"

            //console.log(message);
            var msg = `Hola *${cname}*, Este es un comunicado para avisarle que la póliza de 
seguros *${policynumber}* asociada a la matricula *${car_plate}* ${msgType} el *${date_until}*, 
se le recomienda reactivar su seguro lo más pronto posible.\n
          
        
            `
            location.href = `whatsapp://send/?phone=${tel}&text=${msg}`
            //console.log(msg);
            break;
        /* Configuracion del sistema */
        case "save_config":

            var form = document.querySelector("body form.save_config");
            var data = new FormData(form);
            var id = e.target.dataset.id
            data.append("id", id)
            data.append("save_config", true)
            var pass = data.get("change_pass")
            var rpass = data.get("change_pass_r")

            if (pass != "" && rpass != "") {
                if (pass != rpass) {
                    Swal.fire({
                        title: 'Las contraseñas no coinciden',
                        text: 'Verifica los campos',
                        icon: 'error'

                    })
                    return false;
                }
            }
            $(".saving").css("display", "block");

            $.ajax({
                type: "POST",
                url: "api/controller/user.controller.php",
                data,
                contentType: false,
                processData: false,
                success: function (res) {
                    res = JSON.parse(res);
                    $(".saving").css("display", "none");
                    if (typeof (res) == "object") {
                        switch (res.status) {
                            case true:
                                $("body .nav__user").text(res.fname);
                                Swal.fire({
                                    title: 'Cambios realizados',
                                    text: '.....',
                                    icon: 'success'

                                })
                                break;

                        }
                    }


                }
            });


            break;

        case "addNewService":
            var form = document.querySelector("body form.addtionalServices");
            var data = new FormData(form);
            var id = e.target.dataset.id
            data.append("addNewService", true)

            if ($("input[name=service_name").val() == "" ||
                $("input[name=service_price").val() == "") {
                Swal.fire({
                    title: 'Ambos campos son requeridos',
                    text: '',
                    icon: 'info'
                })
                return false;

            }

            //  $(".saving").css("display", "block");

            $.ajax({
                type: "POST",
                url: "api/controller/user.controller.php",
                data,
                contentType: false,
                processData: false,
                success: function (res) {

                    //   $(".saving").css("display", "none");
                    //console.log(res);
                    $("input[name=service_name").val("");
                    $("input[name=service_price").val("");

                    switch (res) {
                        case "1":
                            viewLoader({
                                viewContainer: ".serviceAdded",
                                path: "configuration/additional_services.php",
                                callback: () => {
                                    init_table()
                                }
                            })
                            Swal.fire({
                                title: 'Nuevo servicio agregado',
                                text: '',
                                icon: 'success'
                            })
                            break;
                    }

                }
            });
            break;

        case "deleteService":
            var sid = e.target.dataset.sid; //id del servicio
            var data = {
                sid,
                deleteService: true
            }
            $.ajax({
                type: "POST",
                url: "api/controller/user.controller.php",
                data,

                success: function (res) {

                    //   $(".saving").css("display", "none");
                    // console.log(res);


                    switch (res) {
                        case "1":
                            viewLoader({
                                viewContainer: ".serviceAdded",
                                path: "configuration/additional_services.php",
                                callback: () => {
                                    init_table()
                                }

                            })
                            Swal.fire({
                                title: 'Servicio eliminado',
                                text: '',
                                icon: 'success'
                            })
                            break;
                    }

                }
            });
            break;


        case "updateService": //cargar los datos del servicio al formulario

            var sid = e.target.dataset.sid; //id del servicio
            var name = e.target.dataset.name; //id del servicio
            var value = e.target.dataset.value; //id del servicio
            $("input[name=service_name").val(name);
            $("input[name=service_price").val(value);
            $("#saveUpdateService").attr("data-sid", sid);
            $("#saveUpdateService").css("display", "block");
            $("#addNewService").css("display", "none");
            break;

        case "saveUpdateService": //Actualiza los servicios

            var form = document.querySelector("body form.addtionalServices");
            var data = new FormData(form);

            var sid = e.target.dataset.sid; //id del servicio
            data.append("sid", sid)
            data.append("saveUpdateService", true)

            if ($("input[name=service_name").val() == "" ||
                $("input[name=service_price").val() == "") {
                Swal.fire({
                    title: 'Ambos campos son requeridos',
                    text: '',
                    icon: 'info'
                })
                return false;

            }
            $.ajax({
                type: "POST",
                url: "api/controller/user.controller.php",
                data,
                processData: false,
                contentType: false,

                success: function (res) {


                    switch (res) {
                        case "1":
                            viewLoader({
                                viewContainer: ".serviceAdded",
                                path: "configuration/additional_services.php",
                                callback: () => {
                                    $("#saveUpdateService").css("display", "none");
                                    $("#addNewService").css("display", "block");
                                    $("input[name=service_name").val("");
                                    $("input[name=service_price").val("");
                                    init_table()
                                }
                            })
                            Swal.fire({
                                title: 'Servicio actualizado',
                                text: '',
                                icon: 'success'
                            })
                            break;
                    }

                }
            });
            break;


        /*Salir del sistema */

        case "logout":
            var data = {

                logout: true
            }


            $.ajax({
                type: "POST",
                url: "api/controller/session.controller.php",
                data: data,
                //processData: false,
                //contentType: false,
                success: function (res) {
                  //  console.log(res);

                    viewLoader({
                        title: "signin",
                        path: "signin/signin.php",
                        callback: () => {
                            /* location.reload() */
                            $(".nav").remove();

                        }

                    })
                }
            });
            break;
    }

});