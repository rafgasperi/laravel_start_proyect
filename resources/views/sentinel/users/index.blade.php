@extends('main-layout')
@section('content')
	<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
		<li class="active">Usuarios</li>
	</ul>
	<!-- PAGE TITLE -->
	<div class="page-title">
		<h2><span class="fa fa-users"></span> Directorio</h2>
	</div>
	<!-- END PAGE TITLE -->


	<!-- PAGE CONTENT WRAPPER -->
	<div class="page-content-wrap">

		<div class="row">
			@include('partials.message')
			<div class="col-md-12">

				<div class="panel panel-default">
					<div class="panel-body">

						<form class="form-horizontal">
							<div class="form-group">
								<div class="col-md-4">
									@if(Sentinel::getUser()->hasAccess('user.create'))
									<a href="{{ route('user.create') }}" class="btn btn-primary btn-rounded  btn-condensed btn-sm"><span class="fa fa-plus"></span> Nuevo(a)</a>
								    @endif
								</div>
								<div class="col-md-8">
									<div class="input-group">
										<input  id="q" type="text" class="form-control" placeholder="Usa el campo de busqueda. Se puede buscar por: Nombre, Email, Cédula."/>
										<div class="input-group-addon">
											<span class="fa fa-search"></span>
										</div>
									</div>
								</div>

							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
		<div id="perfiles">

			@if(is_array($users))
			<?php	$loop = $users; ?>
		    @else
			<?php $loop= $users->toArray() ?>
		    @endif

			@foreach(array_chunk($loop, 4) as $block)
				<div class="row">
					@foreach ($block as $user)
						<?php $u = \App\User::find($user['id']);?>
						<div class="col-md-3 data-block"
							 data-name="{{strtolower($user['first_name'])}} {{strtolower($user['last_name'])}}"
							 data-email="{{strtolower($user['email'])}}"
							 data-cedula="{{strtolower($user['username'])}}"
							 data-depto="{{strtolower($u->dependencia()->first()->descripcion)}}"
							>
							<!-- CONTACT ITEM -->
							<div class="panel panel-default">
								<div class="panel-body profile">
									<div class="profile-image">

										@if(!empty($user['foto']))


											<img src="{{ $user['foto'] }}" width="100px" height="100px">

										@else
											<img src="{{ URL::to('assets/images/users/no-image.jpg') }}">
										@endif
									</div>
									<div class="profile-data">
										<div  class="profile-data-name">{{ $user['first_name'] }} {{ $user['last_name'] }}</div>
									</div>
									<div class="profile-controls">
										<?php $u = \App\User::find($user['id']);?>
											<a href="{{ route('user.show',array($user['id'])) }}" class="profile-control-left" title="ver"><span class="fa fa-eye"></span></a>
											<a href="{{ route('user.edit',array($user['id'])) }}" class="profile-control-right" title="editar"><span class="fa fa-edit"></span></a>
									</div>
								</div>
								<div class="panel-body">
									<div class="contact-info">
										<p><small class="profile-data-cedula">Cédula</small><br/>{{ $user['username'] }}</p>
										<p><small class="profile-data-email">Email</small><br/>{{ $user['email'] }}</p>
										<p><small class="profile-data-depto">Dependencia</small><br/>{{ $u->dependencia()->first()->descripcion }}</p>
										<p><small class="profile-data-last_login">Último ingreso</small><br/>{{ $user['last_login'] }}&nbsp;</p>
									</div>
								</div>
							</div>
							<!-- END CONTACT ITEM -->
						</div>
					@endforeach
				</div>
			@endforeach
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
	</div>
	<script>
		$(document).ready(function() {

			$('#q').on("change keyup", function() {
				var str = $(this).val().toLowerCase();
				$(".data-block").hide().filter(function() {
					var rtnData = "";
					regExName 	    = new RegExp(str.trim(), "ig");

					rtnData = (
							$(this).attr("data-name").match(regExName) ||
							$(this).attr("data-email").match(regExName) ||
							$(this).attr("data-cedula").match(regExName)||
                    	    $(this).attr("data-depto").match(regExName)
					);

					return rtnData;
				}).show();
			});

		});
	</script>
@stop