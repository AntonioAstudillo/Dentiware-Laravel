<?php

namespace App\Http\Controllers\admin;

use Exception;

use App\Helpers\Auxiliares;
use App\Rules\ValidaNombre;
use Illuminate\Support\Str;
use App\Rules\ValidarCorreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Validator;

class DentistaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.registroDentista');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //Sanitizamos datos
        $data = array_map('trim' , $data);
        $data = array_map('strip_tags' , $data);
        $data = array_map('htmlspecialchars', $data);

        $validator = Validator::make($data, [
            'nombreDentista' => ['required' , 'string' , new ValidaNombre],
            'apellidoDentista' => ['required' , 'string' , new ValidaNombre],
            'edadDentista' => ['required' , 'numeric'],
            'telefonoDentista' =>['required' , 'numeric'],
            'generoDentista' =>['required' , 'string'],
            'domicilioDentista' =>['required' , 'string'],
            'correoDentista' =>['required' , 'string' , new validarCorreo(1)],
            'especialidadDentista'=>['required' , 'string'],
            'ssDentista'=>['required' , 'string'],
            'rfcDentista'=>['required' , 'string'],
            'cedulaDentista'=>['required' , 'string'],
            'horarioDentista'=>['required' ],
            'fechaIngreso'=>['required' , 'string'],
            'sueldoDentista'=>['required' , 'string'],
            'clabeDentista'=>['required' , 'string'],
            'numCuentaBanco'=>['required' , 'string']

        ]);

        if($validator->fails())
        {
            $errores = $validator->getMessageBag()->all();
            return response('', 422);
        }

        //creamos el turno
        $data['horarioDentista'] = Auxiliares::crearTurno($data['horarioDentista']);

        //creamos el cargo del dentista
        $data['cargo'] = $this->comprobarCargo($data['especialidadDentista']);


        /*
           Insertamos la data en sus respectivas tabla. En este punto la información ya viene filtrada y sanitizada
        */

        try
        {
            DB::transaction(function () use($data)
            {
                DB::insert("INSERT INTO persona(idPersona, nombre , apellidos, edad, telefono , correo, direccion , genero , tipo) values(?,?,?,?,?,?,?,?,?)",
                [null, Str::ucfirst($data['nombreDentista']) , Str::ucfirst($data['apellidoDentista']) , $data['edadDentista'] , $data['telefonoDentista'] , $data['correoDentista'],
                $data['domicilioDentista'] , $data['generoDentista'] , 1]);

                //obtenemos el ultimo id
                $idLast = DB::getPdo()->lastInsertId();

                DB::insert("INSERT INTO dentista(iddentista , especialidad , cargo , turno , fechaIngreso , sueldo , idPersona , numSocial, rfc , cedula , clabe , cuentaBancaria ,register_date)
                values(?,?,?,?,?,?,?,?,?,?,?,?,?)" ,
                [null ,$data['especialidadDentista'] , $data['cargo'] , $data['horarioDentista'] , $data['fechaIngreso'] , $data['sueldoDentista'] , $idLast , $data['ssDentista'],
                $data['rfcDentista'] , $data['cedulaDentista'] , $data['clabeDentista'] , $data['numCuentaBanco'] , Auxiliares::getDatetime()]);

            });

            //retornarmos un 200 si la transaccion se hizo de forma correcta.
            return response('' , 200);

        }catch(Exception $e){
            return response('', 500);
        }
    }

    /**
     * Utilizamos este metodo, para poder mostrar los doctores de acuerdo al tratamiento que el usuario eliga, este proceso se realiza
     * desde el formulario de registro paciente, Mediante una peticion asincrona.
     */
    public function show(string $id)
    {
        $cargo =  Auxiliares::limpiarValores($id);

        switch($cargo)
        {
            case 0:
                $cargo = 'Odontologo';
            break;
            case 1:
                $cargo = 'Pediatra';
            break;
            case 2:
                $cargo = 'Cirujano';
            break;
            case 3:
                $cargo = 'Odontologo';
            break;
            case 4:
                $cargo = 'Periodontologo';
            break;
            case 5:
                $cargo = 'General';
            break;
            case 6:
                $cargo = 'General';
            break;
            case 7:
                $cargo = 'General';
            break;
            case 8:
                $cargo = 'General';
            break;
            case 9:
                $cargo = 'Cirujano';
            break;
            default:
                $cargo = 1;
            break;
        }

        if($cargo == 1)
        {
            $result = DB::select('SELECT idPersona , nombre , apellidos FROM persona WHERE tipo = ?' , [$cargo]);
        }
        else
        {

           $dentista = DB::table('dentista')->select('idPersona')->where('cargo' , $cargo);

           $result = DB::table('persona')->joinSub($dentista, 'dentista' , function(JoinClause $join){
                $join->on('persona.idPersona' , '=' , 'dentista.idPersona');
           })->select('persona.idPersona' , 'persona.nombre' , 'persona.apellidos')->get();

        }

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //Con este metodo validamos que el correo ingresado en el formulario de registro dentista, no se encuentre ya registrado
    //Este metodo se manda a llamar desde una petición asincrona en el archico admin/registroDentista.js
    public function validaCorreo(Request $request )
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'correo' => ['required' , 'string' , new ValidarCorreo(1)],
        ]);

        if($validator->fails())
        {
            return response('' , 422);
        }else{
            return response('' , 200);
        }

    }


    /**
     * BLOQUE DE METODOS PRIVADOS PARA FUNCIONAMIENTO INTERNO DE LA CLASE
     */

    private function comprobarCargo($especialidad)
    {
        $cargo = '';

        switch ($especialidad) {
            case '1':
                $cargo = 'Pediatra';
            break;
            case '2':
                $cargo = 'Periodontologo';
            break;
            case '3':
               $cargo = 'Cirujano';
            break;
            case '4':
               $cargo = 'General';
               break;
            case '5':
                $cargo = 'Odontologo';
            break;
      }

      return $cargo;
    }



}
