@extends('layouts.app')

@section('content')

	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
        <li>
          <a href="{{ url('admin/recibos') }}">
            Recibos
          </a>
        </li>
				<li class="active">Cobrar</li>
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
			<div class="panel-heading">Recibo de {{$recibo->mes }} {{ $recibo->anio}}</div>
				<div class="panel-body">
					{!! Form::open(['route' => 'admin.recibos.payment', 'method' => 'POST']) !!}

						@include('admin.recibos.partials.table-charge')

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
	$('#all').on('change', function(){
		$('.check').prop('checked', $(this).prop("checked"));
	});
</script>
@endsection
