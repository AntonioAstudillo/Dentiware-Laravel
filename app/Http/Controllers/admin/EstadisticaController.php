<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EstadisticaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.estadistica');
    }


    public function peticion()
    {
       $result =  DB::table('tratamiento')
       ->join('cita' , 'cita.idTratamiento' , '=' , 'tratamiento.idTratamiento')
        ->groupBy('tratamiento.nombre')
        ->select(DB::raw('tratamiento.nombre as nombre') , DB::raw('count(*) as total ') )->get();



        return response()->json(['data' => $result]);

    }




}
