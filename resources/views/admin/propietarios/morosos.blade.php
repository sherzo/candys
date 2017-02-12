@extends('layouts.app')

@section('content')
<div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
      <li><a href="{{ url('admin/propietarios') }}">Propietarios</a></li>
      <li class="active">Morosos</li>
    </ol>
</div><!--/.row-->

<div class="row">
  <div class="col-lg-12"><br>
     @include('flash::message')
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
    	<div class="panel-heading">Listado de Propietarios morosos
    	</div>
    	<div class="panel-body">
        @include('admin.propietarios.partials.table-morosos')
      </div>
    </div>
  </div>
</div>

@endsection
