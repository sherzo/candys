<div class="form-group">
	{!! Form::label('nombre', 'Nombre') !!}
	
	{!! Form::text('nombre', null, ['class' => 'form-control', 'title' => 'Puede editar el nombre del propietario'])!!}
</div>

<div class="form-group">
	{!! Form::label('apellido', 'Apellido') !!}
	
	{!! Form::text('apellido', null, ['class' => 'form-control', 'title' => 'Puede editar el apellido del propietario'])!!}
</div>

<div class="form-group">
	{!! Form::label('telefono', 'Telefono') !!}

	<div class="form-inline">
		{!! Form::select('operadora', array('0412' => '0412', '0424' => '0424', '0416' => '0416', '0414' => '0414', '0426' => '0426'), null, ['class' => 'form-control', 'title' => 'Operadora']) !!}
		
		{!! Form::text('telefono', null, ['class' => 'form-control awesome', 'size' => '53', 'title' => 'Puede editar el número de teléfono', 'maxlength' => '7']) !!}
	</div>
</div>

<div class="form-group">
	<button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Guardar" data-original-title="Guardar">Guardar</button>

</div>