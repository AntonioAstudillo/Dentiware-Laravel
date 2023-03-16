<?php

namespace App\Http\Controllers\admin;

use FFI\Exception;
use App\Rules\ValidaNombre;
use App\Helpers\Auxiliares;
use Illuminate\Support\Str;
use App\Rules\ValidarCorreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Rules\ValidaDomicilio;
use App\Rules\ValidaGenero;
use Illuminate\Support\Facades\Validator;


class PacienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Insertamos en la base de datos un paciente junto con toda la información correspondiente a su primera cita. Retornamos un codigo de estado indicando el resultado
     * de la solicitud recibida.
     * Este metodo se manda a llamar desde una petición asincrona en javascript, la peticion se encuentra en la siguiente ruta admin/registroPaciente.js
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //Sanitizamos datos
        $data = array_map('trim' , $data);
        $data = array_map('strip_tags' , $data);
        $data = array_map('htmlspecialchars', $data);

        $validator = Validator::make($data, [
            'nombrePaciente' => ['required' , 'max:50' , 'string' , new ValidaNombre ] ,
            'apellidoPaciente' => ['required' , 'max:50' , 'string' , new ValidaNombre ] ,
            'edadPaciente' => 'required|max:255|integer',
            'telefonoPaciente' => 'required|numeric',
            'generoPaciente' => ['required' , 'string' , new ValidaGenero] ,
            'domicilioPaciente' => ['required' , 'max:150' , 'string' , new ValidaDomicilio ] ,
            'correoPaciente' => ['required' , 'string' , new ValidarCorreo(2)],
            'tratamientoPaciente' => 'required|string',
            'dentistaPaciente' => 'required|numeric',
            'fechaCita' => 'required|date',
            'horaCita' => 'required|string',
            'comentariosPaciente' => 'string'
        ]);



        if($validator->fails())
        {
            $errores = $validator->getMessageBag()->all();

            return response()->json(['errors' => $errores] , 422);

        }else{

            //Validamos la cita primero.
            if(!Auxiliares::validarCita($data['horaCita'] , $data['fechaCita'] , $data['dentistaPaciente'] ))
            {
                return response()->json(['errors' => 'Cita ocupada'] , 422);
            }


           //obtenemos el saldo
           $saldo = DB::select("SELECT precio FROM tratamiento where idtratamiento = ?" , [$data['tratamientoPaciente'] + 1 ]);
           $data['saldo'] = $saldo[0]->precio;

           try
           {
                DB::transaction(function () use($data)
                {
                    DB::insert("INSERT INTO persona(idPersona, nombre , apellidos, edad, telefono , correo, direccion , genero , tipo) values(?,?,?,?,?,?,?,?,?)",
                    [null, Str::ucfirst($data['nombrePaciente']) , Str::ucfirst($data['apellidoPaciente']) , $data['edadPaciente'] , $data['telefonoPaciente'] , $data['correoPaciente'],
                    $data['domicilioPaciente'] , $data['generoPaciente'] , 2]);

                    //obtenemos el ultimo id
                    $idLast = DB::getPdo()->lastInsertId();

                    DB::insert("INSERT INTO paciente(idpaciente , idPersona , comentarios) values(?, ? ,?)" , [null , $idLast , $data['comentariosPaciente']]);


                    DB::insert("INSERT INTO cita(idcita , fecha , hora , idPaciente , idDentista , idTratamiento , abono , idComentarios , date_Register) values(?,?,?,?,?,?,?,?,?)",
                    [null , $data['fechaCita'], $data['horaCita'] , $idLast , $data['dentistaPaciente'] , $data['tratamientoPaciente'] +1 , $data['saldo'] , null, Auxiliares::getDatetime()]);

                    DB::insert("INSERT INTO historialtratamiento values(?,?,?,?)" , [null , $idLast , '1' , $data['saldo']]);

                });

                //retornarmos un 200 si la transaccion se hizo de forma correcta.
                return response('' , 200);

           }catch(Exception $e){
                return response('' , 500);
           }

        }//cierra else

    }//cierra metodo store

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Mostramos la vista para poder editar un determinado paciente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.editarPaciente');
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


    /**
     * Este metodo nos sirve para llenar el datatable de la vista editarPaciente
     * Este metodo se manda a llamar desde una petición asincrona en el archivo editarPaciente.js de mi carpeta public/admin
     */
    public function getAllPacientes()
    {

        $pacientes = DB::select("SELECT persona.idPersona , persona.nombre , persona.apellidos ,persona.edad , persona.correo , persona.telefono , persona.direccion , persona.genero  FROM persona WHERE persona.tipo = ?" , [2]);


        return response()->json(['data' => $pacientes]);
    }


    public function actualizarDatosPaciente(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'nombre' => ['required' , 'max:50' , 'string' , new ValidaNombre ] ,
            'apellidos' => ['required' , 'max:50' , 'string' , new ValidaNombre ] ,
            'edad' => 'required|max:255|integer',
            'telefono' => 'required|numeric',
            'correo' => ['required' , 'string' , 'email'],
            'direccion' => ['required' , 'max:150' , 'string' , new ValidaDomicilio ] ,
            'genero' => ['required' , 'string' , new ValidaGenero],

        ]);


        if($validator->fails())
        {
            return response('', 422);
        }

        $filasAfectadas = DB::update("UPDATE persona SET nombre = ? , apellidos = ? , edad = ? , telefono = ? , correo = ? , direccion = ? , genero = ?
        WHERE idPersona = ? " , [$data['nombre'] , $data['apellidos'] , $data['edad'] , $data['telefono'] , $data['correo'], $data['direccion'] , $data['genero'] , $data['id']]);

        if($filasAfectadas > 0)
        {
            return response('' , 200);
        }else{
            return response('' , 500);
        }
    }
}
