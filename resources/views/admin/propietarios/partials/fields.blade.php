<div class="form-group">
	{!! Form::label('nombre', 'Nombre') !!}
	
	{!! Form::text('nombre', null, ['class' => 'form-control', 'title' => 'Ingrese el nombre del propietario'])!!}
</div>

<div class="form-group">
	{!! Form::label('apellido', 'Apellido') !!}
	
	{!! Form::text('apellido', null, ['class' => 'form-control', 'title' => 'Ingrese el apellido del propietario'])!!}
</div>

<div class="form-group">
	{!! Form::label('telefono', 'Telefono') !!}

	<div class="form-inline">
		{!! Form::select('operadora', array('0412' => '0412', '0424' => '0424', '0416' => '0416', '0414' => '0414', '0426' => '0426'), null, ['class' => 'form-control']) !!}
		
		{!! Form::text('telefono', null, ['class' => 'form-control awesome', 'title' => 'Introduzca su número de teléfono', 'maxlength' => '7']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('apartamento', 'Numero de Apartamento')!!}
	
	{!! Form::select('apartamentos[]', $apartamentos, null, ['class' => 'form-control select-apartamentos', 'multiple']) !!}

</div>

<div class="form-group">
	<button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Guardar" data-original-title="Guardar">Guardar</button>

	<button type="reset" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Limpiar" data-original-title="Limpiar">Limpiar</button>
</div>