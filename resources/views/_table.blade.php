      <div class="box">
        <div class="box-header">
          {{-- Mostrando <span>{{$reg->count()}} de {{$reg->total()}}</span> registros --}}
          Cantidad de registros: <strong>{{$reg->total()}}</strong> | 
          Total Preventivo: <strong>{{number_format($tot_prev, 2)}}</strong> |
          Total Devengado: <strong>{{number_format($tot_deven, 2)}}</strong> |
          Total Pagado: <strong>{{number_format($tot_pag, 2)}}</strong>
          <div class="box-tools">
            {{-- Filtro de busqueda --}}
            <div class="input-group input-group-sm hidden-xs">
              <form method="get" action="{{ route('preventivos.all') }}">
                <div class="input-group input-group-sm">
                  <input type="text" name="search" class="form-control" placeholder="Buscar preventivo" value="{{request('search')}}">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </form>
            </div>

          </div>
        </div>

        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
               <th>Nro Prev</th>
               <th style="width: 40%;">Detalle (Glosa)</th>
               <th>Fecha elab</th>
               <th style="text-align: center;">
                <span style="color: blue; font-weight: bold;">Prev</span>/
                <span style="color: red; font-weight: bold;">Dev</span>/
                <span style="color: green; font-weight: bold;">Pag</span>
               </th>
               <th>Fte/Org</th>
               <th>Partida</th>
               <th>Tipo</th>
               <th>Progreso</th>
               <th>Operaciones</th>
              </tr>
            </thead>
            <tbody style="font-size: 90%">
              @php $total = 0; @endphp
              @foreach($reg as $row)
              <tr data-id="{{$row->id_preventivo}}">
               <td>{{$row->preventivo}}</td>
               <td style="font-size: 80%;">
                {{$row->glosa}}
              </td>
               <td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
               <td style="text-align: right;">
                <span style="color: blue; font-weight: bold; display: block;">{{number_format($row->importe, 2)}}</span>
                <span style="color: red; font-weight: bold; display: block;">{{number_format($row->pagado, 2)}}</span>
                <span style="color: green; font-weight: bold; display: block;">{{number_format($row->cancelado, 2)}}</span>
               </td>
               @php $total += $row->importe; @endphp
               <td>{{$row->fuente}}-{{$row->organismo}}</td>
               <td>{{$row->id_objeto}}</td>
               @php $label = (isset($row->label)) ? $row->label : 'default'; @endphp
               <td><span class="label label-{{$label}}">{{$row->tipo}}</span></td>
               <td>
                <div class="progress progress-xs" style="margin-bottom: 5px;">
                  @php
                  $label = 'green';
                  if ($row->porcent <= 25) $label = 'red';
                  if ($row->porcent > 26 && $row->porcent <= 50) $label = 'yellow';
                  if ($row->porcent > 51 && $row->porcent <= 75) $label = 'aqua';
                  @endphp
                  <div class="progress-bar progress-bar-{{$label}}" style="width: {{$row->porcent}}%"></div>
                </div>
                @if (!is_null($row->porcent))
                  <span class="badge bg-{{$label}}">{{$row->porcent}}%</span>
                  @endif
              </td>
              
               <td>
                 <a href="#" class="btn btn-primary btn-xs btn-view" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                 <a href="{{route('preventivos.edit', $row->id_preventivo)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                 <a href="#" class="btn btn-danger btn-xs btn-delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></a>
               </td>
              </tr>              
              @endforeach
              @if (($reg->count() < 25 && $reg->count() > 1))
              <tfoot>
                <tr>
                  <th colspan="3" style="text-align: left;">TOTAL </th>
                  <th style="text-align: right;">{{number_format($total, 2)}}</th>
                </tr>
              </tfoot>
              @endif
            </tbody>
          </table>
          <span class="text-center">
          {{$reg->appends(Request::all())->links()}}
          </span>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->