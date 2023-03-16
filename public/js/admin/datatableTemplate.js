/*
    Creamos una plantilla de una datatable, para poder usarlo en todos nuestros archivos donde sea necesario.
    El primer parametro que recibe, son la columnas que va procesar dentro de la tabla definida en la vista.
    El segundo parametro, es la ruta a donde se hara la petición para obtener la información o data de la tabla.
    El tercer parametro, es el nombre de la tabla, el cual debe ser el id que le indicamos a la tabla en la vista.


    Retorna un objeto de tipo datatable.
 */
export function templateDataTable(columnas, endpoint, nombreTabla) {
    const tabla = $(`#${nombreTabla}`).DataTable({
        processing: true,
        ajax: {
            url: endpoint,
        },
        responsive: true,
        columns: columnas,
        language: {
            emptyTable: "",
            info: "",
            infoEmpty: "",
            search: "Buscar:",
            zeroRecords: "",
            paginate: {
                first: "Primero",
                last: "Último",
                next: '<button class="btn btn-outline-dark ms-2">Siguiente </button>',
                previous:
                    '<button class="btn btn-outline-dark">Anterior </button>',
            },
            lengthMenu: "_MENU_",
            processing:
                "<div class='container '>  <div class='spinner-border text-primary editar mt-4' role='status'><span class='sr-only'>Cargando...</span></div> </div>",
            loadingRecords: "Cargando...",
            infoFiltered: " _TOTAL_ de _MAX_ registros",
        },
        pagingType: "simple",
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "Todos"],
        ],
    });

    return tabla;
}
