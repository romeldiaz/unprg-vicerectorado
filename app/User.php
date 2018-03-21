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
        'nombres', 'paterno', 'materno', 'cuenta', 'password', 'jefe', 'oficina_id',
    ];

    //protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];


}
