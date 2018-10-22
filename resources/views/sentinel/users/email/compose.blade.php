@extends('main-layout')
@section('content')
    @section('css')
        {{ Html::style('css/magicsuggest/magicsuggest.css') }}
    @stop
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb push-down-0">
        <li><a href="{{ redirect("/") }}">Home</a></li>
        <li><a href="{{ route("email.index",array('INBOX')) }}">Inbox</a></li>
        <li><a href="#" class="active">Redactar</a></li>
    </ul>
    <!-- END BREADCRUMB -->
<?php $user = \App\User::find(Sentinel::getUser()->id);?>
    <!-- START CONTENT FRAME -->
    <div class="content-frame">
        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                <h2><span class="fa fa-pencil"></span> Redactar</h2>
            </div>
        </div>
        <!-- END CONTENT FRAME TOP -->
    @include("partials.message")

        <!-- START CONTENT FRAME LEFT -->
        <div class="content-frame-left">
            <div class="block">
                <div class="list-group border-bottom">
                    @foreach($user->getMailboxes() as $box)
                        @if($box->count() > 0)
                            <a href="{{ route('email.index',array(str_replace("/", "-", $box->getName()))) }}" class="list-group-item @if(Request::is("email/".$box->getName())) active @endif"><span class="fa fa-inbox"></span> {{ parseInboxName($box->getName()) }} <span class="badge badge-success">{{ $box->count() }}</span></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- END CONTENT FRAME LEFT -->



        <!-- START CONTENT FRAME BODY -->
        <div class="content-frame-body">
            <div class="block">
                {{Form::open(array("method" => "POST","action" => 'EmailController@store',"role" => "form",'class'=>'form-horizontal',"files"=>true))}}
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button class="btn btn-success"><span class="fa fa-envelope"></span> Enviar Mensaje</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">De</label>
                        <div class="col-md-10">
                            {{ Form::text('de',$from->first_name." ".$from->last_name." <".$from->email."> ",array('class'=>'form-control','required','readonly')) }}
                            {{ Form::hidden('from',$from->email,array('class'=>'form-control','required')) }}

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Para</label>
                        <div class="col-md-9">
                            {{ Form::text("to",'',array('class'=>'magicsuggest','id'=>'magicsuggest','data-placeholder'=>'add email')) }}
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-link toggle" data-toggle="mail-cc">Cc</button>
                        </div>
                    </div>
                    <div class="form-group hidden" id="mail-cc">
                        <label class="col-md-2 control-label">Cc</label>
                        <div class="col-md-10">
                            <input name="cc" type="text" class="magicsuggest" data-placeholder="add email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Asunto</label>
                        <div class="col-md-10">
                            {{ Form::text("subject",'',array('class'=>'form-control','placeholder'=>'Re:')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Adjuntar</label>
                        <div class="col-md-10">
                            <input name="attachments[]" multiple id="archivos" type="file" class="file" data-filename-placement="inside"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {{Form::textarea("body", '', array("class" => "summernote_email"))}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success"><span class="fa fa-envelope"></span> Enviar Mensaje</button>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>

        </div>
        <!-- END CONTENT FRAME BODY -->
    </div>
    <!-- END CONTENT FRAME -->
    </div>

    @section('include_script')

        {{ Html::script('js/plugins/summernote/summernote.js') }}
        {{ Html::script('js/plugins/magicsuggest/magicsuggest.js') }}
        {{ Html::script('js/plugins/bootstrap/bootstrap-select.js') }}


    @stop

<script>
    $("#archivos").fileinput({
        allowedFileExtensions : ['jpg', 'png','gif','xls','xlsx','doc','docx','pdf','txt'],
        showUpload:false,
    });

    $('.magicsuggest').magicSuggest({
        placeholder: 'add Email',
        renderer: function(data){
            if(data.foto.length > 0)
            {
                return '<img width="32" height="32" src="' + data.foto + '"/>' + data.full_name + '<'+data.email+'>';
            }
            else
            {
                return '<i class="fa fa-user fa-2x"></i> '+data.full_name+'<'+data.email+'>';
            }

        },
        data: [
            @foreach($to as $t)
                {
                    "id":"{{ $t['email'] }}",
                    "name":"{{ $t['email'] }}",
                    "email":"{{ $t['email'] }}",
                    "full_name":"{{ $t['nombre'] }}",
                    "foto":"{{ $t['foto'] }}"
                },
            @endforeach
        ],
    });

</script>

@stop