<?php

namespace App\Http\Controllers\Pide;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
class RazonSocialController extends Controller
{
    public function index(Request $Request){

    	/*$client = new Client([
	    'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
	    'timeout'  => 30.0,
		]);
		
		$response = $client->request('GET', "PJRazonSocial?razonSocial=NORKY'S&out=json");

		$razonsocial = $response->getBody()->getContents();*/
		
		/*foreach($razonsocial as $r){
			$zona=$r->zona;
			dd($zona);
		}
		*/
        
		//dd($razonsocial);
    	return view('pide.sunarp.razonsocial.consultar.index');
    }

    public function show($id, Request $request){
    	$razon=$request->get('razon_social');

    	$client = new Client([
	    'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
	    'timeout'  => 30.0,
		]);
		
		$response = $client->request('GET', "PJRazonSocial?razonSocial={{$razon}}&out=json");

		$razonsocial = json_decode($response->getBody()->getContents());

		return response()->json(['data' => $razonsocial]);
    }
}
