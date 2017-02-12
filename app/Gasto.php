<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $table = 'gastos';

    protected $fillable = ['gasto'];

    public function recibos()
    {
        return $this->belongsToMany('App\Recibo')->withPivot('importe', 'estatus');
    }
}
