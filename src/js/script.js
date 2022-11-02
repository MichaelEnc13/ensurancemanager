//animacion de los label en el formulario de registro principal
/* $("input").focus(function(e) {
    $(`.${e.target.parentElement.classList[0] } label`).css("top", "0%");
    console.log(e.target.parentElement.classList[0]);
});

$(".form__input__control").focusout(function(e) {
    $(".form__input__control label").css("top", "37%");

}); */


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



init_table();

const baseUri = location.protocol + "//" + location.hostname + "/";
/* Registrar nuevos usuarios */

$(document).on("click", "#register", function(e) {
    var form = document.querySelector("body .form#registerUser");
    var data = new FormData(form);
    var company_code = $("#select_ensurance").val();
    data.append("company", company[company_code].company)
    data.append("company_logo", company[company_code].url)
    data.append("register", true)

    $.ajax({
        type: "POST",
        url: "api/controller/signup.controller.php",
        data,
        processData: false,
        contentType: false,
        success: function(res) {
            console.log(res);
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


});

//iniciar sesion
$(document).on("click", "#login", function(e) {
    var form = document.querySelector("body .form#registerUser");
    var data = new FormData(form);
    data.append("login", true)

    $.ajax({
        type: "POST",
        url: "api/controller/signin.controller.php",
        data,
        processData: false,
        contentType: false,
        success: function(res) {
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

$(document).on("click", "input.aditional_service", function(e) { //obtener la información del checkbox

    let val = $(e.target).val();

    if ($(e.target).prop("checked")) {
        var index = e.target.dataset.index
        json[index] = val;

    } else {

        var index = e.target.dataset.index
        json[index] = "";


    }
    // console.log(json); // ver INFO json

});

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
$(document).on("keyup", ".date_info", function(e) {
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
$(document).on("keyup", ".form__input--cid", function(e) {
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
$(document).on("keyup", "input[type=tel]", function(e) {
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
    var added = additional ? additional : 0;
    //console.log(added);
    if (!isNaN(value) && !isNaN(method) && !isNaN(time)) {
        var total = 0
        var diff = 0
        var next = 0;

        switch (method) { //intercambiar total con el metodo
            case 1: //inicial 
                total = initial
                diff = parseInt((value - initial) + added);
                $("input.form__input--initial,select.form__input--time").css("display", "block");
                $(" input.form__input--initial, select.form__input--time").attr("disabled", false);
                $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", false);
                if (time != 0) { next = parseFloat(diff / time); } else { next = parseFloat(diff) }
                cal_date(30);
                break;
            case 0: //total
                $(" input.form__input--initial, select.form__input--time").css("display", "none");
                $(" input.form__input--initial, select.form__input--time").attr("disabled", true);
                $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", false);
                initial = 0;
                total = parseInt((value - initial) + added);
                diff = 0
                cal_date(360);
                break;
            case 2:
                $(" input.form__input--initial,select.form__input--time").css("display", "none");
                $(" input.form__input--initial, select.form__input--time").attr("disabled", true);
                $(".form__control__checkbox__control input[type=checkbox]").prop("disabled", true);
                //$(".form__control__checkbox__control input[type=checkbox]").prop("checked", false);



                break;
        }

        var formated_value = new Intl.NumberFormat('do-DO', { style: "currency", currency: "DOP" }).format(value)
        var formated_added = new Intl.NumberFormat('do-DO', { style: "currency", currency: "DOP" }).format(added)
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


function verifyFormFields(form) {
    var count = 0;
    var done = true;
    $(form).each(function(index, element) {
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
$(document).on("click", ".form__control__checkbox__control input[type=checkbox]", function(e) {
    var valueInData = e.target.dataset.value;
    var valueInInput = parseInt($("#additional-edit").val());
    additional = parseInt(valueInData ? valueInData : valueInInput)
    if (e.target.checked == true) {

        totalAdditional = totalAdditional + additional
    } else {
        totalAdditional = totalAdditional - additional
    }
    cal_amount(totalAdditional)
});


$(document).on("keyup", ".form__input", function(e) {
    var valueInInput = parseInt($("#additional-edit").val());
    var added = parseInt(totalAdditional != 0 ? totalAdditional : valueInInput)
    cal_amount(added)

});
$(document).on("change", ".form__control__selects select", function(e) {
    /* Este se usa en caso de que la pagina sea recagada y necesite el valor adicional para editar o renovar */
    var valueInInput = parseInt($("#additional-edit").val());
    var added = parseInt(totalAdditional != 0 ? totalAdditional : valueInInput)
    cal_amount(added);

})

$(document).on("click", function(e) {


    let cid;
    let car_plate;
    switch (e.target.id) {
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
                    success: function(res) {
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
                success: function(res) {
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
            var aditional = JSON.stringify(json, true)
                //console.log(aditional);
            data.append("car_id", car_id)
            data.append("cid", cid)
            data.append("aditional", aditional)



            data.set("totalAdditional", totalAdditional) //costo de los servicios adicionales
            data.append("newPolicy", true)

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function(res) {
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

                        success: function(res) {
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

                        success: function(res) {
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


            var aditional = JSON.stringify(json, true)
                //console.log(aditional);
            data.append("car_plate", car_plate)
            data.append("cid", cid)
            data.append("aditional", aditional)


            data.set("totalAdditional", totalAdditional > 0 ? totalAdditional : 0) //costo de los servicios adicionales
            data.append("savePolicy", true)
            var policy = data.get("policy_number");

            $.ajax({
                type: "POST",
                url: "api/controller/client.controller.php",
                data,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);
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
                success: function(res) {
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
                success: function(res) {
                    console.log(res);

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
                success: function(res) {
                    console.log(res);
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
                        success: function(res) {
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

                        success: function(res) {
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
                success: function(res) {
                    console.log(res);

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