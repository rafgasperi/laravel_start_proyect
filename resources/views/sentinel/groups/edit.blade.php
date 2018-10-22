@extends('main-layout')
@section('content')
     @include('partials.breadcrumb',array('ruta'=>'role.index','modulo'=>'Roles','accion'=>'Editar'))
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa fa-users"></span> Rol</h2>
    </div>
    <!-- END PAGE TITLE -->
    <!-- PAGE CONTENT WRAPPER -->

    <div class="page-content-wrap">
        <div class="row">
            @include('partials.message')
            <div class="col-md-12">
            <?php $sentryGroup = Sentinel::findRoleById($data->id);?>
                <!-- START FORM -->
                <div class="panel panel-default">
                    {{ Form::model($data, array('route' => array('role.update', $data->id), 'method' => 'PUT' , 'role' => 'form','class'=>'form-horizontal')) }}
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-edit"></span> <strong>Editar</strong></h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Nombre</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    {{ Form::text('name', $data->name, array("class" => "form-control" , 'required' => 'required'))  }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Slug</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    {{ Form::text('slug', $data->slug, array("class" => "form-control" , 'required' => 'required'))  }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        @foreach(array_chunk(Config::get('permisos.permissions'),3,true) as $block)
                        <div class="row">
                        @foreach($block as $key => $permisos)
                            <div class="col-md-4" >
                                <div style="background: #dedede;margin: 1em 0;text-align: center">
                                    <h2 style="text-align: center">Modulo {{ $key }}</h2>
                                </div>
                                <div class="row checks">
                                    @foreach($permisos as $key2 => $value)
                                        @if ( $sentryGroup->hasAccess($key2) )
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
                        <a href="{{ route('role.index') }}" class="btn btn-custom btn-danger "><i class="fa fa-backward"></i> Atras</a>
                        @if(Sentinel::getUser()->hasAccess('role.show'))
                            <a href="{{ route('role.show',array($data->id)) }}" class="btn btn-custom btn-info "><i class="fa fa-eye"></i> Detalle</a>
                        @endif
                        <button type="submit" class="btn btn-custom btn-primary pull-right"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>
    @section('scripts')
        {{ Html::script('js/plugins/icheck/icheck.min.js') }}

    @stop
@stop