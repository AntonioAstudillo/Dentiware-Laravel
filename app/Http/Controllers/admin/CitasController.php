<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Helpers\Auxiliares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\TratamientosController;




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


    //public static function validarCita($horaCita , $fechaCita , $dentistaPaciente)

    //creamos una cita
    public function store(Request $request)
    {
        $data = $request->all();

        if(!Auxiliares::validarCita($data['horaCita'] , $data['fechaCita'] , $data['dentistaPaciente']  ))
        {
          return response('' , 422);
        }

        $data['abono'] = TratamientosController::getPrecio($data['tratamientoPaciente'] + 1);

        DB::insert('INSERT INTO cita VALUES(?,?,?,?,?,?,?,?,?,?)' , [null , $data['fechaCita']  , $data['horaCita'] , $data['idPaciente'] , $data['dentistaPaciente'] , $data['tratamientoPaciente'] + 1 , $data['abono'] , $data['comentario'] , '1' , Auxiliares::getDatetime()]);

        return response('' , 200);

    }


    //mostramos la vista de editarCita
    public function editarCita()
    {
        return view('admin.editarCita');
    }



    public function update(Request $request)
    {
        $data = $request->all();

        if(!Auxiliares::validarCita($data['horaCita'] , $data['fechaCita'] , $data['dentistaPaciente']  ))
        {
          return response('' , 422);
        }

        $data['abono'] = TratamientosController::getPrecio($data['tratamientoPaciente'] + 1);

        $filasAfectadas = DB::update('UPDATE cita SET fecha = ? , hora = ? , comentarios = ? , abono = ? , idDentista = ? , idTratamiento = ? WHERE idPaciente = ? and status = ? '
        ,[$data['fechaCita'] , $data['horaCita'] , $data['comentario'] , $data['abono'] , $data['dentistaPaciente'] , $data['tratamientoPaciente'] + 1 , $data['idPaciente'] , '1'  ]);

        if($filasAfectadas > 0)
        {
            return response('' , 200);
        }else{
            return response('' , 500);
        }

    }


}
