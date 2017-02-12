@extends('layouts.app')

@section('content')

	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
        <li><a href="{{ url('admin/consultas') }}">Consultas</a></li>
				<li class="active">Mensual</li>
			</ol>
	</div><!--/.row-->

  <div class="row">
    <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Ingresos y Egresos
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6 col-lg-6">
							{!! Form::open(['route' => 'admin.consultas.mensual', 'method' => 'GET', 'class' => 'form-inline'])!!}
							<div class="form-group">
								{!! Form::text('fecha', null, ['class' => 'form-control date-picker', 'id'=> 'startDate', 'title' => 'Seleccione la fecha', 'placeholder' => 'Fecha', 'required'])!!}
							</div>
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" ></span></button>
							{!! Form::close() !!}
						</div>
						@if(isset($mes))
						<div class="col-md-6 col-lg-6 text-right">
							  <a href="{{ route('admin.pdf-movimiento', [$mes, $anio]) }}" class="btn btn-default btn-lg" data-toggle="tooltip" data-placement="top" title="Imprimir" data-original-title="Imprimir">
							    <span class="glyphicon glyphicon-print "></span>
							  </a>
						</div>
						@endif
					</div>
<br>
@if(isset($mes))
<div class="row">
	<div class="col-md-12">
		<h4>Movimientos del mes de <strong>{{ mes($mes) }}</strong> del <strong>{{ $anio }}</strong></h4><br>
	</div>
</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">
		<table class="table table-bordered text-center">
			<thead>
				<tr>
					<td>Ingresos: <strong>{{ $ingresos }} bs</strong></td>
					<td>Ingresos fondo de reserva: <strong>{{ $ingresos_fondo }} bs</strong></td>
					<td>Egresos: <strong>{{ $egresos }} bs</strong</td>
					<td>Egresos fondo de reserva: <strong>{{ $egresos_fondo }} bs</strong></td>
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
		</table><br>
	</div>
	</div>
	@endif
		<!-- <div class="col-md-3">
		  <h5 class="text-info">Ingresos: <strong>{{ $ingresos }} bs</strong> </h5>
		</div>

		<div class="col-md-3">
		  <h5
			 class="text-warning">Ingresos fondo de reserva: <strong>{{ $ingresos_fondo }} bs</strong> </h5>
		</div>

		<div class="col-md-3">
		  <h5 class="text-danger">Egresos: <strong>{{ $egresos }} bs</strong> </h5>
		</div>

		<div class="col-md-3">
		  <h5
			 class="text-danger">Egresos fondo de reserva: <strong>{{ $egresos_fondo }} bs</strong> </h5>
		</div> -->

<!-- </div>
<div class="row">
		<div class="col-md-6 text-center">
			<h4 class="text-success">Ingreso neto: <strong>{{ $ingresos + $ingresos_fondo }} bs</strong> </h4>
		</div>

		<div class="col-md-6 text-center">
			<h4 class="text-danger">Egresos neto: <strong>{{ $egresos + $egresos_fondo }} bs</strong> </h4>
		</div>
</div> -->
<div class="row">
	<div class="col-md-12 col-lg-12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="5" class="text-center" align="center">Ingresos y Egresos del saldo</th>
					</tr>
					<tr>
						<th>Fecha</th>
						<th data-field="gasto" data-sortable="true">Transación</th>
						<th data-field="acciones" data-sortable="true">Signo</th>
						<th data-field="acciones" data-sortable="true">Monto</th>
						<th data-field="acciones" data-sortable="true">Saldo</th>
					</tr>
				</thead>
				<tbody>
					@if($movimientos == '[]')
					<tr>
						<td colspan="5" class="text-center"> No se encontraron movimientos en la fecha seleccionada</td>
					</tr>
					@endif
					@if($movimientos)
					@foreach($movimientos as $movimiento)
						<tr>
							<td>{{ fecha($movimiento->created_at) }}</td>
							<td>{{$movimiento->transaccion}}</td>
							<td class="text-center {{ $movimiento->signo == '+' ? 'success' : 'warning'}}"><strong>{{ $movimiento->signo }}</atrong></td>
							<td>{{ $movimiento->monto }}</td>
							<td>{{ $movimiento->saldo }}</td>
						</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>

	</div>

	</div>
	</div>
</div>
</div>

@endsection

@section('js')
<script>
$(function() {
    $('.date-picker').datepicker( {
				monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dic" ],
				closeText: "Listo",
				currentText: "Actual",
				changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm',
        onClose: function(dateText, inst) {
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
});
</script>
@endsection
