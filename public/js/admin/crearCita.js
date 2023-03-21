import { templateDataTable } from "./datatableTemplate.js";

window.onload = main;

function main() {
    cargarCitas();
}

function cargarCitas() {
    let columnas = [
        { data: "idPersona" },
        { data: "nombre" },
        { data: "edad" },
        { data: "correo" },
        { data: "telefono" },
        {
            defaultContent:
                "<button class='editar btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#cita'><i class='fas fa-plus'></i>",
        },
    ];

    const tabla = templateDataTable(
        columnas,
        "/administrador/getAllPacientes",
        "tablaCrearCita"
    );

    const obtener_data_editar = function (tbody, tabla) {
        let data;

        $(tbody).on("click", "tr", function () {
            data = tabla.row($(this)).data();
            let fechaCita = document.getElementById("fechaCita");
            let horaCita = document.getElementById("horaCita");

            //Llenamos elementos dentro del modal
            llenarSelectTratamiento();
            llenarNombrePaciente(data);

            fechaCita.addEventListener("change", validarFecha);
            horaCita.addEventListener("change", validarHora);

            //Generamos eventos
            document
                .getElementById("tratamientoPaciente")
                .addEventListener("change", llenarSelectDentista);
        });

        document
            .getElementById("btnGuardar")
            .addEventListener("click", function () {
                generarCita(data);
            });
    };

    obtener_data_editar("#tablaCrearCita", tabla);
} //cierra funcion cargaCitas

//Con este metodo lleno dentro del modal el nombre del paciente
function llenarNombrePaciente(data) {
    document.getElementById("nombrePaciente").value =
        data["nombre"] + " " + data["apellidos"];
}

/*En esta función, voy a llenar el select de tratamiento por medio de una peticion a la BD*/
function llenarSelectTratamiento() {
    //Instanciamos la clase XMLHttpRequest()
    let req = new XMLHttpRequest();
    let cadena =
        "<option selected disabled value = 'e'>Elige un tratamiento</option>";

    req.open("GET", "/administrador/getTratamientos");

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

    if (moment(valor).isBefore(moment().format("YYYY-MM-D"))) {
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

function llenarSelectDentista() {
    // Instanciamos la clase XMLHttpRequest()
    let req = new XMLHttpRequest();
    let cadena = "<option selected disabled>Elige un dentista</option>";
    let cargo = document.getElementById("tratamientoPaciente").value;

    req.open("GET", `/llenarSelectDentista/${cargo}`);

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

//Esta funcion me sirve para crear la cita y registrarla en la BD
function generarCita(data) {
    const req = new XMLHttpRequest();
    const formData = new FormData();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    //Agregamos los datos al objeto formData
    formData.append(
        "dentistaPaciente",
        document.getElementById("dentistaPaciente").value
    );
    formData.append(
        "tratamientoPaciente",
        document.getElementById("tratamientoPaciente").value
    );
    formData.append("fechaCita", document.getElementById("fechaCita").value);
    formData.append("horaCita", document.getElementById("horaCita").value);
    formData.append(
        "comentario",
        document.getElementById("comentariosPaciente").value
    );
    formData.append("idPaciente", data.idPersona);

    req.open("POST", "/administrador/crearCita");
    req.setRequestHeader("X-CSRF-TOKEN", token);

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            mensajeRegistroGood();
        } else if (req.status === 422) {
            mensajeError("Fecha ocupada");
        }
    };

    req.send(formData);
}

function mensajeError(mensaje) {
    Swal.fire({
        position: "top-end",
        icon: "error",
        title: mensaje,
        showConfirmButton: false,
        timer: 1500,
    });
}

function mensajeRegistroGood() {
    Swal.fire(
        "Buen trabajo!",
        "La cita se registró correctamente!",
        "success"
    ).then(function () {
        window.location.reload();
    });
}
