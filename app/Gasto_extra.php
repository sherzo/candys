<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto_extra extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $table = 'gastos_extra';

    protected $fillable = ['gasto_extra'];

    public function recibos()
    {
        return $this->belongsToMany('App\Recibo')->withPivot('importe', 'estatus');
    }
}
