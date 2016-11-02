<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */ 

    protected $table = 'fondo';

    protected $fillable = ['reserva', 'real'];
}
