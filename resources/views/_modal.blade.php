  {{-- Modal window --}}
  <div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog" style="width: 750px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Detalle Preventivo</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody>
              <tr>
                <th style="width:25%">Item:</th>
                <td id="id_preventivo"></td>
              </tr>
              <tr>
                <th>Preventivo:</th>
                <td id="preventivo"></td>
              </tr>
              <tr>
                <th>Importe (Bs):</th>
                <td id="importe"></td>
              </tr>
              <tr>
                <th>Secretaria:</th>
                <td id="secretaria"></td>
              </tr>
              <tr>
                <th>Unidad:</th>
                <td id="unidad"></td>
              </tr>
              <tr>
                <th>Detalle (Glosa):</th>
                <td id="detalle"></td>
              </tr>
              <tr>
                <th>Fecha elaboracion:</th>
                <td id="fecha_elab"></td>
              </tr>

              <tr>
                <th>Fuente:</th>
                <td id="fuente"></td>
              </tr>
              <tr>
                <th>Organismo:</th>
                <td id="organismo"></td>
              </tr>
              <tr>
                <th>Partida:</th>
                <td id="id_objeto"></td>
              </tr>
              <tr>
                <th>Tipo preventivo:</th>
                <td id="tipo">
                  {{-- <span class="label label-success">Approved</span> --}}
                </td>
              </tr>
              <tr>
                <th>Ubicación:</th>
                <td id="ubicacion"></td>
              </tr>
              <tr>
                <th>Progreso</th>
                <td id="progreso" style="display: none;">
                  <div class="progress progress-xs" style="display: inline-block; width: 85%">
                    <div id="porcent_barra" class="progress-bar" style="width: 55%"></div>
                  </div>
                  <span id="porcent_data" class="badge bg-red" style="margin-left: 10px;">55%</span>
                </td>
              </tr>
              <tr>
                <th>Estado:</th>
                <td id="estado"></td>
              </tr>
              <tr>
                <th>Observaciones:</th>
                <td id="obs"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button> --}}
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>