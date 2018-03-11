<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';
    public $timestamps = false;
    
    protected $fillable = [
      'cuenta', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
