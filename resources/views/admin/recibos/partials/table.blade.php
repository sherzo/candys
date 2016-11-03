<div class="panel panel-default">
	<div class="panel-heading">Listado de Propietarios
	</div>
	<div class="panel-body">
		
		<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
			<thead>
				<th data-field="mas" data-sortable="true">Mes</th>
				<th data-field="subtotal" data-sortable="true">Subtotal</th>
				<th data-field="fondo" data-sortable="true">Fondo de reserva</th>
				<th data-field="total" data-sortable="true">Total</th>
				<th data-field="cuota" data-sortable="true">Cuota</th>
				<th data-field="acciones" data-sortable="true">acciones</th>
			</thead>
			<tbody>
			@foreach($recibos as $recibo)
				<tr>
					<td>{{ $recibo->mes }}</td>
					<td>{{ $recibo->subtotal }}</td>
					<td>{{ $recibo->fondo }}</td>
					<td>{{ $recibo->total }}</td>
					<td>{{ $recibo->cuota }}</td>
					<td>
						<a href="{{ route('admin.recibos.show', $recibo->id) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Imprimir" data-original-title="">
								<span class="glyphicon glyphicon-eye-open g-2x"></span>
						</a>
						
						<a href="{{ route('admin.prueba', $recibo->id) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Imprimir" data-original-title="">
								<span class="glyphicon glyphicon-print g-2x"></span>
						</a>

						<a href="{{ route('admin.pdf', $recibo->id) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="">
								<span class="glyphicon glyphicon-save  g-2x"></span>
						</a>

						
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
