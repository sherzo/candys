<table class="table table-bordered table-hover table-condensed">
	<thead>
		<th class="text-center">Descripción del gasto</th>
		<th class="text-center">Importe</th>
		<th class="text-center">Cuota</th>
		<th class="text-center">Quitar</th>
	</thead>
	<tbody id="gastos">
		@foreach($gastos as $gasto)
			<tr>
				<td>{{ $gasto->gasto }}
					
					<input type="hidden" name="gastos_id[]" value="{{ $gasto->id }}">
				</td>
				<td>
					<div class="input-group">
						{!! Form::text('importe[]', null, ['class' => 'form-control input-sm importe', 'data' => $gasto->id, 'required', 'size' => '8'])!!}

						<span class="input-group-addon">bs</span>
					</div>
				</td>
				<td >
					<div class="input-group">
						{!! Form::text('cuota[]', 0, ['class' => 'form-control input-sm cuota cuota'.$gasto->id, 'disabled', 'size' => '8'])!!}

						<span class="input-group-addon">bs</span>
					</div>
				</td>
				<td align="center">
					<a class="btn btn-danger btn-xs" disabled=""><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			
		@endforeach
	</tbody>
	<tr>
		<td colspan="3"></td>
		<td align="center">
			<a class="btn btn-success btn-xs" id="agregar_gasto">
				<span class="glyphicon glyphicon-plus"></span>
			</a>
		</td>
	</tr>
	<tfoot>
		@include('admin.recibos.partials.tfooter-recibo')
	</tfoot>
</table>