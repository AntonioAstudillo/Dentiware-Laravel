window.onload = main;

function main() {
    llenarSelectTratamiento();

    let btnPaciente = document.getElementById("btnPaciente");
    let nombrePaciente = document.getElementById("nombrePaciente");
    let apellidoPaciente = document.getElementById("apellidoPaciente");
    let edad = document.getElementById("edadPaciente");
    let telefono = document.getElementById("telefonoPaciente");
    let domicilio = document.getElementById("domicilioPaciente");
    let correo = document.getElementById("correoPaciente");
    let genero = document.getElementById("generoPaciente");
    let fechaCita = document.getElementById("fechaCita");
    let horaCita = document.getElementById("horaCita");

    btnPaciente.onclick = enviarDatos;
    nombrePaciente.addEventListener("change", validarNombre);
    apellidoPaciente.addEventListener("change", validarNombre);
    genero.addEventListener("change", validarGenero);
    edad.addEventListener("change", validarEdad);
    telefono.addEventListener("change", validarTelefono);
    domicilio.addEventListener("change", validarDomicilio);
    correo.addEventListener("change", validarCorreo);
    document
        .getElementById("tratamientoPaciente")
        .addEventListener("change", llenarSelectDentista);
    fechaCita.addEventListener("change", validarFecha);
    horaCita.addEventListener("change", validarHora);
}

//modificamos el valor de los campos de horaCita y fechaCita
function cambiarValidacion() {
    if (document.getElementById("horaCita").classList.contains("is-valid")) {
        document.getElementById("horaCita").classList.remove("is-valid");
    }

    document.getElementById("horaCita").classList.add("is-invalid");

    if (document.getElementById("fechaCita").classList.contains("is-valid")) {
        document.getElementById("fechaCita").classList.remove("is-valid");
    }

    document.getElementById("fechaCita").classList.add("is-invalid");
}

function validarHora(e) {
    const valor = e.target.value;
    const aux = valor.split(":");

    if (aux[0] < 9 || aux[0] > 21) {
        if (
            document.getElementById("horaCita").classList.contains("is-valid")
        ) {
            document.getElementById("horaCita").classList.remove("is-valid");
        }

        document.getElementById("horaCita").classList.add("is-invalid");
    } else {
        if (
            document.getElementById("horaCita").classList.contains("is-invalid")
        ) {
            document.getElementById("horaCita").classList.remove("is-invalid");
        }

        document.getElementById("horaCita").classList.add("is-valid");
    }
}

function validarFecha() {
    let valor = document.getElementById("fechaCita").value;
    const day = new Date(valor);

    if (
        moment(valor).isBefore(moment().format("YYYY-MM-D")) ||
        day.getDay() === 6
    ) {
        if (
            document.getElementById("fechaCita").classList.contains("is-valid")
        ) {
            document.getElementById("fechaCita").classList.remove("is-valid");
        }

        document.getElementById("fechaCita").classList.add("is-invalid");
    } else {
        if (
            document
                .getElementById("fechaCita")
                .classList.contains("is-invalid")
        ) {
            document.getElementById("fechaCita").classList.remove("is-invalid");
        }

        document.getElementById("fechaCita").classList.add("is-valid");
    }
}

function validarNombre(e) {
    let expresion = /^(([a-zA-Z|ñ|Ñ|á|é|í|ó|ú|Á|É|Í|Ó|Ú]+)(\s)?){0,3}$/g;
    let valor = e.target.value;

    if (expresion.test(valor)) {
        if (!e.target.classList.contains("is-valid")) {
            if (e.target.classList.contains("is-invalid")) {
                e.target.classList.remove("is-invalid");
            }

            e.target.classList.add("is-valid");
        }
    } else {
        if (!e.target.classList.contains("is-invalid")) {
            if (e.target.classList.contains("is-valid")) {
                e.target.classList.remove("is-valid");
            }

            e.target.classList.add("is-invalid");
        }
    }
}

function validarEdad(e) {
    let expresion = /^([0-99]+)$/g;

    let valor = e.target.value;

    if (expresion.test(valor)) {
        if (!e.target.classList.contains("is-valid")) {
            if (e.target.classList.contains("is-invalid")) {
                e.target.classList.remove("is-invalid");
            }

            e.target.classList.add("is-valid");
        }
    } else {
        if (!e.target.classList.contains("is-invalid")) {
            if (e.target.classList.contains("is-valid")) {
                e.target.classList.remove("is-valid");
            }

            e.target.classList.add("is-invalid");
        }
    }
}

