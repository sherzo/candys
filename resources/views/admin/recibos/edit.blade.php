@extends('layouts.app')

@section('content')

		<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="{{ url('admin/recibos') }}">Recibos</a></li>
				<li class="active">Editar</li>
			</ol>
		</div><!--/.row-->

    <div class="row"><br>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Recibo del mes de: <strong>{{ $recibo->mes }}</strong> Año: <strong>{{ $recibo->anio }}</strong>
					</div>

					{!! Form::open(['route' => ['admin.recibos.update', $recibo->id], 'method' => 'PUT']) !!}
					<div class="panel-body">

						@include('admin.recibos.partials.table-edit-recibo')
						<br>
						<div class="col-md-12 alert alert-danger hide">
						</div>
						<div class="form-group">
							{!! Form::label('observaciones', 'Oberservaciones') !!}

							{!! Form::textarea('observaciones', $recibo->observaciones,['class' => 'form-control', 'rows' => '4']) !!}
						</div>

						<button class="btn btn-primary btn-sm">Guardar Recibo</button>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>

@endsection
