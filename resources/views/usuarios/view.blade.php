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
		<div class="modal fade in" id="modal-default" style="display: none; padding-right: 17px;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Cambiar contraseña</h4>
						</div>
						<div class="modal-body">
							<form method="post" action="{{route('usuarios.store')}}" class="form-horizontal" style="margin-top: 15px;">
								<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
									<label for="password" class="col-sm-4 control-label">Contraseña actual</label>
									<div class="col-sm-5">
										<input type="password" class="form-control" id="password_old" name="password_old" placeholder="Contraseña">
										{!! $errors->first('password', '<span class="help-block">:message</span>')!!}
									</div>
								</div>
								<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
									<label for="password" class="col-sm-4 control-label">Contraseña nueva</label>
									<div class="col-sm-5">
										<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
										{!! $errors->first('password', '<span class="help-block">:message</span>')!!}
									</div>
								</div>
								<div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
									<label for="password" class="col-sm-4 control-label">Repetir contraseña</label>
									<div class="col-sm-5">
										<input type="password" class="form-control" id="password2" name="password2" placeholder="Contraseña">
										{!! $errors->first('password', '<span class="help-block">:message</span>')!!}
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</div>
			</div>			
		</div>
		<div class="modal fade in" id="modal-default2" style="display: none; padding-right: 17px;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Cambiar imagen</h4>
						</div>
						<form method="post" action="{{route('usuarios.update_avatar', $user->id)}}">
							<input name="_method" type="hidden" value="PATCH">
							{{ csrf_field() }}
							<div class="modal-body" style="float: left;">
								@for ($i = 1; $i <= 5; $i++)
								<div class="col-xs-3" style="padding-bottom: 15px;">
									<div class="radio" style="text-align: center; display: block; padding-right: 0px; width: auto;">
										<label>
											<img src="{{asset('dist/img/avatar'.$i.'.png')}}" alt="User Image" style="max-width: 100%;height: auto;">
											<input type="radio" name="image" value="{{$i}}"> Avatar {{$i}}
										</label>
									</div>
								</div>
								@endfor
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
		<div class="box box-primary">
			<div class="box-body" style="padding-top: 15px;">
				<div class="item">
					<label class="col-sm-2">Nombre</label>{{$user->name}}
				</div>
				<div class="item">
					<label class="col-sm-2">Usuario</label>{{$user->email}}
				</div>
				<div class="item">
					<label class="col-sm-2">Creado el</label>{{$user->created_at}}
				</div>
				<div class="item">
					<label class="col-sm-2">Fecha modificación</label>{{$user->updated_at}}
				</div>
				<div class="item">
					<label class="col-sm-2">Imagen avatar</label>
					<img src="{{asset('dist/img/avatar'.$user->avatar.'.png')}}" alt="User Image" style="max-width: 120px;height: auto;">
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