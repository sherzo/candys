@extends('layouts.app')

@section('content')
	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Recibos</li>
			</ol>
	</div><!--/.row-->

	<div class="row"><br>
		<div class="col-lg-12">
			<a href="{{ url('admin/recibos/create')}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Nuevo recibo</a>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12"><br>
			 @include('flash::message')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			@include('admin.recibos.partials.table')
		</div>
	</div>
@endsection