<?php

namespace App\Http\Controllers;
use App\Http\Requests\ActividadRequest;
use Illuminate\Http\Request;

use App\Actividad;
use App\Oficina;
use App\User;
use App\Responsable;
use Carbon\Carbon;
use View;
use Auth;

class ActividadController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index()
    {
      return redirect('actividades/asignaciones');
    }

    public function asignaciones(Request $request){

      $actividades= User::findOrfail(Auth::user()->id)->actividades->sortByDesc('id');
      return view('actividades.asignaciones', compact('actividades'));
    }

    public function creaciones(Request $request){
      $actividades = User::find(Auth::user()->id)->creaciones->sortByDesc('id');
      return view('actividades.creaciones', compact('actividades'));
    }

    public function todas(Request $request){
      $actividades = Actividad::all();
      return view('actividades.todas', compact('actividades'));
    }

    public function monitoreos(Request $request){
      $actividades = User::find(Auth::user()->id)->monitoreos->sortByDesc('id');
      return view('actividades.monitoreos', compact('actividades'));
    }

    public function create()
    {
        return view('actividades.create', compact('monitores'));
    }

    public function store(ActividadRequest $request)
    {
        // return ($request->presupuesto=='')?'0':$request->presupuesto;
        $datos = $request->all();
        $datos['creador_id']= Auth::user()->id;
        $datos['estado'] = 'creada';
        $datos['fecha_creacion'] = Carbon::now();
        Actividad::create($datos);

        \App\Notificacion::toAdminActivityCreated();

        return redirect('actividades/creaciones');
    }

    public function show($id)
    {
        $actividad = Actividad::findOrfail($id);

        if($actividad->creador->id == Auth::user()->id){
          // Puede ver el creador
          return view('actividades.show', compact('actividad'));
        }elseif($actividad->monitor->id == Auth::user()->id){
          // Puede ver el monitor
          return view('actividades.show', compact('actividad'));
        }elseif(Auth::user()->tipo=='admin'){
          // Puede ver el admin
          return view('actividades.show', compact('actividad'));
        }else{
          // Pueden ver los responsables
          $responsables = $actividad->responsables;
          foreach ($responsables as $key => $responsable) {
            $user = $responsable->user;
            if($user->id == Auth::user()->id){
              return view('actividades.show', compact('actividad'));
            }
          }
        }

        return redirect('actividades/asignaciones');
    }

    public function misActividades(){//muestra solo las actividades creadas por el usuario logeado
      $monitores = User::where('oficina_id', Auth::user()->oficina_id)->get();
      $actividades = Actividad::where('creador_id', Auth::user()->id)->get();
      //return $actividades;
      $users = User::all();
      return view('actividades.index', compact('actividades', 'users', 'monitores'));
    }


    public function edit($id)
    {
      //vista edit solo al creador
      $actividad = Actividad::findOrfail($id);
      if($actividad->creador->id == Auth::user()->id){
        return view('actividades.edit', compact('actividad'));
      }
      return redirect('actividades/creaciones');
    }

    public function update(ActividadRequest $request, $id)
    {
      //modifica solo el creador
      $actividad = Actividad::findOrfail($id);
      if($actividad->creador->id == Auth::user()->id){

        $actividad = Actividad::findOrfail($id);
        $datos = $request->all();
        $datos['creador_id']= Auth::user()->id;
        $datos['estado'] = 'creada';
        $actividad->update($datos);
      }
      return redirect('actividades/creaciones');
    }

    public function destroy($id)
    {
      $actividad = Actividad::findOrfail($id);
      if($actividad->creador->id == Auth::user()->id){
        $actividad->delete();
      }
      return redirect('actividades/creaciones');
    }

    public function post_js(Request $request){
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
              $usuarios = User::where('nombres', 'like', '%'.$request->usuario_nombre.'%')->get();
            }else{
              $users = User::search($request->usuario_nombre)
                ->where('oficina_id', $request->oficina_id)
                ->orderBy('id', 'asc')->get();
            }
            return $users;
            break;

        case 'consultar_responsables':
            $responsables = Responsable::where('actividad_id', $request->actividad_id)
            ->join('users', 'responsables.user_id', '=', 'users.id')
            ->select('users.*')
            ->get();
            return $responsables;
            break;

        default:
          break;
      }
    }

}
