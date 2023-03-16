<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Auxiliares;

class NoticiasController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
             'correo' => 'required|max:255|email',
        ]);

        if($validator->fails())
        {
         return response('' , 422);
        }
        else
        {
           $correo = Auxiliares::limpiarValores($data['correo']);

           DB::insert('INSERT INTO noticias VALUES(? , ?)' , [null , $correo]);

           return response('' , 200);
        }

    }
}
