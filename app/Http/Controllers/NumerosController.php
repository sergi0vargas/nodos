<?php

namespace App\Http\Controllers;

use App\Numero;
use Illuminate\Http\Request;

class NumerosController extends Controller
{
    public function index()
    {
        $listadoNumeros = Numero::all();
        return view('index')->with('listadoNumeros', $listadoNumeros);
    }

    public function guardarNumeroWeb(Request $request){

        $numeroNuevo = new Numero();

        $numeroNuevo->numero = $request->input('numero');
        $numeroNuevo->save();

        $listadoNumeros = Numero::all();
        return redirect('/')->with('listadoNumeros',$listadoNumeros);
    }

}
