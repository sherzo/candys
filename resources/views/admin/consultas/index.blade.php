@extends('layouts.app')

@section('content')

	<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Consultas</li>
			</ol>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12"><br>
			<a href="{{ route('admin.consultas.mensual') }}" class="btn btn-primary">
				<span class="glyphicon glyphicon-calendar"></span>
				Movimiento mensual
			</a>

			<button class="btn btn-success" data-toggle="modal" data-target="#ingresoModal">
				<span class="glyphicon glyphicon-plus"></span>
				Nuevo Ingreso
			</button>


				<button class="btn btn-warning" data-toggle="modal" data-target="#egresoModal">
					<span class="glyphicon glyphicon-minus"></span>
				Nuevo Egreso
			</button>

		@include('admin.consultas.partials.modal')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12"><br>
			 @include('flash::message')
		</div>
	</div>

  <div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body tabs">
        <ul class="nav nav-tabs nav-justified">
					<li class="active"><a href="#movimiento" data-toggle="tab"><span class="glyphicon glyphicon-sort"></span> Movimiento</a></li>
          <li><a href="#por-pagar" data-toggle="tab"><span class="glyphicon glyphicon-usd"></span> Por pagar</a></li>
          <li><a href="#por-cobrar" data-toggle="tab"><span class="glyphicon glyphicon-exclamation-sign"></span> Por cobrar</a></li>
					<li><a href="#movimiento-fondo" data-toggle="tab"> Fondo</a></li>
        </ul>

        <div class="tab-content">
					<div class="tab-pane fade in active" id="movimiento">
						@include('admin.consultas.partials.movimiento')
					</div>

          <div class="tab-pane fade" id="por-pagar">
            @include('admin.consultas.partials.por-pagar')
          </div>

          <div class="tab-pane fade" id="por-cobrar">
            @include('admin.consultas.partials.por-cobrar')
          </div>

					<div class="tab-pane fade" id="movimiento-fondo">
            @include('admin.consultas.partials.movimiento_fondo')
          </div>

        </div>
      </div>
    </div><!--/.panel-->
  </div><!--/.col-->
</div><!-- row -->



@endsection

@section('js')
<script>
	$(document).ready(function(){
		$('#total').change(function(){
			if(this.is(':chequed'))
			{
				alert('chequeado');
			}else{
				alert('NO chequeado');
			}
		});
	});
</script>
@endsection
