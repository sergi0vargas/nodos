<?php

namespace App\Http\Controllers;

use App\Numero;
use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NumerosController extends Controller
{
    public function index()
    {
        $listadoNumeros = Numero::all();

        $suma = 0;
        foreach ($listadoNumeros as $n) {
            $suma += $n->numero;
        }

        $listadoServidores = Server::all();
        return view('index')->with('listadoNumeros', $listadoNumeros)->with('listadoServidores', $listadoServidores)->with('suma',$suma);
    }

    public function guardarNumeroWeb(Request $request){

        $numeroNuevo = new Numero();

        $numeroNuevo->numero = $request->input('numero');
        $numeroNuevo->save();

        $listadoNumeros = Numero::all();
        $listadoServidores = Server::all();
        return redirect('/')->with('listadoNumeros',$listadoNumeros)->with('listadoServidores',$listadoServidores);
    }

    public function retornaSumaNumeros(Request $request){

        $listadoNumeros = Numero::all();

        $suma = 0;
        foreach ($listadoNumeros as $n) {
            $suma += $n->numero;
        }


        $externalContent = file_get_contents('http://checkip.dyndns.com/');
        preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
        $externalIp = $m[1];
        return response()->json(['total' => $suma,'ip' =>  $externalIp ]);
    }

    public function LlamarServidoresYSumar(){

        $listadoServidores = Server::all();
        //
        foreach ($listadoServidores as $servidor) {
            $response = Http::get($servidor->url);
            print($response->body());
        }
    }

    public function guardarURL(Request $request){

        $nuevoServer = new Server();

        $nuevoServer->url = $request->input('url');
        $nuevoServer->save();



        $listadoNumeros = Numero::all();
        $listadoServidores = Server::all();
        return redirect('/')->with('listadoNumeros',$listadoNumeros)->with('listadoServidores',$listadoServidores);
    }

    public function borrarURL(int $id){

        $serverABorrar = Server::get($id);

        $serverABorrar->delete();

        $listadoNumeros = Numero::all();
        $listadoServidores = Server::all();
        return redirect('/')->with('listadoNumeros',$listadoNumeros)->with('listadoServidores',$listadoServidores);
    }

    //borrarURL

// por aca pase
}
