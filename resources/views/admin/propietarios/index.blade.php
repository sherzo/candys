@extends('layouts.app')

@section('content')
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Propietarios</li>
			</ol>
	</div><!--/.row-->
	<div class="row"><br>
		<div class="col-lg-12">
			<a href="{{ url('admin/propietarios/create')}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
		</div>
	</div>
	<div class="row">
	@if (session()->has('flash_notification.message'))
	<br>
	@endif
		<div class="col-lg-12">
			 @include('flash::message')
		</div>
	</div>
	<div class="row">
	@if (!session()->has('flash_notification.message'))
	<br>
	@endif
		<div class="col-lg-12">
			@include('admin.propietarios.partials.table')
		</div>
	</div>
@endsection

@section('js')
<script>
</script>
@endsection