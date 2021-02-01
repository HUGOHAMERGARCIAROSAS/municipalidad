<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function verPrincipal(){
        $u=Auth::user();
        if (is_null($u)){
            $us=session('Usuario');
            if(is_null($us)){
                return redirect('/login');
            }else{
                return redirect('/home');
            }
        }else{
            return redirect('/login');
        }
    }

    public function home(){
        if(!is_null(Auth::user())){
            $mod_men=DB::table('mod_men')->select()->where('persona_id',Auth::user()->per_codigo)->get();
            $persona=DB::table('persona')->select()->where('persona_id',Auth::user()->per_codigo)->first();
            $nombre=$persona->paterno." ".$persona->materno.", ".$persona->nombres;
            $m=Array();
            foreach ($mod_men as $n){
                array_push($m,$n->mod_codigo);
            }
            $modulos=DB::table('modulo')->select()->whereIn('mod_codigo',$m)->get();
            session(['nombre'=>$nombre]);
            session()->forget(['pagina']);
            //return dd(session('User'));
            return view('home',['modulos'=>$modulos,'pagina'=>'Seleccionar Modulo']);
        }else{
            return redirect('/login');
        }
    }

    public function login(){
        return view('auth.login');
    }

    public function modulos($modulo){
        $mod=DB::table('Modulo')->select()->where('mod_codigo',$modulo)->first();
        $permisos=DB::table('permiso')->select()->where('persona_id',Auth::user()->per_codigo)->get();
        $per=Array();
        foreach ($permisos as $p){
            array_push($per,$p->tarea_id);
        }
        $tar=Array();
        $tareas=DB::table('tarea')->select()->whereIn('tarea_id',$per)->orderby('tar_nombre','asc')->get();
        //dd($tareas);
        foreach ($tareas as $t){
            array_push($tar,$t->grupo_id);
        }
        $grupos=DB::table('grupo')->select()->where('mod_codigo',$mod->mod_codigo)->orderby('gru_nombre','asc')->get();
        // $grupos=DB::table('grupo')->select()->where('mod_codigo',$mod->mod_codigo)->whereIn('grupo_id',$tar)->orderby('gru_nombre','asc')->get();
        // dd($grupos);
        $pagina=$mod->mod_url;
        //return dd($tareas);
        session(['pagina'=>$pagina,'modulo'=>$mod,'grupos'=>$grupos,'tareas'=>$tareas]);
        return redirect($pagina);
    }

    public function logout(){
        session()->flush();
        return redirect('login');
    }

    public function cambiarPass(Request $request){
        $old=md5($request->post('old_pass'));
        $new=md5($request->post('new_pass'));
        //$confirm=$request->post('confirm_pass');

        $verifica=DB::select("exec sp_usuario @tipo='18', @value='$old',@primero='".Auth::user()->per_codigo."'");

        if($verifica[0]->num==1){
            DB::statement("exec sp_usuario @tipo='19', @value='$new',@primero='".Auth::user()->per_codigo."'");
            return Redirect::back()->with(['alert'=>'Contraseña actualizada']);
        }else{
            return Redirect::back()->with(['error'=>'La contraseña anterior no es válida']);
        }
    }

}
