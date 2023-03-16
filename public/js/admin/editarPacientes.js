import { templateDataTable } from "./datatableTemplate.js";

$(document).ready(function () {
    let columnas = [
        { data: "idPersona" },
        { data: "nombre" },
        { data: "apellidos" },
        { data: "edad" },
        { data: "correo" },
        { data: "telefono" },
        { data: "direccion" },
        { data: "genero" },
        {
            defaultContent:
                "<button class='editar btn btn-warning btn-sm'><i class='fas fa-pencil-alt fa-sm'></i></button>",
        },
    ];

    //Mandamos a llamar al metodo donde se almacena la plantilla del datatable y lo que nos retorna se lo asignamos a tabla.
    let tabla = templateDataTable(
        columnas,
        "/administrador/getAllPacientes",
        "tablaPacientes"
    );

    const obtener_data_editar = function (tbody, tabla) {
        let data;

        $(tbody).on("click", "button.editar", function () {
            data = tabla.row($(this).parents("tr")).data();

            //mostramos modal
            $("#editUser").modal("show");

            //llenamos modal
            llenarFormulario(data);
        });
    };

    //Es una función con la cual obtengo los datos del registro asociados al boton editar que se presiono dentro del datatable.
    obtener_data_editar("#tablaPacientes", tabla);

    document.getElementById("btnCerrar").addEventListener("click", function () {
        $("#editUser").modal("hide");
    });

    //Le agregamos al boton de guardar el evento de click
    document
        .getElementById("btnGuardar")
        .addEventListener("click", function () {
            actualizarDatos();
        });
});

//Funciones
function actualizarDatos() {
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": token,
        },
    });

    $.ajax({
        url: "/administrador/actualizarDatosPaciente",
        type: "POST",
        data: {
            nombre: document.getElementById("nombre").value,
            apellidos: document.getElementById("apellidos").value,
            edad: document.getElementById("edad").value,
            telefono: document.getElementById("telefono").value,
            correo: document.getElementById("correo").value,
            direccion: document.getElementById("direccion").value,
            genero: document.getElementById("genero").value,
            id: document.getElementById("idUsuario").value,
        },
        success: function (data) {
            Swal.fire(
                "Buen trabajo!",
                "Los datos del paciente se modificaron correctamente!",
                "success"
            ).then();

            $("#editUser").modal("hide");
            const table = $("#tablaPacientes").DataTable();
            table.ajax.reload();
        },
        error: function (data) {
            Swal.fire("Error!", "No se pudo actualizar el paciente!", "error");
        },
    });
}

function llenarFormulario(data) {
    document.getElementById("nombre").value = data["nombre"];
    document.getElementById("apellidos").value = data["apellidos"];
    document.getElementById("edad").value = data["edad"];
    document.getElementById("telefono").value = data["telefono"];
    document.getElementById("correo").value = data["correo"];
    document.getElementById("direccion").value = data["direccion"];
    document.getElementById("idUsuario").value = data["idPersona"];

    if (data["genero"] == "M") {
        document.getElementById(
            "genero"
        ).innerHTML = `<option class="form-control" value="M" selected>Masculino</option>
         <option class="form-control" value="F">Femenino</option>`;
    } else {
        document.getElementById(
            "genero"
        ).innerHTML = `<option class="form-control" value="M">Masculino</option>
         <option class="form-control" value="F" selected>Femenino</option>`;
    }
}
