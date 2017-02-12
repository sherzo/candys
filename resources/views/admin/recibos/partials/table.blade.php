<div class="panel panel-default">
	<div class="panel-heading">Listado de Recibos
	</div>
	<div class="panel-body">

		<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
			<thead>
				<th data-field="mas" data-sortable="true">Mes</th>
				<th>Año</th>
				<th data-field="subtotal" data-sortable="true">Subtotal (bs)</th>
				<th data-field="fondo" data-sortable="true">Fondo de reserva (bs)</th>
				<th data-field="total" data-sortable="true">Total (bs)</th>
				<th data-field="cuota" data-sortable="true">Cuota (bs)</th>
				<th data-field="acciones" data-sortable="true">acciones</th>
			</thead>
			<tbody>
			@foreach($recibos as $recibo)
				<tr>
					<td>{{ $recibo->mes }}</td>
					<td>{{ $recibo->anio }}</td>
					<td>{{ $recibo->subtotal }}</td>
					<td>{{ $recibo->fondo }}</td>
					<td>{{ $recibo->total }}</td>
					<td>{{ $recibo->cuota }}</td>
					<td>
						<a href="{{ route('admin.recibos.edit', $recibo)}}" {{ $recibo->editar ? '' : 'disabled' }} class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Editar" data-original-title="Editar">
							<span class="glyphicon glyphicon-pencil g-2x"></span>
						</a>

						<a href="{{ route('admin.recibos.show', $recibo->id) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Ver" data-original-title="">
								<span class="glyphicon glyphicon-eye-open g-2x"></span>
						</a>

						<a href="{{ route('admin.prueba', $recibo->id) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Imprimir" data-original-title="">
								<span class="glyphicon glyphicon-print g-2x"></span>
						</a>

						<!-- <a href="{{ route('admin.descargar-recibo', $recibo->id) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF por PISO" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a> -->

						<a href="{{ route('admin.recibos.cobrar', $recibo->id) }}" class=""  data-toggle="tooltip" data-placement="top" title="Registrar pago" data-original-title="">
								Cobrar
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
