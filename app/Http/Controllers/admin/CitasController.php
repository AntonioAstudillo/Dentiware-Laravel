<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Helpers\Auxiliares;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
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

    //guardamos los datos correspondientes al pago de la cita
    public function save(Request $request)
    {
        $data = $request->all();

        try
        {
            DB::transaction(function () use($data)
            {
                DB::insert('INSERT INTO pagos VALUES(?,?,?,?,?,?,?)' , [null , $data['cantidad'] , $data['hora'] , $data['fecha'] , $data['folio'] , $data['idCita'] , Auxiliares::getDatetime()]);
                DB::update("UPDATE cita SET status = ? WHERE idcita = ?" , ['0' , $data['idCita']]);
                DB::update("UPDATE historialtratamiento SET saldo = (saldo - ?) where idPaciente = ?" , [$data['cantidad']  , $data['idPaciente']]);

            });

            return response('' , 200);

        }catch(Exception $e)
        {
            return response($e , 500);
        }

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



    //metodo para mostrar la vista de createcita
    public function createCita()
    {
        return view('admin.createCita');
    }


}
