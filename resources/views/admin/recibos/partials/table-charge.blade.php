<table class="table table-bordered table-condensed table-hover">
  <thead>
    <tr class="text-center">
      <th>
        <input type="hidden" name="recibo_id" value="{{ $recibo->id }}">
        <input type="checkbox" id="all"> Seleccionar todos
      </th>
      <th>Propietario</th>
      <th>Apartamento</th>
      <th>Monto</th>
      <th>Estatus</th>
    </tr>
  </thead>
  <tbody>
    @foreach($propietarios as $propietario)
    <tr class="{{ $propietario->pivot->estatus ? '' : 'active' }}">
      <td>
        <input type="checkbox" name="propietarios[]" class="{{ $propietario->pivot->estatus ? 'check' : '' }}" value="{{ $propietario->id }}"
         {{ $propietario->pivot->estatus ? '' : 'disabled' }}>
      </td>
      <td>{{ $propietario->apartamentos[0]->numero }}</td>
      <td>{{ $propietario->nombre }} {{ $propietario->apellido }}</td>
      <td>
      {{ $propietario->pivot->mora ? $recibo->cuota + $recibo->cuota * 0.10 : $recibo->cuota }}

      </td>
      <td><label class="label label-{{ $propietario->pivot->estatus ? 'warning' : 'success'}}">
        {{ $propietario->pivot->estatus ? 'Debe' : 'Solvente' }}
      </label></td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="5">
        <button class="btn btn-primary btn-block">Confirmar Pago</button>
      </td>
    </tr>
  </tfoot>
</table>
