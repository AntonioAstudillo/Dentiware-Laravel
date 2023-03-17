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
            return response('', 422);
        }

        //creamos el turno
        $data['horarioDentista'] = Auxiliares::crearTurno($data['horarioDentista']);

        //creamos el cargo del dentista
        $data['cargo'] = $this->comprobarCargo($data['especialidadDentista']);


        /*
           Insertamos la data en sus respectivas tablas. En este punto la información ya viene filtrada y sanitizada
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
    public function edit()
    {
        return view('admin.editarDentista');
    }



    /**
     * Con este metodo obtenemos todos los dentistas de la base de datos, para poder llenar el datatable de editarDentista.
     * Este metodo se manda a llamar desde una petición asincrona.
     * Es un inner join entre la tabla persona y dentista.
     */
    public function getAllDentistas()
    {

        $personas = DB::table('persona')->select('idPersona' , 'nombre' , 'apellidos' , 'edad' , 'telefono' , 'correo' , 'direccion' , 'genero')->where('tipo' , 1);

        $dentistas = DB::table('dentista')->joinSub($personas, 'persona' , function(JoinClause $join){
            $join->on('persona.idPersona' , '=' , 'dentista.idPersona');
        })->select('persona.idPersona' , 'persona.nombre' , 'persona.apellidos', 'persona.edad' , 'persona.telefono' , 'persona.correo'  , 'persona.direccion' , 'persona.genero',   'dentista.cargo' ,
           'dentista.turno' , 'dentista.fechaIngreso' ,
           'dentista.sueldo' , 'dentista.numSocial' , 'dentista.rfc' , 'dentista.cedula' , 'dentista.clabe' , 'dentista.cuentaBancaria')->get();

        return response()->json(['data' => $dentistas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();

        //Sanitizamos datos
        $data = array_map('trim' , $data);
        $data = array_map('strip_tags' , $data);
        $data = array_map('htmlspecialchars', $data);

        /*
            Hay que recordar, que la especialidad es un valor numerico, y el cargo es un valor alfabetico


            En la tabla dentista, especialidad es un valor numerico  y  cargo es un valor alfabetico
            Si el dato enviado por el usuario es numerico, significa que el usuario hizo una modificación,
            asi que debemos encontrar el equivalente a alfabetico del valor que trae especialidad del formulario
            Para almacenar un alfabetico en el campo cargo de nuestra base de datos.

            De lo contrario, si el valor no es numerico, significa que el usuario no modifico ese campo,
            asi que ese alfabetico se lo asignamos a cargo y encontramos el equivalente numerico de la especialidad que mandan desde el formulario. Para de esa manera
            poder almacenar un valor numerico en el campo especialidad, y dejar el alfabetico en el campo cargo.
         */

        if(is_numeric($data['especialidad']))
        {
            $data['cargo'] = $this->comprobarCargo($data['especialidad']);
        }
         else {
            $data['cargo'] = $data['especialidad'];
            $data['especialidad'] = $this->generarCargoDentista($data['especialidad']);
         }


        try
        {
            DB::transaction(function () use($data)
            {
                DB::update("UPDATE persona SET nombre = ? , apellidos = ? , edad = ? , telefono = ? , correo = ? , direccion = ? , genero = ? where idPersona = ?" ,
                [ $data['nombre'] , $data['apellidos'] , $data['edad'] , $data['telefono'] , $data['correo'] , $data['direccion'] , $data['genero'] , $data['id']]);

               DB::update("UPDATE dentista SET especialidad = ? , cargo = ? , turno = ? , fechaIngreso = ? , sueldo = ? , numSocial = ? , rfc = ? ,cedula = ? ,  clabe = ?,  cuentaBancaria = ? , updateDate = ? where idPersona = ?  ",
                [$data['especialidad'] , $data['cargo'] , $data['turno'] , $data['fechaIngreso'] , $data['sueldo'] , $data['nss'] , $data['rfc'] , $data['cedula'],
                $data['clabe'] , $data['numCuenta'] , Auxiliares::getDatetime() ,$data['id']]);

            });

            //retornarmos un 200 si la transaccion se hizo de forma correcta.
            return response('' , 200);

        }catch(Exception $e){
            return response('', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {
            DB::transaction(function () use($id)
            {
                DB::delete("DELETE FROM persona WHERE idPersona = ?" , [$id]);
                DB::delete("DELETE FROM dentista WHERE idPersona = ?" , [$id]);
            });

            return response('' , 200);

        }catch(Exception $e){
            return response('' , 500);
        }
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


    private function generarCargoDentista($especialidad)
    {
        switch ($especialidad) {
            case 'Pediatra':
                $cargo = '1';
                break;
            case 'Periodontologo':
                $cargo = '2';
            break;
            case 'Cirujano':
               $cargo = '3';
            break;
            case 'General':
                $cargo = '4';
            break;
            case 'Odontologo':
               $cargo = '5';
            break;
            default:
               $cargo = '4';
            break;
        }


        return $cargo;
    }

    //Generamos la vista de buscarDentisa
    public function searchDentistView()
    {
        return view('admin.buscarDentista');
    }


     //generamos la vista de eliminarDentista
    public function eliminarDentista()
    {
       return view('admin.eliminarDentista');
    }



}
