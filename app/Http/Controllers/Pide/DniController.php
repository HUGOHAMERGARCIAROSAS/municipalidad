<?php

namespace App\Http\Controllers\Pide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class DniController extends Controller
{
    public function index(Request $request){
        return view('pide.reniec.dni.consultar.index');
    }

    public function show(Request $request){
        $dni=$request->get('dni');

        $client = new Client([
            'base_uri' => 'https://ws5.pide.gob.pe/Rest/Reniec/',
            'timeout'  => 30.0,
        ]);

        $response = $client->request('GET', "Consultar?nuDniConsulta=$dni&nuDniUsuario=41756520&nuRucUsuario=20174738085&password=*Mv7@rc02020&out=json");

        $busqueda = json_decode($response->getBody()->getContents());

        return response()->json(['data' => $busqueda]);
    }
}
