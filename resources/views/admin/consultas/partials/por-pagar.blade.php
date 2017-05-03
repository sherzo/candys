<div class="col-md-2">
  <h4 class="text-danger">Total por pagar: <strong>{{ $pagar }} bs</strong> </h4>
</div>
<div class="col-md-2">
  <h4 class="text-success">Saldo disponible: <strong>{{ $saldo->saldo }} bs</strong> </h4>
</div>
<div class="col-md-2">
  <a data-toggle="modal" data-target="#prestacionModal"><h4 class="text-info">Acumulado prestaciones: <strong>{{ $prestaciones->acumulado }} bs</strong> </h4></a>
</div>
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
  <thead>
      <th>Fecha</th>
      <th>Gasto</th>
      <th>Monto (bs)</th>
      <th>Acción</th>
  </thead>
  <tbody>
    @foreach($gastos as $gasto)
    <?php $extra = 0; ?>
      @foreach($gasto->recibos as $recibo)
        @if($recibo->pivot->estatus)
          <tr>
            <td>{{ $recibo->mes }} {{ $recibo->anio }}</td>
            <td>{{ $gasto->gasto}}</td>
            <td>{{ $recibo->pivot->importe }}</td>
            <td>
              <a data-toggle="modal" data-target="#abonarModal{{ $gasto->id }}-{{ $recibo->mes }}-{{ $gasto->anio }}">Abonar</a>
              |
              <a href="{{ route('admin.gastos.payment', [$gasto->id, $recibo->id, $extra]) }}">Pagar</a>

              <!-- MODAL ABONAR GASTO -->
              {!! Form::open(['route' => 'admin.gastos.pay', 'method' => 'POST'])!!}
              <div class="modal fade" id="abonarModal{{ $gasto->id }}-{{ $recibo->mes }}-{{ $gasto->anio }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Abonar al gasto:</h4>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <textarea class="form-control" disabled=""> {{ $gasto->gasto }}</textarea>
                        <input type="hidden" name="extra" value="0">
                        <input type="hidden" name="gasto_id" value="{{ $gasto->id }}">
                        <input type="hidden" name="recibo_id" value="{{ $recibo->id }}">
                        </div>

                        <div class="form-group">
                          <label for="descripcion" class="control-label">Monto del gasto:</label>
                          <input type="text" name="monto" disabled value="{{ $recibo->pivot->importe }} bs" class="form-control">
                        </div>

                        <div class="form-group">
                          <label for="monto" class="control-label">Monto para abonar:</label>
                          <div class="input-group">
                            <span class="input-group-addon">Bs.</span>
                            <input type="text" name="monto" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="total" class="control-label" title="Realizar el abono con el fondo de reserva" data-toggle="tooltip"> Abonar con el fondo de reserva</label>
                            <input type="checkbox" name="fondo" title="Realizar el abono con el fondo de reserva" data-toggle="tooltip">
                        </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancerlar</button>
                      <button class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}
            </td>
          </tr>

        @endif
      @endforeach

    @endforeach

    @foreach($gastos_extra as $gasto)
    <?php $extra = 1; ?>
      @foreach($gasto->recibos as $recibo)
        @if($recibo->pivot->estatus)
          <tr>
            <td>{{ $recibo->mes }} {{ $recibo->anio }}</td>
            <td>{{ $gasto->gasto_extra }}</td>
            <td>{{ $recibo->pivot->importe }}</td>
            <td>
              <a data-toggle="modal" data-target="#abonarModal{{ $gasto->id }}-{{ $recibo->mes }}-{{ $gasto->anio }}">Abonar</a>
              |
              <a href="{{ route('admin.gastos.payment', [$gasto->id, $recibo->id, $extra]) }}">Pagar</a>


              <!-- MODAL ABONAR GASTO -->
              {!! Form::open(['route' => 'admin.gastos.pay', 'method' => 'POST'])!!}
              <div class="modal fade" id="abonarModal{{ $gasto->id }}-{{ $recibo->mes }}-{{ $gasto->anio }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Abonar al gasto:</h4>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <textarea class="form-control" disabled=""> {{ $gasto->gasto_extra }}</textarea>
                        <input type="hidden" name="extra" value="1">
                        <input type="hidden" name="gasto_id" value="{{ $gasto->id }}">
                        <input type="hidden" name="recibo_id" value="{{ $recibo->id }}">
                        </div>

                        <div class="form-group">
                          <label for="descripcion" class="control-label">Monto del gasto:</label>
                          <input type="text" name="monto" disabled value="{{ $recibo->pivot->importe }} bs" class="form-control">
                        </div>

                        <div class="form-group">
                          <label for="monto" class="control-label">Monto para abonar:</label>
                          <div class="input-group">
                            <span class="input-group-addon">Bs.</span>
                            <input type="text" name="monto" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="total" class="control-label" title="REalizar el abono con el fondo de reserva" data-toggle="tooltip"> Abonar con el fondo de reserva</label>
                            <input type="checkbox" name="fondo" title="Realizar el abono con el fondo de reserva" data-toggle="tooltip">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancerlar</button>
                      <button class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}
            </td>
          </tr>

        @endif
      @endforeach

    @endforeach

  </tbody>
</table>
