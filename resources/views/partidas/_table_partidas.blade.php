      <div class="box">
        <div class="box-header">
          Cantidad de registros encontrados: &nbsp;{{$reg->count()}}
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr style="font-weight: bold; background-color: lightgray;">
               <th>Nro.</th>
               {{-- <th>Fuente/Org</th> --}}
               <th>Partida</th>
               <th>Descripcion</th>
               <th style="text-align: center; font-size: 85%">Aprobado <br>(A)</th>
               <th style="text-align: center; font-size: 85%">Preventivo <br>(P)</th>
               <th style="text-align: center; font-size: 85%">Devengado <br>(D)</th>
               <th style="text-align: center; font-size: 85%">Pagado <br>(G)</th>
               <th style="text-align: center; font-size: 85%">Saldo aprobado <br>(A-P)</th>
               <th style="text-align: center; font-size: 85%">Saldo preventivo <br>(P-D)</th>
               <th style="text-align: center; font-size: 85%">Saldo devengado <br>(A-D)</th>
             </tr>
           </thead>
           @php 
           $colspan = 11;
           $total_aprob = 0; $total_preven = 0; $total_pagado = 0; $total_cancelado = 0;
           $total_org_aprob = 0; $total_org_preven = 0; $total_org_pagado = 0; $total_org_cancelado = 0;
           $total_fuente_aprob = 0; $total_fuente_preven = 0; $total_fuente_pagado = 0; $total_fuente_cancelado = 0;
           $total_saldo_aprob = 0; $total_saldo_preven = 0; $total_saldo_deven = 0;
           $total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
           @endphp
           <tbody style="font-size: 85%">
            @foreach($reg as $row)
            @if ($loop->first)
            @php 
            $reg_fuente = $row->fuente;
            $reg_org = $row->organismo; 
            @endphp
            <tr>
              <td  colspan="{{$colspan}}" style="text-align: left;">
                <strong>{{"Fuente: ".$reg_fuente." ".getFuentes()[$reg_fuente]}}</strong>
              </td>
            </tr>
            <tr>
              <td  colspan="{{$colspan}}" style="text-align: left;">
                <strong>{{"Organismo: ".$reg_org." ".ucfirst(mb_strtolower(getOrganismos()[$reg_org]))}}
              </td>
            </tr>
            @endif
            @if ($row->organismo <> $reg_org)
              <tr style="font-weight: bold; background-color: lightgray;">
                <td colspan="3" style="text-align: left;">Total organismo: {{$reg_org}}</td>
                <td style="text-align: right;">{{number_format($total_org_aprob, 2)}}</td>
                <td style="text-align: right;">{{number_format($total_org_preven, 2)}}</td>
                <td style="text-align: right;">{{number_format($total_org_pagado, 2)}}</td>
                <td style="text-align: right;">{{number_format($total_org_cancelado, 2)}}</td>
                <td style="text-align: right;">{{number_format($total_org_saldo_aprob, 2)}}</td>
                <td style="text-align: right;">{{number_format($total_org_saldo_preven, 2)}}</td>
                <td style="text-align: right;">{{number_format($total_org_saldo_deven, 2)}}</td>
              </tr>
              @php 
              $reg_org = $row->organismo; 
              $total_org_aprob = 0; $total_org_preven = 0; $total_org_pagado = 0; $total_org_cancelado = 0;
              $total_org_saldo_aprob = 0; $total_org_saldo_preven = 0; $total_org_saldo_deven = 0;
              @endphp
              @if($row->fuente <> $reg_fuente)
                <tr style="font-weight: bold; background-color: lightgray;">
                  <td colspan="3" style="text-align: left;"><strong>Total fuente: {{$reg_fuente}}</strong></td>
                  <td style="text-align: right;">{{number_format($total_fuente_aprob, 2)}}</td>
                  <td style="text-align: right;">{{number_format($total_fuente_preven, 2)}}</td>
                  <td style="text-align: right;">{{number_format($total_fuente_pagado, 2)}}</td>
                  <td style="text-align: right;">{{number_format($total_fuente_cancelado, 2)}}</td>
                </tr>
                @php 
                  $reg_fuente = $row->fuente;
                  $total_fuente_aprob = 0; $total_fuente_preven = 0; $total_fuente_pagado = 0; $total_fuente_cancelado = 0;
                @endphp
                <tr>
                  <td  colspan="{{$colspan}}" style="text-align: left;">
                    <strong>{{"Fuente: ".$reg_fuente." ".getFuentes()[$reg_fuente]}}</strong>
                  </td>
                </tr>
              @endif
              <tr>
                <td  colspan="{{$colspan}}" style="text-align: left;">
                  <strong>{{"Organismo: ".$reg_org." ".ucfirst(mb_strtolower(getOrganismos()[$reg_org]))}}</strong>
                </td>
              </tr>
            @endif            
            
            <tr>
               <td>{{$loop->iteration}}</td>
               {{-- <td>{{$row->fuente}}-{{$row->organismo}}</td> --}}
               <td>{{$row->partida}}</td>
               <td>{{ucfirst(mb_strtolower($row->descripcion))}}</td>
               <td style="text-align: right;">{{number_format($row->monto_aprob, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->monto_preven, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->monto_pagado, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->monto_cancelado, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->saldo_aprob, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->saldo_preven, 2)}}</td>
               <td style="text-align: right;">{{number_format($row->saldo_deven, 2)}}</td>
               @php 
               $total_aprob += $row->monto_aprob;
               $total_preven += $row->monto_preven;
               $total_pagado += $row->monto_pagado;
               $total_cancelado += $row->monto_cancelado;
               $total_org_aprob += $row->monto_aprob;
               $total_org_preven += $row->monto_preven;
               $total_org_pagado += $row->monto_pagado;
               $total_org_cancelado += $row->monto_cancelado;
               $total_fuente_aprob += $row->monto_aprob;
               $total_fuente_preven += $row->monto_preven;
               $total_fuente_pagado += $row->monto_pagado;
               $total_fuente_cancelado += $row->monto_cancelado;
               $total_saldo_aprob += $row->saldo_aprob;
               $total_saldo_preven += $row->saldo_preven;
               $total_saldo_deven += $row->saldo_deven;
               $total_org_saldo_aprob += $row->saldo_aprob;
               $total_org_saldo_preven += $row->saldo_preven;
               $total_org_saldo_deven += $row->saldo_deven;
               @endphp
             </tr>
             {{-- @if (is_null(request('o')) && $loop->last)
             
            @endif --}}
            @endforeach
            <tr style="font-weight: bold; background-color: lightgray;">
              <td colspan="3" style="text-align: left;">Total organismo: {{$reg_org}}</td>
              <td style="text-align: right;">{{number_format($total_org_aprob, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_org_preven, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_org_pagado, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_org_cancelado, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_org_saldo_aprob, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_org_saldo_preven, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_org_saldo_deven, 2)}}</td>
            </tr>
            <tr style="font-weight: bold; background-color: lightgray;">
              <td colspan="3" style="text-align: left;"><strong>Total fuente: {{$reg_fuente}}</strong></td>
              <td style="text-align: right;">{{number_format($total_fuente_aprob, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_fuente_preven, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_fuente_pagado, 2)}}</td>
              <td style="text-align: right;">{{number_format($total_fuente_cancelado, 2)}}</td>
            </tr>
            <tr style="background-color: lightgray;">
              <th colspan="3">TOTAL GENERAL</th>
              <th style="text-align: right;">{{number_format($total_aprob, 2)}}</th>
              <th style="text-align: right;">{{number_format($total_preven, 2)}}</th>
              <th style="text-align: right;">{{number_format($total_pagado, 2)}}</th>
              <th style="text-align: right;">{{number_format($total_cancelado, 2)}}</th>
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