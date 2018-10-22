@extends('main-layout')
@section('content')
	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
		<li class="active">Roles</li>
	</ul>
	<!-- END BREADCRUMB -->
	<!-- PAGE TITLE -->
	<div class="page-title">
		<h2><span class="fa fa-users"></span> Roles</h2>
	</div>
	<!-- END PAGE TITLE -->
	<!-- PAGE CONTENT WRAPPER -->

	<div class="page-content-wrap">
		<div class="row">
			<div class="col-md-12">
			@include('partials.message')
			<!-- START DEFAULT DATATABLE -->
				<div class="panel panel-default">
					<div class="panel-heading">
						@if(Sentinel::getUser()->hasAccess("role.create"))
							<h3 class="panel-title">
								<a href="{{ route('role.create') }}" class="btn btn-primary btn-rounded btn-condensed btn-sm" title="Nuevo(a)"><span class="fa fa-plus"></span> Nuevo(a)</a>
							</h3>
						@endif
						<ul class="panel-controls">
							<li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
							<li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
							<li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table datatable table-bordered table-striped table-actions">
								<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>									
									<th>Fecha de Creacion</th>
									<th>Acciones</th>
								</tr>
								</thead>
								<tbody>
								@foreach ($data as $dato)
									<tr>
										<td>{{ $dato->id }}</td>
										<td>{{ $dato->name }}</td>
										<td>{{ $dato->created_at }}</td>
										<td>
											@if(Sentinel::getUser()->hasAccess("role.show"))
												<a href="{{ route('role.show', array($dato->id)) }}" class="btn btn-primary btn-rounded btn-condensed btn-sm" title="Detalle"><span class="fa fa-eye"></span></a>
											@endif
											@if(Sentinel::getUser()->hasAccess("role.edit"))
												<a href="{{ route('role.edit', array($dato->id)) }}" class="btn btn-success btn-rounded btn-condensed btn-sm" title="Editar"><span class="fa fa-pencil"></span></a>
											@endif
											@if(Sentinel::getUser()->hasAccess("role.destroy"))
												<button class="btn btn-danger btn-rounded btn-condensed btn-sm" onclick="delete_row('{{ route('role.destroy', array($dato->id)) }}','Roles');"><span class="fa fa-times" title="Borrar"></span></button>
											@endif
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- END DEFAULT DATATABLE -->
			</div>
		</div>
	</div>
@section('scripts')
	{{   Html::script('js/plugins/datatables/jquery.dataTables.min.js') }}
@stop
@stop