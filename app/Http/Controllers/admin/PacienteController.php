<?php

namespace App\Http\Controllers\admin;

use FFI\Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidarCorreo;

class PacienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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


        $validator = Validator::make($data, [
            'nombrePaciente' => 'required|max:50|string',
            'apellidoPaciente' => 'required|max:60|string',
            'edadPaciente' => 'required|max:255|integer',
            'telefonoPaciente' => 'required|numeric',
            'generoPaciente' => 'required|string|',
            'domicilioPaciente' => 'required|string',
            'correoPaciente' => ['required' , 'string' , new ValidarCorreo],
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
           //Sanitizamos datos
           $data = array_map('trim' , $data);
           $data = array_map('strip_tags' , $data);
           $data = array_map('htmlspecialchars', $data);

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


                    DB::insert("INSERT INTO cita(idcita , fecha , hora , idPaciente , idDentista , idTratamiento , abono , idComentarios) values(?,?,?,?,?,?,?,?)",
                            [null , $data['fechaCita'], $data['horaCita'] , $idLast , $data['dentistaPaciente'] , $data['tratamientoPaciente'] +1 , $data['saldo'] , null
                        ]);

                    DB::insert("INSERT INTO historialtratamiento values(?,?,?,?)" , [null , $idLast , '1' , $data['saldo']]);

                });

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
