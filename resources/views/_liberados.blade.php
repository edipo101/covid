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
               <th style="width: 40%;">Detalle (Resumen)</th>
               <th>Secretaria</th>
               <th>Unidad</th>
               <th>Tipo</th>
               <th style="text-align: center;">Importe (Bs)</th>
               <th style="text-align: center;">Devengado (Bs)</th>
               <th style="text-align: center;">Por liberar (Bs)</th>
               <th>Operaciones</th>
              </tr>
              @foreach($reg as $row)
              <tr data-id="{{$row->id_preventivo}}">
               <td>{{$row->preventivo}}</td>
               <td>{{substr($row->glosa, 0, 100)."..."}}</td>
               <td title="{{$row->secretaria}}">{{$row->sigla}}</td>
               <td>{{$row->unidad}}</td>
               @php $label = (isset($row->label)) ? $row->label : 'default'; @endphp
               <td><span class="label label-{{$label}}">{{$row->tipo}}</span></td>               
               <td class="right">{{number_format($row->importe, 2)}}</td>
               <td class="right">{{number_format($row->pagado, 2)}}</td>
               <td class="right">{{number_format($row->liberado, 2)}}</td>
               <td>
                 <a href="#" class="btn btn-primary btn-xs btn-view" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i> Ver </a>
                 <a href="{{route('preventivos.edit', $row->id_preventivo)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                 {{-- <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Borrar </a> --}}
               </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <span class="text-center">
          {{$reg->appends(Request::all())->links()}}
          </span>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->