<div class="panel panel-default">
	<div class="panel-heading">Listado de Propietarios
	</div>
	<div class="panel-body">
		
		<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
			<thead>
				<th data-field="nombre" data-sortable="true">Mes</th>
				<th data-field="telefono" data-sortable="true">Subtotal</th>
				<th data-field="apartamento" data-sortable="true">Total</th>
				<th data-field="acciones" data-sortable="true">acciones</th>
			</thead>
			<tbody>
			@foreach($recibos as $recibo)
				<tr>
					<td>{{ $recibo->created_at }}</td>
					<td>{{ $recibo->subtotal }}</td>
					<td>{{ $recibo->total }}</td>
					<td></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>