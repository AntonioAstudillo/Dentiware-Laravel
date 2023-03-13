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


}
