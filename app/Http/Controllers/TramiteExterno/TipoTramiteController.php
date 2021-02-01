<?php

namespace App\Http\Controllers\TramiteExterno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TipoTramiteController extends Controller
{
    public function verTipoTramite(Request $request){
        $pagina="Mantenedor de Tipo de Trámite";
        $areas=DB::select("exec trd_tipotramite @tipo='19'");
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('desc') || $request->get('area')){
            $desc=$request->get('desc');
            $area=$request->get('area');
            $tptras=DB::select("exec trd_tipotramite @tipo='3', @value='".$desc."',@primero='".$area."'");
            $cant_tptra=count($tptras);
            $pageSize=$cant_tptra;
        }else{
            $tptras=DB::select("exec trd_tipotramite @tipo='1', @start='".$offset."', @end='".$pageSize."'");
            $cant=DB::select('exec trd_tipotramite @tipo=2');
            $cant_tptra=$cant[0]->coddoc;
        }
        if($cant_tptra!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($tptras,$cant_tptra, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.tipotramite',['pagina'=>$pagina,'areas'=>$areas,'tipotramites'=>$paginator]);
        }else{
            return view('tramitedocumentario.mantenedores.tipotramite',['pagina'=>$pagina,'areas'=>$areas]);
        }
    }

    public function nuevoTipoTramite(){
        $pagina="Editar de Tipo de Trámite";
        $areas=DB::select("exec trd_tipotramite @tipo='19'");
        return view('tramitedocumentario.mantenedores.regtipotramite',['pagina'=>$pagina,'areas'=>$areas]);
    }

    public function registrarTipoTramite(Request $request){
        $dsc=$request->get('descripcion');
        $area=$request->get('area');
        $online=$request->get('online');
        DB::raw("exec trd_tipotramite @tipo='7',@value='".$area."',@primero='".strtoupper($dsc)."',@start='".$online."',@segundo='1'");
        return redirect('tramitedocumentario/tipotramites')->with(['alert'=>'Tipo de Tramite registrado']);
    }

    public function editarTipoTramite(Request $request){
        $id=$request->get('id');
        $pagina="Editar de Tipo de Trámite";
        $areas=DB::select("exec trd_tipotramite @tipo='19'");
        $tipotramite=DB::select("exec trd_tipotramite @tipo='5', @codigo='".$id."'");
        return view('tramitedocumentario.mantenedores.vertipotramite',['pagina'=>$pagina,'tipotramite'=>$tipotramite,'areas'=>$areas]);
    }
    public function actualizarTipoTramite(Request $request){
        $id=$request->get('id');
        $dsc=$request->get('descripcion');
        $area=$request->get('area');
        $online=0;
        if($request->get('desc')){
            $online=1;
        }else{
            $online=0;
        }
        DB::statement("exec trd_tipotramite @tipo='17',@codigo='$id',@primero='$dsc',@value='$area',@start='$online''");
        return redirect('tramitedocumentario/tipotramites')->with(['alert'=>'Tipo de Tramite editado']);
    }

    public function anularTipoTramite(Request $request){
        $id=$request->get('id');
        $estado=$request->get('estado');
        if($estado==1){
            $est=0;
            DB::statement("exec trd_tipotramite @tipo='18',@codigo=".$id.",@value='".$est."'");
            return redirect('tramitedocumentario/tipotramites')->with(['alert'=>'Tipo de Tramite Anulado']);
        }else{
            $est=1;
            DB::statement("exec trd_tipotramite @tipo='18',@codigo=".$id.",@value='".$est."'");
            return redirect('tramitedocumentario/tipotramites')->with(['alert'=>'Tipo de Tramite Activado']);
        }

    }
}
