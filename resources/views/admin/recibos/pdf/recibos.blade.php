
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recibos del mes de Nomviembre</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
</head>
<body>

	<div class="contaider-fluid">
	@for($i = 0; $i <= 10; $i++)
		<div class="row">
			<div class="col-md-12">
				<h5>&nbsp;&nbsp;&nbsp;Junta de Condominio</h5>
				<h5><strong>"Residencias Candys II"</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small> </small></h5>
				
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<strong>Propietario: <span class="text-uppercase">{{ $propietario->nombre }} {{ $propietario->apellido }}</span></strong>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Apartamento: <span class="text-uppercase">
				@foreach($apartamentos as $apartamento)
				{{ $apartamento->numero }}
				@endforeach
				</span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Mes: <span class="text-uppercase">{{ $recibo->mes }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Año: {{ $recibo->anio }}</strong>
				
			</div>
		</div>
			
	
		<div class="row">
			<div class="col-sm-6"><br>
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
					</tbody>
					<tfoot>
						<tr>
							<th class="text-center">SUBTOTAL</th>
							<th class="info">{{ $recibo->subtotal }}</th>
							<th class="info">{{ round($recibo->subtotal / 44, 2) }}</th>
						</tr>
						<tr>
							<th class="text-center">FONDO DE RESERVA 
								@if($recibo->operacion != '')
								{{ ($recibo->operacion == '+') ? 'RECAUDO:' : 'DESCUENTO:' }} 
								@endif
								{{ ($recibo->porcentaje == '') ? '' : $recibo->porcentaje.'%' }} </th>
							<th class="info">{{ $recibo->fondo }}</th>
							<th class="info">{{ round($recibo->fondo / 44, 2) }}</th>
						</tr>
						<tr class="success total" >
							<th class="text-center">TOTAL</th>
							<th class="success total">{{ $recibo->total }} </th>
							<th class="success total">{{ $recibo->cuota }}</th>
						</tr>
						<tr class="success total" >
							<th class="text-center">TOTAL</th>
							<th class="success total">{{ $recibo->total }} </th>
							<th class="success total">{{ $recibo->cuota }}</th>
						</tr>
					</tfoot>
				</table>
				<strong>Información: </strong><em class="text-muted">{{ $recibo->observaciones }}</em>
			</div>
		</div>
@endfor
	</div>

</body>
</html>
