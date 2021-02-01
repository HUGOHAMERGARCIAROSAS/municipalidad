<?php

namespace App\Http\Controllers\TramiteExterno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpedienteEmail;
class ExpedientesController extends Controller
{
    public function mantenedorExpedientes(Request $request){
        $pagina="Mantenedor de Expedientes";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $exp=$request->get('expediente');
            $anio=$request->get('anio');
            $inte=$request->get('interesado');
            $asun=$request->get('asunto');
            $expedientes=DB::select("exec trd_expediente @tipo=3,@coddoc='$exp',@anio='$anio' ,@primero='%$inte%',@segundo='%$asun%'");
            $cant_exp=count($expedientes);
            $pageSize=$cant_exp;
        }else{
            $expedientes=DB::select("exec trd_expediente @tipo='1', @start='".$offset."', @end='".$pageSize."'");
            $cant=DB::select('exec trd_expediente @tipo=2');
            $cant_exp=$cant[0]->linea;
        }
        if($cant_exp!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($expedientes,$cant_exp, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.expedientes',['pagina'=>$pagina,'expedientes'=>$paginator]);
        }else{
            return view('tramitedocumentario.mantenedores.expedientes',['pagina'=>$pagina]);
        }
    }

    public function verExpediente(Request $request){
        $pagina="Editar de Expediente";
        $exp=$request->get('exped');
        $anio=$request->get('anio');
        $expediente=DB::select("exec trd_expediente @tipo='4',@coddoc='".$exp."',@anio='".$anio."' ");
        $tipoexp=DB::select("exec trd_expediente @tipo=73");
        $tipotramite=DB::select("exec trd_expediente @tipo=74");
        return view('tramitedocumentario.mantenedores.verexpediente',['pagina'=>$pagina,'expediente'=>$expediente,'tipoexp'=>$tipoexp,'tipotramite'=>$tipotramite]);
    }

    public function editarExpediente(Request $request){
        $exp=$request->get("exped");
        $anio=$request->get("anio");
        $tipodoc=$request->get("tipodoc");
        $remitente=$request->get("remitente");
        $observ=$request->get("observ");
        $asunt=$request->get("asunto");
        $refer=$request->get("refer");
        $folio=$request->get("folios");
        $estado=$request->get("estado");
        $tptra_ids=$request->get("tptra_ids");
        $codigo=$request->get("codcontri");
        DB::raw("exec trd_expediente @tipo='5',@coddoc='".$exp."',@anio='".$anio."',@primero='".$observ."',@segundo='".$remitente."',@value='".$asunt."',@folios='".$folio."',@tipodoc='".$tipodoc."',@tercero='".$refer."',@tptra_id='".$tptra_ids."',@usuario='".session('Usuario')->per_login."',@estado='".$estado."',@codcontri='".$codigo."' ");
        return redirect('tramitedocumentario/expedientes')->with(['alert'=>'Expediente editado']);
    }

    public function anulaExpediente(Request $request){
        $exp=$request->get("exped");
        $anio=$request->get("anio");
        DB::raw("exec trd_expediente @tipo='6',@coddoc='".$exp."',@anio='".$anio."',@usuario='".Auth::user()->per_login."'");
        return redirect('tramitedocumentario/expedientes')->with(['alert'=>'Expediente Anulado']);
    }

    public function verCodigoBarras(Request $request){
        $exp=$request->get("exped");
        $anio=$request->get("anio");
        $codd=DB::select("select top 1 codregdocumentos as codd from regdocumentos where documento_anio='".$anio."' and documento_coddocumento='".$exp."' and estadodoc='I'");
        $usu=DB::select("select top 1 substring(usuario_usuario,1,2) as usu from regdocumentos where documento_anio='".$anio."' and documento_coddocumento='".$exp."' and estadodoc='I'");
        $datos=DB::select("exec trd_gestionarexp @tipo=4,@exp='".$exp."',@anio='".$anio."'");
        $ofi=$datos[0]->hora;
        $codpatri=$datos[0]->anio."".$datos[0]->coddocumento."";
        $fech=$datos[0]->fecha;
        $folios=$datos[0]->folios;
        return view('tramitedocumentario.mantenedores.vercodigobarras',["codpatri"=>$codpatri,"codd"=>$codd,"usu"=>$usu,"exp"=>$exp,"anio"=>$anio,"folios"=>$folios,"fech"=>$fech,"ofi"=>$ofi]);
    }

