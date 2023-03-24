import { templateDataTable } from "./datatableTemplate.js";

window.onload = main;

function main() {
    mostrarUsers();

    let btnRegister = document.getElementById("btnRegistrar");

    btnRegister.addEventListener("click", registrarUsuario);
}

function mostrarUsers() {
    let columnas = [
        { data: "id" },
        { data: "name" },
        { data: "email" },
        { data: "created_at" },
        {
            defaultContent:
                "<button class='editar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#edit'><i class='fas fa-pencil-alt fa-sm'></i></button> <button class='eliminar btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#delete'><i class='fas fa-trash-alt'></i></i></button>",
        },
    ];

    //Mandamos a llamar al metodo donde se almacena la plantilla del datatable y lo que nos retorna se lo asignamos a tabla.
    let tabla = templateDataTable(
        columnas,
        "/administrador/getUsers",
        "tablaUsuarios"
    );

    const obtener_data_editar = function (tbody, tabla) {
        $(tbody).on("click", "tr", function (e) {
            let data = tabla.row($(this)).data();

            if (
                e.target.classList.contains("editar") ||
                e.target.classList.contains("fa-pencil-alt")
            ) {
                getDataModalView(data);
            } else {
                confirmDelete(data.id);
            }
        });
    };

    obtener_data_editar("#tablaUsuarios", tabla);
}

function deleteUser(id) {
    let req = new XMLHttpRequest();

    req.open("get", `/administrador/administrador/delete/${id}`);

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            Swal.fire(
                "Buen trabajo!",
                "Los datos del usuario se eliminaron correctamente!",
                "success"
            ).then(function () {
                location.reload();
            });
        } else {
            Swal.fire("Ups!", "El proceso no se pudo concretar!", "error");
        }
    };

    req.send();
}

function confirmDelete(id) {
    Swal.fire({
        title: "¿Está seguro de eliminar de forma permanente a este usuario?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            deleteUser(id);
        } else if (result.isDenied) {
            Swal.fire("El usuario no se eliminó", "", "info");
        }
    });
}

function getDataModalView(data) {
    llenarModalEditar(data);
}

function llenarModalEditar(data1) {
    document.getElementById("nombreModal").value = data1.name;
    document.getElementById("passwordModal").disabled = true;
    document.getElementById("passwordModal").value = null;
    document.getElementById("correoModal").value = data1.email;

    //Evento para actualizar los datos del usuario
    document
        .getElementById("btnGuardar")
        .addEventListener("click", function () {
            updateData(data1.id);
        });

    //Evento para activar el input del password
    document
        .getElementById("btnPassword")
        .addEventListener("click", function () {
            document.getElementById("passwordModal").disabled = false;
            localStorage.setItem(
                "password",
                document.getElementById("passwordModal").value
            );
        });

    //Evento para activar el boton de guardar cambios
    document
        .getElementById("datosPaciente")
        .addEventListener("change", function () {
            document.getElementById("btnGuardar").disabled = false;
        });

    document.getElementById("btnClose").addEventListener("click", function () {
        data1 = null;
    });
}

function updateData(idPersona) {
    let req = new XMLHttpRequest();
    let data = new FormData();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    data.append("nombre", document.getElementById("nombreModal").value);
    data.append("correo", document.getElementById("correoModal").value);
    data.append("idPersona", idPersona);

    if (localStorage.getItem("password") != null) {
        data.append("password", document.getElementById("passwordModal").value);
    }

    req.open("POST", "/administrador/administrador/updateUser");
    req.setRequestHeader("X-CSRF-TOKEN", token);

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            Swal.fire(
                "Buen trabajo!",
                "Los datos del usuario se modificaron correctamente!",
                "success"
            ).then(function () {
                localStorage.clear();
                location.reload();
            });
        } else {
            Swal.fire("Ups!", "El proceso no se pudo concretar!", "error");
        }
    };

    req.send(data);
}

//Mediante esta funcion voy a mandarle al controlador todos los datos que tenga el formulario via una peticion HTTPrequest
function registrarUsuario(e) {
    let req = new XMLHttpRequest();
    let data = new FormData(document.getElementById("formUsuario"));
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    req.open("POST", "/administrador/administrador/registerUser");
    req.setRequestHeader("X-CSRF-TOKEN", token);

    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) {
            Swal.fire(
                "Buen trabajo!",
                "El usuario fue dado de alta correctamente!",
                "success"
            ).then(function () {
                location.reload();
            });
        } else {
            Swal.fire("Ups!", "El proceso no se pudo concretar!", "error");
        }
    };

    req.send(data);
    e.preventDefault();
}
