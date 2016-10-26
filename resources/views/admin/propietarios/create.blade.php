@extends('layouts.app')

@section('content')
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="{{ url('admin/propietarios') }}">Propietarios</a></li>
				<li class="active">Nuevo</li>
			</ol>
	</div><!--/.row-->

	<div class="row"><br>
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Nuevo Propietario
				</div>
				<div class="panel-body">
				
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

				{!! Form::open(['route' => 'admin.propietarios.store', 'method' => 'POST']) !!}
					
					@include('admin.propietarios.partials.fields')

				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script>
	$('.select-apartamentos').chosen({
      placeholder_text_multiple: 'Selecione el apartamento',
      no_results_text: 'No se encontraron apartamento: '
    });
</script>
@endsection