<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificacion extends Model
{
  use SoftDeletes; //habilita borrado suave (borrado por software)
  protected $dates = ['deleted_at'];

  protected $table = 'notificaciones';
  public $timestamps = false;

  protected $fillable = ['fecha', 'tipo', 'enlace', 'user_id'];
}
