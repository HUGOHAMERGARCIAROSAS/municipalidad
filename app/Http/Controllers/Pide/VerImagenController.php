<?php

namespace App\Http\Controllers\Pide;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
class VerImagenController extends Controller
{
    public function index(Request $request){

    }

    public function show($transaccion, $idImg, $tipo, $nroTotalPag, $nroPagRef, $pagina){
    	//dd($idImg);
    	$idImg=$idImg;
    	$transaccion=$transaccion;
    	$tipo=$tipo;
    	$nroTotalPag=$nroTotalPag;
    	$nroPagRef=$nroPagRef;
    	$pagina=$pagina;

    	//dd($transaccion);

    	$client = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 30.0,
        ]);
        
        $response = $client->request('GET', "VerAsientos?transaccion={$transaccion}&idImg={$idImg}&tipo={$tipo}&nroTotalPag={$nroTotalPag}&nroPagRef={$nroPagRef}&pagina={$pagina}&out=json");

        $imagen = json_decode($response->getBody()->getContents(),true)['verAsientoResponse']['img'];
        
        //$jpg = base64_decode($imagen);
        //dd($imagen);
        //return response()->json(['data' => $imagen]);
        /*$pdf= \PDF::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
		return $pdf->stream();*/
		//$pdf= \PDF::loadView('sunarp.asientos.consultar.show',['jpg'=>$jpg]);
		//return $pdf;
		//dd($jpg);
        return view('pide.sunarp.asientos.consultar.show',["imagen"=>$imagen]);
    }
}