    public function verMovimientosExpedientes(Request $request){
        $arr= array(
            "0"=> array("texto"=>"Ingresado","valor"=>"I"),
            "1"=> array("texto"=>"Recibido","valor"=>"R"),
            "2"=> array("texto"=>"Derivado","valor"=>"D"),
            "3"=> array("texto"=>"Archivado","valor"=>"A"),
            );
        $areas=DB::select('exec lSP_Combos @tipo=1');
        $pagina="MANTENEDOR MOVIMIENTO DE EXPEDIENTES";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $exp=$request->get('expediente');
            $anio=$request->get('anio');
            $inte=$request->get('interesado');
            $asun=$request->get('asunto');
            $est=$request->get('estado');
            $area=$request->get('area');
            $movimientos=DB::select("exec trd_expediente @tipo=12, @coddoc='".$exp."', @value='".$est."', @anio='".$anio."' ,@primero='%$inte%',@segundo='%$asun%',@area='".$area."' ");
            $cant_mov=count($movimientos);
            $pageSize=$cant_mov;
        }else{
            $movimientos=DB::select("exec trd_expediente @tipo=7, @start='".$offset."', @end='".$pageSize."'");
            $cant=DB::select('exec trd_expediente @tipo=8');
            $cant_mov=$cant[0]->linea;
        }
        if($cant_mov!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($movimientos,$cant_mov, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.movimientos',['pagina'=>$pagina,'movimientos'=>$paginator,'estados'=>$arr,'areas'=>$areas]);
        }else{
            return view('tramitedocumentario.mantenedores.movimientos',['pagina'=>$pagina,'estados'=>$arr,'areas'=>$areas]);
        }

    }

    public function verMovimientosArchivos(Request $request){
        $arr= array(
            "0"=> array("texto"=>"Ingresado","valor"=>"I"),
            "1"=> array("texto"=>"Recibido","valor"=>"R"),
            "2"=> array("texto"=>"Derivado","valor"=>"D"),
            "3"=> array("texto"=>"Archivado","valor"=>"A"),
        );
        $areas=DB::select('exec lSP_Combos @tipo=1');
        $pagina="MANTENEDOR MOVIMIENTO DE EXPEDIENTES";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $exp=$request->get('expediente');
            $anio=$request->get('anio');
            $inte=$request->get('interesado');
            $asun=$request->get('asunto');
            $est=$request->get('estado');
            $area=$request->get('area');
            $movimientos=DB::select("exec trd_expediente @tipo=12, @coddoc='".$exp."', @value='".$est."', @anio='".$anio."' ,@primero='%$inte%',@segundo='%$asun%',@area='".$area."' ");
            $cant_mov=count($movimientos);
            $pageSize=$cant_mov;
        }else{
            $movimientos=DB::select("exec trd_expediente @tipo='76', @start='".$offset."', @end='".$pageSize."', @usuario='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_expediente @tipo=75, @usuario='".Auth::user()->per_codigo."'");
            $cant_mov=$cant[0]->linea;
        }
        if($cant_mov!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($movimientos,$cant_mov, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.movimientosar',['pagina'=>$pagina,'movimientos'=>$paginator,'estados'=>$arr,'areas'=>$areas]);
        }else{
            return view('tramitedocumentario.mantenedores.movimientosar',['pagina'=>$pagina,'estados'=>$arr,'areas'=>$areas]);
        }
    }

