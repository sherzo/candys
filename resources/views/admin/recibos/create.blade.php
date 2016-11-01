@extends('layouts.app')

@section('content')

		<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="{{ url('admin/recibos') }}">Recibos</a></li>
				<li class="active">Nuevo</li>
			</ol>
		</div><!--/.row-->
	<form action="intro.php">
	
		<div class="row"><br>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Recibo del mes de: <strong>{{ $month }}</strong>
					</div>
					<div class="panel-body">
					
						@include('admin.recibos.partials.table-recibo')
						<br>
						<div class="form-group">
							{!! Form::label('observaciones', 'Oberservaciones') !!}

							{!! Form::textarea('observaciones', null,['class' => 'form-control', 'rows' => '4']) !!}
						</div>

						<button class="btn btn-primary btn-sm">Crear Recibo</button>
					</div>
				</div>
			</div>
		</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/recibo.js') }}"></script>
<script src="{{ asset('assets/js/calculo-total.js') }}"></script>
@endsection