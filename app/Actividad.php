<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividad extends Model
{
    use SoftDeletes; //habilita borrado suave (borrado por software)
    protected $dates = ['deleted_at'];

    protected $table = 'actividades';
    public $timestamps = false;


    protected $fillable = [
        'nombre', 'estado', 'presupuesto', 'fecha_inicio', 'fecha_fin_esperada',
        'fecha_fin', 'numero_resolucion', 'fecha_resolucion', 'fecha_acta', 'descripcion_acta', 'creador_id', 'monitor_id'
    ];
    protected $guarded = ['id'];
}
