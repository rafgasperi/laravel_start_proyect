@extends('main-layout')
@section('content')
    @include('partials.breadcrumb',array('ruta'=>'user.index','modulo'=>'Usuarios','accion'=>'Editar'))
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
                <div class="panel panel-default tabs">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#info" data-toggle="tab">Información General</a></li>
                        @if(Sentinel::getUser()->hasAccess('user.permisos'))
                        <li><a href="#permisos" data-toggle="tab">Permisos</a></li>
                        @endif
                    </ul>
                    <div class="panel-body tab-content">
                        <div class="tab-pane active" id="info">
                            <!-- START FORM -->
                            <div class="panel panel-default">
                                {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT' , 'role' => 'form','class'=>'form-horizontal')) }}

                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">Cédula</label>
                                            <div class="col-md-10 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    {{ Form::text('username', $user->username , array("class" => "form-control" , 'required' => 'required','readonly'))  }}
                                                </div>
                                                <small>Esta sera usada como usuario para el ingreso</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">Dependencia</label>
                                            <div class="col-md-10 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-building"></span></span>
                                                    {{ Form::select('dependencia_id',\App\Dependencia::pluck('descripcion','id'), $user->departamento_id , array("class" => "form-control" , 'required' => 'required'))  }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">Email</label>
                                            <div class="col-md-10 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    {{ Form::email('email', $user->email , array("class" => "form-control" , 'required' => 'required'))  }}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">Rol</label>
                                            <div class="col-md-10 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-users"></span></span>
                                                     {{ Form::select('roles[]',$roles, $user->roles()->pluck('role_id')->toArray(), ['id' => 'grupo', 'multiple' => 'multiple','class'=>'form-control']) }}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">Nombre</label>
                                            <div class="col-md-10 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    {{ Form::text('first_name', $user->first_name , array("class" => "form-control" , 'required' => 'required'))  }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 col-xs-12 control-label">Apellido</label>
                                            <div class="col-md-10 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    {{ Form::text('last_name', $user->last_name , array("class" => "form-control" , 'required' => 'required'))  }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <a href="{{ route('user.index') }}" class="btn btn-custom btn-danger "><i class="fa fa-backward"></i> Atras</a>
                                    @if(Sentinel::getUser()->hasAccess('user.show'))
                                        <a href="{{ route('user.show',array($user->id)) }}" class="btn btn-custom btn-info "><i class="fa fa-eye"></i> Detalle</a>
                                    @endif
                                    <a href="#" class="btn btn-custom btn-warning" data-toggle="modal" data-target="#modal_change_password"><i class="fa fa-lock"></i> Cambiar contraseña</a>

                                    <button type="submit" class="btn btn-custom btn-primary pull-right"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <!-- END FORM -->
                        </div>
                        @if(Sentinel::getUser()->hasAccess('user.permisos'))
                        <div class="tab-pane" id="permisos">

                                <div class="col-md-12">
                                    <!-- START FORM -->
                                    <div class="panel panel-default">
                                        {{ Form::model($user, array('route' => array('user.permisos', $user->id), 'method' => 'PUT' , 'role' => 'form','class'=>'form-horizontal')) }}

                                        <div class="panel-body">
                                            <div class="form-group">
                                                <?php $sentry_user = Sentinel::findById($user->id);?>
                                                @foreach(array_chunk(Config::get('permisos.permissions'),3,true) as $block)
                                                    <div class="row">
                                                        @foreach($block as $key => $permisos)
                                                            <div class="col-md-4" >
                                                                <div style="background: #dedede;margin: 1em 0;text-align: center">
                                                                    <h2 style="text-align: center">Modulo {{ $key }}</h2>
                                                                </div>
                                                                <div class="row checks">
                                                                    @foreach($permisos as $key2 => $value)
                                                                        @if ( $sentry_user->hasAccess($key2) )
                                                                            <div class="col-md-6">
                                                                                <div class="col-sm-10 text-right">
                                                                                    <i class="control-label2">{{ $value }}</i>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <label class="switch">
                                                                                        <input type="checkbox" checked="" name="{{ $key2 }}" class="form-control"/>
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-6">
                                                                                <div class="col-sm-10 text-right">
                                                                                    <i class="control-label2">{{ $value }}</i>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <label class="switch">
                                                                                        <input type="checkbox" name="{{ $key2 }}"  class="form-control" />
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="panel-footer">
                                            <button type="submit" class="btn btn-custom btn-primary pull-right"><i class="fa fa-save"></i> Guardar</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                    <!-- END FORM -->
                                </div>

                        </div>
                        @endif
                    </div>
                </div>

            </div>
            @include('modals.cambiar_contrasena',array('usuario'=>$user))

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