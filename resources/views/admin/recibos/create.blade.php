@extends('layouts.app')

@section('content')

		<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="{{ url('admin/recibos') }}">Recibos</a></li>
				<li class="active">Nuevo</li>
			</ol>
		</div><!--/.row-->

	
		<div class="row"><br>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Recibo del mes de: <strong>{{ $month }}</strong>
					</div>

					{!! Form::open(['route' => 'admin.recibos.store', 'method' => 'POST']) !!}
					<div class="panel-body">
					{!! Form::hidden('mes', $month) !!}
					{!! Form::hidden('anio', $year) !!}

						@include('admin.recibos.partials.table-recibo')
						<br>
						<div class="col-md-12 alert alert-danger hide">
						</div>
						<div class="form-group">
							{!! Form::label('observaciones', 'Oberservaciones') !!}

							{!! Form::textarea('observaciones', null,['class' => 'form-control', 'rows' => '4']) !!}
						</div>

						<button class="btn btn-primary btn-sm">Crear Recibo</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/recibo.js') }}"></script>
<script src="{{ asset('assets/js/calculo-total.js') }}"></script>
@endsection