@extends('main-layout')
@section('content')
    @include('partials.breadcrumb',array('ruta'=>'user.index','modulo'=>'Usuarios','accion'=>'Nuevo'))
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-user"></span> Usuarios</h2>
    </div>
    <!-- END PAGE TITLE -->
    <!-- PAGE CONTENT WRAPPER -->

    <div class="page-content-wrap">
        <div class="row">
            @include('partials.message')
            <div class="col-md-12">
                <!-- START FORM -->
                <div class="panel panel-default">
                    {{Form::open(array("method" => "POST","action" => 'UserController@store',"role" => "form",'class'=>'form-horizontal'))}}
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Rol</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-search"></span></span>
                                    {{ Form::select('role_id', $roles , null ,array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Dependencia</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-building"></span></span>
                                    {{ Form::select('dependencia_id',\App\Dependencia::pluck('descripcion','id'),  null ,array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Email</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    {{ Form::email('email',  null ,array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Nombre</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    {{ Form::text('first_name',  null ,array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Apellido</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    {{ Form::text('last_name',  null ,array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Cédula</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    {{ Form::text('username',  null ,array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                                <small>Esta sera usada como usuario para el ingreso</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Contraseña</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    {{ Form::password('password',  array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Confirmar Contraseña</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    {{ Form::password('password_confirm',  array("class" => "form-control" , 'required' => 'required')) }}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('user.index') }}" class="btn btn-custom btn-danger "><i class="fa fa-backward"></i> Atras</a>
                        <button type="submit" class="btn btn-custom btn-primary pull-right"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>

@stop