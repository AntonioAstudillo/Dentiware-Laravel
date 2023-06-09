import { templateDataTable } from "./datatableTemplate.js";

window.onload = main;

function main() {
    cargarCitas();
}

function cargarCitas() {
    let columnas = [
        { data: "idPersona" },
        { data: "fecha" },
        { data: "hora" },
        { data: "nombre" },
        { data: "correo" },
        { data: "abono" },
        { data: "tratamiento" },
        {
            defaultContent:
                "<button class='editar btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#showDentist'><i class='fas fa-eye'></i></button> <button class='editar btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#payConsult'><i class='fas fa-money-bill'></i></button>",
        },
    ];

    const tabla = templateDataTable(
        columnas,
        "/administrador/getPagoCitas",
        "tablaPagoCitas"
    );

    const obtener_data_editar = function (tbody, tabla) {
        let data;
        $(tbody).on("click", "tr", function () {
            data = tabla.row($(this)).data();
            obtenerDatosDentista(data.idcita, data.idPersona);
            llenarModalPago(data);
        });

        btnPago.addEventListener("click", function (e) {
            let cantidadServicio = parseFloat(
                document.getElementById("cantidadServicio").value
            );
            let dineroIngresado = parseFloat(
                document.getElementById("abonoServicio").value
            );

            if (cantidadServicio > dineroIngresado) {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "Cantidad incorrecta",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                //Le añado al objeto un atributo más el cual corresponde a la referencia del recibo

                data.reciboServicio =
                    document.getElementById("reciboServicio").textContent;
                data.cantidadServicio = cantidadServicio;
                data.dineroIngresado = dineroIngresado;
                data.cambioServicio = dineroIngresado - cantidadServicio;
                generarPago(data);
            }
        });
    };

    obtener_data_editar("#tablaPagoCitas", tabla);
} //cierra funcion cargaCitas

function llenarModalDentista(data) {
    const objeto = data;
    document.getElementById("idPersona").value = objeto.data[0]["idPersona"];
    document.getElementById("nombre").value = objeto.data[0]["nombre"];
    document.getElementById("edad").value = objeto.data[0]["edad"];
    document.getElementById("cargo").value = objeto.data[0]["cargo"];
    document.getElementById("turno").value = objeto.data[0]["turno"];
    document.getElementById("correo").value = objeto.data[0]["correo"];
}

function obtenerDatosDentista(idCita, idPersona) {
    $.ajax({
        url: "/administrador/dentista",
        type: "get",
        data: {
            idCita: idCita,
            idPersona: idPersona,
        },
        success: function (data) {
            llenarModalDentista(data);
        },
        error: function () {
            //alert("Error");
        },
    });
}

function llenarModalPago(data) {
    let abono = document.getElementById("abonoServicio");
    let cambio = document.getElementById("cambioServicio");
    let fechaPago = moment().format("DD MMMM YY, h:mm:ss a");
    let reciboServicio = getRandom() + getCharacter();

    //Llenamos los datos del modal.
    document.getElementById("cantidadServicio").value = data.abono;
    document.getElementById("fechaPago").textContent = fechaPago;
    document.getElementById("reciboServicio").textContent = reciboServicio;
    document.getElementById("servicioPago").textContent = data.tratamiento;
    document.getElementById("precioServicio").textContent = data.abono;
    document.getElementById("totalServicio").textContent = "$" + data.abono;

    //Definimos los eventos tanto para el cambio como para el boton de generar pago
    abono.addEventListener("change", function (e) {
        //Lo que hago aqui, es generar el cambio
        let valor = parseFloat(e.target.value);

        valor = valor - parseFloat(data.abono);

        cambio.value = valor;
    });
} //cierra funcion llenarModalPago

function generarPago(data) {
    const req = new XMLHttpRequest();
    const formData = new FormData();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    //Agregamos los datos al objeto formData
    formData.append("cantidad", data.cantidadServicio);
    formData.append("hora", data.hora);
    formData.append("fecha", data.fecha);
    formData.append("folio", data.reciboServicio);
    formData.append("idCita", data.idcita);
    formData.append("idPaciente", data.idPersona);

    req.open("POST", "/administrador/generarPagoCita");
    req.setRequestHeader("X-CSRF-TOKEN", token);

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            Swal.fire(
                "Buen trabajo!",
                "El pago se efectuó correctamente!",
                "success"
            ).then(function () {
                //Aqui debemos generar el pdf
                getSaldo(data);
            });
        } else {
            Swal.fire(
                "Ups!",
                "Tuvimos problemas al procesar el pago!",
                "error"
            ).then(function () {
                // window.location.reload();
            });
        }
    };

    req.send(formData);
}

function getSaldo(data) {
    const doc = new jsPDF("p", "mm", [150, 150]);

    doc.text(20, 20, "FOLIO: " + data.reciboServicio);
    doc.text(
        20,
        30,
        "FECHA DE PAGO: " + moment().format("DD MMMM YY, h:mm:ss a")
    );
    doc.text(20, 40, "PACIENTE: " + data.nombre);
    doc.text(20, 50, "TRATAMIENTO: " + data.tratamiento);
    doc.text(20, 60, "CANTIDAD: " + data.cantidadServicio);
    doc.text(20, 70, "Recibido: " + data.dineroIngresado);
    doc.text(20, 80, "CAMBIO: " + data.cambioServicio);
    doc.text(20, 90, "SALDO: 0");
    doc.text(20, 100, "AGRADECEMOS SU PREFERENCIA");
    doc.save(data.reciboServicio);
    window.location.reload();
}

function getRandom() {
    return Math.round(Math.random() * 999999999 - 100 + 100);
}

function getCharacter() {
    const letras = [
        "q",
        "e",
        "w",
        "r",
        "t",
        "y",
        "u",
        "i",
        "o",
        "p",
        "a",
        "s",
        "d",
        "f",
        "g",
        "h",
        "j",
        "k",
        "l",
        "ñ",
        "z",
        "x",
        "c",
        "v",
        "b",
        "n",
        "n",
        "m",
    ];

    let valor = Math.round(Math.random() * (letras.length - 1 - 1) + 1);

    return letras[valor];
}
