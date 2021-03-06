      <div class="box">
        <div class="box-header">
          Mostrando <span>{{$reg->count()}} de {{$reg->total()}}</span> registros
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
            <tbody>
              <tr>
               <th>Nro Prev</th>
               <th style="width: 40%;">Detalle (Glosa)</th>
               <th>Fecha elab</th>
               <th style="text-align: center;">Importe<br>(Bs)</th>
               <th style="text-align: center;">Devengado<br>(Bs)</th>
               <th>Fte/Org</th>
               <th>Partida</th>
               <th>Tipo</th>
               <th>Operaciones</th>
              </tr>
              @php $total = 0; @endphp
              @foreach($reg as $row)
              <tr data-id="{{$row->id_preventivo}}">
               <td>{{$row->preventivo}}</td>
               <td style="font-size: 70%;">{{$row->glosa}}</td>
               <td>{{date('d/m/Y', strtotime($row->fecha_elab))}}</td>
               <td style="text-align: right;">{{number_format($row->importe, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->pagado, 2)}}</td>
               @php $total += $row->importe; @endphp
               <td>{{$row->fuente}}-{{$row->organismo}}</td>
               <td>{{$row->id_objeto}}</td>
               @php $label = (isset($row->label)) ? $row->label : 'default'; @endphp
               <td><span class="label label-{{$label}}">{{$row->tipo}}</span></td>
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