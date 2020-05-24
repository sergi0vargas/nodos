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

    //cuando me consultan
    public function retornaSumaNumeros(Request $request){


        //leer quien me llamo, y guardar

        $listadoNumeros = Numero::all();

        $suma = 0;
        foreach ($listadoNumeros as $n) {
            $suma += $n->numero;
        }

        $listadoServidores = Server::all();

        $ipCliente = $_SERVER['REMOTE_ADDR'];
        foreach ($listadoServidores as $servidor) {
            if(strpos($servidor->url, $ipCliente) !== false){
                $servidor->yaMeConsulto = 1;
                $servidor->save();
                print("NO encontrado encontrado , marcando leido");
            }else{

            }
        }
        //esto es para saber la ip de internet
        /*
            $externalContent = file_get_contents('http://checkip.dyndns.com/');
            preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
            $externalIp = $m[1];
        */

        return response()->json(['total' => $suma,'ip' => $_SERVER['REMOTE_ADDR'] ]);
    }

    //cuando yo consulto a los demas
    public function LlamarServidoresYSumar(){

        $listadoServidores = Server::all();
        $total = 0;
        foreach ($listadoServidores as $servidor) {
            if($servidor->yaLoConsulte == 1)
                print("servidor consultado anteriormente ->");
            //me guardo el servidor como consultado
            $servidor->yaLoConsulte = 1;
            $servidor->save();

            $response = Http::get($servidor->url)['total'];
            $total += floatval ($response);
            print("Respuesta Servidor ".$response."<br>");
        }
        //Falta sumarme a mi mismo
        $listadoNumeros = Numero::all();
        $suma = 0;
        foreach ($listadoNumeros as $n) {
            $suma += $n->numero;
        }
        print("<br>");
        print("Valor sin sumar el local".$total."<br>");
        print("Valor Local ".$suma."<br>");
        print("<br>");
        print("Valor total final ".($total+$suma));
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
