@extends('main-layout')
@section('content')
	@include('partials.breadcrumb',array('ruta'=>'user.index','modulo'=>'Usuarios','accion'=>'Detalle'))
	<!-- PAGE TITLE -->
	<div class="page-title">
		<h2><span class="fa fa-users"></span> Usuario</h2>
	</div>
	<!-- END PAGE TITLE -->
	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<div class="row">
			@include('partials.message')
			<div class="col-md-6">
				<!-- START PANEL -->
				<div class="panel panel-default form-horizontal">
					<div class="panel-heading">
						<h3><span class="fa fa-eye"></span> Detalle</h3>
					</div>
					<div class="panel-body form-group-separated">

						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Nombre</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $user->first_name }}</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Apellido</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $user->last_name }}</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Roles</label>
							<div class="col-md-8 col-xs-7 line-height-30">
								@foreach($user->roles()->get() as $grupo)
									{{ $grupo->name }} ,
								@endforeach
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Email</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $user->email }} &nbsp;</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Cédula</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $user->username }} &nbsp;</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Dependencia</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $user->dependencia()->first()->descripcion }} &nbsp;</div>
						</div>

						<div class="panel-footer">
							<a href="{{ route('user.index') }}" class="btn btn-custom btn-danger"><i class="fa fa-backward"></i> Atras</a>
							@if(Sentinel::getUser()->hasAccess("user.create"))
								<a href="{{ route('user.create') }}" class="btn btn-custom btn-info"><i class="fa fa-plus"></i> Nuevo</a>
							@endif
							@if(Sentinel::getUser()->hasAccess("users.edit"))
								<a href="{{ route('user.edit',array($user->id)) }}" class="btn btn-custom btn-success"><i class="fa fa-edit"></i> editar</a>
							@endif
						</div>
					</div>

				</div>
				<!-- END PANEL -->
			</div>
			<div class="col-md-6">
				<!-- START PANEL -->
				<div class="panel panel-default tabs">
					<ul class="nav nav-tabs nav-justified">
						@if(Sentinel::getUser()->hasAccess('user.permisos'))
						<li  class="active"><a href="#permisos" data-toggle="tab">Permisos</a></li>
					    @endif
					</ul>
					<div class="panel-body tab-content">
						@if(Sentinel::getUser()->hasAccess('user.permisos'))
						<div class="tab-pane active" id="permisos">
							<?php $sentry_user = Sentinel::findById($user->id);?>
							@foreach(config('permisos.permissions') as $key => $permisos)
								<div class="row">
									<h4>{{ $key }}</h4>
									@foreach($permisos as $key2 => $value)

										<div class="col-md-4">
											{{-- $key2 --}}
											<div class="col-md-8 text-right">
												{{ $value }}
											</div>
											@if ( $sentry_user->hasAccess($key2) )
												<div class="col-md-4 ">
													<i class="switch">
														<input type="checkbox" checked="" readonly>
														<span></span>
													</i>
												</div>
											@else
												<div class="col-md-4">
													<i class="switch">
														<input type="checkbox" readonly>
														<span></span>
													</i>
												</div>
											@endif
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
					    @endif
					</div>
				</div>
				<!-- END PANEL -->
			</div>
		</div>
	</div>
@stop