<div class="col-md-3">
  <h4 class="text-primary">Total por cobrar: <strong>{{ $cobrar }} bs</strong> </h4>
</div>
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
  <thead>
      <th>Propietario</th>
      <th>Apartamento</th>
      <th>Cobrar</th>
      <th>Monto total</th>
  </thead>
  <tbody>
    @foreach($propietarios as $propietario)
    <?php $monto = 0; ?>
    <tr>
      <td>{{ $propietario->nombre }} {{ $propietario->apellido }}</td>
      <td>{{ $propietario->apartamentos[0]->numero }}</td>
      <td>
        @foreach($propietario->recibos as $recibo)
          @if($recibo->pivot->estatus)
          <?php $monto = $recibo->pivot->mora ? $monto + ($recibo->cuota + $recibo->cuota *  0.10) : $monto + $recibo->cuota;  ?>
          <a href="#" data-toggle="modal"
           data-target=".bs-example-modal-sm{{ $propietario->id }}-{{$recibo->id}}">{{ $recibo->mes }}-{{ $recibo->anio }} </a> |

           <div class="modal fade bs-example-modal-sm{{ $propietario->id }}-{{ $recibo->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
             <div class="modal-dialog modal-sm" role="document">
                 <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <center><h4 class="modal-title">¿Cobrar el recibo {{ $recibo->mes }}-{{ $recibo->anio }} del Propietario(a) {{ $propietario->nombre }} APTO: {{$propietario->apartamentos[0]->numero}}?</h4></center>
                   </div>
                   <div class="modal-body">

                     <a href="{{ route('admin.propietarios.payment', [$propietario->id, $recibo->id]) }}" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a>

                     <a href="" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></a>
                   </div>
                 </div>
               </div>
           </div>
          @endif
        @endforeach
      </td>
      <td>{{ $monto }}</td>
    @endforeach
  </tbody>
</table>