    public function verMovimientosGer(Request $request){
        $arr= array(
            "0"=> array("texto"=>"Ingresado","valor"=>"I"),
            "1"=> array("texto"=>"Recibido","valor"=>"R"),
            "2"=> array("texto"=>"Derivado","valor"=>"D"),
            "3"=> array("texto"=>"Archivado","valor"=>"A"),
        );
        $areas=DB::select('exec lSP_Combos @tipo=1');
        $pagina="MANTENEDOR MOVIMIENTO DE EXPEDIENTES";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $exp=$request->get('expediente');
            $anio=$request->get('anio');
            $inte=$request->get('interesado');
            $asun=$request->get('asunto');
            $est=$request->get('estado');
            $area=$request->get('area');
            $movimientos=DB::select("exec trd_expediente @tipo=21,@coddoc='".$exp."',@anio='".$anio."' ,@primero='%$inte%',@segundo='%$asun%',@area='".$area."'");
            $cant_mov=count($movimientos);
            $pageSize=$cant_mov;
        }else{
            $movimientos=DB::select("exec trd_expediente @tipo='20', @start='".$offset."', @end='".$pageSize."'");
            $cant=DB::select("SELECT count(*) as linea FROM regdocumentos");
            $cant_mov=$cant[0]->linea;
        }
        if($cant_mov!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($movimientos,$cant_mov, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.movimientosgr',['pagina'=>$pagina,'movimientos'=>$paginator,'estados'=>$arr,'areas'=>$areas]);
        }else{
            return view('tramitedocumentario.mantenedores.movimientosgr',['pagina'=>$pagina,'estados'=>$arr,'areas'=>$areas]);
        }
    }

    public function nuevoExpediente(){
        $pagina="REGISTRO DE EXPEDIENTE";
        $tipoguarda="MP";
        $areas=DB::select("exec trd_tipotramite @tipo='19'");
        $hora=DB::select("select SUBSTRING(convert(varchar(14),getdate(),108), 1, 5) as hora");
        $now=Carbon::now();
        $fecha=$now->format('d/m/Y');
        $ultexp=DB::select("SELECT max(coddocumento) as coddoc from expediente where tipotramite = 'E' and anio = $now->year");
        $nroexp=$ultexp[0]->coddoc+1;
        $tipoexp=DB::select("exec trd_expediente @tipo=73");
        $tipotramite=DB::select("exec trd_expediente @tipo=74");
        $tipodoc=DB::select("SELECT idtpdoc as valor, tpd_descripcion as texto FROM exptp_documento order by 2");
        return view('tramitedocumentario.ProcesosTramite.regexpediente',['pagina'=>$pagina,'hora'=>$hora,'tipoguarda'=>$tipoguarda,'fecha'=>$fecha,"areas"=>$areas,'nro_exp'=>$nroexp,'tipoexp'=>$tipoexp,"tipotramite"=>$tipotramite,'tipodoc'=>$tipodoc]);
    }

    public function nuevoExpedienteV(Request $request){
        $pagina="REGISTRO DE EXPEDIENTE";
        $virtual=1;
        $areas=DB::select("exec trd_tipotramite @tipo='19'");
        $hora=DB::select("select SUBSTRING(convert(varchar(14),getdate(),108), 1, 5) as hora");
        $now=Carbon::now();
        $fecha=$now->format('d/m/Y');
        $ultexp=DB::select("SELECT max(coddocumento) as coddoc from expediente where tipotramite = 'E' and anio = $now->year");
        $nroexp=$ultexp[0]->coddoc+1;
        $tipoexp=DB::select("exec trd_expediente @tipo=73");
        $tipotramite=DB::select("exec trd_expediente @tipo=74");
        $tipodoc=DB::select("SELECT idtpdoc as valor, tpd_descripcion as texto FROM exptp_documento order by 2");
        if($request->get('id')){
            $id=$request->post('id');
            $solicitud=DB::select("exec trd_expediente @tipo=69, @codigo='$id'");
            return view('tramitedocumentario.ProcesosTramite.regexpediente',['pagina'=>$pagina,'virtual'=>$virtual,'hora'=>$hora,'fecha'=>$fecha,'solicitud'=>$solicitud,"areas"=>$areas,'nro_exp'=>$nroexp,'tipoexp'=>$tipoexp,"tipotramite"=>$tipotramite,'tipodoc'=>$tipodoc]);
        }else{
            return view('tramitedocumentario.ProcesosTramite.regexpediente',['pagina'=>$pagina,'virtual'=>$virtual,'hora'=>$hora,'fecha'=>$fecha,"areas"=>$areas,'nro_exp'=>$nroexp,'tipoexp'=>$tipoexp,"tipotramite"=>$tipotramite,'tipodoc'=>$tipodoc]);
        }

    }

