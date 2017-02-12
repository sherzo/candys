<div class="col-md-3">
  <h4 class="text-success">Saldo disponible: <strong>{{ $saldo->saldo }} bs</strong></h4>
</div>
<div class="col-md-3">
  <h4 class="text-warning"><a data-toggle="modal" data-target="#disponerModal" class="text-warning">Fondo de reserva: <strong>{{ $fondo->real }} bs</strong> </a></h4>
</div>
<!--  Modal -->

<!-- Fin Modal -->
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
  <thead>
      <th>Fecha</th>
      <th>Descripción</th>
      <th>Signo + / -</th>
      <th>Monto (bs)</th>
      <th>Saldo (bs)</th>
  </thead>
  <tbody>
    @foreach($movimientos as $movimiento)
      <tr>
        <td>{{ fecha($movimiento->created_at) }}</td>
        <td>{{ $movimiento->transaccion }}</td>
        <td class="{{ $movimiento->signo == '+' ? 'success' : 'warning'}} text-center"><strong>{{ $movimiento->signo }}</strong></td>
        <td class="{{ $movimiento->signo == '+' ? 'success' : 'warning'}}">{{ $movimiento->monto }}</td>
        <td class="{{ $movimiento->signo == '+' ? 'success' : 'warning'}}">{{ $movimiento->saldo }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
