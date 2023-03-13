<?php

namespace App\Helpers;

use Illuminate\Support\Str;


/**
 *
 */
class Auxiliares extends Str
{

   public static function limpiarValores(string $cadena)
   {
      $cadena = filter_var($cadena, FILTER_SANITIZE_STRING);
      $cadena = trim($cadena);
      $cadena = strip_tags($cadena);

      return $cadena;
   }

}




?>