    public function regExpediente(Request $request){
        $now=Carbon::now();
        $fecha=$now->format('d/m/Y');
        $tipodoc=$request->post('tipodoc');
        $desc=$request->post('desc');
        $tipoexp=$request->post('tipoexp');
        $remitente="";
        $area="0203";
        if($tipoexp==1){
            $remitente=$request->post('remitentea');
        }else if($tipoexp==2){
            $remitente=$request->post('remitentet');
        }
        $contribuyente=$request->post('persona');
        $asunto=$request->post('asunto');
        $referencia=$request->post('refer');
        $folio=$request->post('folios');
        $tipotramite=$request->post('tptra');
        $destino=$request->post('destino');
        $numdocumento=DB::select("SET NOCOUNT ON ; exec trd_gestionarexp @tipo=3, @remitente='".$remitente."',@asunto='".$asunto."',@referencia='".$referencia."',@folios='".$folio."',@descripcion='".$desc."', @tipodoc='".$tipoexp."',@idtpdoc='".$tipodoc."',@usuario='".Auth::user()->per_login."',@area='".$area."',@tptra_id='".$tipotramite."',@codcontri='".$contribuyente."',@destino='".$destino."'");
        $idconsult=DB::select("select top 1 codregdocumentos as numero from regdocumentos where documento_anio='".date('Y')."' and documento_coddocumento='".$numdocumento[0]->numero."' and estadodoc='I' order by fecha_insert desc");
        //ver idconsult y codigo de barras en modal

        if($request->post('email')){
            $email=trim($request->post('email'));
            Mail::to($email)->queue(new ExpedienteEmail($numdocumento[0]->numero,$numdocumento[0]->anio,$idconsult[0]->numero,$fecha));
        }
        return redirect('tramitedocumentario/expedientes')->with(['alert'=>"Expediente ".$numdocumento[0]->numero."-".$numdocumento[0]->anio." generado"]);
    }

    public function pendientesRecibir(Request $request){
        $pagina="LISTADO DE EXPEDIENTES PENDIENTES POR RECIBIR";
        $arr= array(
            "0"=> array("texto"=>"Ingresado","valor"=>"I"),
            "1"=> array("texto"=>"Recibido","valor"=>"R"),
            "2"=> array("texto"=>"Derivado","valor"=>"D"),
            "3"=> array("texto"=>"Archivado","valor"=>"A"),
        );
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $exp=$request->get('expediente');
            $anio=$request->get('anio');
            $inte=$request->get('interesado');
            $asun=$request->get('asunto');
            $area=$request->get('area');
            $expedientes=DB::select("exec trd_expediente @tipo=17,@codigo='".Auth::user()->per_codigo."',@coddoc='".$exp."',@anio='".$anio."',@primero='%$inte%',@segundo='%$asun%',@area='".$area."'");
            $cant_exp=count($expedientes);
            $pageSize=$cant_exp;
        }else{
            $expedientes=DB::select("exec trd_expediente @tipo='16', @start='".$offset."', @end='".$pageSize."',@codigo='".Auth::user()->per_codigo."', @area='".$areas[0]->valor."'");
            $cant=DB::select("exec trd_expediente @tipo='17', @area='".$areas[0]->valor."',@codigo='".Auth::user()->per_codigo."'");
            $cant_exp=$cant[0]->linea;
        }
        if($cant_exp!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($expedientes,$cant_exp, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.ProcesosTramite.exppendientes',['pagina'=>$pagina,'expedientes'=>$paginator,"areas"=>$areas]);
        }else{
            return view('tramitedocumentario.ProcesosTramite.exppendientes',['pagina'=>$pagina,"areas"=>$areas]);
        }
    }

    public function estadoExpediente(Request $request){
        $exp=$request->get('exp');
        $anio=$request->get('anio');
        $estado=DB::select("exec trd_gestionarexp @tipo=21,@exp='".$exp."',@anio='".$anio."'");
        $atd="";
        if($estado[0]->textt!="")$atd=" que atienda ".$estado[0]->textt;
        $mensaje=$estado[0]->estadodocs." ".$estado[0]->are_descripcion." ".$atd." el ".$estado[0]->fecha." a las ".$estado[0]->hora;
        return $mensaje;
    }

