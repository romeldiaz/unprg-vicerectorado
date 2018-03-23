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

    public function index()
    {
      return redirect('actividades/asignaciones');
    }

    public function asignaciones(Request $request){
      //Muestra las actividades a las que a sido asignado como responsable
      $actividades = Actividad::search($request->get('search'))->where('responsables.user_id', Auth::user()->id)
                      ->join('responsables', 'actividades.id', '=', 'responsables.actividad_id')
                      ->select('actividades.*')
                      ->paginate(5);

      return view('actividades.asignaciones', compact('actividades'));
    }

    public function creaciones(Request $request){
      //las actividades creadas por el usuario
      $actividades = Actividad::search($request->get('search'))->where('creador_id', Auth::user()->id)->paginate(5);
      return view('actividades.creaciones', compact('actividades'));
    }

    public function monitoreos(Request $request){
      //las actividades creadas por el usuario
      $actividades = Actividad::search($request->get('search'))->where('monitor_id', Auth::user()->id)->paginate(5);
      return view('actividades.monitoreos', compact('actividades'));
    }

    public function create()
    {
        //usuarios de la misma oficina quien crea la actividad
        $monitores = User::where('oficina_id', Auth::user()->oficina_id)->get();
        return view('actividades.create', compact('monitores'));
    }

    public function store(ActividadRequest $request)
    {
        $datos = $request->all();
        $datos['creador_id']= Auth::user()->id;
        $datos['estado'] = 'creada';
        Actividad::create($datos);
        return redirect('actividades/creaciones');
    }

    public function show($id)
    {
        $oficinas = Oficina::all();
        $actividad = Actividad::findOrfail($id);
        $creador = User::findOrfail($actividad->creador_id);
        $monitor = User::findOrfail($actividad->monitor_id);
        $responsables = Responsable::where('actividad_id', $id)
                        ->join('users', 'users.id', '=', 'responsables.user_id')
                        ->select('users.*')
                        ->get();

        //calcular tiempo restantes
        $tmp = $actividad->fecha_fin_esperada;
        if(!empty($tmp)){
          $myYear = substr($tmp,0, 4);
          $myMonth = substr($tmp, 5, 2);
          $myDay = substr($tmp, 8, 2);
          $fin = Carbon::createFromDate($myYear,$myMonth,$myDay);
          $hoy = Carbon::now();
          $plazo = $hoy->diffInDays($fin, false); // = fin-hoy
        }else{
          $plazo = null;
        }

        return view('actividades.show', compact('oficinas', 'actividad', 'responsables', 'creador', 'monitor','plazo'));
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
      $actividad = Actividad::findOrfail($id);
      $monitores = User::where('oficina_id', Auth::user()->oficina_id)->get();
      return view('actividades.edit', compact('actividad', 'monitores'));
    }

    public function update(ActividadRequest $request, $id)
    {
      $actividad = Actividad::findOrfail($id);
      $datos = $request->all();
      $datos['creador_id']= Auth::user()->id;
      $datos['estado'] = 'creada';
      $actividad->update($datos);
      return redirect('actividades/creaciones');
    }

    public function destroy($id)
    {
      $actividad = Actividad::findOrfail($id);
      $actividad->delete();
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
              $todos = User::where('oficina_id', $request->oficina_id);
              $usuarios = $todos->where('nombres', 'like', '%'.$request->usuario_nombre.'%')->get();
            }
            return $usuarios;
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
