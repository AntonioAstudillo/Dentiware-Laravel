window.onload = main;

function main() {
    mostrarElementos();
    cargarTablaDentistas();
    obtenerSalario();
}

function mostrarElementos() {
    document.getElementById("cargando").classList.add("d-none");
    document.getElementById("tabla").classList.remove("d-none");
    document.getElementById("btnPayPal").classList.remove("d-none");
}

function cargarTablaDentistas() {
    $("#tablaNomina").DataTable({
        ajax: {
            url: "/administrador/getNomina",
        },
        dom: "Bfrtip",
        buttons: [
            {
                extend: "pdf",
                className: "btn btn-outline-danger btn-small",
                text: '<i class="fas fa-file-pdf"></i>',
                processing: true,
            },
            {
                extend: "csv",
                className: "btn btn-outline-success btn-small",
                text: '<i class="fas fa-file-csv"></i>',
                processing: true,
            },
            {
                extend: "print",
                className: "btn btn-outline-secondary btn-small",
                text: '<i class="fas fa-print"></i>',
                processing: true,
            },
            {
                extend: "copy",
                className: "btn btn-outline-info btn-small",
                text: '<i class="fas fa-copy"></i>',
                processing: true,
            },
        ],
        responsive: true,
        language: {
            emptyTable: "No hay dentistas registrados",
            info: "",
            infoEmpty: "Mostrando 0 de 0 dentistas registrados",
            search: "Buscar:",
            zeroRecords: "Sin resultados",
            paginate: {
                first: "Primero",
                last: "Último",
                next: '<button class="btn btn-outline-dark ms-2">Siguiente </button>',
                previous:
                    '<button class="btn btn-outline-dark">Anterior </button> ',
            },
            infoFiltered: "",
            infoPostFix: "",
            lengthMenu: "_MENU_",
        },
        columns: [
            { data: "idPersona" },
            { data: "nombre" },
            { data: "apellidos" },
            { data: "clabe" },
            { data: "cuentaBancaria" },
            {
                data: "sueldo",
                render: DataTable.render.number(",", ",", "2", "$ "),
            },
            { data: "rfc" },
        ],
        pagingType: "simple",
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "Todos"],
        ],
    });
}

function obtenerSalario() {
    // Instanciamos la clase XMLHttpRequest()
    let req = new XMLHttpRequest();

    req.open("GET", "/administrador/getSalary", false);

    req.onreadystatechange = function () {
        if (req.status == 200 && req.readyState == 4) {
            let valor = JSON.parse(req.responseText);
            const { total } = valor[0];
            cargarNomina(total);
        }
    };

    req.send();
}

function cargarNomina(valor) {
    // Render the PayPal button into #paypal-button-container
    paypal
        .Buttons({
            locale: "en_MXN",
            style: {
                size: "responsive",
                shape: "pill",
                color: "gold",
                label: "pay",
                layout: "horizontal",
            },

            // Set up the transaction
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [
                        {
                            amount: {
                                value: valor,
                            },
                        },
                    ],
                });
            },

            // Finalize the transaction
            onApprove: function (data, actions) {
                actions.order.capture().then(function (orderData) {
                    guardarDatosNomina(orderData);
                });
            },
        })
        .render("#paypal-button-container");
}

function guardarDatosNomina(orderData) {
    let xhr = new XMLHttpRequest();
    let form = new FormData();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    form.append("idTransaccion", orderData.id);
    form.append("payerId", orderData.payer.payer_id);
    form.append("merchant_id", orderData.purchase_units[0].payee.merchant_id);
    form.append("amount", orderData.purchase_units[0].amount.value);
    form.append("updateTime", orderData.create_time);
    form.append("usuario", localStorage.getItem("usuario"));

    xhr.open("POST", "/administrador/guardarNomina");
    xhr.setRequestHeader("X-CSRF-TOKEN", token);

    xhr.onreadystatechange = function () {
        if (xhr.status === 200) {
            Swal.fire({
                title: "Excelente!",
                text: "La nómina fue depositada con éxito!",
                imageUrl: "../../images/nomina.jpg",
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: "Custom image",
            });
        } else {
            alert("La transaccion no se pudo concretar");
        }
    }; //cierra callback

    xhr.send(form);
}