    public function recibirExpediente(Request $request){
        $exp=$request->post('exp');
        $anio=$request->post('anio');
        $area=$request->post('area1');
        DB::unprepared("exec trd_gestionarexp @tipo=20, @anio='".$anio."',@exp='".$exp."',@area='".$area."',@usuario='".Auth::user()->per_login."'");
        //return dd("Result");
        return redirect('tramitedocumentario/exppendientes')->with(['alert'=>"Expediente ".$exp."-".$anio." recibido"]);
    }

    public function gestionExpedientes(Request $request){
        $pagina="GESTIÓN DE EXPEDIENTES";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $areas1=DB::select('exec lSP_Combos @tipo=1');

        if($request->get('expediente') || $request->get('anio')){
            $exp=$request->post('expediente');
            $anio=$request->post('anio');
            $expediente=DB::select("exec trd_gestionarexp @tipo=1,@exp='".$exp."',@anio='".$anio."'");
            return view('tramitedocumentario.ProcesosTramite.gestion_expedientes',['pagina'=>$pagina,"areas"=>$areas,"areas1"=>$areas1,"expediente"=>$expediente]);
        }else{
            return view('tramitedocumentario.ProcesosTramite.gestion_expedientes',['pagina'=>$pagina,"areas"=>$areas,"areas1"=>$areas1]);
        }
    }

    public function derivarExpediente(Request $request){
        $exp=$request->post('exp');
        $anio=$request->post('anio');
        $aread=$request->post('area1');
        $trab=$request->post('trab');
        $copia=$request->post('copia');
        $observ=$request->post('observ');
        $fol=$request->post('folios');
        $area=$request->post('area');
        $idcodreg="";
        if($request->post('idcodreg')){
            $idcodreg=$request->post('idcodreg');
        }
        DB::unprepared("exec trd_gestionarexp @tipo=2, @exp='".$exp."',@anio='".$anio."',@area='".$area."',@observacion='".$observ."',@copia='".$copia."',@folios='".$fol."',@usuario='".Auth::user()->per_login."',@accion='D' ,@area2='".$aread."',@trab='".$trab."',@idinforme='".$idcodreg."'");
        return redirect('tramitedocumentario/gestionexpedientes')->with(['alert'=>"Expediente ".$exp."-".$anio." derivado"]);
    }

    public function archivarExpediente(Request $request){
        $exp=$request->post('exp');
        $anio=$request->post('anio');
        $fol=$request->post('folios');
        $obsr=$request->post('observ');
        $cop=$request->post('copia');
        $area=$request->post('are_copdigo');
        $idcodreg="";
        if($request->post('idcodreg')){
            $idcodreg=$request->post('idcodreg');
        }
        DB::raw("exec trd_gestionarexp @tipo=2, @exp='".$exp."',@anio='".$anio."',@area='".$area."',@observacion='".$obsr."',@copia='".$cop."',@folios='".$fol."',@usuario='".Auth::user()->per_login."',@accion='A',@idinforme='".$idcodreg."'");
        return redirect('tramitedocumentario/gestionexpedientes')->with(['alert'=>"Expediente ".$exp."-".$anio." archivado"]);
    }

    public function proveerExpediente(Request $request){
        $exp=$request->post('exp');
        $anio=$request->post('anio');
        $area=$request->post('area');
        $aread=$request->post('aread');
        $asunto=$request->post('asunto');
        $fecha=$request->post('freg');
        $copia=$request->post('copia');
        $fol=$request->post('folios');
        $cod=DB::select("exec trd_informes @tipo='16',@are_codigo='".$area."',@persona_id='".Auth::user()->per_login."', @fecha ='".$fecha."',@ptram='0' , @asunto ='".$asunto."',@destino ='".$aread."', @usuario='".Auth::user()->per_login."'");
        DB::raw("exec trd_gestionarexp @tipo=2, @exp='".$exp."',@anio='".$anio."',@area='".$area."',@observacion='Proveido: ".$asunto."',@copia='".$copia."',@folios='".$fol."',@usuario='".Auth::user()->per_login."',@accion='D' ,@area2='".$aread."',@trab='".Auth::user()->per_codigo."',@idinforme='".$cod[0]->id."'");
        return redirect('tramitedocumentario/gestionexpedientes')->with(['alert'=>"Expediente ".$exp."-".$anio." proveído"]);
    }

