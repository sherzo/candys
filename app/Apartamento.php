<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */ 

    protected $table = 'apartamentos';

    protected $fillable = ['numero'];

    public function propietarios()
    {
        return $this->belongsToMany('App\Propietario', 'propietario_apartamento');
    }
}
