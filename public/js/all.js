import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

window.onload = main;

function main() {
    let boton = document.getElementById("btnConsultaFree");

    if (document.getElementById("btnNoticias") !== null) {
        document
            .getElementById("btnNoticias")
            .addEventListener("click", registrarCorreo);
    }

    if (boton != null) {
        boton.addEventListener("click", guardarDatos);
    }
}

function registrarCorreo(e) {
    e.preventDefault();

    let correo = document.getElementById("correoNoticias").value;

    if (correo !== "") {
        peticionNoticias(correo);
    } else {
        Swal.fire("Debe ingresar un correo");
    }
}

function peticionNoticias(correo) {
    const req = new XMLHttpRequest();
    const formData = new FormData();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    formData.append("correo", correo);

    req.open("POST", "/noticias");
    req.setRequestHeader("X-CSRF-TOKEN", token);

    req.addEventListener("load", function () {
        if (req.status === 422) {
            mensajeError("Tuvimos problemas al procesar la petición");
        } else if (req.status === 200) {
            Swal.fire(
                "Buen trabajo!",
                "Su correo se registro correctamente!",
                "success"
            ).then(() => location.reload());
        }
    });

    req.send(formData);
}

function guardarDatos() {
    //Aqui capturo los datos para poder hacer la peticion a archivo .php y guardarlos en la tabla
    let nombre = document.getElementById("nombre").value;
    let telefono = document.getElementById("telefono").value;
    let correo = document.getElementById("correo").value;
    let tipo = document.getElementById("tipoTratamiento").value;
    let mensaje = document.getElementById("mensaje").value;

    const peticion = new XMLHttpRequest();
    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    //Creamos un objeto de tipo formData, para poder enviar los datos del formulario en la peticion
    let formData = new FormData();

    //Mostrarmos spinner y ocultamos boton
    mostrarSpinner();
    ocultarBoton();

    formData.append("nombre", nombre);
    formData.append("telefono", telefono);
    formData.append("correo", correo);
    formData.append("tratamiento", tipo);
    formData.append("mensaje", mensaje);

    peticion.open("POST", "/consulta/");
    peticion.setRequestHeader("X-CSRF-TOKEN", token);

    peticion.addEventListener("load", function () {
        ocultarSpinner();
        mostrarBoton();

        if (peticion.status === 422) {
            mensajeError("Revise bien su información");
        } else if (peticion.status === 200) {
            mensajeCorrecto(
                "Tu consulta quedó registrada. Un colaborador te contactará a la brevedad!"
            );
            document.getElementById("formConsulta").reset();
        }
    });

    peticion.send(formData);
}

function mostrarSpinner() {
    document.getElementById("spinner").style.display = "block";
}

function mostrarBoton() {
    document.getElementById("btnConsultaFree").style.display = "block";
}

function ocultarSpinner() {
    document.getElementById("spinner").style.display = "none";
}

function ocultarBoton() {
    document.getElementById("btnConsultaFree").style.display = "none";
}

function mensajeError(mensaje) {
    Swal.fire("Datos incorrectos!", mensaje, "error");
}

function mensajeCorrecto(mensaje) {
    Swal.fire("Buen trabajo!", mensaje, "success");
}

$(document).ready(function ()
{
		$('.owl-two').owlCarousel({
			loop: true,
			margin: 20,
			nav: false,
			responsiveClass: true,
			autoplay: false,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				480: {
					items: 1,
					nav: false
				},
				667: {
					items: 1,
					nav: false
				},
				1000: {
					items: 1,
					nav: false
				}
			}
		})

		$('.owl-one').owlCarousel({
			loop: true,
			margin: 0,
			nav: false,
			responsiveClass: true,
			autoplay: false,
			autoplayTimeout: 5000,
			autoplaySpeed: 1000,
			autoplayHoverPause: false,
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				480: {
					items: 1,
					nav: false
				},
				667: {
					items: 1,
					nav: true
				},
				1000: {
					items: 1,
					nav: true
				}
			}
		});


		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});

		$('.popup-with-move-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-slide-bottom'
		});

		$(function () {
			$('.navbar-toggler').click(function () {
				$('body').toggleClass('noscroll');
			})
		});

		/*Esta linea me sirve para generar el numero de citas diarias y los clientes felices*/
		$('.counter').countUp();
});


/**************************************************************
  Este codigo hace referencia al boton flecha que se genera cuando el usuario realiza un scroll hacia abajo
  la funcionalidad de este boton, es que cuando el usuario presione sobre 'el, debemos dirigirlo hasta el header la pagina web'
**************************************************************/


// Cuando el usuario hace un scroll hacia abajo de 20 pixeles arriba del documento, mostramos el boton.
document.getElementById('movetop').onclick = function(){
	topFunction();
}

window.onscroll = function () {
	scrollFunction()
};

//Esta funcion me sirve, para ocultar o mostrar el boton movetop de acuerdo a la posicion en la que se encuentre el usuario.
function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		document.getElementById("movetop").style.display = "block";
	} else {
		document.getElementById("movetop").style.display = "none";
	}
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}

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