    public function pendientesTrabajador(Request $request){
        $pagina="LISTADO DE EXPEDIENTES PENDIENTES TRABAJADOR POR RECIBIR DEL TRABAJADOR";
        $arr= array(
            "0"=> array("texto"=>"Ingresado","valor"=>"I"),
            "1"=> array("texto"=>"Recibido","valor"=>"R"),
            "2"=> array("texto"=>"Derivado","valor"=>"D"),
            "3"=> array("texto"=>"Archivado","valor"=>"A"),
        );
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $exp=$request->get('expediente');
            $anio=$request->get('anio');
            $inte=$request->get('interesado');
            $asun=$request->get('asunto');
            $area=$request->get('area');
            $expedientes=DB::select("exec trd_expediente @tipo=17,@codigo='".Auth::user()->per_codigo."',@coddoc='".$exp."',@anio='".$anio."',@primero='%$inte%',@segundo='%$asun%',@area='".$area."'");
            $cant_exp=count($expedientes);
            $pageSize=$cant_exp;
        }else{
            $expedientes=DB::select("exec trd_expediente @tipo='28', @start='".$offset."', @end='".$pageSize."',@codigo='".Auth::user()->per_codigo."', @area='".$areas[0]->valor."'");
            $cant=DB::select("exec trd_expediente @tipo='27', @area='".$areas[0]->valor."',@codigo='".Auth::user()->per_codigo."'");
            $cant_exp=$cant[0]->linea;
        }
        if($cant_exp!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($expedientes,$cant_exp, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.ProcesosTramite.exppendientes',['pagina'=>$pagina,'expedientes'=>$paginator,"areas"=>$areas]);
        }else{
            return view('tramitedocumentario.ProcesosTramite.exppendientes',['pagina'=>$pagina,"areas"=>$areas]);
        }
    }

    public function pendientesFirma(Request $request){
        $pagina="LISTADO DE EXPEDIENTES PENDIENTES POR RECIBIR";
        $arr= array(
            "0"=> array("texto"=>"Ingresado","valor"=>"I"),
            "1"=> array("texto"=>"Recibido","valor"=>"R"),
            "2"=> array("texto"=>"Derivado","valor"=>"D"),
            "3"=> array("texto"=>"Archivado","valor"=>"A"),
        );
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $exp=$request->get('expediente');
            $anio=$request->get('anio');
            $inte=$request->get('interesado');
            $asun=$request->get('asunto');
            $area=$request->get('area');
            $expedientes=DB::select("exec trd_expediente @tipo=42,@codigo='".Auth::user()->per_codigo."',@coddoc='".$exp."',@anio='".$anio."',@primero='%$inte%',@segundo='%$asun%',@area='".$area."'");
            $cant_exp=count($expedientes);
            $pageSize=$cant_exp;
        }else{
            $expedientes=DB::select("exec trd_expediente @tipo='29', @start='".$offset."', @end='".$pageSize."',@codigo='".Auth::user()->per_codigo."', @area='".$areas[0]->valor."'");
            $cant=DB::select("exec trd_expediente @tipo='30', @area='".$areas[0]->valor."',@codigo='".Auth::user()->per_codigo."'");
            $cant_exp=$cant[0]->linea;
        }
        if($cant_exp!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($expedientes,$cant_exp, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.ProcesosTramite.exppendientes',['pagina'=>$pagina,'expedientes'=>$paginator,"areas"=>$areas]);
        }else{
            return view('tramitedocumentario.ProcesosTramite.exppendientes',['pagina'=>$pagina,"areas"=>$areas]);
        }
    }

    public function cantBandejaEntrada(){
        $bandejae=DB::select("exec trd_expediente @tipo=32,@codigo='".Auth::user()->per_codigo."'");
        return $bandejae[0]->linea;
    }

    public function cantBandejaPersonal(){
        $bandejap=DB::select("exec trd_expediente @tipo=34,@codigo='".Auth::user()->per_codigo."'");
        return $bandejap[0]->linea;
    }

