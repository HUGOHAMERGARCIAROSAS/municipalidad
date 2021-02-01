<?php

namespace App\Http\Controllers\Pide;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
class TitularidadController extends Controller
{
    public function index(Request $Request){
    	
        /*$client = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 30.0,
        ]);
        
        $response = $client->request('GET', "Titularidad?tipoParticipante=N&apellidoPaterno=SANCHEZ&apellidoMaterno=CHAVEZ&nombres=JORGE&razonSocial=&out=json");

        $titularidad = json_decode($response->getBody()->getContents());
        dd($titularidad);*/

        $clientOficina = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 60.0,
        ]);
        
        $response = $clientOficina->request('GET', "Oficinas?out=json");

        $oficinas = json_decode($response->getBody()->getContents(),true)['oficina']['oficina'];
        usort($oficinas, function ($a, $b) {
            return $a['descripcion'] <=> $b['descripcion'];
        });
        
    	return view('pide.sunarp.titularidad.consultar.index',["oficinas"=>$oficinas]);
    }

    public function show($id, Request $request){
        $tipoParticipante=$request->get('tipoParticipante');
        $paterno=strtoupper($request->get('paterno'));
        $materno=strtoupper($request->get('materno'));
        $nombre=strtoupper($request->get('nombre'));
        $razonSocial=strtoupper($request->get('razon_social'));

        $client = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 30.0,
        ]);
        if($tipoParticipante=="N"){
        $response = $client->request("GET","Titularidad?tipoParticipante=N&apellidoPaterno={$paterno}&apellidoMaterno={$materno}&nombres={$nombre}&razonSocial=&out=json");    
        }else{
           $response = $client->request("GET","Titularidad?tipoParticipante=J&apellidoPaterno=&apellidoMaterno=&nombres=&razonSocial={$razonSocial}&out=json"); 
        }
        

        $titularidad = json_decode($response->getBody()->getContents());

        return response()->json(['data' => $titularidad]);
    }

    public function imprimir(Request $request){
        $tipoParticipante=$request->get('tipo');
        $paterno=strtoupper($request->get('paterno'));
        $materno=strtoupper($request->get('materno'));
        $nombre=strtoupper($request->get('nombre'));
        $razonSocial=strtoupper($request->get('razon_social'));

        $client = new Client([
            'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
            'timeout'  => 30.0,
        ]);
        if($tipoParticipante=="N"){
            $response = $client->request("GET","Titularidad?tipoParticipante=N&apellidoPaterno={$paterno}&apellidoMaterno={$materno}&nombres={$nombre}&razonSocial=&out=json");
        }else{
            $response = $client->request("GET","Titularidad?tipoParticipante=J&apellidoPaterno=&apellidoMaterno=&nombres=&razonSocial={$razonSocial}&out=json");
        }


        $titularidad = json_decode($response->getBody()->getContents());

        //$cant=count($titularidad->buscarTitularidadResponse->respuestaTitularidad->respuestaTitularidad);
        return view('pide.sunarp.titularidad.consultar.imprimir',['titularidad'=>$titularidad->buscarTitularidadResponse->respuestaTitularidad]);
    }
}
