<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
class PlantillaController extends Controller
{
    public function verPlantillas(Request $request){
      $pagina="Plantillas";
      $page = request('page', 1);
      $pageSize = 15;
      $offset = ($page * $pageSize) - $pageSize;
      if($request->get('query')){
          $query=$request->get('query');
          $plantillas=DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(12,"","","","",$query,"",""));
          $data = array_slice($plantillas, $offset, $pageSize, true);
          $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($plantillas), $pageSize, $page);
          $paginator->setPath(request('url'));
          return view('administracion.plantillas.plantillas',['pagina'=>$pagina,'plantillas'=>$paginator,'query'=>$query]);
      }else{
        $plantillas=DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(1,"","","","","","",""));
        $data = array_slice($plantillas, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($plantillas), $pageSize, $page);
        $paginator->setPath(request('url'));
        //return dd($plantillas);
        return view('administracion.plantillas.plantillas',['pagina'=>$pagina,'plantillas'=>$paginator]);
      }
    }

    public function registrarPlantilla(){
      $pagina='Registrar Plantilla Rol';
      return view('administracion.plantillas.registrar_plantilla',['pagina'=>$pagina]);
    }

    public function guardarPlantilla(Request $request){
      $plantilla=$request->get('plantilla');
      $desc=$request->get('descripcion');
      DB::statement('exec sp_plarol ?,?,?,?,?,?,?,?', array(5,"","","","",$plantilla,$desc,""));
      return redirect('administracion/plantillas')->with(['alert'=>'Plantilla '.$plantilla.' creada']);
    }

    public function cambiarEstadoPlantilla(Request $request){
      $id=$request->get('id');
      $estado=$request->get('estado');
      DB::statement('exec sp_plarol ?,?,?,?,?,?,?,?', array(8,"",$id,"","","","",$estado));
      return redirect('administracion/plantillas')->with(['alert'=>'Estado actualizado correctamente']);
    }

    public function editarPlantilla($id){
      $pagina='Editar Plantilla Rol';
      $plantilla=DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(13,"",$id,"","","","",""));
      return view('administracion.plantillas.editar_plantilla',['pagina'=>$pagina,'plantilla'=>$plantilla]);
    }

    public function actualizarPlantilla($id,Request $request){
      $plantilla=$request->get('plantilla');
      $desc=$request->get('descripcion');
      DB::statement('exec sp_plarol ?,?,?,?,?,?,?,?', array(9,"",$id,"","",$plantilla,$desc,""));
      return redirect('administracion/plantillas')->with(['alert'=>'Plantilla '.$plantilla.' actualizada']);
    }

    public function verPermisosModulosUsuario($id){
        $pagina="Permisos de Modulos";
        $modulos=DB::table('Modulo')->select()->get();
        $mod_pla=DB::table('mod_pla')->select('mod_codigo')->where('plarol_id',$id)->get();
        $plantilla=DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(13,"",$id,"","","","",""));
        return view('administracion.plantillas.permisos_modulos',['pagina'=>$pagina,'modulos'=>$modulos,'mod_pla'=>$mod_pla,'plantilla'=>$plantilla]);
    }

    public function verPermisosUsuario($id){
        $pagina="Permisos de Grupos y Tareas";
        $modulos=DB::table('Modulo')->select()->get();
        $plantilla=DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(13,"",$id,"","","","",""));
        $mod_men=DB::table('mod_pla')->select('mod_pla.mod_codigo','Modulo.mod_descripcion')
            ->join('Modulo','mod_pla.mod_codigo','=','Modulo.mod_codigo')
            ->where('plarol_id',$id)->get();
        $m=Array();
        $mod_pla=DB::table('mod_pla')->select('mod_codigo')->where('plarol_id',$id)->get();
        foreach ($mod_pla as $n){
            array_push($m,$n->mod_codigo);
        }
        $grupos1=DB::table('grupo')->select()->where('gru_activo',1)->whereIn('mod_codigo',$m)->get();
        $g=Array();
        foreach ($grupos1 as $s){
            array_push($g,$s->grupo_id);
        }
        $tareas1=DB::table('tarea')->select()->where('tar_activo',1)->whereIn('grupo_id',$g)->get();
        $tar_pla=DB::table('tar_pla')->select()->where('plarol_id',$id)->get();
        //return dd($grupos1);
        return view('administracion.plantillas.permisos',['pagina'=>$pagina,'modulos'=>$modulos,'mod_pla'=>$mod_pla,'mod_men'=>$mod_men,'grupos1'=>$grupos1,'tareas1'=>$tareas1,'tar_pla'=>$tar_pla,'plantilla'=>$plantilla]);
    }

    public function registrarPermisosModulosUsuario($id,Request $request){
        $plantilla=DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(13,"",$id,"","","","",""));
        $modulos=$request->get('Modulos');
        DB::statement('exec sp_plarol ?,?,?,?,?,?,?,?', array(10,"",$id,"","","","",""));
        foreach ($modulos as $m){
            DB::statement('exec sp_plarol ?,?,?,?,?,?,?,?', array(6,"",$id,$m,"","","",""));
        }
        //return dd($modulos);
        return redirect('administracion/plantillas')->with(['alert'=>'Permisos a modulos actualizados para la plantilla '.$plantilla[0]->plarol_nombre]);
    }

    public function registrarPermisosUsuario($id,Request $request){
        $plantilla=DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(13,"",$id,"","","","",""));
        $tareas=$request->get('Tareas');
        DB::statement('exec sp_plarol ?,?,?,?,?,?,?,?', array(11,"",$id,"","","","",""));
        foreach ($tareas as $t){
            DB::statement('exec sp_plarol ?,?,?,?,?,?,?,?', array(7,"",$id,"",$t,"","",""));
        }
        //return redirect('usuarios');
        return redirect('administracion/plantillas')->with(['alert'=>'Permisos a tareas actualizados para la plantilla '.$plantilla[0]->plarol_nombre]);
    }
}
