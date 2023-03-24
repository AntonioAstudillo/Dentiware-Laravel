<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Helpers\Auxiliares;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Visualizamos la vista principal de dashboard
     */
    public function index()
    {
        return view('admin.registroPacientes');
    }

    //obtenemos todos los datos de la tabla users, para mostrarlos en el datatable de administrador/administrador
    public function all()
    {
       $resultado = DB::select('SELECT id , name , email  , created_at  FROM users');

       return response()->json(['data' => $resultado]);
    }



    /**
     *  Creamos un nuevo usuario
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['fecha']  = Auxiliares::getDatetime();

        $count = DB::insert("INSERT INTO users(name , email , password , created_at , updated_at) values(?,?,?,?,?)" , [ucwords($data['nombreUsuario']) , $data['correoUsuario'] , $data['password'] , $data['fecha']  , $data['fecha'] ]);

        if($count > 0)
        {
            return response('' , 200);
        }
        else{
            return response('' , 500);
        }
    }


    /**
     * Mostramos una lista con todos los usuarios con perfil de administrador registrados.
     */
    public function show()
    {
        return view('admin.administrador');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $data['time'] = Auxiliares::getDatetime();

        if(isset($data['password']))
        {
            $data['password'] = Hash::make($data['password']);
          DB::update('UPDATE users SET name = ? , email = ? , password = ?  , updated_at = ? WHERE id = ? ' , [ ucwords($data['nombre']) , $data['correo'] , $data['password'] , $data['time']   , $data['idPersona']  ]);
        }else{
           DB::update('UPDATE users SET name = ? , email = ?  , updated_at = ?  WHERE id = ? ' ,[ ucwords($data['nombre'])  , $data['correo'] , $data['time'] ,  $data['idPersona']  ]);
        }

        return response('' , 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $count = DB::delete('DELETE FROM users WHERE id = ?' , [$id]);

        if($count > 0)
        {
            return response('' , 200);
        }
        else{
            return response('' , 500);
        }


    }
}
