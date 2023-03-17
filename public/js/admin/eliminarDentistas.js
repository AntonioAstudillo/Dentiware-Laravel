import { templateDataTable } from "./datatableTemplate.js";

$(document).ready(function () {
    const columnas = [
        { data: "idPersona" },
        { data: "nombre" },
        { data: "apellidos" },
        { data: "edad" },
        { data: "telefono" },
        { data: "correo" },
        { data: "direccion" },
        { data: "genero" },
        {
            defaultContent:
                "<button class='eliminar btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteUser'><i class='fas fa-trash-alt'></i></button>",
        },
    ];

    const tabla = templateDataTable(
        columnas,
        "/administrador/getAllDentistas",
        "tablaPacientes"
    );

    const obtener_data_editar = function (tbody, tabla) {
        $(tbody).on("click", "tr", function () {
            let data = tabla.row($(this)).data();
            document.getElementById("idDentista").value = data["idPersona"];
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
    const idDentista = document.getElementById("idDentista").value;

    $("#deleteUser").modal("hide");

    $.ajax({
        url: `/administrador/deleteDentista/${idDentista}`,
        type: "get",
        success: function () {
            Swal.fire(
                "Buen trabajo!",
                "Los datos del dentista se eliminaron correctamente!",
                "success"
            ).then(function () {
                window.location.reload();
            });
        },
        error: function () {
            Swal.fire(
                "Ups!",
                "Los datos del dentista no se pudieron eliminar!",
                "error"
            );
        },
    });
}
