window.onload = main;

function main() {
    let boton = document.getElementById("btnConsultaFree");

    if (document.getElementById("btnNoticias") !== null) {
        document
            .getElementById("btnNoticias")
            .addEventListener("click", registrarCorreo);
    }

    if (boton != null) {
        boton.addEventListener("click", guardarDatos);
    }
}

function registrarCorreo(e) {
    e.preventDefault();

    let correo = document.getElementById("correoNoticias").value;

    if (correo !== "") {
        peticionNoticias(correo);
    } else {
        Swal.fire("Debe ingresar un correo");
    }
}

function peticionNoticias(correo) {
    const req = new XMLHttpRequest();
    const formData = new FormData();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    formData.append("correo", correo);

    req.open("POST", "/noticias");
    req.setRequestHeader("X-CSRF-TOKEN", token);

    req.addEventListener("load", function () {
        if (req.status === 422) {
            mensajeError("Tuvimos problemas al procesar la petición");
        } else if (req.status === 200) {
            Swal.fire(
                "Buen trabajo!",
                "Su correo se registro correctamente!",
                "success"
            ).then(() => location.reload());
        }
    });

    req.send(formData);
}

function guardarDatos() {
    //Aqui capturo los datos para poder hacer la peticion a archivo .php y guardarlos en la tabla
    let nombre = document.getElementById("nombre").value;
    let telefono = document.getElementById("telefono").value;
    let correo = document.getElementById("correo").value;
    let tipo = document.getElementById("tipoTratamiento").value;
    let mensaje = document.getElementById("mensaje").value;

    const peticion = new XMLHttpRequest();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    //Creamos un objeto de tipo formData, para poder enviar los datos del formulario en la peticion
    let formData = new FormData();

    //Mostrarmos spinner y ocultamos boton
    mostrarSpinner();
    ocultarBoton();

    formData.append("nombre", nombre);
    formData.append("telefono", telefono);
    formData.append("correo", correo);
    formData.append("tratamiento", tipo);
    formData.append("mensaje", mensaje);

    peticion.open("POST", "/consulta/");
    peticion.setRequestHeader("X-CSRF-TOKEN", token);

    peticion.addEventListener("load", function () {
        ocultarSpinner();
        mostrarBoton();

        if (peticion.status === 422) {
            mensajeError("Revise bien su información");
        } else if (peticion.status === 200) {
            mensajeCorrecto(
                "Tu consulta quedó registrada. Un colaborador te contactará a la brevedad!"
            );
            document.getElementById("formConsulta").reset();
        }
    });

    peticion.send(formData);
}

function mostrarSpinner() {
    document.getElementById("spinner").style.display = "block";
}

function mostrarBoton() {
    document.getElementById("btnConsultaFree").style.display = "block";
}

function ocultarSpinner() {
    document.getElementById("spinner").style.display = "none";
}

function ocultarBoton() {
    document.getElementById("btnConsultaFree").style.display = "none";
}

function mensajeError(mensaje) {
    Swal.fire("Datos incorrectos!", mensaje, "error");
}

function mensajeCorrecto(mensaje) {
    Swal.fire("Buen trabajo!", mensaje, "success");
}
