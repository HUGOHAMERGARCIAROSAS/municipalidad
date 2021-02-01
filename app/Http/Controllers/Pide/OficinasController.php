<?php

namespace App\Http\Controllers\Pide;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
class OficinasController extends Controller
{
    public function index(Request $Request){
    	$client = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 30.0,
        ]);

        $response = $client->request('GET', "Oficinas?out=json");

        $oficinas = json_decode($response->getBody()->getContents(),true);
        //dd($oficinas->toJson());
        /*$aux=0;
        	foreach ($oficinas['oficina']['oficina'] as $ofi) {
        		$aux=$aux+1;
        		$dato=$ofi['descripcion'];
        		dd($dato);

        		//dd($aux);
        	}*/
        //dd($aux);
        //dd($oficinas);
        //dd($oficinas);
            //$aux=$oficinas['oficina']['oficina'][]['descripcion'];
        /*usort($oficinas, function ($a, $b) {
            return $a['descripcion'] <=> $b['descripcion'];
        });*/
    	return view('pide.sunarp.oficinas.consultar.index',["oficinas"=>$oficinas]);
    }
}
