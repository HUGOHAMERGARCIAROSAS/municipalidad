<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
class TareaController extends Controller
{
  public function verTareas(Request $request){
      $pagina="Tareas";
      $page = request('page', 1);
      $pageSize = 10;
      $offset = ($page * $pageSize) - $pageSize;
      if ($request->get('query')) {
          $query = $request->get('query');
          $tareas=DB::select('exec sp_tarea ?,?,?,?,?,?,?,?,?,?,?,?',array("","","$query","",""," ","",""," "," ",13,""));
          $data = array_slice($tareas, $offset, $pageSize, true);
          $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($tareas), $pageSize, $page);
          $paginator->setPath(request('url'));
          return view('administracion.tareas.tareas',['pagina'=>$pagina,'tareas'=>$paginator,'query'=>$query]);
      }else{
        $tareas=DB::select('exec sp_tarea ?,?,?,?,?,?,?,?,?,?,?,?',array(" ","","","",""," ","",""," "," ",12,""));
        $data = array_slice($tareas, $offset, $pageSize, true);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($tareas), $pageSize, $page);
        $paginator->setPath(request('url'));
      return view('administracion.tareas.tareas',['pagina'=>$pagina,'tareas'=>$paginator]);
      }
  }

  public function cambiarEstadoTarea(Request $request){
    $id=$request->get('id');
    $estado=$request->get('estado');
    DB::statement('exec sp_tarea ?,?,?,?,?,?,?,?,?,?,?,?',array("$id","","","",""," ","",$estado," "," ",14,""));
    //return dd($estado);
    return redirect('/administracion/tareas')->with(['alert'=>'Estado actualizado']);
  }

  public function registrarTarea(){
      $pagina='Registro de Tareas';
      $modulos=DB::table('modulo')->select()->get();
      return view('administracion.tareas.registrar_tareas',['pagina'=>$pagina,'modulos'=>$modulos]);
  }

  public function editarTarea($id){
      $tarea=DB::table('tarea')->select()->where('tarea_id',$id)->first();
      $pagina='Editar de Tareas';
      $modulos=DB::table('modulo')->select()->get();
      $grupos=DB::table('grupo')->select()->where('mod_codigo',$tarea->mod_codigo)->get();
      return view('administracion.tareas.editar_tarea',['pagina'=>$pagina,'tarea'=>$tarea,'modulos'=>$modulos,'grupos'=>$grupos]);
  }

  public function actualizarTarea($id,Request $request){
    $modulo=$request->get('modulo');
    $grupo=$request->get('grupo');
    $nombre=$request->get('tarea');
    $desc=$request->get('descripcion');
    $url=$request->get('url');
    $icono=$request->get('icono');
    $orden=$request->get('orden');
    DB::statement('exec sp_tarea ?,?,?,?,?,?,?,?,?,?,?,?',array("$id","$grupo","$nombre","$desc","$icono","$orden","$url",1," "," ",8,"$modulo"));
    return redirect('/administracion/tareas')->with(['alert'=>'Informacion actualizada para la tarea '.$nombre]);
  }

  public function guardarTarea(Request $request){
    $modulo=$request->get('modulo');
    $grupo=$request->get('grupo');
    $nombre=$request->get('tarea');
    $desc=$request->get('descripcion');
    $url=$request->get('url');
    $icono=$request->get('icono');
    $orden=$request->get('orden');
    //agregar logica de nombre unico por modulo
    DB::statement('exec sp_tarea ?,?,?,?,?,?,?,?,?,?,?,?',array(" ","$grupo","$nombre","$desc","$icono","$orden","$url",1," "," ",7,"$modulo"));
    return redirect('/administracion/tareas')->with(['alert'=>'Tarea '.$nombre.' creada']);
  }
}
