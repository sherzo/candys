<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recibos {{ $recibo->mes}}-{{ $recibo->anio }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
	<style>
	body {
		font-size: 9px;
	}
	</style>
</head>
<body>
	<div class="container-fluid">
	@foreach($propietarios as $propietario)
	<?php $meses = 0; ?>
		<div class="row">
			<div class="col-md-12">
				<h5>&nbsp;&nbsp;&nbsp;&nbsp;Junta de Condominio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;<span style="font-size:10px;"></span></h5>
				<h5>
					<strong>"Residencias Candy's II"</strong>
					<br><span style="font-size: 10px; ">&nbsp;&nbsp;&nbsp;&nbsp;Calle Rivas Turmero Estado Aragua
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Banco de Venezuela - <strong>0102-0115-29-0000271541</strong> - cta. corriente</span>

			</h5>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Rif: J-29534444-9
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span style="font-size:10px;">Correo: <strong> condominiocandys2@gmail.com</strong></span>
				<br>

			</div>

		</div>

		<div class="row">
			<div class="col-lg-12"><br>
				<strong>Propietario(a):
					<span class="text-uppercase">{{ $propietario->nombre }} {{ $propietario->apellido }}</span>
				</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Apartamento:
					<span class="text-uppercase">
					@foreach($propietario->apartamentos as $apartamento)
						{{ $apartamento->numero }}
					@endforeach
					</span>
				</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Mes:
					<span class="text-uppercase">{{ $recibo->mes }}</span>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Año: {{ $recibo->anio }}
				</strong>
			</div>
		</div>

		<div class="row">
			<div class="col-md-9"><br>
				<table class="table table-bordered">
					<thead>
						<tr class="success">
							<th>Descripcion del Pago</th>
							<th>Importe (bs)</th>
							<th>Cuota (bs)</th>
						</tr>
					</thead>
					<tbody>
						<colgroup>
   						<col>
   						<col span="2" style="background-color:#f5f5f5">
  					</colgroup>
						@foreach($gastos as $gasto)
						<tr>
							<td>{{ $gasto->gasto }}</td>
							<td>{{ $gasto->pivot->importe }}</td>
							<td>{{ round($gasto->pivot->importe / 44, 2) }}</td>
						</tr>
						@endforeach

						@foreach($gastos_extra as $gasto_extra)
						<tr>
							<td>{{ $gasto_extra->gasto_extra }}</td>
							<td>{{ $gasto_extra->pivot->importe }}</td>
							<td>{{ round($gasto_extra->pivot->importe / 44, 2) }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th class="text-right">SUBTOTAL</th>
							<th class="info">{{ $recibo->subtotal }}</th>
							<th class="info">{{ round($recibo->subtotal / 44, 2) }}</th>
						</tr>
						<tr>
							<th class="text-right">FONDO DE RESERVA
								@if($recibo->operacion != '')
									{{ ($recibo->operacion == '+') ? 'RECAUDO:' : 'DESCUENTO:' }}
								@endif
								{{ ($recibo->porcentaje == '') ? '' : $recibo->porcentaje.'%' }} </th>
							<th class="info">{{ $recibo->fondo }}</th>
							<th class="info">{{ round($recibo->fondo / 44, 2) }}</th>
						</tr>

						@if($propietario->pivot->mora)
						<tr>
							<th class="danger text-right">INTERES DE MORA 10%</td>
								<th></th>
							<th>{{ round($recibo->cuota * 0.10, 2) }}</th>
							</th>
						</tr>
						@endif

						<tr class="success total" style="font-size: 12px;">
							<th class="text-right">TOTAL</th>
							<th class="success total">{{ $recibo->total  }} </th>
							<th class="success total">
							{{ $propietario->pivot->mora ? $recibo->cuota + $recibo->cuota * 0.10 : $recibo->cuota }}
							</th>
						</tr>
					</tfoot>
				</table>
				<strong>Información: </strong><em class="text-muted">{{ $recibo->observaciones }}</em>
			</div>
		</div>
		<br><table style='page-break-after:always;'></br></table><br>
	@endforeach
	</div>

</body>
</html>
