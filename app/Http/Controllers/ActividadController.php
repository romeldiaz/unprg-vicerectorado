<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Http\Requests\ActividadRequest;
use App\Usuario;
use App\Oficina;
use App\Responsable;
use DB;

class ActividadController extends Controller
{
    public function cargarResponsables(Request $request){
      $responsable = Responsable::where('actividad_id',$request->id)
                      ->join('usuario', 'responsable.usuario_id', '=', 'usuario.id')
                      ->select('usuario.*')
                      ->get();
      return $responsable;
    }

    public function responsableSelected(Request $request){
      if($request->type=='u'){
        return Usuario::find($request->id);
      }elseif($request->type=='o'){
        return Oficina::find($request->id);
      }else{
        return [];
      }
    }

    public function buscarResponsable(Request $request){
      $word = $request->word;
      $tabla = $request->type;

      //$datos = Usuario::all();
      //$datos = DB::select('select concat(nombre, \' \', paterno, \' \', materno) as fullnombre  from usuario where concat(nombre, \' \', paterno, \' \', materno) like %ro%');
      //$datos = DB::select('select * from usuario where nombre like \%r\%');

      if(empty($word)){
        if($tabla=='u'){
          $datos = DB::select('select * from usuario');
        }elseif ($tabla=='o') {
          $datos = DB::select('select * from oficina');
        }else{
          $datos = null;
        }
      }else{
        if($tabla=='u'){
          //$datos = DB::select('select UPPER(nombre) from usuario where UPPER(nombre) LIKE "%ROMEL%"');
          $datos = DB::table('usuario')
                                      ->where('UPEER\(nombre\)', '=','romel')
                                      ->get();
        }elseif ($tabla=='o') {
          $datos = DB::table('oficina')
                                      ->where('UPPER(nombre)', 'like','UPPER(%'.$word.'%)')
                                      ->get();
        }else{
          $datos = null;
        }
      }
      return $datos;
    }

    public function index()
    {
        $actividades = Actividad::all();
        return view('actividades.index',['actividades'=>$actividades]);
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('actividades.create', ['usuarios'=>$usuarios]);
    }

    public function store(Request $request)
    {
        $actividad = new Actividad;
        $actividad->nombre = $request->nombre;
        $actividad->presupuesto = !empty($request->presupuesto)?$request->presupuesto:0;
        $actividad->estado = '0';
        $actividad->fecha_creacion = date ('Y-m-d');
        $actividad->fecha_inicio = $request->fecha_inicio;
        $actividad->fecha_fin_esperada =$request->fecha_fin_esperada;
        $actividad->fecha_fin = NULL;
        $actividad->numero_resolucion = $request->numero_resolucion;
        $actividad->fecha_resolucion = $request->fecha_resolucion;
        $actividad->numero_acta = $request->numero_acta;
        $actividad->fecha_acta = $request->fecha_acta;
        $actividad->descripcion_acta = $request->descripcion_acta;
        $actividad->save();

        $actividad_id =  $actividad->max('id'); //recuperamos el id del ultimo registro insertado


        if(isset($request->usuarios)){//guardar usuarios como responsables
          foreach($request->usuarios as $usuario_id){
            $responsable = new Responsable();
            $responsable->usuario_id = $usuario_id;
            $responsable->actividad_id = $actividad_id;
            $responsable->save();
          }
        }
        if(isset($request->oficinas)){//guardar todos los usuarios de la oficinas
          foreach($request->oficinas as $oficina_id){
            $usuarios = Usuario::where('oficina_id', $oficina_id)->get();
            foreach($usuarios  as $usuario){
              $responsable = new Responsable();
              $responsable->usuario_id = $usuario->id;
              $responsable->actividad_id = $actividad_id;
              $responsable->save();
            }
          }
        }

        return redirect('actividades');
    }

    public function show($id)
    {
        return view('actividades.show');
    }


    public function edit($id)
    {
        $usuarios = Usuario::all();
        $actividad = Actividad::find($id);
        return view('actividades.update', ['usuarios'=>$usuarios, 'actividad'=>$actividad]);
    }

    public function update(Request $request, $id)
    {
      $actividad = Actividad::find($id);
      $actividad->nombre = $request->nombre;
      $actividad->presupuesto = !empty($request->presupuesto)?$request->presupuesto:0;
      $actividad->estado = '0';
      $actividad->fecha_creacion = date ('Y-m-d');
      $actividad->fecha_inicio = $request->fecha_inicio;
      $actividad->fecha_fin_esperada =$request->fecha_fin_esperada;
      $actividad->fecha_fin = NULL;
      $actividad->numero_resolucion = $request->numero_resolucion;
      $actividad->fecha_resolucion = $request->fecha_resolucion;
      $actividad->numero_acta = $request->numero_acta;
      $actividad->fecha_acta = $request->fecha_acta;
      $actividad->descripcion_acta = $request->descripcion_acta;
      $actividad->save();

      $actividad_id =  $id;

      $eliminar = Responsable::where('actividad_id',$actividad_id)->delete();

      if(isset($request->usuarios)){//guardar usuarios como responsables
        foreach($request->usuarios as $usuario_id){
          $responsable = new Responsable();
          $responsable->usuario_id = $usuario_id;
          $responsable->actividad_id = $actividad_id;
          $responsable->save();
        }
      }
      if(isset($request->oficinas)){//guardar todos los usuarios de la oficinas
        foreach($request->oficinas as $oficina_id){
          $usuarios = Usuario::where('oficina_id', $oficina_id)->get();
          foreach($usuarios  as $usuario){
            $responsable = new Responsable();
            $responsable->usuario_id = $usuario->id;
            $responsable->actividad_id = $actividad_id;
            $responsable->save();
          }
        }
      }

      return redirect('actividades');
    }


    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        $actividad->delete();
        return redirect('actividades');
    }
}