function validarTelefono(e) {
    let expresion = /^[0-9]{10}$/g;

    let valor = e.target.value;

    if (expresion.test(valor)) {
        if (!e.target.classList.contains("is-valid")) {
            if (e.target.classList.contains("is-invalid")) {
                e.target.classList.remove("is-invalid");
            }

            e.target.classList.add("is-valid");
        }
    } else {
        if (!e.target.classList.contains("is-invalid")) {
            if (e.target.classList.contains("is-valid")) {
                e.target.classList.remove("is-valid");
            }

            e.target.classList.add("is-invalid");
        }
    }
}

function validarDomicilio(e) {
    let expresion = /^([a-z|Ñ|ñ|A-Z|á|é|í|ó|ú|Á|É|Í|Ó|Ú|0-9#,]\s?)+$/g;

    let valor = e.target.value;

    if (expresion.test(valor)) {
        if (!e.target.classList.contains("is-valid")) {
            if (e.target.classList.contains("is-invalid")) {
                e.target.classList.remove("is-invalid");
            }

            e.target.classList.add("is-valid");
        }
    } else {
        if (!e.target.classList.contains("is-invalid")) {
            if (e.target.classList.contains("is-valid")) {
                e.target.classList.remove("is-valid");
            }

            e.target.classList.add("is-invalid");
        }
    }
}

function validarGenero() {
    let valor = document.getElementById("generoPaciente");

    if (valor.value == "N") {
        if (!valor.classList.contains("is-valid")) {
            valor.classList.add("is-invalid");
        } else {
            valor.classList.remove("is-valid");
        }

        valor.classList.add("is-invalid");
    } else {
        if (valor.classList.contains("is-invalid")) {
            valor.classList.remove("is-invalid");
        }

        valor.classList.add("is-valid");
    }
}

function validarCorreo(e) {
    let expresion =
        /^(([^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+(\.[^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+)*)|(\".+\")){2,63}@(hotmail.com|gmail.com|uteg.edu.mx|outlook.com)$/i;

    let valor = e.target.value;

    if (expresion.test(valor)) {
        if (!e.target.classList.contains("is-valid")) {
            if (e.target.classList.contains("is-invalid")) {
                e.target.classList.remove("is-invalid");
            }

            e.target.classList.add("is-valid");
        }
    } else {
        if (!e.target.classList.contains("is-invalid")) {
            if (e.target.classList.contains("is-valid")) {
                e.target.classList.remove("is-valid");
            }

            e.target.classList.add("is-invalid");
        }
    }
}

/**Aqui termina el bloque de funciones de  validaciones*/

/*Aqui comienza el bloque de funciones complementarias*/

/*En esta función, voy a llenar el select de tratamiento por medio de una peticion a la BD*/
function llenarSelectTratamiento() {
    //Instanciamos la clase XMLHttpRequest()
    let req = new XMLHttpRequest();
    let cadena =
        "<option selected disabled value = 'e'>Elige un tratamiento</option>";

    req.open("GET", "administrador/getTratamientos");

    req.onreadystatechange = function () {
        if (req.status == 200 && req.readyState == 4) {
            let valor = JSON.parse(req.responseText);

            for (let i = 0; i < valor.length; i++) {
                cadena += `<option value = "${i}">${valor[i]["nombre"]}</option>`;
            }

            document.getElementById("tratamientoPaciente").innerHTML = cadena;
        }
    };

    req.send(null);
} //cierra funcion llenarSelectTratamiento

/*Con esta funcion voy a limpiar los estilos del formulario. O sea, le voy a quitar la validation bootstrap*/
function limpiarEstilos() {
    let nombrePaciente = document.getElementById("nombrePaciente");
    let apellidoPaciente = document.getElementById("apellidoPaciente");
    let edad = document.getElementById("edadPaciente");
    let telefono = document.getElementById("telefonoPaciente");
    let domicilio = document.getElementById("domicilioPaciente");
    let correo = document.getElementById("correoPaciente");
    let genero = document.getElementById("generoPaciente");
    let fechaCita = document.getElementById("fechaCita");
    let horaCita = document.getElementById("horaCita");
    //is-invalid
    nombrePaciente.classList.contains("is-valid") ||
    nombrePaciente.classList.contains("is-invalid")
        ? nombrePaciente.classList.remove("is-valid", "is-invalid")
        : "";
    apellidoPaciente.classList.contains("is-valid") ||
    apellidoPaciente.classList.contains("is-invalid")
        ? apellidoPaciente.classList.remove("is-valid", "is-invalid")
        : "";
    edad.classList.contains("is-valid") || edad.classList.contains("is-invalid")
        ? edad.classList.remove("is-valid", "is-invalid")
        : "";
    telefono.classList.contains("is-valid") ||
    telefono.classList.contains("is-invalid")
        ? telefono.classList.remove("is-valid", "is-invalid")
        : "";
    domicilio.classList.contains("is-valid") ||
    domicilio.classList.contains("is-invalid")
        ? domicilio.classList.remove("is-valid", "is-invalid")
        : "";
    correo.classList.contains("is-valid") ||
    correo.classList.contains("is-invalid")
        ? correo.classList.remove("is-valid", "is-invalid")
        : "";
    genero.classList.contains("is-valid") ||
    genero.classList.contains("is-invalid")
        ? genero.classList.remove("is-valid", "is-invalid")
        : "";
    fechaCita.classList.contains("is-valid") ||
    fechaCita.classList.contains("is-invalid")
        ? fechaCita.classList.remove("is-valid", "is-invalid")
        : "";
    horaCita.classList.contains("is-valid") ||
    horaCita.classList.contains("is-invalid")
        ? horaCita.classList.remove("is-valid", "is-invalid")
        : "";
}

function llenarSelectDentista() {
    // Instanciamos la clase XMLHttpRequest()
    let req = new XMLHttpRequest();
    let cadena = "<option selected disabled>Elige un dentista</option>";
    let cargo = document.getElementById("tratamientoPaciente").value;

    req.open("GET", `llenarSelectDentista/${cargo}`);

    req.onreadystatechange = function () {
        if (req.status == 200 && req.readyState == 4) {
            let valor = JSON.parse(req.responseText);

            for (let i = 0; i < valor.length; i++) {
                cadena += `<option value = "${valor[i]["idPersona"]}">${valor[i]["nombre"]} ${valor[i]["apellidos"]}</option>`;
            }

            document.getElementById("dentistaPaciente").innerHTML = cadena;
        }
    };

    req.send();
}

function divErrorMostrar() {
    //quitamos la clase para poder visualizar el div
    document.getElementById("cajaError").classList.remove("errorDiv");
}

function divErrorEsconder() {
    //añadimos la clase para poder esconder el div
    document.getElementById("cajaError").classList.add("errorDiv");
}

function mensajeError(mensaje) {
    divErrorMostrar();
    document.getElementById("mensajeError").textContent = mensaje;
}

function mensajeRegistroGood() {
    Swal.fire(
        "Buen trabajo!",
        "El paciente se registró correctamente!",
        "success"
    ).then(function () {
        document.getElementById("formPaciente").reset();
        limpiarEstilos();
    });
}

//fechaCita  horaCita
//Antes de enviar los datos vamos a validar que los datos de la fecha y hora sean correctos
function validarHoraFecha() {
    const hora = document.getElementById("horaCita").value;
    const fecha = document.getElementById("fechaCita").value;
    const aux = hora.split(":");
    const day = new Date(fecha);

    if (!(aux[0] < 9 || aux[0] > 21)) {
        //ahora validamos la fecha
        if (
            !moment(fecha).isBefore(moment().format("YYYY-MM-D")) &&
            day.getDay() !== 6
        ) {
            return true;
        } else {
            document.getElementById("horaCita").classList.add("is-invalid");
            return false;
        }
    } else {
        document.getElementById("horaCita").classList.add("is-invalid");
        return false;
    }
}

/*
      En esta función, vamos a enviar los datos que el usuario haya ingresado en el formulario al controlador.
    */
function enviarDatos(e) {
    //bloqueamos el boton de registrar
    bloquearBtnRegistro();

    //Antes de enviar los datos, vamos a revisar que la cita y hora sean en dias correctos
    if (validarHoraFecha()) {
        let req = new XMLHttpRequest();
        let data = $("#formPaciente").serialize();
        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        req.open("POST", "/registraPaciente");
        req.setRequestHeader(
            "content-type",
            "application/x-www-form-urlencoded"
        );
        req.setRequestHeader("X-CSRF-TOKEN", token);

        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    divErrorEsconder();
                    mensajeRegistroGood();
                } else if (req.status === 500) {
                    divErrorEsconder();
                    mensajeError(
                        "Hubo un error al momento de procesar la solicitud"
                    );
                } else if (req.status === 422) {
                    let valor = JSON.parse(req.responseText);
                    valor.errors.forEach((element) => {
                        return mensajeError(element);
                    });
                }
            }
        };

        req.send(data);
    } else {
        mensajeError("Datos de la cita incorrectos");
    }

    desbloquearBtnRegistro();
    e.preventDefault();
}

function bloquearBtnRegistro() {
    document.getElementById("btnPaciente").disabled = true;
}

function desbloquearBtnRegistro() {
    document.getElementById("btnPaciente").disabled = false;
}
