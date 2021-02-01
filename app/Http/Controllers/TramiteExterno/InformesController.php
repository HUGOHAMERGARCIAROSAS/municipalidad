<?php

namespace App\Http\Controllers\TramiteExterno;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class InformesController extends Controller
{
    public function verInformesTrbPendientes(Request $request){
        $pagina="MANTENEDOR INFORMES PEDIENTES POR RECIBIR DE UN TRABAJADOR";
        $nombres=DB::select("select paterno+' '+materno+' '+nombres as materno from Persona where persona_id = '".Auth::user()->per_codigo."'");
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $tipodoc=DB::select("SELECT idtpdoc as valor, tpd_descripcion as texto FROM exptp_documento order by 2");

        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('desc') || $request->get('area')){
            $tdoc=$request->get('tipodoc');
            $area=$request->get('area');
            $dest=$request->get('destino');
            $exp=$request->get('exp');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $asunto=$request->get('asunto');
            $anio=$request->get('anio');
            $infp=DB::select("exec trd_informestrab @tipo=16,@primero='".$area."',@segundo='".$tdoc."', @fecha='".$finicio->format('d/m/Y')."', @fecha1='".$ffin->format('d/m/Y')."',@value='%$asunto%',@destino='".$dest."' , @numero='".$exp."', @start='".$anio."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=count($infp);
            $pageSize=$cant_inf;
        }else{
            $infp=DB::select("exec trd_informestrab @tipo='14', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_informestrab @tipo='15', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=$cant[0]->linea;
        }
        if($cant_inf!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($infp,$cant_inf, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.informestrbpend',['pagina'=>$pagina,'areas'=>$areas,'nombres'=>$nombres,'tipodoc'=>$tipodoc,'informes'=>$paginator]);
        }else{
            return view('tramitedocumentario.mantenedores.informestrbpend',['pagina'=>$pagina,'areas'=>$areas,'nombres'=>$nombres,'tipodoc'=>$tipodoc]);
        }
    }

    public function archivarInforme(Request $request){
        $id=$request->get("id");
        DB::raw("exec trd_informestrab @tipo='17',@codigo='".$id."' ,@usuario='".Auth::user()->per_login."'");
        return redirect('tramitedocumentario/informestrp')->with(['alert'=>'Informe archivado']);
    }

    public function proveerInforme(Request $request){
        $pagina="AGREGAR INFORME DEL TRABAJADOR";
        $id=$request->get("id");
        return view('tramitedocumentario.mantenedores.proveerinformetrbp',['pagina'=>$pagina,'id'=>$id]);
    }

    public function verProveidos(Request $request){
        $areas=DB::select("exec lSP_Requerimientos @tipo='30', @Per_Codigo='".Auth::user()->per_codigo."'");
        $tipodoc=DB::select("SELECT idtpdoc as valor, tpd_descripcion as texto FROM exptp_documento where idtpdoc='27' order by 2");
        $destinos=DB::select("SELECT are_codigo as valor, are_descripcion as texto FROM area where len(are_codigo)='4' and activo='1' and are_codigo in (select are_codigo from Area_Trabajador where per_codigo='".Auth::user()->per_codigo."' and ATra_Estado = '1' ) order by 2");
        $pagina="MANTENEDOR DE PROVEIDOS";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $tdoc=$request->get('tipodoc');
            $area=$request->get('area');
            $dest=$request->get('destino');
            $exp=$request->get('exp');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $asunto=$request->get('asunto');
            $anio=$request->get('anio');
            $proveidos=DB::select("exec trd_informes @tipo=3,@primero='".$area."',@segundo='".$tdoc."', @fecha='".$finicio->format('d/m/Y')."', @fecha1='".$ffin->format('d/m/Y')."',@value='%$asunto%',@destino='".$dest."' , @numero='".$exp."', @start='".$anio."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_prov=count($proveidos);
            $pageSize=$cant_prov;
        }else{
            $proveidos=DB::select("exec trd_informes @tipo='14', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_informes @tipo='2', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_prov=$cant[0]->linea;
        }
        if($cant_prov!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($proveidos,$cant_prov, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.proveidos',['pagina'=>$pagina,'informes'=>$paginator,"tipodoc"=>$tipodoc,"destinos"=>$destinos,'areas'=>$areas]);
        }else{
            return view('tramitedocumentario.mantenedores.proveidos',['pagina'=>$pagina,"tipodoc"=>$tipodoc,"destinos"=>$destinos,'areas'=>$areas]);
        }
    }

    public function verProveidoArchivo(Request $request){

    }

    public function anularProveido(Request $request){
        $id=$request->get("id");
        DB::raw("exec trd_informes @tipo='9',@codigo='".$id."' ,@usuario='".Auth::user()->per_login."'");
        return redirect('tramitedocumentario/proveidos')->with(['alert'=>'Proveido eliminado']);
    }

    public function verInformes(Request $request){
        $areas=DB::select("exec lSP_Requerimientos @tipo='30', @Per_Codigo='".Auth::user()->per_codigo."'");
        $tipodoc=DB::select("SELECT idtpdoc as valor, tpd_descripcion as texto FROM exptp_documento order by 2");
        $destinos=DB::select("SELECT are_codigo as valor, are_descripcion as texto FROM area where len(are_codigo)='4' and activo='1' and are_codigo in (select are_codigo from Area_Trabajador where per_codigo='".Auth::user()->per_codigo."' and ATra_Estado = '1' ) order by 2");
        $pagina="MANTENEDOR INFORMES GENERALES";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('exp') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $tdoc=$request->get('tipodoc');
            $area=$request->get('area');
            $dest=$request->get('destino');
            $exp=$request->get('exp');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $asunto=$request->get('asunto');
            $anio=$request->get('anio');
            $informes=DB::select("exec trd_informes @tipo=3,@primero='".$area."',@segundo='".$tdoc."', @fecha='".$finicio->format('d/m/Y')."', @fecha1='".$ffin->format('d/m/Y')."',@value='%$asunto%',@destino='".$dest."' , @numero='".$exp."', @start='".$anio."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=count($informes);
            $pageSize=$cant_inf;
        }else{
            $informes=DB::select("exec trd_informes @tipo='1', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_informes @tipo='2', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=$cant[0]->linea;
        }
        if($cant_inf!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($informes,$cant_inf, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.informes',['pagina'=>$pagina,'informes'=>$paginator,"tipodoc"=>$tipodoc,"destinos"=>$destinos,'areas'=>$areas]);
        }else{
            return view('tramitedocumentario.mantenedores.informes',['pagina'=>$pagina,"tipodoc"=>$tipodoc,"destinos"=>$destinos,'areas'=>$areas]);
        }
    }

    public function anularInforme(Request $request){
        $id=$request->get("id");
        DB::raw("exec trd_informes @tipo='9',@codigo='".$id."' ,@usuario='".Auth::user()->per_login."'");
        return redirect('tramitedocumentario/informes')->with(['alert'=>'Informe anulado']);
    }

    public function anexarAInforme(Request $request){

    }

    public function verInformesTrabajador(Request $request){
        $pagina="MANTENEDOR INFORMES GENERALES DEL TRABAJADOR";
        $nombres=DB::select("select paterno+' '+materno+' '+nombres as materno from Persona where persona_id = '".Auth::user()->per_codigo."'");
        $areas=DB::select("exec lSP_Requerimientos @tipo=30, @Per_Codigo='".Auth::user()->per_codigo."'");
        $tipodoc=DB::select("SELECT idtpdoc as valor, tpd_descripcion as texto FROM exptp_documento order by 2");

        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('desc') || $request->get('area')){
            $tdoc=$request->get('tipodoc');
            $area=$request->get('area');
            $dest=$request->get('destino');
            $exp=$request->get('exp');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $asunto=$request->get('asunto');
            $anio=$request->get('anio');
            $infp=DB::select("exec trd_informestrab @tipo=3,@primero='".$area."',@segundo='".$tdoc."', @fecha='".$finicio->format('d/m/Y')."', @fecha1='".$ffin->format('d/m/Y')."',@value='%$asunto%',@destino='".$dest."' , @numero='".$exp."', @start='".$anio."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=count($infp);
            $pageSize=$cant_inf;
        }else{
            $infp=DB::select("exec trd_informestrab @tipo='1', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_informestrab @tipo='2', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=$cant[0]->linea;
        }
        if($cant_inf!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($infp,$cant_inf, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.mantenedores.informestrb',['pagina'=>$pagina,'areas'=>$areas,'nombres'=>$nombres,'tipodoc'=>$tipodoc,'informes'=>$paginator]);
        }else{
            return view('tramitedocumentario.mantenedores.informestrb',['pagina'=>$pagina,'areas'=>$areas,'nombres'=>$nombres,'tipodoc'=>$tipodoc]);
        }
    }

    public function informesGenerales(Request $request){
        $tipodoc=DB::select("SELECT idtpdoc as valor, tpd_descripcion as texto FROM exptp_documento order by 2");
        $destinos=DB::select("SELECT are_codigo as valor, are_descripcion as texto FROM area where len(are_codigo)='4' and activo='1' and are_codigo in (select are_codigo from Area_Trabajador where per_codigo='".Auth::user()->per_codigo."' and ATra_Estado = '1' ) order by 2");
        $areas=DB::select("exec trd_tipotramite @tipo='13'");
        $pagina="LISTADO DE INFORMES GENERALES PREVIO EXPEDIENTE";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = $pageSize*($page-1);
        if($request->get('expediente') || $request->get('anio') || $request->get('exp') || $request->get('expediente')){
            $tdoc=$request->get('tipo');
            $area=$request->get('area');
            $dest=$request->get('destino');
            $exp=$request->get('expediente');
            $finicio=Carbon::parse($request->post('finicio'));
            $ffin=Carbon::parse($request->post('ffin'));
            $asunto=$request->get('asunto');
            $anio=$request->get('anio');
            $informes=DB::select("exec trd_informes @tipo=3,@primero='".$area."',@segundo='".$tdoc."', @fecha='".$finicio."', @fecha1='".$ffin."',@value='%$asunto%',@destino='".$dest."' , @numero='".$exp."', @start='".$anio."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=count($informes);
            $pageSize=$cant_inf;
        }else{
            $informes=DB::select("exec trd_informes @tipo='10', @start='".$offset."', @end='".$pageSize."', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant=DB::select("exec trd_informes @tipo='11', @Per_Codigo='".Auth::user()->per_codigo."'");
            $cant_inf=$cant[0]->linea;
        }
        if($cant_inf!=0){
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($informes,$cant_inf, $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('tramitedocumentario.ProcesosTramite.reginformes',['pagina'=>$pagina,'informes'=>$paginator,"tipodoc"=>$tipodoc,"destinos"=>$destinos,'areas'=>$areas]);
        }else{
            return view('tramitedocumentario.ProcesosTramite.reginformes',['pagina'=>$pagina,"tipodoc"=>$tipodoc,"destinos"=>$destinos,'areas'=>$areas]);
        }
    }
}
