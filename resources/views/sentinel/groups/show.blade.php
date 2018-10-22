@extends('main-layout')
@section('content')
	@include('partials.breadcrumb',array('ruta'=>'role.index','modulo'=>'Roles','accion'=>'Detalle'))
	<!-- PAGE TITLE -->
	<div class="page-title">
		<h2><span class="fa fa-users"></span> Rol</h2>
	</div>
	<!-- END PAGE TITLE -->
	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">
		<?php $sentryGroup = Sentinel::findRoleById($data->id);?>
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
							<label class="col-md-4 col-xs-5 control-label">#</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $data->id }}</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Nombre</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $data->name }}</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Slug</label>
							<div class="col-md-8 col-xs-7 line-height-30">{{ $data->slug }}</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 col-xs-5 control-label">Fecha Creación</label>
							<div class="col-md-8 col-xs-7">{{ $data->created_at }}</div>
						</div>
						<div class="panel-footer">
							<a href="{{ route('role.index') }}" class="btn btn-custom btn-danger"><i class="fa fa-backward"></i> Atras</a>
							@if(Sentinel::getUser()->hasAccess("role.create"))
								<a href="{{ route('role.create') }}" class="btn btn-custom btn-info"><i class="fa fa-plus"></i> Nuevo</a>
							@endif
							@if(Sentinel::getUser()->hasAccess("role.edit"))
								<a href="{{ route('role.edit',array($data->id)) }}" class="btn btn-custom btn-success"><i class="fa fa-edit"></i> editar</a>
							@endif
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3><span class="fa fa-eye"></span> Usuarios</h3>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th width="33%">Nombre</th>
								<th width="33%">Usuario</th>
								<th width="33%">Correo</th>
							</tr>
							</thead>
							<tbody>
							@foreach($data->usuarios()->get() as $usuario)
								<tr>
									<td>{{ $usuario->first_name }} {{ $usuario->last_name }}</td>
									<td>{{ $usuario->username }}</td>
									<td>{{ $usuario->email }}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
				<!-- END PANEL -->
			<div class="col-md-6">
				<!-- START PANEL -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3><span class="fa fa-eye"></span> Permisos</h3>
					</div>
					<div class="panel-body">
							@foreach(config('permisos.permissions') as $key => $permisos)
								<div class="row">
									<h4>{{ $key }}</h4>
									@foreach($permisos as $key2 => $value)

										<div class="col-md-4">
											{{-- $key2 --}}
											<div class="col-md-8 text-right">
												{{ $value }}
											</div>
											@if ( $sentryGroup->hasAccess($key2) )
												<div class="col-md-4 ">
													<i class="switch">
														<input type="checkbox" checked="" value="0">
														<span></span>
													</i>
												</div>
											@else
												<div class="col-md-4">
													<i class="switch">
														<input type="checkbox" value="1">
														<span></span>
													</i>
												</div>
											@endif
										</div>
									@endforeach
								</div>
							@endforeach
					</div>

				</div>
				<!-- END PANEL -->
			</div>
		</div>
	</div>
@stop