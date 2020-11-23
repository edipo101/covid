      <div class="box">
        <div class="box-header">
          Cantidad de registros encontrados: &nbsp;{{$reg->count()}}
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>Nro.</th>
               <th>Fuente</th>
               <th>Organismo</th>
               <th>Partida</th>
               <th>Descripcion</th>
               <th style="text-align: center;">Aprobado (Bs)</th>
               <th style="text-align: center;">Preventivo (Bs)</th>
               <th style="text-align: center;">Devengado (Bs)</th>
               <th style="text-align: center;">Saldo aprobado (Bs)</th>
               <th style="text-align: center;">Saldo preventivo (Bs)</th>
               <th style="text-align: center;">Saldo devengado (Bs)</th>
              </tr>
              @php 
                $total_aprob = 0; $total_preven = 0; $total_pagado = 0; 
                $total_org_aprob = 0; $total_org_preven = 0; $total_org_pagado = 0; $org = 210;
                $total_saldo_aprob = 0; $total_saldo_preven = 0; $total_saldo_deven = 0;
                $total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
              @endphp
              @foreach($reg as $row)
                @if ($loop->first)
                  @php $org = $row->organismo; @endphp
                @endif
                @if ($row->organismo <> $org)
                  <tr style="font-weight: bold; background-color: lightgray;">
                    <td colspan="5" style="text-align: left;">TOTAL ORGANISMO: {{$org}}</td>
                    <td style="text-align: right;">{{number_format($total_org_aprob, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_preven, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_pagado, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_aprob, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_preven, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_deven, 2)}}</td>
                  </tr>
                  @php 
                    $org = $row->organismo; 
                    $total_org_aprob = 0; $total_org_preven = 0; $total_org_pagado = 0;
                    $total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
                  @endphp
                @endif
              <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$row->fuente}}</td>
               <td>{{$row->organismo}}</td>
               <td>{{$row->partida}}</td>
               <td>{{$row->descripcion}}</td>
               <td style="text-align: right;">{{number_format($row->monto_aprob, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->monto_preven, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->monto_pagado, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->saldo_aprob, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->saldo_preven, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->saldo_deven, 2)}}</td>
               @php 
                $total_aprob += $row->monto_aprob;
                $total_preven += $row->monto_preven;
                $total_pagado += $row->monto_pagado;
                $total_org_aprob += $row->monto_aprob;
                $total_org_preven += $row->monto_preven;
                $total_org_pagado += $row->monto_pagado;
                $total_saldo_aprob += $row->saldo_aprob;
                $total_saldo_preven += $row->saldo_preven;
                $total_saldo_deven += $row->saldo_deven;
                $total_org_saldo_aprob += $row->saldo_aprob;
                $total_org_saldo_preven += $row->saldo_preven;
                $total_org_saldo_deven += $row->saldo_deven;
               @endphp
              </tr>
              @if (is_null(request('o')) && $loop->last)
                  <tr style="font-weight: bold; background-color: lightgray;">
                    <td colspan="5" style="text-align: left;">TOTAL ORGANISMO: {{$org}}</td>
                    <td style="text-align: right;">{{number_format($total_org_aprob, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_preven, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_pagado, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_aprob, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_preven, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_deven, 2)}}</td>
                  </tr>
              @endif
              @endforeach
              <tr style="background-color: lightgray;">
                <th colspan="5">TOTAL</th>
                <th style="text-align: right;">{{number_format($total_aprob, 2)}}</th>
                <th style="text-align: right;">{{number_format($total_preven, 2)}}</th>
                <th style="text-align: right;">{{number_format($total_pagado, 2)}}</th>
                <th style="text-align: right;">{{number_format($total_saldo_aprob, 2)}}</th>
                <th style="text-align: right;">{{number_format($total_saldo_preven, 2)}}</th>
                <th style="text-align: right;">{{number_format($total_saldo_deven, 2)}}</th>
              </tr>              
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->