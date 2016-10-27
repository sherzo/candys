<div class="form-group">	
	{!! Form::text('gasto', null, ['class' => 'form-control', 'title' => 'Nombre del gasto', 'size' => '53', 'placeholder' => 'Nuevo gasto...', 'required'])!!}
</div>
<button type="submit" class="btn btn-primary">Guardar @if(isset($gastoedit)) cambios @endif</button>