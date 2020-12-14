      <div class="box">
        <div class="box-header">
          Cantidad de registros encontrados: &nbsp;{{$reg->count()}}
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <tbody>
              <tr>
               <th>Nro.</th>
               <th>Sigla</th>
               <th>Secretaria</th>
               <th>Partida</th>
               <th>Descripcion</th>
               <th style="text-align: center; font-size: 85%">Cantidad</th>
               <th style="text-align: center; font-size: 85%">Preventivo <br>(P)</th>
               <th style="text-align: center; font-size: 85%">Devengado <br>(D)</th>
               <th style="text-align: center; font-size: 85%">Saldo aprobado <br>(A-P)</th>
               <th style="text-align: center; font-size: 85%">Saldo preventivo <br>(P-D)</th>
               <th style="text-align: center; font-size: 85%">Saldo devengado <br>(A-D)</th>
              </tr>
              @php 
                $total_aprob = 0; $total_preven = 0; $total_pagado = 0; 
                $total_org_aprob = 0; $total_org_preven = 0; $total_org_pagado = 0; $id_secre = null;
                $total_saldo_aprob = 0; $total_saldo_preven = 0; $total_saldo_deven = 0;
                $total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
              @endphp
              @foreach($reg as $row)
                @if ($loop->first)
                  @php $id_secre = $row->id_secretaria; $secre = $row->secretaria; @endphp
                  <tr style="font-weight: bold; background-color: lightgray;">
                    <td colspan="11" style="text-align: left;">{{is_null($row->secretaria) ? '(SIN DESIGNACIÓN)': $row->secretaria}}</td>
                  </tr>
                @endif
                @if ($row->id_secretaria <> $id_secre)
                  
                  <tr style="font-weight: bold;">
                    <td colspan="5" style="text-align: left;">TOTAL {{$secre}}</td>
                    <td style="text-align: right;">{{number_format($total_org_aprob, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_preven, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_pagado, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_aprob, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_preven, 2)}}</td>
                    <td style="text-align: right;">{{number_format($total_org_saldo_deven, 2)}}</td>
                  </tr>
                  <tr style="font-weight: bold; background-color: lightgray;"><td colspan="11" style="text-align: left;">{{$row->secretaria}}</td></tr>
                  @php 
                    $id_secre = $row->id_secretaria; 
                    $secre = $row->secretaria; 
                    $total_org_aprob = 0; $total_org_preven = 0; $total_org_pagado = 0;
                    $total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
                  @endphp
                @endif
              <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$row->sigla}}</td>
               <td>{{$row->secretaria}}</td>
               <td>{{$row->partida}}</td>
               <td>{{$row->descripcion}}</td>
               <td style="text-align: right;">{{$row->cant}}</td>
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
                    <td colspan="5" style="text-align: left;">TOTAL ORGANISMO: {{$id_secre}}</td>
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