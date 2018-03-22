<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class JavascriptController extends Controller
{
  public function index(){
    return 'fuciones js';
  }

	public function funciones(Request $request){
      $response  = [];//datos que se devuelven a la vista
      switch ($request->op) {//controlador de la operacion que se va a realizar
        /*----------------------------JS:ACTIVIDAD----------------------------*/
        case 'show_info_user':
          $user = DB::table('users')->where('id',$request->user_id)->get();
          $oficina = DB::table('oficinas')->where('id', $user[0]->oficina_id)->get();
          $actividades_total = DB::table('responsables')->where('user_id',$request->user_id)->get();
          $response = [
            'user'=>$user[0],
            'oficina'=>$oficina[0],
            'actividades'=>['total'=>count($actividades_total)],
            'metas'=>['total'=>26],
            'puntaje'=>['total'=>56]
          ];
          break;
        /*----------------------------JS:ACTIVIDAD----------------------------*/
        case 'consultar_oficinas_por_nombre':
          $response = DB::table('oficinas')
                      ->whereNull('deleted_at')
                      ->where('nombre', 'like', '%'.$request->nombre.'%')->get();
          break;
        default:
          break;
      }
      return $response;
  	}
}
