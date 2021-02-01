<?php

namespace App\Http\Controllers\TramiteExterno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class SeguimientoDocumentoController extends Controller
{
    public function seguimientoExpedientes(){
        $pagina="SEGUIMIENTO DE EXPEDIENTES";
        $tipotra=DB::select("exec trd_expediente @tipo=74");
        return view('tramitedocumentario.Consultas.seguimiento_documentos',["pagina"=>$pagina,"tipotra"=>$tipotra]);
    }

    public function buscarExpediente(Request $request){
        $pagina="SEGUIMIENTO DE EXPEDIENTES";
        $tipotra=DB::select("exec trd_expediente @tipo=74");
        $exp=$request->post('expediente');
        $anio=$request->post('anio');
        $desc=$request->post('desc');
        $inte=$request->post('interesado');
        $asunto=$request->post('asunto');
        $finicio=Carbon::parse($request->post('finicio'))->format('d/m/Y');
        $ffin=Carbon::parse($request->post('ffin'))->format('d/m/Y');
        $refer=$request->post('referencia');
        $tptra=$request->post('tptra');
        //return dd($request);
        if($exp!=""){
            $expediente=DB::select("exec trd_gestionarexp @tipo=4,@exp='".$exp."',@anio='".$anio."'");
            $cantexp=count($expediente);
            if($cantexp>0){
                $informe=DB::select("select archivo from exp_informes where idinforme='".$expediente[0]->idinforme."'");
                $archivos=DB::select("select archivo from expediente_archivo where coddocumento='".$exp."' and anio='".$anio."'");
                $cantarchivos=count($archivos);
                $movimientos=DB::select("exec trd_gestionarexp @tipo=5,@exp='".$exp."',@anio='".$anio."'");
                $cantmoves=count($movimientos);
                $dias=DB::select("SET NOCOUNT ON; exec trd_gestionarexp @tipo=7,@exp='".$exp."',@anio='".$anio."'");
                $cantnrodias=count($dias);
                return view('tramitedocumentario.Consultas.seguimiento_documentos',["pagina"=>$pagina,"tipotra"=>$tipotra,"expediente"=>$expediente,"cant_expe"=>$cantexp,"movimientos"=>$movimientos,"cant_moves"=>$cantmoves,"informe"=>$informe,"cant_archivos"=>$cantarchivos,"archivos"=>$archivos,"cantnrodias"=>$cantnrodias,"nrodias"=>$dias]);
            }else{
                return view('tramitedocumentario.Consultas.seguimiento_documentos',["pagina"=>$pagina,"tipotra"=>$tipotra,"cant_expe"=>$cantexp]);
            }
        }else{
            $expedientes=DB::select("exec trd_gestionarexp @tipo=6,@remitente='%".$inte."%',@asunto='%".$asunto."%',@referencia='%".$refer."%',@fecha='".$finicio."',@anio='".$anio."' ,@fechaf='".$ffin."',@descripcion='%".$desc."%',@tipodoc='".$tptra."'");
            $cantexpes=count($expedientes);
            if($cantexpes>0){
                $page = request('page', 1);
                $pageSize = 10;
                $offset = $pageSize*($page-1);
                $items = array_slice($expedientes, $offset, $pageSize, true);
                $paginator = new \Illuminate\Pagination\LengthAwarePaginator($items,$cantexpes, $pageSize, $page);
                $paginator->setPath(request('url'));
                return view('tramitedocumentario.Consultas.seguimiento_documentos',["pagina"=>$pagina,"tipotra"=>$tipotra,"expedientes"=>$paginator,"cant_expes"=>$cantexpes]);
            }
            else{
                return view('tramitedocumentario.Consultas.seguimiento_documentos',["pagina"=>$pagina,"tipotra"=>$tipotra,"cant_expes"=>$cantexpes]);
            }

        }

    }

    public function imprimirSeguimiento(Request $request){
        $exp=$request->get('exp');
        $anio=$request->get('anio');
        $expediente=DB::select("exec trd_gestionarexp @tipo=4,@exp='".$exp."',@anio='".$anio."'");
        $cantexp=count($expediente);
        $informe=DB::select("select archivo from exp_informes where idinforme='".$expediente[0]->idinforme."'");
        $archivos=DB::select("select archivo from expediente_archivo where coddocumento='".$exp."' and anio='".$anio."'");
        $cantarchivos=count($archivos);
        $movimientos=DB::select("exec trd_gestionarexp @tipo=5,@exp='".$exp."',@anio='".$anio."'");
        $cantmoves=count($movimientos);
        $dias=DB::select("SET NOCOUNT ON; exec trd_gestionarexp @tipo=7,@exp='".$exp."',@anio='".$anio."'");
        $cantnrodias=count($dias);
        $fecha=DB::select("select convert(varchar(14),getdate(),105) as fecha");
        $hora=DB::select("select convert(varchar(14),getdate(),114) as hora");
        return view('tramitedocumentario.mantenedores.imprimirseguimiento',["expediente"=>$expediente,"cant_expe"=>$cantexp,"movimientos"=>$movimientos,"cant_moves"=>$cantmoves,"informe"=>$informe,"cant_archivos"=>$cantarchivos,"archivos"=>$archivos,"fecha"=>$fecha,"hora"=>$hora,"usuario"=>Auth::user()->per_login,"cantnrodias"=>$cantnrodias,"nrodias"=>$dias]);
    }


}
