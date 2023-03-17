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
                "<button class='eliminar btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteUser'><i class='fas fa-trash-alt'></i></button>",
        },
    ];

    //Mandamos a llamar al metodo donde se almacena la plantilla del datatable y lo que nos retorna se lo asignamos a tabla.
    let tabla = templateDataTable(
        columnas,
        "/administrador/getAllPacientes",
        "tablaPacientes"
    );

    const obtener_data_editar = function (tbody, tabla) {
        $(tbody).on("click", "tr", function () {
            let data = tabla.row($(this)).data();

            document.getElementById("idPaciente").value = data["idPersona"];
        });

        document
            .getElementById("btnEliminar")
            .addEventListener("click", function () {
                eliminarPaciente();
            });
    };

    //Esta funcion es importante, ya que con ella yo puedo acceder al evento de eliminar Paciente
    obtener_data_editar("#tablaPacientes", tabla);
});

function eliminarPaciente() {
    const idPaciente = document.getElementById("idPaciente").value;

    $("#deleteUser").modal("hide");

    $.ajax({
        url: `/administrador/deletePaciente/${idPaciente}`,
        type: "get",

        success: function (data) {
            Swal.fire(
                "Buen trabajo!",
                "Los datos del paciente se eliminaron correctamente!",
                "success"
            ).then(function () {
                const table = $("#tablaPacientes").DataTable();
                table.ajax.reload();
            });
        },
        error: function () {
            Swal.fire(
                "Ups!",
                "Los datos del paciente no se pudieron eliminar!",
                "error"
            );
        },
    });
}
