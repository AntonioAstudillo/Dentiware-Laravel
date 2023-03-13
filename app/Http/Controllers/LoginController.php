<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check())
        {
            return redirect('/dashboard');
        }

        return view('login');

    }

    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required|max:255|email',
            'password' => 'required',
        ]);


        if($validator->fails())
        {
            return response('La validacion falla' , 422);
        }
        else
        {
            if(!( auth()->attempt( $request->only('email' , 'password') )  )   )
            {
                return response('Credenciales incorrectas' , 401);

            }
            else{
                return response('Acceso correcto' , 200);
            }
        }
    }


    public function logout()
    {
        auth()->logout();

       return redirect()->route('login');
    }

}
