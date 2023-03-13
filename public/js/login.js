window.onload = main;

function main() {
    let btn = document.getElementById("btnIngresar");

    btn.addEventListener("click", onClick);
} //cierra funcion main

function onClick(e) {
    e.preventDefault();
    ocultarBoton();
    mostrarSpinner();

    loguearse();
}

function mostrarSpinner() {
    document.getElementById("spinnerLogin").style.visibility = "visible";
}

function ocultarSpinner() {
    document.getElementById("spinnerLogin").style.visibility = "hidden";
}

function mostrarBoton() {
    document.getElementById("btnIngresarLogin").style.display = "block";
}

function ocultarBoton() {
    document.getElementById("btnIngresarLogin").style.display = "none";
}

function loguearse() {
    //Capturamos los datos e instanciamos el objeto para hacer las peticiones
    let formElement = document.getElementById("formLogin");
    let xhr = new XMLHttpRequest();
    let form = new FormData(formElement);
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    xhr.open("POST", "/signIn/");
    xhr.setRequestHeader("X-CSRF-TOKEN", token);

    xhr.addEventListener("load", function () {
        if (xhr.status === 401) {
            errorMensaje("Acceso Denegado");
        } else if (xhr.status === 422) {
            errorMensaje("Credenciales incorrectas!");
        } else if (xhr.status === 200) {
            goodMensaje("Bienvenido a Dentiware");
        }

        ocultarSpinner();
        mostrarBoton();
    });

    xhr.send(form);
}

function errorMensaje(mensaje) {
    Swal.fire({
        position: "top-end",
        icon: "error",
        title: mensaje,
        showConfirmButton: false,
        timer: 1500,
    });
}

function goodMensaje(mensaje) {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: mensaje,
        showConfirmButton: false,
        timer: 1500,
    }).then(() => {
        window.location.href = "/dashboard";
    });
}
