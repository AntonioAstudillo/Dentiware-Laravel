<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CitasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //Generamos la vista de pagoCitas
    public function index()
    {
       return view('admin.cobroCitas');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

     //Con este metodo vamos a obtener todas las citas generadas, para poder mostrarlas en el datatable de pagoCitas
    public function show()
    {
        $citas = DB::table('cita')
        ->join('tratamiento' , 'cita.idTratamiento' , '=' , 'tratamiento.idtratamiento')
        ->join('persona' , 'persona.idPersona' , "=" , 'cita.idPaciente')
        ->where('cita.status' , '=' , 1)
        ->select('cita.idcita' , 'persona.idPersona' , 'cita.fecha' , 'cita.hora' , DB::raw('concat(persona.nombre , " " , persona.apellidos) as nombre') , 'persona.correo' , 'cita.abono' ,DB::raw('tratamiento.nombre as tratamiento'))
        ->get();


        return response()->json(['data' => $citas]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
