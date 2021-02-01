<?php

namespace App\Http\Controllers\TramiteExterno;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ProcesosWebController extends Controller
{
    function _random()
    {
        $codigo = "";
        $longitud = 8;
        for ($i=1; $i<=$longitud; $i++){
            $letra = chr(rand(97,122));
            $codigo .= $letra;
        }
        return $codigo;
    }

    function getIPs(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return($ip);
    }

    public function buscarTributo(Request $request){
        $query=$request->get('search');
        if(is_numeric($query)){
            $tributos=DB::select("SELECT tributos_id as valor, descripcion as texto FROM tributos 	WHERE activo='1' and tipo_tributo='7' and   tributos_id = '".$query."' order by 2");
        }else{
            $tributos=DB::select("SELECT tributos_id as valor, descripcion as texto FROM tributos 	WHERE activo='1' and tipo_tributo='7' and   descripcion LIKE '%".$query."%' order by 2");
        }
        //return dd($personas);
        $response = array();
        foreach($tributos as $t){
            $response[] = array(
                "id"=>$t->valor,
                "text"=>$t->texto
            );
        }
        echo json_encode($response);
        exit;
    }

    public function listarTickets(Request $request){
        $pagina="LISTADO DE TICKET GENERADOS";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $solicitante=$request->get('solicitante');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $dni=$request->get('dni');
            $tributo=$request->get('tributo');
            $recibo=$request->get('recibo');
            $area=$request->get('area');
            $expedientes=DB::select("exec trd_liquidacion @tipo=3,@fecha='".$finicio."',@fechaf='".$ffin."',@primero='".$area."',@tributo='%".$tributo."%',@nrorecibo='".$recibo."',
                                    @segundo='%".$solicitante."%',@dni='".$dni."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_exp=count($expedientes);
            $pageSize=$cant_exp;
        }else{
            $expedientes=DB::select("exec trd_liquidacion @tipo='1', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_liquidacion @tipo='2', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_exp=$cant[0]->linea;
        }
        if($cant_exp!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($expedientes,$cant_exp, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.ProcesosWeb.listadotickets',['pagina'=>$pagina,'tickets'=>$paginator,"areas"=>$areas]);
        }else{
            return view('tramitedocumentario.ProcesosWeb.listadotickets',['pagina'=>$pagina,"areas"=>$areas]);
        }
    }

    public function anularTicket(Request $request){
        $id=$request->get("id");
        DB::raw("exec trd_liquidacion @tipo='9',@codigo='".$id."' ,@usuario='".Auth::user()->per_login."'");
        return redirect('tramitedocumentario/listadotickets')->with(['alert'=>'Ticket anulado']);
    }

    public function generaTicket(){
        $pagina="GENERAR TICKET DE PAGO - INICIO EXPEDIENTE";
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $hora=DB::select("select SUBSTRING(convert(varchar(14),getdate(),108), 1, 5) as hora");
        $now=Carbon::now();
        $fecha=$now->format('d/m/Y');
        return view('tramitedocumentario.ProcesosWeb.generarticket',['pagina'=>$pagina,"areas"=>$areas,'hora'=>$hora,'fecha'=>$fecha]);
    }

    public function registrarTicket(Request $request){
        $dni=$request->get('dni');
        $paterno=$request->get('paterno');
        $materno=$request->get('materno');
        $nombres=$request->get('nombres');
        $correo=$request->get('correo');
        $correo1=$request->get('correo1');
        $monto=$request->get('monto');
        $destino=$request->get('destino');
        $codigo=$request->get('tributo');
        $nroc=_random();
        $ipp=getIPs();
        $persona=DB::select("exec sp_persona @tipo='26',@documento='".$dni."',@paterno='".$paterno."',@materno='".$materno."',@nombres='".$nombres."',@user='".Auth::user()->per_login."'");
        DB::raw("insert into liqui_tributos (tributos_id,persona_id,codigo,fecha,monto,are_codigo,correo,correo1,estado,usuario_insert,ip_insert) values 
                      ('".$codigo."','".$persona."','".$nroc."',getdate(),'".$monto."','".$destino."','".$correo."','".$correo1."','P','".Auth::user()->per_login."','".$ipp."')");

        //mail

        return redirect('tramitedocumentario/listadotickets')->with(['alert'=>'Ticket anulado']);
    }

    public function listarSolicitudesWeb(Request $request){
        $pagina="LISTADO DE SOLICITUDES WEB";
        $tipos=DB::select("exec trd_expediente @tipo='59',@codigo='".Auth::user()->per_codigo."'");
        $ip=request()->ip();
        $areas1=DB::select('exec lSP_Combos @tipo=1');
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('dni') || $request->get('apellidos') || $request->get('tptra') || $request->get('finicioC') || $request->get('ffin')){
            $dni=$request->get('dni');
            $apellidos=$request->get('apellidos');
            $tipo=$request->get('tptra');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $solicitudes=DB::select("exec trd_expediente @tipo=60, @dni='".$dni."', @apellidos='%$apellidos%' , @fecha='".$finicio."' ,@fecha1='".$ffin."', @tipotramite='".$tipo."', @codigo='".Auth::user()->per_codigo."'");
            $cant_exp=count($solicitudes);
            $pageSize=$cant_exp;
        }else{
            $solicitudes=DB::select("exec trd_expediente @tipo='57', @start='".$offset."', @end='".$pageSize."',@codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_expediente @tipo='58',@codigo='".Auth::user()->per_codigo."'");
            $cant_exp=$cant[0]->linea;
        }
        if($cant_exp!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($solicitudes,$cant_exp, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.ProcesosWeb.solicitudesweb',['pagina'=>$pagina,'tipos'=> $tipos,'areas1'=>$areas1,'ip'=>$ip,'solicitudes'=>$paginator]);
        }else{
            return view('tramitedocumentario.ProcesosWeb.solicitudesweb',['pagina'=>$pagina,'tipos'=> $tipos,'areas1'=>$areas1,'ip'=>$ip]);
        }
    }

    public function verAdjuntosSolicitud(Request $request){
        $id=$request->get('id');
        $adjuntos=DB::select("SELECT triniar_url_publica as url FROM tramite_inicio_archivos ta inner join tramite_inicio ti on ta.triniar_trini_id=ti.trini_origen WHERE ti.trini_id='".$id."'");
        $texto="";
        $i=1;
        foreach($adjuntos as $a){
            $texto.="<tr>";
            $texto.="<td>$i</td>";
            $texto.="<td><a href='$a->url' target='_blank'>Adjunto_$i</a></td>";
            $texto.="</tr>";
            $i++;
        }
        return $texto;
    }

    public function anularSolicitudWeb(Request $request){
        $id=$request->get('id');
        $motivo=$request->get('motivo');
        DB::unprepared("exec trd_expediente @tipo=68, @codigo='".$id."', @usuario='".Auth::user()->per_codigo."', @value='".$motivo."'");
        return redirect('tramitedocumentario/solicitudes')->with(['alert'=>'Solicitud web anulada']);
    }

    public function verificarSolicitudWeb(Request $request){
        $id=$request->get('id');
        DB::unprepared("exec trd_expediente @tipo=77, @codigo='".$id."', @usuario='".Auth::user()->per_codigo."'");
        return redirect('tramitedocumentario/solicitudes')->with(['alert'=>'Solicitud web verificada']);
    }

    public function derivarSolicitudWeb(Request $request){
        $id=$request->get('id');
        $area=$request->get('area');
        DB::unprepared("exec trd_expediente @tipo=67, @codigo='".$id."', @value='".$area."' , @usuario='".Auth::user()->per_codigo."'");
        return redirect('tramitedocumentario/solicitudes')->with(['alert'=>'Solicitud web derivada']);
    }

    public function movimientosSolicitudesWeb(Request $request)
    {
        $id = $request->get('id');
        $movimientos = DB::select("exec trd_expediente @tipo=78,@codigo='$id'");
        $html = "";
        foreach ($movimientos as $m) {
            $html .= "<tr>";
            $html .= "<td>$m->fecha</td>";
            if ($m->deriva == 1) {
                $html .= "<td>Solicitud derivada a $m->area</td>";
            } else {
                if ($m->verifica == 0) {
                    $html .= "<td>Solicitud registrada</td>";
                } else {
                    if ($m->verifica == 1) {
                        $html .= "<td>Solicitud verificada</td>";
                    } else {
                        if ($m->verifica == 3) {
                            $html .= "<td>Solicitud anulada</td>";
                        } elseif ($m->verifica == 4) {
                            $html .= "<td>Solicitud elevada a epxpediente $m->area</td>";
                        }
                    }
                }
            }
            $html .= "<td>$m->usuario</td>";
            $html .= "</tr>";
        }
        return $html;
    }

    public function listarSolicitudesWebVerificadas(Request $request){
        $pagina="LISTADO DE SOLICITUDES WEB VERIFICADAS";
        $tipos=DB::select("exec trd_expediente @tipo='63',@codigo='".Auth::user()->per_codigo."'");
        $ip=request()->ip();
        $areas1=DB::select('exec lSP_Combos @tipo=1');
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('dni') || $request->get('apellidos') || $request->get('tptra') || $request->get('finicioC') || $request->get('ffin')){
            $dni=$request->get('dni');
            $apellidos=$request->get('apellidos');
            $tipo=$request->get('tptra');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $solicitudes=DB::select("exec trd_expediente @tipo=64, @dni='".$dni."', @apellidos='%$apellidos%' , @fecha='".$finicio."' ,@fecha1='".$ffin."', @tipotramite='".$tipo."', @codigo='".Auth::user()->per_codigo."'");
            $cant_exp=count($solicitudes);
            $pageSize=$cant_exp;
        }else{
            $solicitudes=DB::select("exec trd_expediente @tipo='61', @start='".$offset."', @end='".$pageSize."',@codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_expediente @tipo='62',@codigo='".Auth::user()->per_codigo."'");
            $cant_exp=$cant[0]->linea;
        }
        if($cant_exp!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($solicitudes,$cant_exp, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.ProcesosWeb.solicitudeswebv',['pagina'=>$pagina,'tipos'=> $tipos,'areas1'=>$areas1,'ip'=>$ip,'solicitudes'=>$paginator]);
        }else{
            return view('tramitedocumentario.ProcesosWeb.solicitudeswebv',['pagina'=>$pagina,'tipos'=> $tipos,'areas1'=>$areas1,'ip'=>$ip]);
        }
    }

}


