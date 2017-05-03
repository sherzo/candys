<!-- INICIO MODAL -->
{!! Form::open(['route' => 'admin.consultas.new', 'method' => 'POST'])!!}
<div class="modal fade" id="ingresoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nuevo ingreso</h4>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="signo" value="+">
          <div class="form-group">
            <label for="descripcion" class="control-label">Descripción de la transacción:</label>
            <textarea  required class="form-control" name="transaccion" id="descripcion"></textarea>
          </div>

            <div class="form-group">
            <label for="message-text" class="control-label">Monto:</label>
            <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <input type="text" name="monto" class="form-control" required>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
<!--  FIN MODAL -->


<!-- INICIO MODAL -->
{!! Form::open(['route' => 'admin.consultas.new', 'method' => 'POST'])!!}
<div class="modal fade " id="egresoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nuevo Egreso</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="signo" value="-">
          <div class="form-group">
            <label for="descripcion" class="control-label">Descripción de la transacción:</label>
            <textarea  required class="form-control"name="transaccion" id="descripcion"></textarea>
          </div>

            <div class="form-group">
            <label for="message-text" class="control-label">Monto:</label>
            <div class="input-group">
            <span class="input-group-addon">Bs.</span>
            <input type="text" name="monto" class="form-control" required>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
<!--  FIN MODAL -->


<!-- MODAL FONDO DE RESERVA -->
{!! Form::open(['route' => 'admin.consultas.disponer', 'method' => 'POST'])!!}
<div class="modal fade" id="disponerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Disponer del fondo de reserva</h4>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="signo" value="-">
          <div class="form-group">
            <label for="descripcion" class="control-label">Saldo:</label>
            <input type="text" name="disponible" disabled id="saldoDisponible" value="{{ $fondo->real }} bs" class="form-control">
          </div>

          <div class="form-group">
            <label for="descripcion" class="control-label">Descripción de la transacción:</label>
            <textarea  required class="form-control"name="transaccion" id="descripcion"></textarea>
          </div>

          <div class="form-group">
            <label for="monto" class="control-label">Monto:</label>
            <div class="input-group">
              <span class="input-group-addon">Bs.</span>
              <input type="text" name="monto" class="form-control" required>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}


<!-- MODAL ACUMULADO DE PRESTACIONES -->
{!! Form::open(['route' => 'admin.consultas.prestaciones', 'method' => 'POST'])!!}
<div class="modal fade" id="prestacionModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cancelar prestaciones sociales</h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="signo" value="-">
          <div class="form-group">
            <label for="descripcion" class="control-label">Acumulado:</label>
            <input type="text" name="disponible" disabled id="saldoDisponible" value="{{ $prestaciones->acumulado }} bs" class="form-control">
          </div>
          <div class="form-group">
            <label for="monto" class="control-label">Monto a cancelar:</label>
            <div class="input-group">
              <span class="input-group-addon">Bs.</span>
              <input type="text" name="monto" id="monto" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="total" class="control-label" title="Con esta opción cancelara el total de prestaciones" data-toggle="tooltip"> Cancelar todo</label>
              <input type="checkbox" id="total" name="total" title="Con esta opción cancelara el total de prestaciones" data-toggle="tooltip">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary">Pagar</button>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}
