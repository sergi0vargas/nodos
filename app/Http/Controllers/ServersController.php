<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;

class ServersController extends Controller
{
    public function index()
    {
        $listadoURL = Server::all();
        return view('index')->with('listadoURL', $listadoURL);
    }

    public function guardarURL(Request $request){

        $nuevoServer = new Server();

        $nuevoServer->url = $request->input('url');
        $nuevoServer->save();

        $listadoURL = Numero::all();
        return redirect('/')->with('listadoURL',$listadoURL);
    }
}
