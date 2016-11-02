<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */ 

    protected $table = 'recibos';

    protected $fillable = ['mes', 'subtotal', 'fondo', 'total', 'cuota', 'observaciones'];


    public function gastos()
    {
        return $this->belongsToMany('App\Gasto');
    }

    public function gastos_extra()
    {
        return $this->belongsToMany('App\Gasto_extra', 'gasto_extra_recibo');
    }
}
