<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Movimiento del {{ mes($mes) }} del {{ $anio}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <style>
      body{
        font-size: 16px;
      }
      table {
        font-size: 12px;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
          <div class="row">
      			<div class="col-md-12">
      				<h5>&nbsp;&nbsp;&nbsp;&nbsp;Junta de Condominio &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
          <div class="row">

            <br>
            <h4> Reporte de ingresos y egresos  del mes de {{ mes($mes ) }} del {{ $anio }}</h4>
            <br>
            <table class="table table-bordered text-center">
        			<thead>
        				<tr>
        					<td>Ingresos: <strong><br>{{ $ingresos }} bs</strong></td>
        					<td>Ingresos fondo de reserva: <strong><br>{{ $ingresos_fondo }} bs</strong></td>
        					<td>Egresos: <strong><br>{{ $egresos }} bs</strong</td>
        					<td>Egresos fondo de reserva: <strong><br>{{ $egresos_fondo }} bs</strong></td>
        				</tr>
        				<tr>
        					<td colspan="2">
        						<h4 class="text-success">Ingreso neto: <strong>{{ $ingresos + $ingresos_fondo }} bs</strong> </h4>
        					</td>
        					<td colspan="2">
        						<h4 class="text-danger">Egreso neto: <strong>{{ $egresos + $egresos_fondo }} bs</strong> </h4>
        					</td>
        				</tr>
        			</thead>
        		</table>

            <h4 class="text-center">Ingresos del mes</h4>
            <br>
            <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <td>Tansacción</td>
                    <td>Signo</td>
                    <td>Monto</td>
                    <td>Saldo</td>
                  </tr>
              </thead>

              <tbody>
                @foreach($movimientos as $movimiento)
                  @if($movimiento->signo == '+')
                    <tr>
                      <td>{{ $movimiento->transaccion }}</td>
                      <td>{{ $movimiento->signo}}</td>
                      <td>{{ $movimiento->monto}}</td>
                      <td>{{ $movimiento->saldo }}</td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>

            <h4 class="text-center">Egresos del mes</h4>
            <br>
            <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <td>Tansacción</td>
                    <td>Signo</td>
                    <td>Monto</td>
                    <td>Saldo</td>
                  </tr>
              </thead>
              <tbody>
                @foreach($movimientos as $movimiento)
                  @if($movimiento->signo == '-')
                    <tr>
                      <td>{{ $movimiento->transaccion }}</td>
                      <td>{{ $movimiento->signo}}</td>
                      <td>{{ $movimiento->monto}}</td>
                      <td>{{ $movimiento->saldo }}</td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
