<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Auxiliares;

class ConsultaController extends Controller
{


    /**
     * Creamos una nueva consulta, esta información es enviada desde el formulario de consultas gratis en la vista home
     * La peticion al servidor se hace por medio de una consulta asincrona utilizando el objeto HttpRequest de javascript
     */
    public function store(Request $request)
    {

      $data = $request->all();

      $validator = Validator::make($data, [
            'nombre' => 'required|max:255|string',
            'telefono' => 'required|integer|numeric',
            'correo' => 'required|max:255|email',
            'tratamiento' => 'required|string',
            'mensaje' => 'required|string',
      ]);

      if($validator->fails())
      {
        return response('' , 422);
      }
      else
      {
         $nombre = STR::ucfirst(Auxiliares::limpiarValores($data['nombre']));
         $telefono = Auxiliares::limpiarValores($data['telefono']);
         $correo = Auxiliares::limpiarValores($data['correo']);
         $tratamiento = Auxiliares::limpiarValores($data['tratamiento']);
         $mensaje = STR::upper(Auxiliares::limpiarValores($data['mensaje']));

         DB::insert('INSERT INTO consultas VALUES(? , ? ,? ,? ,? ,? )' , [null , $nombre , $telefono , $correo , $tratamiento , $mensaje ]);

         return response('Validación correcta' , 200);
      }
   }
}
