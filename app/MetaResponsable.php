<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaResponsable extends Model
{
    protected $table = 'meta_responsable';
    //protected $primaryKey = 'meta_id, responsable_id';
    //public $incrementing = false; //desactivar el incremento para pk
    public $timestamps = false;
}
