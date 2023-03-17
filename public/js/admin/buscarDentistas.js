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
    ];

    //Mandamos a llamar al metodo donde se almacena la plantilla del datatable y lo que nos retorna se lo asignamos a tabla.
    templateDataTable(
        columnas,
        "/administrador/getAllDentistas",
        "tablaPacientes"
    );
});
