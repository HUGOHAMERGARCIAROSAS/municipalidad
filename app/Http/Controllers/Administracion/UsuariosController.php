<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UsuariosController extends Controller
{
    public function verUsuarios(Request $request)
    {
        $pagina = "Usuarios";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        if ($request->get('query')) {
            $query = $request->get('query');
            $usuarios = DB::select('exec sp_usuario ?,?,?,?,?,?,?,?,?,?,?', array(3, "", "", $query, "", "", "", "", "", "", ""));
            $data = array_slice($usuarios, $offset, $pageSize, true);
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($usuarios), $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('administracion.usuarios.usuarios', ['pagina' => $pagina, 'usuarios' => $paginator, 'query' => $query]);
        } else {
            return view('administracion.usuarios.usuarios', ['pagina' => $pagina]);
        }
    }

    public function buscarTrabajadores(Request $request)
    {
        $query = $request->get('search');
        $personas = DB::select('exec sp_persona ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', array(25, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $query));
        $response = array();
        foreach ($personas as $t) {
            $response[] = array(
                "id" => $t->persona_ID,
                "text" => $t->texto
            );
        }
        echo json_encode($response);
        exit;
    }

    public function buscarTrabajadoresArea(Request $request)
    {
        $query = $request->get('search');
        $area = $request->get('area');
        $personas = DB::select("SET NOCOUNT ON ;exec rhSP_Trabajador @tipo = 32, @trabajador='%$query%',@Are_Codigo='" . $area . "'");
        //return dd($personas);
        $response = array();
        foreach ($personas as $t) {
            $response[] = array(
                "id" => $t->id,
                "text" => $t->nombres
            );
        }
        echo json_encode($response);
        exit;
    }

    public function registrarUsuario()
    {
        $areas = DB::table('area')->select()->where('activo', 1)->get();
        $plantillas = DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(2, "", "", "", "", "", "", ""));
        return view('administracion.usuarios.registrar_usuario', ['areas' => $areas, 'plantillas' => $plantillas]);
    }

    public function guardarUsuario(Request $request)
    {
        $persona = $request->get('persona');
        $login = $request->get('login');
        $pass = md5($request->get('pass'));
        $area = $request->get('area');
        $plantilla = $request->get('plantilla');
        DB::statement('exec sp_usuario ?,?,?,?,?,?,?,?,?,?,?', array(7, "", "", "", $persona, $area, "", "", $login, $pass, ""));
        return redirect('administracion/usuarios')->with(['alert' => 'Usuario ' . $login . ' creado']);
    }

    public function editarUsuario($id)
    {
        $pagina = 'Editar Usuario';
        $usuario = DB::select('exec sp_usuario ?,?,?,?,?,?,?,?,?,?,?', array(5, "", "", "", "$id", "", "", "", "", "", ""));
        $areas = DB::table('area')->select()->where('activo', 1)->get();
        $plantillas = DB::select('exec sp_plarol ?,?,?,?,?,?,?,?', array(2, "", "", "", "", "", "", ""));
        //return dd($usuario);
        return view('administracion.usuarios.editar_usuario', ['pagina' => $pagina, 'areas' => $areas, 'plantillas' => $plantillas, 'usuario' => $usuario]);
    }

    public function actualizarUsuario($id, Request $request)
    {
        $persona = $request->get('persona');
        $login = $request->get('login');
        $pass = md5($request->get('pass'));
        $area = $request->get('area');
        $plantilla = $request->get('plantilla');
        $cambio = $request->get('cambio');
        DB::statement('exec sp_usuario ?,?,?,?,?,?,?,?,?,?,?', array(8, "", "", "", $id, $area, 1, "", $login, $pass, ""));
        if ($cambio == "on") {
            DB::statement('exec sp_usuario ?,?,?,?,?,?,?,?,?,?,?,?', array(28, "", "", "", $id, "", "", "", "", "", "", $plantilla));
            return redirect('administracion/usuarios')->with(['alert' => 'Usuario ' . $login . ' actualizado con cambio de palntilla']);
        } else {
            return redirect('administracion/usuarios')->with(['alert' => 'Usuario ' . $login . ' actualizado']);
        }
    }

    public function actualizaEstadoUsuario(Request $request)
    {
        $id = trim($request->post('codigo'));
        $login = $request->post('login');
        $estado = $request->post('valor');
        if ($estado == 1) {
            DB::unprepared("SET NOCOUNT ON; exec sp_usuario @tipo=9, @codigo='$id'");
            return redirect('administracion/usuarios')->with(['alert' => 'Usuario ' . $login . ' deshabilitado']);
        }else{
            DB::unprepared("SET NOCOUNT ON; exec sp_usuario @tipo=30, @codigo='$id'");
            return redirect('administracion/usuarios')->with(['alert' => 'Usuario ' . $login . ' habilitado']);
        }
    }

    public function verPermisosModulosUsuario($id)
    {
        $pagina = "Permisos de Modulos";
        $modulos = DB::table('Modulo')->select()->get();
        $mod_men = DB::table('mod_men')->select('mod_codigo')->where('persona_id', $id)->get();
        $usuario = DB::select('exec sp_usuario ?,?,?,?,?,?,?,?,?,?,?', array(5, "", "", "", $id, "", "", "", "", "", ""));
        return view('administracion.usuarios.permisos_modulos', ['pagina' => $pagina, 'modulos' => $modulos, 'mod_men' => $mod_men, 'usuario' => $usuario]);
    }

    public function verPermisosUsuario($id)
    {
        $pagina = "Permisos de Grupos y Tareas";
        $modulos = DB::table('Modulo')->select()->get();
        $usuario = DB::select('exec sp_usuario ?,?,?,?,?,?,?,?,?,?,?', array(5, "", "", "", $id, "", "", "", "", "", ""));

        $m = Array();
        $mod_men = DB::table('mod_men')->select('mod_men.mod_codigo', 'Modulo.mod_descripcion')
            ->join('Modulo', 'mod_men.mod_codigo', '=', 'Modulo.mod_codigo')
            ->where('persona_id', $id)->get();
        foreach ($mod_men as $n) {
            array_push($m, $n->mod_codigo);
        }
        $grupos1 = DB::table('grupo')->select()->where('gru_activo', 1)->whereIn('mod_codigo', $m)->get();
        $g = Array();
        foreach ($grupos1 as $s) {
            array_push($g, $s->grupo_id);
        }
        $tareas1 = DB::table('tarea')->select()->where('tar_activo', 1)->whereIn('grupo_id', $g)->get();
        $per_tar = DB::table('permiso')->select()->where('persona_id', $id)->get();
        //return dd($grupos1);
        return view('administracion.usuarios.permisos', ['pagina' => $pagina, 'modulos' => $modulos, 'mod_men' => $mod_men, 'grupos1' => $grupos1, 'tareas1' => $tareas1, 'per_tar' => $per_tar, 'usuario' => $usuario]);
    }

    public function registrarPermisosModulosUsuario($id, Request $request)
    {
        $user = DB::table('usuario')->select('per_login')->where('per_codigo', $id)->first();
        $modulos = $request->get('Modulos');
        DB::table('mod_men')->where('persona_id', $id)->delete();
        foreach ($modulos as $m) {
            DB::table('mod_men')->insert(['persona_id' => $id, 'mod_codigo' => $m, 'mom_estado' => 1]);
        }
        //return dd($modulos);
        return redirect('administracion/usuarios')->with(['alert' => 'Permisos a modulos actualizados para el usuario ' . $user->per_login]);
    }

    public function registrarPermisosUsuario($id, Request $request)
    {
        $user = DB::table('usuario')->select('per_login')->where('per_codigo', $id)->first();
        $tareas = $request->get('Tareas');
        DB::table('permiso')->where('persona_id', $id)->delete();
        foreach ($tareas as $t) {
            DB::table('permiso')->insert(['persona_id' => $id, 'tarea_id' => $t, 'pso_activo' => 1, 'rol_id' => 30]);
        }
        //return redirect('usuarios');
        return redirect('administracion/usuarios')->with(['alert' => 'Permisos a tareas actualizados para el usuario ' . $user->per_login]);
    }
}
