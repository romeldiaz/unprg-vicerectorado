<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes; //habilita borrado suave (borrado por software)
    protected $dates = ['deleted_at'];

    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = [
        'nombres', 'paterno', 'materno', 'cuenta', 'password', 'jefe', 'oficina_id', 'correo', 'telefono','cargo'
    ];

    //protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function scopeSearch($query, $search){
		$search = preg_replace('[\s+]','', $search);//quitar espacios
		$search = strtolower($search);//convertir todo a minusculas
		if($search != ""){
			$query->where(\DB::raw("LOWER(CONCAT(nombres, paterno, materno))"), "LIKE", "%$search%")
			->orWhere(\DB::raw("LOWER(cuenta)"), "LIKE", "%$search%");
		}
	}


	// Added

	public function actividades()
	{
		return $this->belongsToMany(Actividad::class, 'responsables');
	}

	public function responsables()
	{
		return $this->hasMany(Responsable::class);
	}

	public function oficina()
	{
		return $this->belongsTo(Oficina::class);
	}

	public function completo()
	{
		return $this->paterno.' '.$this->materno.' '.$this->nombres;
	}
}
