@extends('layout')

@section('title', 'Preventivo | Perfil usuario')

@section('content-header')
<h1>Perfil de usuario</h1>
<ol class="breadcrumb">
	<li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
	@if (auth()->user()->id_role == 1)
	<li><a href="{{route('usuarios.index')}}">Usuarios</a></li>
	@endif
	<li class="active">Perfil usuario</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		@php $display = (isset($errors)) ? 'block' : 'none';
		@endphp
		<div class="modal fade in" id="modal-default" style="display: none; padding-right: 17px;">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="{{route('usuarios.update_password', $user->id)}}" class="form-horizontal" style="margin-top: 15px;">
						<input name="_method" type="hidden" value="PATCH">
						{{ csrf_field() }}
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Cambiar contraseña</h4>
						</div>
						<div class="modal-body">
							<div class="form-group {{$errors->has('password_old') ? 'has-error' : ''}}">
								<label for="password" class="col-sm-4 control-label">Contraseña actual</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="password_old" name="password_old" placeholder="Contraseña actual">
									{!! $errors->first('password_old', '<span class="help-block">:message</span>')!!}
								</div>
							</div>
							<div class="form-group {{$errors->has('password_new') ? 'has-error' : ''}}">
								<label for="password" class="col-sm-4 control-label">Contraseña nueva</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="password_new" name="password_new" placeholder="Contraseña nueva">
									{!! $errors->first('password_new', '<span class="help-block">:message</span>')!!}
								</div>
							</div>
							<div class="form-group {{$errors->has('password_repeat') ? 'has-error' : ''}}">
								<label for="password" class="col-sm-4 control-label">Repetir contraseña</label>
								<div class="col-sm-5">
									<input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="Repetir contraseña">
									{!! $errors->first('password_repeat', '<span class="help-block">:message</span>')!!}
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade in" id="modal-default2" style="display: none; padding-right: 17px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="{{route('usuarios.update_avatar', $user->id)}}">
					<input name="_method" type="hidden" value="PATCH">
					{{ csrf_field() }}
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Cambiar imagen</h4>
					</div>
					<div class="modal-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Mujeres</a></li>
								<li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Hombres</a></li>
							</ul>
							<div class="tab-content" style="padding: 0px;">
								<div class="tab-pane active" id="tab_1">
									<div class="modal-body" style="float: left;">
										@for ($i = 1; $i <= 7; $i++)
										<div class="col-xs-3" style="padding-bottom: 15px;">
											<div class="radio" style="text-align: center; display: block; padding-right: 0px; width: auto;">
												<label style="padding-left: 0px;">
													<img src="{{asset('dist/img/avatar'.$i.'.jpg')}}" alt="User Image" style="max-width: 100%;height: auto;">
													<input type="radio" name="image" value="{{$i}}"> Avatar {{$i}}
												</label>
											</div>
										</div>
										@endfor
									</div>
								</div>
								<div class="tab-pane" id="tab_2">
									<div class="modal-body" style="float: left;">
										@for ($i = 8; $i <= 14; $i++)
										<div class="col-xs-3" style="padding-bottom: 15px;">
											<div class="radio" style="text-align: center; display: block; padding-right: 0px; width: auto;">
												<label style="padding-left: 0px;">
													<img src="{{asset('dist/img/avatar'.$i.'.jpg')}}" alt="User Image" style="max-width: 100%;height: auto;">
													<input type="radio" name="image" value="{{$i}}"> Avatar {{$i}}
												</label>
											</div>
										</div>
										@endfor
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
						<button id="btn-save" type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="box box-primary">
		<div class="box-body" style="padding-top: 15px;">
			<div class="item">
				<label class="col-sm-2">Nombre</label>{{$user->name}}
			</div>
			<div class="item">
				<label class="col-sm-2">Usuario</label>{{$user->email}}
			</div>
			<div class="item">
				<label class="col-sm-2">Rol</label>{{$user->role}}
			</div>
			<div class="item">
				<label class="col-sm-2">Creado el</label>{{$user->created_at}}
			</div>
			<div class="item">
				<label class="col-sm-2">Fecha modificación</label>{{$user->updated_at}}
			</div>
			<div class="item">
				<label class="col-sm-2">Imagen avatar</label>
				<img src="{{asset('dist/img/avatar'.$user->avatar.'.jpg')}}" alt="User Image" style="max-width: 120px;height: auto;">
			</div>
			<div class="item">
				<label for="" class="col-sm-2"></label>
				<button id="chg-avatar" class="btn btn-default" data-toggle="modal" data-target="#modal-default2">Cambiar imagen</button>
			</div>
			{{-- <div class="item">
				<label for="" class="col-sm-2"></label>
				<button class="btn btn-default" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Cambiar contraseña</button>
			</div> --}}

		</div>
	</div>
</div>
@endsection