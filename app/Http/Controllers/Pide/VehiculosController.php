<?php

namespace App\Http\Controllers\Pide;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
class VehiculosController extends Controller
{
    public function index(Request $Request){

    	$clientOficina = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 60.0,
        ]);
        
        $response = $clientOficina->request('GET', "Oficinas?out=json");

        $oficinas = json_decode($response->getBody()->getContents(),true)['oficina']['oficina'];
        usort($oficinas, function ($a, $b) {
            return $a['descripcion'] <=> $b['descripcion'];
        });

    	return view('pide.sunarp.vehiculos.consultar.index',["oficinas"=>$oficinas]);
    }

    public function show($id, Request $request){
        $codZona=$request->get('codZona');
        $codOficina=$request->get('codOficina');
        
        $numero_placa=strtoupper($request->get('numero_placa'));
        

        $client = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 30.0,
        ]);
        
        $response = $client->request('GET', "VerDetalleRPV?zona={$codZona}&oficina={$codOficina}&placa={$numero_placa}&out=json");

        $vehiculos = json_decode($response->getBody()->getContents(),true);

        return response()->json(['data' => $vehiculos]);
    }

    public function imprimir(Request $request){
        $codZona=$request->get('codZona');
        $codOficina=$request->get('codOficina');

        $numero_placa=strtoupper($request->get('numero_placa'));


        $client = new Client([
            'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
            'timeout'  => 30.0,
        ]);

        $response = $client->request('GET', "VerDetalleRPV?zona={$codZona}&oficina={$codOficina}&placa={$numero_placa}&out=json");

        $vehiculos = json_decode($response->getBody()->getContents(),true);


        //return dd($vehiculos);
        return view('pide.sunarp.vehiculos.consultar.imprimir',['vehiculos'=>$vehiculos]);
    }
}
