<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';

    public $timestamps = false;

    public static function myStore($request){
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

      $actividad_id =  $actividad->max('id');
      //return $actividad_id;

      //verificamos si se definio resposnables (para evitar error php)
      if(isset($request->usuarios)){
        //guardarmos responsables
        foreach($request->usuarios as $usuario_id){
          $responsable = new Responsable();
          $responsable->usuario_id = $usuario_id;
          $responsable->actividad_id = Actividad::all()->last()->id;
          $responsable->save();
        }
      }
    }

  public static function myUpdate($request, $id){
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

    //desactivar responsable
    $olds = Responsable::where('actividad_id', $actividad_id)->get();
    foreach ($olds as $key => $old) {
      $estado = false;
      if(isset($request->usuarios)){

        foreach ($request->usuarios as $usuario_id) {
          echo $old->usuario_id. '=='. $usuario_id. '<br>';
          if($old->usuario_id == $usuario_id){
            $estado = true;
            break;
          }
        }
      }

      $old->estado = $estado;
      $old->save();
    }

    //agregar responsable
    if(isset($request->usuarios)){
      foreach($request->usuarios as $usuario_id){
        $responsable = Responsable::where('actividad_id', $actividad_id)
        ->where('usuario_id',$usuario_id)
        ->get();
        if(count($responsable)==0){//crea un reponsable por primera ves
          $responsable = new Responsable();
          $responsable->usuario_id = $usuario_id;
          $responsable->actividad_id = $actividad_id;
          $responsable->estado = true;
          $responsable->save();
        }else{
          $responsable->estado = true; //activa un responsable
          //$responsable->save();
        }
      }
    }
  }
}
