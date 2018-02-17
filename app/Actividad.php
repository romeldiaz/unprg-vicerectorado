<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';

    public static function buscarResponsable($word, $type){
      //type: u: tabla usuarios, o: tabla de oficina
      $tabla = $type=='u'?'usuario':'oficina';
      return $tabla;
    }
}
