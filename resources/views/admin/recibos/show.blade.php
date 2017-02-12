@extends('layouts.app')

@section('content')
<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="{{ url('admin/recibos') }}">Recibos</a></li>
				<li class="active">Ver</li>
			</ol>
	</div><!--/.row-->
<div class="row">

</div>
<div class="row"><br>
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Recibo del mes de: <strong>{{ $recibo->mes }} {{ $recibo->anio }}</strong>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						@include('flash::message')
					</div>
				<table class="table table-bordered table-condensed">
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
					</tfoot>
				</table>
				<strong>Información: </strong><em class="text-muted">{{ $recibo->observaciones }}</em>
				<div class="col-md-12 text-center">
					<a href="{{ route('admin.recibos.edit', $recibo->id) }}" class="btn btn-default btn-sm" {{ $recibo->editar ? '' : 'disabled' }} class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Editar" data-original-title="Editar"><span class="glyphicon glyphicon-pencil g-2x"></span></a>
				</div>
			</div>
		</div>
		</div>

</div>
@endsection
