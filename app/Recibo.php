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

    protected $fillable = ['subtotal', 'total'];
}
