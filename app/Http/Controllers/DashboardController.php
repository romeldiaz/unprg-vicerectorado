<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Oficina;
use App\Responsable;
use Validator;
use Session;
use Auth;

class DashboardController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
        return view('dashboard.index');
    }

    public function perfil(){
      $cuenta =  Auth::user()->cuenta;
      $user = User::where('cuenta',$cuenta)->get()->last();//como es un unico registro
      $oficina = Oficina::findOrFail($user->oficina_id);
      return view('dashboard.perfil' , ['user'=>$user, 'oficina'=>$oficina]);
    }


    public function misMetas(){
      $usuario = Usuario::findOrFail(64);
      return view('dashboard.misMetas',[
        'usuario'=>$usuario
      ]);
    }

    public function tareas(){//las tareas muestra mis metas y/o actividades asignadas
      $usuario_id = 64;
      $usuario = Usuario::findOrFail($usuario_id);
      $actividades = Responsable::where('usuario_id', $usuario_id)
      ->join('actividad', 'responsable.actividad_id', '=', 'actividad.id')
      ->select('actividad.*')
      ->get();
      return view('actividades.index',[
        'usuario'=>$usuario,
        'actividades'=>$actividades
      ]);
    }

    public function updateProfile(Request $request, $id){

      $rules = [
        'cuenta' => 'required',
        'nombre' => 'required',
        'paterno' => 'required',
        'materno' => 'required',
        'clave' => 'required',
      ];

      $messages[] = [
        'cuenta.required' => 'Cuenta requerido',
        'nombre.required' => 'Nombre requerido',
        'paterno.required' => 'Apellido paterno requerido',
        'materno.required' => 'Apellido materno requerido',
        'clave.required' => 'Contraseña requerida',
      ];
      $this->validate($request, $rules, $messages[0]);

      //verificar si el nuevo usuario ya existe
      //verificar que las contraseñas antiguas coiciden
      $userTmp = Usuario::findOrFail($id);
      if($userTmp->clave != $request->clave){
        Session::flash('error', 'Contraseña Incorrecta');
        return back();
      }
      $usuario = Usuario::find($request->id);
      $usuario->cuenta = $request->cuenta;
      $usuario->nombre = $request->nombre;
      $usuario->paterno = $request->paterno;
      $usuario->materno = $request->materno;
      if(!empty($request->clave2)){
        $usuario->clave = $request->clave2;
      }
      $usuario->save();
      return back();
    }

}
