@extends('layouts.app')

@section('content')

	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Gastos</li>
			</ol>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12"><br>
			 @include('flash::message')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			@if(isset($gastoedit))

				{!! Form::model($gastoedit,['route' => ['admin.gastos.update', $gastoedit], 'method' => 'PUT', 'class' => 'form-inline']) !!}

					@include('admin.gastos.partials.fields')

				{!!Form::close() !!}

			@else

				{!! Form::open(['route' => 'admin.gastos.store', 'method' => 'POST', 'class' => 'form-inline']) !!}

					@include('admin.gastos.partials.fields')

				{!!Form::close() !!}

			@endif
		</div>
	</div>

	<div class="row">
	<br>
		<div class="col-lg-12">
			@include('admin.gastos.partials.table')
		</div>
	</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/actualizar-gasto.js') }}"></script>
@endsection