    public function cantMemorandum(){
        $memo=DB::select("exec trd_expediente @tipo=40,@codigo='".Auth::user()->per_codigo."'");
        return $memo[0]->linea;
    }

    public function cantInvitaciones(){
        //$invitaciones=DB::select("");
        return 0;
    }

    public function cantRecibidos(){
        //$recibidos=DB::select("");
        return 0;
    }

    public function cantPendientesResponder(){
        $pendientes=DB::select("exec trd_expediente @tipo=43,@codigo='".Auth::user()->per_codigo."'");
        return $pendientes[0]->total;
    }

    public function cantArchivados(){
        $archivados=DB::select("exec trd_expediente @tipo=37,@codigo='".Auth::user()->per_codigo."'");
        return $archivados[0]->linea;
    }

    public function cantEliminados(){
        $eliminados=DB::select("exec trd_expediente @tipo=35,@codigo='".Auth::user()->per_codigo."'");
        return $eliminados[0]->linea;
    }

    public function bandejaEntrada(){
        $pagina="Bandeja de Entrada";
        $cant=[];
        $be=$this->cantBandejaEntrada();
        array_push($cant,$be);
        $bp=$this->cantBandejaPersonal();
        array_push($cant,$bp);
        $memo=$this->cantMemorandum();
        array_push($cant,$memo);
        $invi=$this->cantInvitaciones();
        array_push($cant,$invi);
        $rec=$this->cantRecibidos();
        array_push($cant,$rec);
        $pend=$this->cantPendientesResponder();
        array_push($cant,$pend);
        $arch=$this->cantArchivados();
        array_push($cant,$arch);
        $eli=$this->cantEliminados();
        array_push($cant,$eli);
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $bandeja=DB::select("exec trd_expediente @tipo='31',@codigo='".Auth::user()->per_codigo."', @area='".$areas[0]->valor."'");

        return view("tramitedocumentario.ProcesosTramite.bandeja",['pagina'=>$pagina,'cant'=>$cant,'bandeja'=>$bandeja]);
    }

