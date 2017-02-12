@extends('layouts.app')

@section('content')
<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('admin') }}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="{{ url('admin/recibos') }}">Recibos</a></li>
				<li class="active">Descargar</li>
			</ol>
		</div><!--/.row-->

	
		<div class="row"><br>
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-default">
					<div class="panel-heading">Recibo del mes de: <strong>{{ $recibo->mes }}</strong>
					</div>
					<div class="panel-body">
					<table class="table table-condensed table-bordered">
						<thead>
							<tr>
								<th class="text-center">Piso</th>
								<th class="text-center">Descargar</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td align="center">PB</td>
								<td align="center">
									<a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 1, 'ultimo' => 4]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a>
								</td>
							</tr>
							<tr>
								<td align="center">1</td>
								<td align="center">
									<a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 5, 'ultimo' => 8]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
										<span class="glyphicon glyphicon-save  g-2x"></span>
									</a>
								</td>
							</tr>
							<tr>
								<td align="center">2</td>
								<td align="center">
									<a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 9, 'ultimo' => 12]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
										<span class="glyphicon glyphicon-save  g-2x"></span>
									</a>
								</td>
							</tr>
							<tr>
								<td align="center">3</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 13, 'ultimo' => 16]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a></td>
							</tr>
							<tr>
								<td align="center">4</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 17, 'ultimo' => 20]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a></td>
							</tr>
							<tr>
								<td align="center">5</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 21, 'ultimo' => 24]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a></td>
							</tr>
							<tr>
								<td align="center">6</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 25, 'ultimo' => 28]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a></td>
							</tr>
							<tr>
								<td align="center">7</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 29, 'ultimo' => 32]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a></td>
							</tr>
							<tr>
								<td align="center">8</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 33, 'ultimo' => 36]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a></td>
							</tr>
							<tr>
								<td align="center">9</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 37, 'ultimo' => 40]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
							</tr>
							<tr>
								<td align="center">10</td>
								<td align="center"><a href="{{ route('admin.recibos-piso', ['id' => $recibo->id, 'primer' => 41, 'ultimo' => 44]) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
@endsection