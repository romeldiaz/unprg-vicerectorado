<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Http\Requests\ActividadRequest;
use App\User;
use App\Oficina;
use App\Responsable;
use App\Meta;
use DB;
use Carbon\Carbon;

class ActividadController extends Controller
{

    public function index()
    {
        //dependiendo del usuario se mostraran los uua
        $actividades = Actividad::where('status',true)->get();
        return view('actividades.index',['actividades'=>$actividades]);
    }

    public function create()
    {
        $usuarios = User::all();
        $oficinas = Oficina::all();
        return view('actividades.create', [
          'usuarios'=>$usuarios,
          'oficinas'=>$oficinas
        ]);
    }

    public function store(ActividadRequest $request)
    {
        Actividad::myStore($request);
        return redirect('actividades');
    }

    public function show($id)
    {
        $actividad = Actividad::findOrFail($id);
        $metas = Meta::where('actividad_id',$id)->get();
        $responsables = Responsable::where('actividad_id',$id)
        ->join('usuario', 'responsable.usuario_id', '=', 'usuario.id')
        ->select('usuario.*')
        ->get();
        return view('actividades.show',[
          'actividad'=>$actividad,
          'responsables'=>$responsables,
          'metas'=>$metas
        ]);
    }


    public function edit($id)
    {
        $usuarios = User::all();
        $oficinas = Oficina::all();
        $actividad = Actividad::find($id);
        return view('actividades.update', [
          'usuarios'=>$usuarios,
          'oficinas'=>$oficinas,
          'actividad'=>$actividad
        ]);
    }

    public function update(Request $request, $id)
    {
      Actividad::myUpdate($request, $id);
      return redirect('actividades');
    }


    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->status = false;
        $actividad->save();
        return redirect('actividades');
    }

    public function actividad_js(Request $request){
      switch ($request->op) {
        case 'select_usuario_by_oficina':
            if($request->oficina_id==0){
              $user = User::all();
            }else{
              $user = User::where('oficina_id', $request->oficina_id)->get();
            }
            return $user;
            break;

        case 'search_usuario_by_nombre':
            if($request->oficina_id==0){
              $usuarios = Usuario::where('nombre', 'like', '%'.$request->usuario_nombre.'%')->get();
            }else{
              $todos = Usuario::where('oficina_id', $request->oficina_id);
              $usuarios = $todos->where('nombre', 'like', '%'.$request->usuario_nombre.'%')->get();
            }
            return $usuarios;
            break;

        case 'consultar_responsables':
            $responsables = Responsable::where('estado', '=', true)
            ->where('actividad_id', '=', $request->actividad_id)
            ->join('usuario', 'responsable.usuario_id', '=', 'usuario.id')
            ->select('usuario.*')
            ->get();
            return $responsables;
            break;

        default:
          break;
      }


    }
}
