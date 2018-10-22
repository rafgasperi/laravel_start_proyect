@extends('main-layout')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
        <li class="active">Usuarios</li>
    </ul>
    <!-- END BREADCRUMB -->
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-user"></span> MI PERFIL</h2>
    </div>
    <!-- END PAGE TITLE -->
    <!-- PAGE CONTENT WRAPPER -->

    <div class="page-content-wrap">
        <div class="row">
            @include('partials.message')
            <div class="col-md-3 col-sm-4 col-xs-5">
                <form method="" action="" class="form-horizontal">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <h3>{{ $usuario->first_name }} {{ $usuario->last_name }}</h3>
                        </div>
                        <div class="panel-body form-group-separated">
                            <br/>
                            <div class="text-center" id="user_image">
                                @if($usuario->foto <> "")
                                    <img src="{{ $usuario->foto }}" class="img-thumbnail">
                                @else
                                    <i class="fa fa-user fa-4x img-thumbnail"></i>
                                @endif
                            </div><hr/>

                            <div class="form-group">
                                <div class="col-md-12 col-xs-12">
                                    <a href="#" class="btn btn-primary btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_photo">Cambiar Foto</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label">#ID</label>
                                <div class="col-md-8 col-xs-7">
                                    <input type="text" value="{{ $usuario->id }}" class="form-control" disabled/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label">Cédula</label>
                                <div class="col-md-8 col-xs-7">
                                    {{ Form::text("cedula",$usuario->username,array('class'=>'form-control','required'=>'required','readonly')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label">Dependencia</label>
                                <div class="col-md-8 col-xs-7">
                                    {{ Form::text("dependencia_id",$usuario->dependencia()->first()->descripcion,array('class'=>'form-control','required'=>'required','readonly')) }}
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label">Roles</label>
                                <div class="col-md-8 col-xs-7">
                                    {{ Form::text("grupo",$usuario->roles()->first()->name,array('class'=>'form-control','required'=>'required','disabled' => 'disabled')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-xs-12">
                                    <a href="#" class="btn btn-info btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_password"><i class="fa fa-lock"></i> Cambiar contraseña</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>




            </div>
            <div class="col-md-6 col-sm-8 col-xs-7">

                {{ Form::model($usuario, array('route' => array('user.update', $usuario->id),'class' => 'form-horizontal', 'method' => 'PUT' , 'role' => 'form')) }}
                {{ Form::hidden("redirect_to","/user/".$usuario->id."/perfil",null,array()) }}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3><span class="fa fa-pencil"></span> Perfil</h3>
                    </div>
                    <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Nombre</label>
                            <div class="col-md-9 col-xs-7">
                                {{ Form::text("first_name",$usuario->first_name,array('class'=>'form-control','required'=>'required')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Apellido</label>
                            <div class="col-md-9 col-xs-7">
                                {{ Form::text("last_name",$usuario->last_name,array('class'=>'form-control','required'=>'required')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Email</label>
                            <div class="col-md-9 col-xs-7">
                                {{ Form::email("email",$usuario->email,array('class'=>'form-control','required'=>'required')) }}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 col-xs-5">
                                {{ Form::hidden('redirect_to',route('user.perfil',array($usuario->id))) }}
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-paper-plane"></i> Enviar</button>
                            </div>
                        </div>


                    </div>
                </div>
                {{ Form::close() }}


            </div>

            <div class="col-md-3">
                <div class="panel panel-default form-horizontal">
                    <div class="panel-body">
                        <h3><span class="fa fa-info-circle"></span> Quick Info</h3>
                        <p>Información relevante de este usuario.</p>
                    </div>
                    <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Último Ingreso</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $usuario->last_login }}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Registro</label>
                            <div class="col-md-8 col-xs-7 line-height-30">{{ $usuario->created_at }}</div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- MODALS -->
           @include('modals.cambiar_contrasena')
           @include('modals.subir_foto_perfil')
            <!-- END PAGE CONTENT -->
        </div>
    </div>
    <script>
        $("#dp-1 input").datepicker({
            format: 'yyyy-mm-dd',
            startView: 2,
            beforeShowYear: function (date){
                if (date.getFullYear() == 2016)
                {
                    return false;
                }
            }
        });
    </script>
@stop