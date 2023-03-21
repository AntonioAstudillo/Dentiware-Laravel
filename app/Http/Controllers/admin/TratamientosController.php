<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TratamientosController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }


    //Obtenemos todos los tratamientos para poder dibujarlos en el select de tratamientos en el modulo de registro pacientes del dashboard
    public function show()
    {
        $result = DB::select('SELECT * FROM tratamiento');
        return response()->json($result);
    }


    //obtenemos el precio de un tratamiento
    public static function getPrecio($tratamiento)
    {
      $data = DB::select('SELECT precio FROM tratamiento WHERE idtratamiento = ?' , [$tratamiento]);

      return (isset($data[0]->precio)) ? $data[0]->precio : false ;
    }


}
