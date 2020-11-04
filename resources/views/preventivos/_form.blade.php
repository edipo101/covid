        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-3 control-label" for="nro_preven">Nro preventivo</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="nro_preven" name="nro_preven" placeholder="" value="{{old('nro_preven', $preven->preventivo)}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Importe (Bs)</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="importe" name="importe" value="{{old('importe', $preven->importe)}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Tipo</label>
            <div class="col-sm-9">
              @foreach($tipos as $key => $value)
              <div class="radio">
                <label>
                  <input type="radio" name="tipo" id="tipo" value="{{$key}}" {!!(($key == $preven->id_tipo) ? "checked=\"checked\"" : "")!!}>{{$value}}
                </label>
              </div>
              @endforeach              
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Detalle</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="detalle" id="detalle" cols="30" rows="6">{{old('glosa', $preven->glosa)}}</textarea>
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
                <option value=""></option>
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
              <input type="text" class="form-control" id="partida" name="partida" placeholder="" value="{{old('id_objeto', $preven->id_objeto)}}">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Ubicacion</label>
            <div class="col-sm-3">
              <select class="form-control" id="ubicacion" name="ubicacion">
                <option></option>
                @foreach($ubicaciones as $ubicacion)
                  <option {!!(($ubicacion == $preven->ubicacion) ? "selected=\"selected\"" : "")!!}>{{old('ubicacion', $ubicacion)}}</option>
                @endforeach
              </select>
            </div>
            {{-- <div class="col-sm-9">
              @foreach($ubicaciones as $ubicacion)
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                  {{old('ubicacion', $ubicacion)}}
                </label>
              </div>
              @endforeach
            </div> --}}
          </div>
          <div class="form-group">
            <label for="" class="col-sm-3 control-label">Estado</label>
            <div class="col-sm-3">
              <select class="form-control" id="estado" name="estado">
                <option></option>
                @foreach($estados as $estado)
                  <option {!!(($estado == $preven->estado) ? "selected=\"selected\"" : "")!!}>{{old('estado', $estado)}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
