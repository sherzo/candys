<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $table = 'propietarios';

    protected $fillable = ['nombre', 'apellido', 'operadora', 'telefono'];


    public function apartamentos()
    {
        return $this->belongsToMany('App\Apartamento', 'propietario_apartamento');
    }

    public function recibos()
    {
        return $this->belongsToMany('App\Recibo', 'propietario_recibo')->withPivot('estatus', 'mora');
    }




}
