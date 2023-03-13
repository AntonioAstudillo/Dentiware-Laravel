<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\admin\AdminController;
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



/**
 * ESTAS DOS RUTAS SE LLAMAN DESDE UNA PETICION ASINCRONA DE JAVASCRIPT
 *
 */


//Esta ruta se manda a llamar desde una peticón asincrona utilizando el objeto XMLHttpRequest.
Route::post('/consulta' , [ConsultaController::class , 'store']);


//Esta ruta manda a llamar al controlador encargado de almacenar los correos de noticias.
Route::post('/noticias' , [NoticiasController::class , 'store']);

/**
 * FIN DE RUTAS LLAMADAS POR PETICIÓN ASINCRONA
 */


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



//Con esta ruta almacenamos un nuevo paciente a la base de datos. Esta ruta se llamada desde una petición asincrona desde el archivo registroPaciente.js
Route::post('/registraPaciente' , [PacienteController::class , 'store']);
