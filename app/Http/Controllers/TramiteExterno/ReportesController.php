<?php

namespace App\Http\Controllers\TramiteExterno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ReportesController extends Controller
{
    public function verExpRegFechas(Request $request){
        $pagina="Expedientes Registrados de acuerdo a las Fechas ";
        $areas=DB::select("exec lSP_Combos @tipo=1");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=1,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.expregfecha",['pagina'=>$pagina,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expregfecha",['pagina'=>$pagina,'areas'=>$areas]);
        }
    }

    public function verExpRegFechasArea(Request $request){
        $pagina="Expedientes Registrados de acuerdo a las Fechas ";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=1,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.expregfechaarea",['pagina'=>$pagina,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expregfechaarea",['pagina'=>$pagina,'areas'=>$areas]);
        }
    }

    public function verExpRecFechas(Request $request){
        $pagina="Expedientes Recibidos de acuerdo a las Fechas";
        $areas=DB::select("exec lSP_Combos @tipo=1");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=2,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.exprecfecha",['pagina'=>$pagina,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.exprecfecha",['pagina'=>$pagina,'areas'=>$areas]);
        }
    }

    public function verExpRecFechasArea(Request $request){
        $pagina="Expedientes Recibidos de acuerdo a las Fechas";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=2,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.exprecfechaarea",['pagina'=>$pagina,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.exprecfechaarea",['pagina'=>$pagina,'areas'=>$areas]);
        }
    }

    public function verExpNroDias(Request $request){
        $pagina="Expedientes Nro de Dias desde la Recepción";
        if($request->get('dias') || $request->get('anio') || $request->get('modo' )){
            $dias=$request->post('dias');
            $anio=$request->post('anio');
            $modo=$request->get('modo');
            if($modo==1){
                $expedientes=DB::select("exec trd_gestionarexp @tipo=8, @dias='".$dias."',@anio='".$anio."'");
            }else{
                $expedientes=DB::select("exec trd_gestionarexp @tipo=9, @dias='".$dias."',@anio='".$anio."'");
            }
            return view("tramitedocumentario.reportes.expnrodias",['pagina'=>$pagina,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expnrodias",['pagina'=>$pagina]);
        }
    }

    public function verExpDerFechas(Request $request){
        $pagina="Expedientes Recibidos de acuerdo a las Fechas";
        $areas=DB::select("exec lSP_Combos @tipo=1");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=3,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.expderfecha",['pagina'=>$pagina,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expderfecha",['pagina'=>$pagina,'areas'=>$areas]);
        }
    }

    public function verExpDerFechasArea(Request $request){
        $pagina="Expedientes Recibidos de acuerdo a las Fechas";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=3,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.expderfecha",['pagina'=>$pagina,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expderfecha",['pagina'=>$pagina,'areas'=>$areas]);
        }
    }

    public function verExpAsunto(Request $request){
        $pagina="Expedientes de Acuerdo a Asunto";
        $areas=DB::select("exec lSP_Combos @tipo=1");
        $tptra=DB::select("exec trd_expediente @tipo=74");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin') || $request->get('ffin') || $request->get('tptra') || $request->get('asunto')|| $request->get('refer')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $asunto=$request->post('asunto');
            $refer=$request->post('refer');
            $tptra1=$request->post('tptra');
            $expedientes=DB::select("exec trd_reportes @tipo=4,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."',@asunto='$asunto',@refer='$refer',@tptra='$tptra1'");
            return view("tramitedocumentario.reportes.expasunto",['pagina'=>$pagina,'tptras'=>$tptra,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expasunto",['pagina'=>$pagina,'tptras'=>$tptra,'areas'=>$areas]);
        }
    }

    public function verExpArchFechas(Request $request){
        $pagina="Expedientes de Acuerdo a Archivados de acuerdo a fechas";
        $areas=DB::select("exec lSP_Combos @tipo=1");
        $tptra=DB::select("exec trd_expediente @tipo=74");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=3,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.exparchfecha",['pagina'=>$pagina,'tptras'=>$tptra,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.exparchfecha",['pagina'=>$pagina,'tptras'=>$tptra,'areas'=>$areas]);
        }
    }

    public function verExpArchFechasArea(Request $request){
        $pagina="Expedientes de Acuerdo a Archivados de acuerdo a fechas";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $tptra=DB::select("exec trd_expediente @tipo=74");
        if($request->get('area') || $request->get('finicio') || $request->get('ffin') || $request->get('ffin')){
            $area=$request->post('area');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=3,@area='".$area."',@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.exparchfechaarea",['pagina'=>$pagina,'tptras'=>$tptra,'areas'=>$areas,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.exparchfechaarea",['pagina'=>$pagina,'tptras'=>$tptra,'areas'=>$areas]);
        }
    }

    public function verExpPendientes(Request $request){
        $pagina="Expedientes sin Atender";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $anios=DB::select("trd_reportes @tipo=6");
        if($request->get('area') || $request->get('trab') || $request->get('anio')){
            $area=$request->post('area');
            $trab=$request->post('trab');
            $anio=$request->post('anio');
            $expedientes=DB::select("SET NOCOUNT ON; exec trd_expediente @tipo=53,@area='$area',@anio='$anio',@codigo='$trab'");
            return view("tramitedocumentario.reportes.expreppend",['pagina'=>$pagina,'areas'=>$areas,'anios'=>$anios,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expreppend",['pagina'=>$pagina,'areas'=>$areas,'anios'=>$anios]);
        }
    }

    public function verEstdExpEstado(Request $request){
        $pagina="Estadístico de Expedientes por Estado";
        $areas=DB::select("exec lSP_Combos @tipo=1");
        $anios=DB::select("trd_reportes @tipo=6");
        if($request->get('area') || $request->get('anio')){
            $area=$request->post('area');
            $anio=$request->post('anio');
            $expedientes=DB::select("trd_reportes @tipo=7, @area='$area',@anio='$anio'");
            $arr=DB::select("trd_reportes @tipo=8, @area='$area'");
            $title="Reporte de Estado de Expedientes del año $anio del área ". $arr[0]->Are_Descripcion;
            return view("tramitedocumentario.reportes.estadexpestado",['pagina'=>$pagina,'areas'=>$areas,'anios'=>$anios,'expedientes'=>$expedientes,'title'=>$title]);
        }else{
            return view("tramitedocumentario.reportes.estadexpestado",['pagina'=>$pagina,'areas'=>$areas,'anios'=>$anios]);
        }
    }

    public function verEstadExpTptra(Request $request){
        $pagina="Estadístico de Expedientes por Tipo de Trámite";
        $tptras=DB::select("exec trd_expediente @tipo=74");
        $anios=DB::select("trd_reportes @tipo=6");
        if($request->get('tptra') || $request->get('anio')){
            $tptra=$request->post('tptra');
            $anio=$request->post('anio');
            $expedientes=DB::select("trd_reportes @tipo=9, @tptra='$tptra',@anio='$anio'");
            $tp=DB::select("trd_reportes @tipo=10, @tptra='$tptra'");
            $title="Reporte de Expedientes del año $anio por tipo de trámite". $tp[0]->tptra_descripcion;
            return view("tramitedocumentario.reportes.estadexptptra",['pagina'=>$pagina,'tptras'=>$tptras,'anios'=>$anios,'expedientes'=>$expedientes,'title'=>$title]);
        }else{
            return view("tramitedocumentario.reportes.estadexptptra",['pagina'=>$pagina,'tptras'=>$tptras,'anios'=>$anios]);
        }
    }

    public function verEstadExpArea(Request $request){
        $pagina="Estadístico de Expedientes por Área";
        $areas=DB::select("exec lSP_Combos @tipo=1");
        $anios=DB::select("trd_reportes @tipo=6");
        if($request->get('area') || $request->get('anio')){
            $area=$request->post('area');
            $anio=$request->post('anio');
            $expedientes=DB::select("trd_reportes @tipo=11, @area='$area',@anio='$anio'");
            $arr=DB::select("trd_reportes @tipo=8, @area='$area'");
            $title="Reporte de Expedientes de año $anio del área ". $arr[0]->Are_Descripcion;
            return view("tramitedocumentario.reportes.estadexparea",['pagina'=>$pagina,'areas'=>$areas,'anios'=>$anios,'expedientes'=>$expedientes,'title'=>$title]);
        }else{
            return view("tramitedocumentario.reportes.estadexparea",['pagina'=>$pagina,'areas'=>$areas,'anios'=>$anios]);
        }
    }

    public function verEstadExpAnual(Request $request){
        $pagina="Estadístico de Expedientes por Tipo de Trámite";
        $expedientes=DB::select("trd_reportes @tipo=12");
        $title="Reporte de Expedientes por Años";
        return view("tramitedocumentario.reportes.estadexpanual",['pagina'=>$pagina,'expedientes'=>$expedientes,'title'=>$title]);
    }

    public function verEstadExpMensual(Request $request){
        $pagina="Estadístico de Expedientes por Área";
        $anios=DB::select("trd_reportes @tipo=6");
        if($request->get('anio')){
            $anio=$request->post('anio');
            $expedientes=DB::select("trd_reportes @tipo=13,@anio='$anio'");
            $title="Reporte de Expedientes por mes del año $anio";
            return view("tramitedocumentario.reportes.estadexpmensual",['pagina'=>$pagina,'anios'=>$anios,'expedientes'=>$expedientes,'title'=>$title]);
        }else{
            return view("tramitedocumentario.reportes.estadexpmensual",['pagina'=>$pagina,'anios'=>$anios]);
        }
    }

    public function verReportesGenerales(Request $request){
        $areas=DB::select("exec lSP_Combos @tipo=1");
        $pagina="Reportes Generales";
        return view("tramitedocumentario.reportes.exprepgenerales",['areas'=>$areas,'paginas'=>$pagina]);
    }

    public function verexpModificados(Request $request){
        $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
        $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');

        $expedientes=DB::select("exec trd_expediente @tipo='46', @fecha='$finicio',@horaa='$ffin'");

        //return response()->json(['data' => $expedientes]);
        return $expedientes;
    }

    public function verexpEliminados(Request $request){
        $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
        $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');

        $expedientes=DB::select("exec trd_expediente @tipo='47', @fecha='$finicio',@horaa='$ffin'");

        //return response()->json(['data' => $expedientes]);
        return $expedientes;
    }

    public function verMovModificados(Request $request){
        $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
        $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
        $area=$request->post('area');
        if($area==0){
            $expedientes=DB::select("exec trd_expediente @tipo='48', @fecha='$finicio',@horaa='$ffin'");
        }else{
            $expedientes=DB::select("exec trd_expediente @tipo='49',@value='".$area."', @fecha='$finicio',@horaa='$ffin'");
        }

        //return response()->json(['data' => $expedientes]);
        return $expedientes;
    }

    public function verMovEliminados(Request $request){
        $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
        $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
        $area=$request->post('area');
        if($area=="0"){
            $expedientes=DB::select("exec trd_expediente @tipo='50', @fecha='$finicio',@horaa='$ffin'");
        }else{
            $expedientes=DB::select("exec trd_expediente @tipo='51',@value='".$area."', @fecha='$finicio',@horaa='$ffin'");
        }

        //return response()->json(['data' => $expedientes]);
        return $expedientes;
    }

    public function verAreasDeriva(Request $request){
        $pagina="Expedientes Derivados de acuerdo a las Fechas";
        $areasT=DB::select("exec lSP_Combos @tipo=1");
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        if($request->get('area') || $request->get('aread') || $request->get('finicio') || $request->get('ffin')){
            $area=$request->post('area');
            $aread=$request->post('aread');
            $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
            $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
            $expedientes=DB::select("exec trd_reportes @tipo=3,@area='".$area."',@aread=".$aread.",@finicio='".$finicio."', @ffin='".$ffin."'");
            return view("tramitedocumentario.reportes.expareaderivados",['pagina'=>$pagina,'areas'=>$areas,'areasd'=>$areasT,'expedientes'=>$expedientes]);
        }else{
            return view("tramitedocumentario.reportes.expareaderivados",['pagina'=>$pagina,'areas'=>$areas,'areasd'=>$areasT]);
        }
    }
}

