<div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
  <label for="name" class="col-sm-2 control-label">Nombre</label>
  <div class="col-sm-5">
    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{old('name', $user->name)}}">
    {!! $errors->first('name', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
  <label for="email" class="col-sm-2 control-label">Login</label>
  <div class="col-sm-5">
    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="{{old('email', $user->email)}}">
    {!! $errors->first('email', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
  <label for="password" class="col-sm-2 control-label">Contraseña</label>
  <div class="col-sm-5">
    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
    {!! $errors->first('password', '<span class="help-block">:message</span>')!!}
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-5">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{old('url_previous', url()->previous())}}" class="btn btn-default">Cancelar</a>
  </div>
</div>