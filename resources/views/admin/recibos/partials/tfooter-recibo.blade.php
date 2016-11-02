<tr>
	<th align="left"> 
		Subtotal
	</th>
	<th>
		<div class="input-group">
			<input type="text" name="" id="importe_s" disabled="" class="form-control input-sm" value="0" size="8">

			<span class="input-group-addon">bs</span>
		</div>
		</th>
	<th>
		<div class="input-group">
			<input type="text" name="" id="cuota_s" disabled="" class="form-control input-sm" value="0" size="8">
		
			<span class="input-group-addon">bs</span>
		</div>
		</th>
	<th></th>
</tr>

<tr>
	<th>
		<div class="form-inline">
			Fondo de reserva
			actual: 
			<div class="input-group">

			<input type="text" value="{{ $fondo->real }}" class="form-control input-sm" size="2" disabled id="fondo_real">
			
			<span class="input-group-addon">bs</span>
			</div>
			
			---

			<select class="form-control input-sm form-inline" id="opcion" name="operacion">
				<option value="">seleccione</option>
				<optgroup label="Por (%)">
				<option value="1">Recaudo</option>
				<option value="2">Descuento</option>
				</optgroup>
				<optgroup label="Por (bs)">
				<option value="3">Recaudo</option>
				<option value="4">Descuento</option>
				</optgroup>
			</select>

			<div class="input-group">
				<input type="number" class="form-control input-sm" size="3" maxlength="3" disabled="" id="valor" min="1" max="100" name="valor">

				<span class="input-group-addon" id="operacion">%</span>
			</div>
		</div>
	</th>
		
	<th>	
		<div class="input-group">
			<input type="text" name="" id="importe_fondo" disabled="" class="form-control input-sm" value="0" size="8">

			<span class="input-group-addon">bs</span>
		</div>
	</th>
	<th>	
		<div class="input-group">
			<input type="text" name="" id="cuota_fondo" disabled="" class="form-control input-sm" value="0" size="8">

			<span class="input-group-addon">bs</span>
		</div>
	</th>
	
	<th></th>
</tr>

<tr >
	<th>Total</th>
	<th class="bg-info">
		<div class="input-group">
			<input type="text" name="" id="importe_t" disabled="" class="form-control input-sm" value="0" size="8">

			<span class="input-group-addon">bs</span>
		</div>
	</th>
	<th class="bg-info">
		<div class="input-group">
			<input type="text" name="" id="cuota_t" disabled="" class="form-control input-sm" value="0" size="8">

			<span class="input-group-addon">bs</span>
		</div>
	</th>
	<th></th>
</tr>