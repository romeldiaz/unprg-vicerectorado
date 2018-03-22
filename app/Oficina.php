<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficina extends Model
{
    use SoftDeletes; //habilita borrado suave (borrado por software)
    protected $dates = ['deleted_at'];

    protected $table = 'oficinas';
    public $timestamps = false;

    //protected $fillable = ['nombre'];
	protected $guarded = ['id'];
	
	
	// Added
	public function users()
	{
		return $this->hasMany(User::class);
	}
}
