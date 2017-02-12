<?php

use Carbon\Carbon;
use App\Prestacion;


function fechaDia($created_at)
{
  $fecha = new Carbon($created_at);
  $dias = array(1 => 'Lunes',2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes', 6=> 'Sabado', 7 => 'Domingo');

  foreach ($dias as $key => $value) {
    if($key == $fecha->dayOfWeek){
      $dia = $value;
    }
  }

  return $dia.' '.$fecha->format('d-m-Y');
}

function fecha($date)
{
  $dias = array(1 => 'Lunes',2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes', 6=> 'Sabado', 0 => 'Domingo');

  $meses = array('1' => 'ENE', '2' => 'FEB', '3' => 'MAR', '4' => 'ABR',
  '5' => 'MAY', '6' => 'JUN', '7' => 'JUL', '8' => 'AGO',
   '9' => 'SEP', '10' => 'OCT', '11' => 'NOV', '12' => 'DIC');

  $fecha = new Carbon($date);

  foreach ($dias as $key => $value) {
    if($key == $fecha->dayOfWeek){
      $dia = $value;
    }
  }

  foreach ($meses as $key => $value) {
    if($key == $fecha->format('m')){
      $mes = $value;
    }
  }
  return $dia.' '.$fecha->format('d').'-'.$mes.'-'.$fecha->format('Y');
}

function mes($fecha)
{
  $meses = array('01' => 'Enero', '02' => 'Febrero',
                 '03' => 'Marzo', '04' => 'Abril',
                 '05' => 'Mayo', '06' => 'Junio',
                 '07' => 'Julio', '08' => 'Agosto',
                 '09' => 'Septiembre', '10' => 'Octubre',
                 '11' => 'Noviembre', '12' => 'Diciembre');

  foreach ($meses as $key => $mes)
  {
    if ($fecha == $key)
    {
      return $mes;
    }
  }

}

function AcumuladoPrestaciones($monto)
{
  $prestaciones = Prestacion::first();
  $prestaciones->acumulado = $prestaciones->acumulado + $monto;
  $prestaciones->save();
}
