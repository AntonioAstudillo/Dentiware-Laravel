<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class VistasController extends Controller
{

   public function index()
   {
      return view('home');
   }

   public function about()
   {
      return view('about');
   }

   public function services()
   {
      return view('servicios');
   }

   public function contacto()
   {
      return view('contacto');
   }


   /*
        Este metodo lo mandan a llamar desde la ruta 'servicios{id}'
        Limpiamos el id que nos envian y comprobamos que no esté vacio
        Si no está vacio, reemplazamos el caracter - por un espacio en blanco para de esa forma
        al hacer la consulta a la DB, podamos obtener los registros que coincidan con el string dado.
    */
   public function show(string $id)
   {
      $id = filter_var($id, FILTER_SANITIZE_STRING);

      if($id === '')
      {
         return Redirect::route('services');
      }
      else
      {
         $id = str_replace('-' , ' ' , $id);

         $servicio = DB::select('SELECT nombre , descripcion , imagen , precio FROM tratamiento WHERE nombre LIKE ? LIMIT 1', [ '%'. $id . '%']);

         return view('servicio' , ['data' => $servicio]);

      }


   }
}
