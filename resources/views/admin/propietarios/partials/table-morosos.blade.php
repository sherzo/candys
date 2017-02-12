<table class="table table-striped table-hover">
  <thead>
      <th>Propietario</th>
      <th>Apartamento</th>
      <th class="text-center">Recibos</th>
      <th>Monto total (bs)</th>
  </thead>
  <tbody>
    <?php $contador = 0; ?>
    @foreach($propietarios as $propietario)
    <?php $mora = 0; ?>
      @foreach($propietario->recibos as $recibo)
        @if($recibo->pivot->estatus)
        <?php  $mora++ ?>
        @endif
      @endforeach

    <?php $monto = 0; ?>
    @if($mora > 2)
    <tr>
      <td>{{ $propietario->nombre }} {{ $propietario->apellido }}</td>
      <td>{{ $propietario->apartamentos[0]->numero }}</td>
      <td>
        @foreach($propietario->recibos as $recibo)
          @if($recibo->pivot->estatus)
          <?php  $contador++; ?>
          <?php $monto = $recibo->pivot->mora ? $monto + ($recibo->cuota + $recibo->cuota *  0.10) : $monto + $recibo->cuota;  ?>
          <a href="{{ route('admin.recibos.cobrar', $recibo->id) }}">{{ $recibo->mes }}-{{ $recibo->anio }} </a> |
          @endif
        @endforeach
      </td>
      <td class="text-center">{{ $monto }}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
<div class="col-md-12 text-center"><br><br>
  <a class="btn btn-default btn-lg" {{ $contador == 0 ? 'disabled' : ' '}} href="{{ route('admin.pdf-morosos')}}" data-toggle="tooltip" data-placement="top" title="Descargar PDF" data-original-title="Imprimir">
    <span class="glyphicon glyphicon-print "></span>
  </a>
</div>
