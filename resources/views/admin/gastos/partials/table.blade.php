<div class="panel panel-default">
	<div class="panel-heading">Listado de gastos del condomio 
	</div>
	<div class="panel-body">
		<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
			<thead>
					<th data-field="gasto" data-sortable="true">Nombre del gasto</th>
					<th data-field="acciones" data-sortable="true">Acción</th>
			</thead>
			<tbody>
				@foreach($gastos as $gasto)
					<tr>
						<td>{{ $gasto->gasto }}</td>
						<td>
							<a href="{{ route('admin.gastos.edit', $gasto->id) }}" class="btn btn-default btn-xs"  data-toggle="tooltip" data-placement="top" title="Editar" data-original-title="Editar">
								<span class="glyphicon glyphicon-pencil g-2x"></span>
							</a>						
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>