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

    protected $fillable = ['mes', 'anio','subtotal', 'fondo', 'porcentaje', 'operacion', 'total', 'subcuota', 'cuota_fondo', 'cuota', 'observaciones'];


    public function gastos()
    {
        return $this->belongsToMany('App\Gasto')->withPivot('importe', 'estatus');
    }

    public function gastos_extra()
    {
        return $this->belongsToMany('App\Gasto_extra', 'gasto_extra_recibo')->withPivot('importe', 'estatus');
    }

    public function propietarios()
    {
        return $this->belongsToMany('App\Propietario', 'propietario_recibo')->withPivot('estatus', 'mora');
    }
}
