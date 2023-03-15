<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


/**
 *
 */
class Auxiliares extends Str
{

   //limpiamos un string
   public static function limpiarValores(string $cadena)
   {
      $cadena = filter_var($cadena, FILTER_SANITIZE_STRING);
      $cadena = trim($cadena);
      $cadena = strip_tags($cadena);

      return $cadena;
   }

   //Con este metodo validamos si una cita ingresada, ya se encuentra registrada
   public static function validarCita($horaCita , $fechaCita , $dentistaPaciente)
   {
      $citas = DB::select('SELECT * FROM cita WHERE hora = ? AND fecha = ? AND idDentista = ? AND status = ?', [$horaCita , $fechaCita , $dentistaPaciente , 1]);


       $count = count($citas);

       return ($count > 0) ? false : true;
   }

   //generamos un datetime para poder usarlo en cualquier parte del sistema
   public static function getDatetime()
   {
    $now = Carbon::now()->timezone('America/Mexico_City');
    return $now->toDateTimeString();
   }

      /**
    * [crearTurno Esta funcion me va servir para modificar el turno, y pueda guardarse en la base de datos como un palabra y no como un numero]
    * @param  [string] $numero               [el valor del turno]
    * @return [string]         [el turno modificado a palabra]
    */

   public static function crearTurno($numero){
      if($numero == 1){
         return 'Diurno';
      }else{
         return 'Vespertino';
      }
   }

}




?>
