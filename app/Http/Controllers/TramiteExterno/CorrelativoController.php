<?php

namespace App\Http\Controllers\TramiteExterno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CorrelativoController extends Controller
{
    public function listarCorrelativo(Request $request){
        $pagina="Mantenedor de Correlativos por";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $tipodoc=DB::select("exec trd_correlativo @tipo=10");
        if($request->get('area') || $request->get('tipo')){
            $area=$request->get('area');
            $tipo=$request->get('tipo');
            $correlativos=DB::select("exec trd_correlativo @tipo=3,@primero='".$area."',@segundo='".$tipo."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_corr=count($correlativos);
            $pageSize=$cant_corr;
        }else{
            $correlativos=DB::select("exec trd_correlativo @tipo='1', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_correlativo @tipo='2', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_corr=$cant[0]->linea;
        }
        if($cant_corr!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($correlativos,$cant_corr, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.correlativos',['pagina'=>$pagina,'correlativos'=>$paginator,'areas'=>$areas,'tipodoc'=>$tipodoc]);
        }else{
            return view('tramitedocumentario.mantenedores.correlativos',['pagina'=>$pagina,'areas'=>$areas,'tipodoc'=>$tipodoc]);
        }
    }

    public function anularCorrelativo(Request $request){
        $corr=$request->get("correlativo");
        $sql="exec trd_correlativo @tipo=9,@codigo='".$corr."' ,@usuario='".session('Usuario')->per_login."'";
        DB::raw($sql);
        return redirect('tramitedocumentario/correlativos')->with(['alert'=>'Correlativo anulado '.$sql]);
    }

    public function listarCorrelativoTrb(Request $request){
        $pagina="Mantenedor de Correlativos por Trabajador";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $tipodoc=DB::select("exec trd_correlativo @tipo=10");
        if($request->get('area') || $request->get('tipo')){
            $area=$request->get('area');
            $tipo=$request->get('tipo');
            $correlativos=DB::select("exec trd_correlativotrab @tipo=3,@primero='$area',@segundo='$tipo', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_corr=count($correlativos);
            $pageSize=$cant_corr;
        }else{
            $correlativos=DB::select("exec trd_correlativotrab @tipo='1', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_correlativotrab @tipo='2', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_corr=$cant[0]->linea;
        }
        if($cant_corr!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($correlativos,$cant_corr, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.correlativostrb',['pagina'=>$pagina,'correlativos'=>$paginator,'areas'=>$areas,'tipodoc'=>$tipodoc]);
        }else{
            return view('tramitedocumentario.mantenedores.correlativostrb',['pagina'=>$pagina,'areas'=>$areas,'tipodoc'=>$tipodoc]);
        }
    }

    public function anularCorrelativoTrb(Request $request){
        $corr=$request->get("correlativo");
        $sql="exec trd_correlativo @tipo='9',@codigo='".$corr."' ,@usuario='".Auth::user()->per_login."'";
        DB::raw($sql);
        return redirect('tramitedocumentario/correlativos')->with(['alert'=>'Correlativo anulado '.$sql]);
    }
}
