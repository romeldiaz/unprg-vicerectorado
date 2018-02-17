<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    public static function checkOficina($oficina_id){
      return Usuario::where('oficina_id', '=', $oficina_id)
      ->where('jefe',true)
      ->get();
    }
}
