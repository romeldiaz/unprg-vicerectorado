<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Carbon\Carbon;


class Notificacion extends Model
{
  use SoftDeletes; //habilita borrado suave (borrado por software)
  protected $dates = ['deleted_at'];

  protected $table = 'notificaciones';
  public $timestamps = false;

  protected $fillable = ['fecha', 'tipo', 'enlace', 'user_id'];

  public function scopeSearch($query, $search){
    $search = preg_replace('[\s+]','', $search);//quitar espacios
    $search = strtolower($search);//convertir todo a minusculas

    if($search != ""){
			$query->where(\DB::raw("REPLACE(LOWER(title),' ','')"), "LIKE", "%$search%")
			       ->orWhere(\DB::raw("LOWER(type)"), "LIKE", "%$search%");
		}
  }

  public function creadoHace(){
    $hoy = Carbon::now();
    $inicio = Carbon::create(
      date("Y", strtotime($this->date)),
      date("m", strtotime($this->date)),
      date("d", strtotime($this->date))
    );

    $tiempo = $hoy->diffInDays($inicio);
    if($tiempo>7){
        $tiempo = $hoy->diffInWeeks($inicio);
        if($tiempo>4){//mas de 5 semanas
          $tiempo = $hoy->diffInMonths($inicio);
          if($tiempo>12){//mas de 12 meses
            $tiempo = $hoy->diffInYears($inicio);
            return $tiempo.' años';
          }else{
            return $tiempo.'meses';
          }
        }else{
          return $tiempo.'semanas';
        }
    }elseif($tiempo==0){
      return 'Hoy';
    }
    return $tiempo.'dias';
  }

  public static function NotifyToAdminActivityCreated($from_id){
    $actividad = Actividad::all()->last();
    $user = User::findOrfail($from_id);
    $msn = 'El usuario '.$user->nombres.' ha creado una nueva actividad, ingresa al siguente
    elace para darle un vistaso > '.url('/actividad/'.$actividad->id);

    $admins = User::where('tipo','admin')->get();
    foreach ($admins as $key => $admin) {
      $notify = \DB::table('notificaciones')->insert([
        'date'=>Carbon::now(),
        'type'=>'Actividad',
        'title' => 'Nueva actividad creada',
        'from' => $from_id,
        'to' =>  $admin->id,
        'checked'=>false,
        'detail'=>$msn,
      ]);
    }

  }
  // ------------------------------DICCIONARIO------------------------------
  //(opcional): indica acividad o meta
  //NOTIFICACIONES->TIPOS:ACCION
  // actividad(1): crear(1), eliminar(2)
  // monitor(2):
  // responsable(3): asignar(1), reasignar(2), eliminar(2)
  // meta(4):
  // -----------------------------------------------------------------------

  public static function toUser($from_id, $to_id, $type, $type_id, $action){
    \DB::table('notificaciones')->insert([
      'date'=>Carbon::now(),
      'type'=> $type,
      'type_id'=> $type_id,
      'action'=>$action,
      'from' => $from_id,
      'to' =>  $to_id,
      'checked' => false,
      'detail' => 'detalle de notificacion',
    ]);
  }

  public static function toAdmin($from_id, $null, $type, $type_id, $action){
    $admins = User::where('tipo','admin')->get();
    foreach ($admins as $key => $to) {
      \DB::table('notificaciones')->insert([
        'date'=>Carbon::now(),
        'type'=> $type,
        'type_id'=> $type_id,
        'action'=>$action,
        'from' => $from_id,
        'to' =>  $to->id,
        'checked' => false,
        'detail' => 'detalle de notificacion',
      ]);
    }

  }


}
