<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listado de morosos</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <style>
      body{
        font-size: 16px;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
    		<div class="row">
          <div class="row">
      			<div class="col-md-12">
      				<h5>&nbsp;&nbsp;&nbsp;&nbsp;Junta de Condominio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      					&nbsp;&nbsp;<span style="font-size:10px;"></span></h5>
      				<h5>
      					<strong>"Residencias Candy's II"</strong>
      					<br><span style="font-size: 10px; ">&nbsp;&nbsp;&nbsp;&nbsp;Calle Rivas Turmero Estado Aragua

<br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <span style="font-size: 10px;">Rif: J-29534444-9</span>
      			</h5>

      			</div>
    			</div>
    		</div><br>
        <span style="font-size: 22px;">Listado de propietarios Morosos</span>
        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="text-right"><strong>{{ fecha($date) }}</strong></span><br><br>
      <table class="table table-bordered">
        <thead >
          <tr >
            <th class="text-center">Apartamento</th>
            <th class="text-center">Cant. Recibos</th>
            <th class="text-center">Monto</th>
          </th>
        </thead>
        <tbody>
          @foreach($propietarios as $propietario)
          <?php $mora = 0; ?>
          <?php $contador = 0;?>
            @foreach($propietario->recibos as $recibo)
              @if($recibo->pivot->estatus)
              <?php  $mora++ ?>
              @endif
            @endforeach

          <?php $monto = 0; ?>
          @if($mora > 2)
          <tr class="text-center">
            <td>{{ $propietario->apartamentos[0]->numero }}</td>
            <td style="font-size: 14px;">
              @foreach($propietario->recibos as $recibo)
                @if($recibo->pivot->estatus)
                <?php $contador++;?>
                <?php $monto = $recibo->pivot->mora ? $monto + ($recibo->cuota + $recibo->cuota *  0.10) : $monto + $recibo->cuota;  ?>
                @endif
              @endforeach
              {{ $contador }}
            </td>
            <td >{{ $monto }} bs</td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
    </div><br>
    <span style="font-size: 14px;"><strong>Informacion:</strong> A partir del tercer recibo atrasado se agrega <strong>10% de interes de mora</strong> a la cuota del mismo.</span>
  </body>
</html>