    public function detalleBandeja(Request $request){
        $exp=$request->get("exp");
        $anio=$request->get("anio");
        $bandeja=$request->get("bandeja");
        if ($bandeja!=""){
            DB::statement("update expediente_bandeja set leido='1',fechaleido=getdate() where idbandeja='$bandeja'");
        }
        $expediente=DB::select("exec trd_gestionarexp @tipo=4,@exp='".$exp."',@anio='".$anio."'");
        $cantexp=count($expediente);
        $informe=DB::select("select archivo from exp_informes where idinforme='".$expediente[0]->idinforme."'");
        $archivos=DB::select("select archivo from expediente_archivo where coddocumento='".$exp."' and anio='".$anio."'");
        $cantarchivos=count($archivos);
        $movimientos=DB::select("exec trd_gestionarexp @tipo=5,@exp='".$exp."',@anio='".$anio."'");
        $cantmoves=count($movimientos);
        $dias=DB::select("SET NOCOUNT ON; exec trd_gestionarexp @tipo=7,@exp='".$exp."',@anio='".$anio."'");
        $cantnrodias=count($dias);
        $coddocumento=$expediente[0]->coddocumento;
        $docanio=$expediente[0]->anio;
        $remitente=$expediente[0]->remitente;
        $asunto=$expediente[0]->asunto;
        $refer=$expediente[0]->referencia;
        $response="
        <div class='row' style='display: block; font-size: 12px;'>
            <div class='row'>
            <div class='col-lg-2 col-md-2 col-sm-2'>
                <label>Expediente: </label> $coddocumento
            </div>
            <div class=\"col-lg-2 col-md-2 col-sm-2\">
                <label>Año: </label> $docanio
            </div>
            <div class=\"col-lg-3 col-md-3 col-sm-3\">
                <label>Imprimir:</label>
                <button type=\"button\" class=\"btn btn-default btn-sm\" style='font-size: 12px;'
                        onclick=\"Printt($coddocumento,$docanio)\">
                    <span class=\"fa fa-print\"></span> Imprimir
                </button>
                </a>
            </div>
            <div class=\"col-lg-4 col-md-4 col-sm-4\">
                <label>Descargables:</label>
                <button type=\"button\" class=\"btn btn-default btn-sm\" style='font-size: 12px;'
                        onclick=\"printpdf($coddocumento,$docanio)\">
                    <span class=\"fa fa-download\"></span> Individual
                </button>
                <button type=\"button\" class=\"btn btn-default btn-sm\" style='font-size: 12px;'
                        onclick=\"printpdfacum($coddocumento,$docanio)\">
                    <span class=\"fa fa-file-pdf\"></span> Acumulados
                </button>
            </div>
            </div>
            <div class=\"row\">
            <div class=\"col-lg-6 col-md-6 col-sm-6\">
                <label>Interesado: </label> $remitente
            </div>
            </div>
            <div class=\"row\">
            <div class=\"col-lg-6 col-md-6 col-sm-6\">
                <label>Asunto: </label> $asunto
            </div>
            </div>
            <div class=\"row\">
            <div class=\"col-lg-6 col-md-6 col-sm-6\">
                <label>Referencia: </label> $refer
            </div>
            </div>
        </div>";
        if($cantarchivos>0){
            $response.="<h5 class=\"text-center\">Archivos Adjuntos</h5>";
            foreach ($archivos as $a){
                $vs1 = 1; $ext = explode(".", $a->archivo);
                $num = count($ext) - 1;
                $ext = strtolower($ext[$num]);
                $response.="<a onclick='printpdf(".$expediente[0]->coddocumento.",".$expediente[0]->anio.")'>Archivo".$vs1."-".$ext."</a>";
            }
        }
        $response.="<h5 class=\"text-center\">Movimientos</h5>
                    <table class=\"table table-hover text-center table-sm\" style='font-size: 12px;'>
                        <thead>
                        <tr>
                            <th>Nro Movimiento</th>
                            <th>Folios</th>
                            <th>Observaciones</th>
                            <th>Área</th>
                            <th>Copia</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Archivos</th>
                        </tr>
                        </thead>
                        <tbody>";
        $k=$cantmoves;
        foreach ($movimientos as $e){
            if ($e->areaderiv != "" && $e->trabderiva != "") {
                $vaa = " a $e->areaderiv que atienda $e->trabderiva";
            } elseif ($e->areaderiv != "") {
                $vaa = " a $e->areaderiv";
            } else {
                $vaa = "";
            }
            $response.="<tr>
                            <td>$k</td>
                            <td>$e->folios</td>
                            <td>$e->observacion</td>
                            <td>$e->are_descripcion</td>
                            <td>$e->copia</td>
                            <td>$e->fecha $e->hora</td>
                            <td>$e->estadodocs $vaa</td>
                            <td>";
            if($e->idinform!="" && $e->idinform!="0"){
                if($e->archivo==""){
                    $response.="<button type=\"submit\" class=\"btn btn-default btn-sm\"
                                                                            title=\"Detalles\"
                                                                            onclick=\"printpdfE('',$e->idinform);\">
                                                                        <span class=\"fa fa-download\"></span></button>";
                }else{
                 $response.="<button type=\"submit\" class=\"btn btn-default btn-sm\"
                                                                            title=\"Detalles\"
                                                                            onclick=\"printpdfE(\".$e->archivo,$e->idinform);\">
                                                                        <span class=\"fa fa-download\"></span></button>";
                }
            }
            if($e->archivv!=""){

            }
        }
        return $response;
    }

    public function estadoBandeja(Request $request){
        $exp=$request->get("exp");
        $anio=$request->get("anio");
        $estado=DB::select("exec trd_gestionarexp @tipo=21,@exp='$exp',@anio='$anio'");
        $atd="";
        if($estado[0]->textt!="")$atd=" que atienda ".$estado[0]->textt;
        $dratd="";
        if($estado[0]->arederiva!="")$dratd=" para ".$estado[0]->arederiva;
        $clsdp="";
        if($estado[0]->estadodoc=="R")$clsdp="#3C9";
        if($estado[0]->estadodoc=="D")$clsdp="#0CF";
        if($estado[0]->estadodoc=="A")$clsdp="#906";
        $response=$estado[0]->estadodocs .' por '.$estado[0]->are_descripcion.' '.$dratd.' '.$atd.' el '.$estado[0]->fecha.' a las '.$estado[0]->hora;

        return $response;
    }
}
