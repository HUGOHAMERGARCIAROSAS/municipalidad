<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;

class GrupoController extends Controller
{
    public function verGrupos(Request $request)
    {
        $pagina = "Grupos";
        $page = request('page', 1);
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        if ($request->get('query')) {
            $query = $request->get('query');
            $grupos = DB::select('exec sp_grupo ?,?,?,?,?,?,?,?,?', array("", "$query", "", "", "", "", "", "", 13));
            $data = array_slice($grupos, $offset, $pageSize, true);
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($grupos), $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('administracion.grupos.grupos', ['pagina' => $pagina, 'grupos' => $paginator, 'query' => $query]);
        } else {
            $grupos = DB::select('exec sp_grupo ?,?,?,?,?,?,?,?,?', array("", "", "", "", "", "", "", "", 12));
            $data = array_slice($grupos, $offset, $pageSize, true);
            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, count($grupos), $pageSize, $page);
            $paginator->setPath(request('url'));
            return view('administracion.grupos.grupos', ['pagina' => $pagina, 'grupos' => $paginator]);
        }
    }

    public function registrarGrupo()
    {
        $pagina = 'Registrar Grupo';
        $modulos = DB::table('modulo')->select()->get();
        return view('administracion.grupos.registrar_grupo', ['pagina' => $pagina, 'modulos' => $modulos]);
    }

    public function guardarGrupo(Request $request)
    {
        $modulo = $request->get('modulo');
        $nombre = $request->get('grupo');
        $desc = $request->get('descripcion');
        $icono = $request->get('icono');
        $orden = $request->get('orden');
        DB::statement('exec sp_grupo ?,?,?,?,?,?,?,?,?,?', array("", $nombre, $desc, $icono, $orden, 1, "", "", 16, $modulo));
        return redirect('/administracion/grupos')->with(['alert' => 'Grupo ' . $nombre . ' Creado']);
    }

    public function editarGrupo($id)
    {
        $pagina = 'Editar Grupo';
        $modulos = DB::table('modulo')->select()->get();
        $grupo = DB::table('grupo')->select()->where('grupo_id', $id)->first();
        return view('administracion.grupos.editar_grupo', ['pagina' => $pagina, 'modulos' => $modulos, 'grupo' => $grupo]);
    }

    public function actualizarGrupo($id, Request $request)
    {
        $modulo = $request->get('modulo');
        $nombre = $request->get('grupo');
        $desc = $request->get('descripcion');
        $icono = $request->get('icono');
        $orden = $request->get('orden');
        DB::statement('exec sp_grupo ?,?,?,?,?,?,?,?,?,?', array($id, $nombre, $desc, $icono, $orden, 1, "", "", 15, $modulo));
        return redirect('/administracion/grupos')->with(['alert' => 'Grupo ' . $nombre . ' actualizado']);
    }

    public function cambiarEstadoGrupo(Request $request)
    {
        $id = $request->get('id');
        $estado = $request->get('estado');
        DB::statement('exec sp_grupo ?,?,?,?,?,?,?,?,?', array($id, "", "", "", "", $estado, "", "", 14));
        //return dd($estado);
        return redirect('/administracion/grupos')->with(['alert' => 'Estado actualizado']);
    }
}
