<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
class PermisosController extends Controller
{


    public function listarGruposModulo(Request $request){
      $mod=$request->get('mod_codigo');
      $grupos=DB::table('grupo')->select('grupo_id','gru_nombre')->where('mod_codigo',$mod)->get();
      $response = array();
      foreach($grupos as $t){
          $response[] = array(
              "grupo_id"=>$t->grupo_id,
              "gru_nombre"=>$t->gru_nombre
          );
      }
      echo json_encode($response);
      exit;
    }


}
