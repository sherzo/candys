<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_fondo extends Model
{
  protected $table = 'movimientos_fondo';

  protected $fillable = ['signo', 'transaccion', 'monto', 'saldo_fondo'];
}
