<?php

namespace App\Http\Controllers\Pide;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
class AsientosController extends Controller
{
    public function index(Request $request){
    	//$usersId = trim($request->get('numero_partida'));

    	/*if($usersId==""){
    		$client = new Client([
	    // Base URI is used with relative requests
	    'base_uri' => 'https://jsonplaceholder.typicode.com',
	    // You can set any number of default request options.
	    'timeout'  => 2.0,
		]);
		$response = $client->request('GET', 'posts?userId=1');
		$responseusers = $client->request('GET', 'users');
		$json = json_decode(($response->getBody()->getContents()));
		$users = json_decode(($responseusers->getBody()->getContents()));
    		return view('sunarp.asientos.consultar.index',['json'=>$json,'users'=>$users,'usersId'=>$usersId]);
    	}
    	else{
    	if($request){
    	$client = new Client([
	    // Base URI is used with relative requests
	    'base_uri' => 'https://jsonplaceholder.typicode.com',
	    // You can set any number of default request options.
	    'timeout'  => 30.0,
		]);
		$response = $client->request('GET', "posts?userId={$usersId}");
		$responseusers = $client->request('GET', 'users');
		$json = json_decode(($response->getBody()->getContents()));
		$users = json_decode(($responseusers->getBody()->getContents()));
		//dd($json);
		//dd($users);
		}*/
		$clientOficina = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 60.0,
        ]);

        $response = $clientOficina->request('GET', "Oficinas?out=json");

        $oficinas = json_decode($response->getBody()->getContents(),true)['oficina']['oficina'];
        usort($oficinas, function ($a, $b) {
            return $a['descripcion'] <=> $b['descripcion'];
        });

        /*$client = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 30.0,
        ]);

        $response = $client->request('GET', "ListarAsientos?zona=01&oficina=01&partida=44473739&registro=21000&out=json");



        $asientos = json_decode($response->getBody()->getContents(),true);
        $prueba= $asientos['listarAsientosResponse']['asientos'];
        $prueba = array($prueba);

        $cant=count($prueba);
        $listAsientos=array();
        $listFolios=array();
        $listFichas=array();
        for ($i=0;$i<$cant;$i++){
            if (array_key_exists('listFichas', $prueba[0])) {
                $listFichas['Fichas']=1;
            }else{
                $listFichas['Fichas']=0;
            }
            if (array_key_exists('listFolios', $prueba[0])) {
                $listFolios['Folios']=1;
            }else{
                $listFolios['Folios']=0;
            }
            if (array_key_exists('listAsientos', $prueba[0])) {
                $listAsientos['Asientos']=1;
            }else{
                $listAsientos['Asientos']=0;
            }
            //$listFolios=$prueba[0]['listFolios'];
            //$listFichas=$prueba[0]['listFichas'];
            //$listAsientos=$prueba[0]['listAsientos'];
            //dd($prueba[0]['listAsientos']);
        }
        dd($listAsientos);

        $aux=0;
            foreach ($prueba as $key) {
                $aux=$aux+1;
            }
        //dd($aux);*/

    	return view('pide.sunarp.asientos.consultar.index',["oficinas"=>$oficinas]);
    }


    public function show($id, Request $request){
        //$contador = array();
        $codZona=$request->get('codZona');
        $codOficina=$request->get('codOficina');
        $registro=$request->get('registro');
        $numero_partida=$request->get('numero_partida');


        $client = new Client([
        'base_uri' => 'https://ws3.pide.gob.pe/Rest/Sunarp/',
        'timeout'  => 30.0,
        ]);

        $response = $client->request('GET', "ListarAsientos?zona={$codZona}&oficina={$codOficina}&partida={$numero_partida}&registro={$registro}&out=json");



        $asientosval = json_decode($response->getBody()->getContents(),true);

        $prueba= $asientosval['listarAsientosResponse']['asientos'];
        $prueba = array($prueba);
        //dd($prueba);
        //dd(count($prueba));
        /*foreach($prueba as $a){
            dd($a[0]);
        }*/
        $cant=count($prueba);
        $listAsientos=array();
        $listFolios=array();
        $listFichas=array();
        for ($i=0;$i<$cant;$i++){
            if (array_key_exists('listFichas', $prueba[0])) {
                $listFichas['Fichas']=1;
            }else{
                $listFichas['Fichas']=0;
            }
            if (array_key_exists('listFolios', $prueba[0])) {
                $listFolios['Folios']=1;
            }else{
                $listFolios['Folios']=0;
            }
            if (array_key_exists('listAsientos', $prueba[0])) {
                $listAsientos['Asientos']=1;
            }else{
                $listAsientos['Asientos']=0;
            }
            //$listFolios=$prueba[0]['listFolios'];
            //$listFichas=$prueba[0]['listFichas'];
            //$listAsientos=$prueba[0]['listAsientos'];
            //dd($prueba[0]['listAsientos']);
        }
        $asientos = array_merge($asientosval, $listFichas, $listAsientos, $listFolios);

        return response()->json(['data' => $asientos]);
    }
}
