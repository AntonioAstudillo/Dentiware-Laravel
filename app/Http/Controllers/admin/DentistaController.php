<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Auxiliares;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

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
        //
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
        //
    }

    /**
     * Display the specified resource.
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
}
