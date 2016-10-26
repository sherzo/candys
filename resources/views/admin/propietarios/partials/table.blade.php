<div class="panel panel-default">
	<div class="panel-heading">Listado de Propietarios
	</div>
	<div class="panel-body">
		
		<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
			<thead>
				<th data-field="nombre" data-sortable="true">Nombre</th>
				<th data-field="telefono" data-sortable="true">Telf.</th>
				<th data-field="apartamento" data-sortable="true">Apto.</th>
				<th data-field="acciones" data-sortable="true">acciones</th>
			</thead>
			<tbody>
				@foreach($propietarios as $propietario)
					<tr>
						<td>{{ $propietario->nombre }} {{ $propietario->apellido }}</td>
						<td>{{ $propietario->operadora }}-{{ $propietario->telefono}}</td>
						<td>
							@foreach($propietario->apartamentos as $apartamento)
								{{ $apartamento->numero }},
							@endforeach
						</td>
						<td>
							<a href="{{ route('admin.propietarios.edit', $propietario)}}" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Editar" data-original-title="Editar">
								<span class="glyphicon glyphicon-pencil g-2x"></span>
							</a>

							<button class="btn btn-default btn-xs" title="Eiminar" data-toggle="modal" data-target=".bs-example-modal-sm{{ $propietario->id }}">
								<span class="glyphicon glyphicon-trash g-2x"></span>
							</button>

							<div class="modal fade bs-example-modal-sm{{ $propietario->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
							  <div class="modal-dialog modal-sm" role="document">
								    <div class="modal-content">
								    <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <center><h4 class="modal-title">¿Desea eliminar al propietario {{ $propietario->nombre }}?</h4></center>
								      </div>
								      <div class="modal-body">
								      		
								        <a href="{{ route('admin.propietarios.destroy', $propietario) }}" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a>

								        <a href="" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></a>
								      </div>
								    </div>
		  						</div>
							</div>
						</td>

					</tr>
					
				@endforeach
			</tbody>
		</table>
	</div>
</div>

