<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CitasController;
use App\Http\Controllers\admin\NominaController;
use App\Http\Controllers\admin\DentistaController;
use App\Http\Controllers\admin\PacienteController;
use App\Http\Controllers\admin\TratamientosController;

/**
 * RUTAS GENERALES
 */
Route::get('/' , [VistasController::class , 'index'])->name('home');
Route::get('/nosotros', [VistasController::class , 'about'] )->name('about');
Route::get('/servicios', [VistasController::class , 'services'] )->name('services');
Route::get('/contacto', [VistasController::class , 'contacto'] )->name('contacto');

/**
 * Esta ruta en especifico se utiliza para ir generando la vista de un servicio de la clinica en particular
 * Le mandamos el id, hacemos la consulta a la DB y mostramos la vista correspondiente al id
 */
Route::get('/servicios/{id}', [VistasController::class , 'show'])->name('service');

/**
 * FIN DE RUTAS GENERALES
 */


//Esta ruta se manda a llamar desde una peticón asincrona utilizando el objeto XMLHttpRequest.
Route::post('/consulta' , [ConsultaController::class , 'store']);

//Esta ruta manda a llamar al controlador encargado de almacenar los correos de noticias.
Route::post('/noticias' , [NoticiasController::class , 'store']);

//Ruta para mostrar la vista del login
Route::get('/login' , [LoginController::class , 'index'])->name('login');

//Ruta utilizada para cerrar sesion
Route::get('/logout' , [LoginController::class , 'logout'])->name('logout');

//Con esta ruta creamos la sesion en caso de que las credenciales del usuario sean correctas
Route::post('/signIn' , [LoginController::class , 'store'])->name('signIn');

//Generamos la vista del dashboard, en caso de que el usuario este autenticado
Route::get('/dashboard' , [AdminController::class , 'index'])->name('admin.index');

/*Con esta ruta voy a obtener todos los tratamientos que tiene la clinica para poder llenar el select de tratamientos dentro de la vista registro pacientes
  en el dashboard del sistema. Esta ruta se llama desde una peticion asincrona. */
Route::get('/administrador/getTratamientos' , [TratamientosController::class , 'show']);

//Llenamos el select del dentista de acuerdo a la especialidad que elige el usuario.
//Esta ruta se manda a llamar desde una peticion asincrona
Route::get('/llenarSelectDentista/{id}' , [DentistaController::class , 'show']);


//Mostramos el formulario de registra Dentista.
Route::get('/registraDentista' , [DentistaController::class , 'index'])->name('admin.registraDentista');

//Esta ruta nos sirve para poder registrar al paciente en la database.
Route::post('/registraDentista' , [DentistaController::class, 'store']);


//Ruta utilizada para generar la vista de eliminacion de dentistas
Route::get('/administrador/eliminarDentista' , [DentistaController::class , 'eliminarDentista'])->name('admin.eliminarDentista');


//Ruta utilizada para eliminar un dentista
Route::get('/administrador/deleteDentista/{id}' , [DentistaController::class , 'destroy']);

//Esta ruta se manda a llamar desde una petición asincrona, se utiliza para validar el correo del dentista dentro del formulario de registroDentista
Route::post('/administrador/validarCorreoDentista' , [DentistaController::class , 'validaCorreo']);

//Ruta para mostrar el formulario de editar dentista.
Route::get('/administrador/editarDentista' , [DentistaController::class , 'edit'])->name('admin.editarDentista');


//Ruta utilizada para llenar el datatable de la vista editar dentista. Se llama desde una petición asincrona.
Route::get('/administrador/getAllDentistas' , [DentistaController::class , 'getAllDentistas']);


//Con esta ruta actualizamos los datos de un dentista. Dicha ruta se llama desde una peticion del archivo editarDentista.js
Route::post('/administrador/actualizarDatosDentista' , [DentistaController::class , 'update']);

//Ruta utilizada para generar la vista de buscar dentistas
Route::get('/administrador/buscarDentisas' , [DentistaController::class , 'searchDentistView'])->name('admin.buscarDentista');


//Esta ruta se usa desde la vista pagoCita para llenar el modal con los datos de un determinado dentista
Route::get('/administrador/dentista' , [DentistaController::class ,'dentista']);



//Ruta para mostrar el formulario de editar paciente
Route::get('/administrador/editarPaciente' , [PacienteController::class , 'edit'])->name('admin.editarPaciente');

//Ruta utilizada para llenar el datatable de la vista editar paciente. Se llama desde una petición asincrona.
Route::get('/administrador/getAllPacientes' , [PacienteController::class , 'getAllPacientes']);

//Esta ruta la utilizamos para actualizar los datos de un paciente.
Route::post('/administrador/actualizarDatosPaciente' , [PacienteController::class , 'actualizarDatosPaciente']);

//Con esta ruta almacenamos un nuevo paciente a la base de datos. Esta ruta se llamada desde una petición asincrona desde el archivo registroPaciente.js
Route::post('/registraPaciente' , [PacienteController::class , 'store']);



//Ruta utilizada para generar la vista de buscar pacientes
Route::get('/administrador/buscarPacientes' , [PacienteController::class , 'show'])->name('admin.buscarPaciente');


//Ruta para mostrar vista de eliminar paciente
Route::get('/administrador/eliminarPaciente' , [PacienteController::class , 'eliminarPaciente'])->name('admin.eliminarPaciente');


//Ruta usada para eliminar un paciente, se manda a llamar desde una petición asincrona en el archivo eliminarPacientes.js de la carpeta admin
Route::get('/administrador/deletePaciente/{idPaciente}' , [PacienteController::class , 'destroy']);



/**
 *
 *
 * BLOQUE DE RUTAS PARA GENERAR LA NOMINA
 *
 */

 //Genera la vista
Route::get('/administrador/nomina' , [NominaController::class , 'index'])->name('admin.nomina');

//obtenemos los datos para llenar la datatable de la nomina
Route::get('/administrador/getNomina' , [NominaController::class , 'show']);

//Obtenemos el total de salario, para mandarlo a la api de pay pal
Route::get('/administrador/getSalary' , [NominaController::class , 'getSalary']);

//guardamos la nomina en caso de exito
Route::post('/administrador/guardarNomina' , [NominaController::class , 'saveNomina']);


/**
 *
 * FIN DE BLOQUE DE RUTA PARA GENERAR LA NOMINA
 *
 */

  //Generamos la vista de pagosCitas
 Route::get('/administrador/pagoCitas' , [CitasController::class , 'index'])->name('admin.pagoCita');


//ruta para llenar el datatable de la vista pagoCitas
 Route::get('/administrador/getPagoCitas' , [CitasController::class , 'show']);


 //Esta ruta se llamada desde el archivo cobroCitas.js, la cual se utiliza para obtener el saldo de un determinado tratamiento
 Route::get('/administrador/getSaldo{id}' , [CitasController::class] , 'getSaldo');

//Ruta utilizada para guardar los datos del pago de una cita.
 Route::post('/administrador/generarPagoCita' , [CitasController::class , 'save']);


 Route::get('/administrador/crearCita' , [CitasController::class , 'createCita'])->name('admin.createCita');
 Route::post('/administrador/crearCita' , [CitasController::class , 'store'])->name('admin.createCita');
