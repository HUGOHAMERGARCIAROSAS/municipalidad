<?php

namespace App\Http\Controllers\TramiteExterno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TupaController extends Controller
{
    public function verTupa(Request $request){
        $pagina="TUPA - Procesos";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        if($request->get('nombre') || $request->get('anio')){
            $nombre=$request->get('nombre');
            $anio=$request->get('anio');
            $tupas=DB::select("exec sp_tupa @tipo='3', @start='".$offset."', @limit='".$pageSize."'");
            $cant_corr=count($tupas);
            $pageSize=$cant_corr;
        }else{
            $tupas=DB::select("exec sp_tupa @tipo='3', @start='".$offset."', @limit='".$pageSize."'");
            $cant=DB::select("exec sp_tupa @tipo='4'");
            $cant_corr=$cant[0]->total;
        }
        if($cant_corr!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($tupas,$cant_corr, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.tupa.tupa',['pagina'=>$pagina,'tupas'=>$paginator]);
        }else{
            return view('tramitedocumentario.tupa.tupa',['pagina'=>$pagina]);
        }
    }

    public function nuevoTupa(){
        $pagina="Nuevo Proceso";
        $areas=DB::select("exec sp_mov_tupa @tipo = '1'");
        return view("tramitedocumentario.tupa.nuevotupa",['pagina'=>$pagina,"areas"=>$areas]);
    }

    public function editarTupa(Request $request){
        $pagina="Nuevo Proceso";
        $id=$request->get("proceso");
        $proceso=DB::select("SET NOCOUNT ON; exec sp_tupa @tipo='1', @proceso_id='$id'");
        $areas=DB::select("SET NOCOUNT ON; exec sp_mov_tupa @tipo = '1'");
        return view("tramitedocumentario.tupa.nuevotupa",['pagina'=>$pagina,"areas"=>$areas,"proceso"=>$proceso]);
    }

    public function registrarTupa(Request $request){
        $area=$request->get("are_codigo");
        $nombre=$request->get("nombre");
        $subnombre=$request->get("sub_nombre");
        $porcentaje=$request->get("porcentaje_uit");
        $soles=$request->get("soles_uit");
        $plazo=$request->get("plazo_resolver");
        $inicia=$request->get("inicia_proceso");
        $resuelve=$request->get("autoridad_resuelve");
        $instancia=$request->get("instancia_consideracion");
        $apela=$request->get("presenta_apelacion");
        DB::unprepared("exec sp_tupa @tipo='6', @are_codigo='$area', @nombre='$nombre', @sub_nombre='$subnombre', @porcentaje_uit='$porcentaje', @soles_uit='$soles', @plazo_resolver='$plazo', @inicio_procedimiento='$inicia', @autoridad_resuelve='$resuelve', @instancia_consideracion='$instancia', @presenta_apelacion='$apela'");
        return redirect("tramitedocumentario/procesos")->with(['alert'=>'Proceso Registrado']);
    }
    public function actualizarTupa(Request $request){
        $area=$request->get("are_codigo");
        $nombre=$request->get("nombre");
        $subnombre=$request->get("sub_nombre");
        $porcentaje=$request->get("porcentaje_uit");
        $soles=$request->get("soles_uit");
        $plazo=$request->get("plazo_resolver");
        $inicia=$request->get("inicia_proceso");
        $resuelve=$request->get("autoridad_resuelve");
        $instancia=$request->get("instancia_consideracion");
        $apela=$request->get("presenta_apelacion");
        $proceso=$request->get("proceso");
        DB::unprepared("exec sp_tupa @tipo='8',@proceso_id='$proceso' ,@are_codigo='$area', @nombre='$nombre', @sub_nombre='$subnombre', @porcentaje_uit='$porcentaje', @soles_uit='$soles', @plazo_resolver='$plazo', @inicio_procedimiento='$inicia', @autoridad_resuelve='$resuelve', @instancia_consideracion='$instancia', @presenta_apelacion='$apela'");
        return redirect("tramitedocumentario/procesos")->with(['alert'=>'Proceso Actualizado']);
    }

    public function activaTupa(Request $request){
        $proceso=$request->get("proceso");
        DB::unprepared("exec sp_tupa @tipo='10',@proceso_id='$proceso'");
        return redirect("tramitedocumentario/procesos")->with(['alert'=>'Proceso Activado']);
    }

    public function anulaTupa(Request $request){
        $proceso=$request->get("proceso");
        DB::unprepared("exec sp_tupa @tipo='9',@proceso_id='$proceso'");
        return redirect("tramitedocumentario/procesos")->with(['alert'=>'Proceso Anulado']);
    }
}
