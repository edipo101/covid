        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label" for="nro_preven">Nro preventivo</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="nro_preven" name="nro_preven" placeholder="" value="{{old('nro_preven', $preven->preventivo)}}" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Importe (Bs)</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="importe" name="importe" value="{{old('importe', $preven->importe)}}" title="Monto reservado (preventivo)">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Devengado (Bs)</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="pagado" name="pagado" value="{{old('pagado', $preven->pagado)}}" title="Monto a cancelar">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Tipo</label>
            <div class="col-sm-9">
              @foreach($tipos as $key => $value)
              <div class="radio">
                <label>
                  <input type="radio" name="id_tipo" id="tipo" value="{{$key}}" {!!(($key == $preven->id_tipo) ? "checked=\"checked\"" : "")!!}>{{$value}}
                </label>
              </div>
              @endforeach
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Detalle (Glosa)</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="glosa" id="glosa" cols="30" rows="6">{{old('glosa', $preven->glosa)}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" for="fecha_elab">Fecha elaboracion</label>
            <div class="col-sm-3">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input id="fecha_elab" name="fecha_elab" type="text" class="datemask form-control" value="{{old('fecha_elab', date("d/m/Y", strtotime($preven->fecha_elab)))}}">
              </div>
            </div>

          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Fuente</label>
            <div class="col-sm-9">
                <div class="radio">
                  <label>
                    <input type="radio" name="fuente" id="fuente" value="20" {!!(($preven->fuente == 20) ? "checked=\"checked\"" : "")!!}>
                    20 (Rec. Propios)
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="fuente" id="fuente" value="41" {!!(($preven->fuente == 41) ? "checked=\"checked\"" : "")!!}>
                    41 (Trans. T.G.N.)
                  </label>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Organismo</label>
            <div class="col-sm-3">
              <select class="form-control" id="organismo" name="organismo">
                <option value='' disabled selected style='display:none;'>Seleccione una opcion</option>
                <option {!!(($preven->organismo == 210) ? "selected=\"selected\"" : "")!!}>210</option>
                <option {!!(($preven->organismo == 230) ? "selected=\"selected\"" : "")!!}>230</option>
                <option {!!(($preven->organismo == 111) ? "selected=\"selected\"" : "")!!}>111</option>
                <option {!!(($preven->organismo == 113) ? "selected=\"selected\"" : "")!!}>113</option>
                <option {!!(($preven->organismo == 119) ? "selected=\"selected\"" : "")!!}>119</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Partida</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="id_objeto" name="id_objeto" placeholder="" value="{{old('id_objeto', $preven->id_objeto)}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Secretaria</label>
            <div class="col-sm-8">
              <select class="form-control" id="id_secretaria" name="id_secretaria">
                <option value='' disabled selected style='display:none;'>Seleccione una opcion</option>
                @foreach($secretarias as $secretaria)
                <option value={{$secretaria->id_secretaria}} {!!(($secretaria->id_secretaria == $preven->id_secretaria) ? "selected=\"selected\"" : "")!!}>{{$secretaria->secretaria.' ('.$secretaria->sigla.')'}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Unidad</label>
            <div class="col-sm-7">
              <select class="form-control" id="id_unidad" name="id_unidad">
                @if (!is_null($unidades))
                <option value='' disabled selected style='display:none;'>Seleccione una opcion</option>
                @foreach($unidades as $unidad)
                <option value={{$unidad->id_unidad}} {!!(($unidad->id_unidad == $preven->id_unidad) ? "selected=\"selected\"" : "")!!}>{{$unidad->unidad}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Ubicacion</label>
            <div class="col-sm-3">
              <select class="form-control" id="ubicacion" name="ubicacion">
                @if ($preven->id_tipo == 1)
                  @foreach($ubicaciones_men as $key => $value)
                  <option value={{$key}} {!!(($key == $preven->id_ubimen) ? "selected=\"selected\"" : "")!!}>{{$key.'. '.$value}}</option>
                  @endforeach
                  @elseif ($preven->id_tipo == 2)
                    @foreach($ubicaciones_dir as $key => $value)
                    <option value={{$key}} {!!(($key == $preven->id_ubidir) ? "selected=\"selected\"" : "")!!}>{{$key.'. '.$value}}</option>
                    @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Estado</label>
            <div class="col-sm-3">
              <select class="form-control" id="id_estado" name="id_estado">
                <option value='' disabled selected style='display:none;'>Seleccione una opcion</option>
                @foreach($estados as $key => $value)
                <option value={{$key}} {!!(($key == $preven->id_estado) ? "selected=\"selected\"" : "")!!}>{{$value}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Observaciones</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="3">{{old('observaciones', $preven->observaciones)}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Desembolso</label>
            <div class="col-sm-9">
              {{-- @foreach($tipos as $key => $value) --}}
              <div class="radio">
                <label>
                  <input type="radio" name="desembolso" id="" value="24" {!!(($preven->desembolso == 24) ? "checked=\"checked\"" : "")!!}> 24 MILLONES
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="desembolso" id="" value="23" {!!(($preven->desembolso == 23) ? "checked=\"checked\"" : "")!!}> 23 MILLONES
                </label>
              </div>
              {{-- @endforeach               --}}
            </div>
          </div>
        </div>
