<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

  protected $table = 'movimientos';

  protected $fillable = ['signo', 'transaccion', 'monto', 'saldo'];

  

}
