<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Helpers\Auxiliares;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NominaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //generamos la vista de la nomina
    public function index()
    {
        return view('admin.nomina');
    }


    //Obtenemos todos los registros correspondientes a la Nomina
    public function show()
    {
        $resultado = DB::table('persona')
        ->join('dentista' , 'dentista.idPersona' , '=' , 'persona.idPersona')
        ->where('persona.tipo' , '=' , 1)
        ->select('persona.idPersona' , 'persona.nombre' , 'persona.apellidos' , 'dentista.clabe' , 'dentista.cuentaBancaria' , 'dentista.sueldo' , 'dentista.rfc')
        ->get();

        return response()->json(['data' => $resultado]);

    }


    //generamos el total de los salarios de los dentistas
    public function getSalary()
    {
        $total = DB::select("SELECT sum(sueldo) as 'total' FROM dentista");
        return $total;
    }



    public function saveNomina(Request $request)
    {
        $data = $request->all();
        $count = DB::insert("INSERT INTO nomina VALUES(?,?,?,?,?,?,?)" ,
        [null , $data['idTransaccion'] , $data['payerId'] , $data['merchant_id'] , $data['amount'] , $data['usuario'] , Auxiliares::getDatetime() ]);

        if($count > 0)
        {
            return response('' , 200);
        }else{
            return response('' , 500);
        }


    }








}
