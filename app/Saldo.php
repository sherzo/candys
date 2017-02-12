<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */

  protected $table = 'saldo';

  protected $fillable = ['saldo'];
}
