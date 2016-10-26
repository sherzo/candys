@extends('layouts.app')

@section('content')
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="{{ url('admin/propietarios') }}">Propietarios</a></li>
				<li class="active">Editar</li>
			</ol>
	</div><!--/.row-->

	<div class="row"><br>
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Propietario #{{ $propietario->id.' '.$propietario->nombre.' '.$propietario->apellido }}
				</div>
				<div class="panel-body">
				@include('flash::message')
				
				@if (count($errors) > 0)
				    <div class="alert alert-danger alert-important">
				    	Corriga los errores para poder guardar
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				
				{!! Form::model($propietario, ['route' => ['admin.propietarios.update', $propietario], 'method' => 'PUT', $propietario]) !!}
					
					@include('admin.propietarios.partials.fields-edit')
				
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection