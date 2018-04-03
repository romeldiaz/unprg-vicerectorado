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


	// Added

	public function metas()
	{
		return $this->hasMany(Meta::class);
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'responsables');
	}

	public function responsables()
	{
		return $this->hasMany(Responsable::class);
	}

	public function creador()
	{
		return $this->belongsTo(User::class, 'creador_id');
	}

  	public function scopeSearch($query, $search){
		$search = preg_replace('[\s+]','', $search);//quitar espacios
		$search = strtolower($search);//convertir todo a minusculas

		if($search != ""){
			$query->where(\DB::raw("REPLACE(LOWER(nombre),' ', '')"), "LIKE", "%$search%");
		}
	}

	public function porcentaje(){
		$inicio = strtotime($this->fecha_inicio);
	      $fin = strtotime($this->fecha_fin_esperada);
	      $total = $fin-$inicio;
	      $diastotal = ((($total/60)/60)/24);
	      
	      $hoy = date('Y-m-d');
	      $dia = strtotime($hoy);
	      $pasado = $dia-$inicio;
	      $diaspasados = ((($pasado/60)/60)/24);

	      $porcentaje = ($diaspasados/$diastotal)*100;
	      $porcentaje = round($porcentaje);
	      if($porcentaje>100){
	        $porcentaje = 100;
	      }
	      return $porcentaje;
	}
}
