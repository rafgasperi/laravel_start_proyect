@extends('main-layout')
@section('content')
    <?php $user = \App\User::find(Sentinel::getUser()->id);?>
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb push-down-0">
        <li><a href="{{ URL::to("/") }}">Home</a></li>
        <li><a href="{{ route("email.index",array(Request::segment(2))) }}">{{ Request::segment(2) }}</a></li>
        <li><a href="#" class="active">Mensaje</a></li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- START CONTENT FRAME -->
    <div class="content-frame">
        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                <h2><span class="fa fa-file-text"></span> Mensaje</h2>
            </div>

            <div class="pull-right">
                <button class="btn btn-default"><span class="fa fa-print"></span> Imprimir</button>
                <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
            </div>
        </div>
        <!-- END CONTENT FRAME TOP -->

        <!-- START CONTENT FRAME LEFT -->
        <div class="content-frame-left">
            @if(Sentinel::getUser()->hasAccess('email.create'))
                <div class="block">
                    <a href="{{ route('email.create') }}" class="btn btn-danger btn-block btn-lg"><span class="fa fa-edit"></span> REDACTAR</a>
                </div>
            @endif
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

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-left">


                        @if(isset($from->foto))
                            <img src="{{ $from->foto }}" class="panel-title-image" alt="{{ $from->first_name }} {{ $from->last_name }}"/>
                        @endif
                        <h3 class="panel-title">{{ $message->getFrom()->getName() }} <small> {{ "<".$message->getFrom()->getAddress().">" }} </small></h3>

                    </div>

                    <div class="pull-right">

                        <div class="btn-group">
                            <a href="{{ route('email.show',array(Request::segment(2),$message->getNumber()-1)) }}" class="btn btn-default" title="before message"><span class="fa fa-mail-reply"></span></a>
                            <a href="{{ route('email.show',array(Request::segment(2),$message->getNumber()+1)) }}"class="btn btn-default" title="next message"><span class="fa fa-mail-forward"></span></a>
                        </div>
                        <button class="btn btn-default"><span class="fa fa-star" title="flagged message"></span></button>
                        <button class="btn btn-default"><span class="fa fa-trash-o" title="delete message"></span></button>
                    </div>
                </div>
                <div class="panel-body">
                    <h1>{{ $message->getSubject()}} <small>{{  time_elapsed_string($message->getDate()->format('Y-m-d H:i:s')) }}</small></h1>
                    <textarea id="summernote">

                        @if(!empty($message->getBodyHtml()))
                          {{ $message->getBodyHtml() }}
                        @elseif(!empty($message->getBodyText()))
                          {{ $message->getBodyText() }}
                        @endif

                    </textarea>
                </div>
                <div class="panel-body panel-body-table">
                    <h6>Adjuntos</h6>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="50">Tipo</th><th>Nombre</th><th width="100">Peso</th><th>Descargar</th>
                        </tr>
                        <?php $i=1;?>
                        @foreach($message->getAttachments() as $attachment)
                            <?php $ext = pathinfo($attachment->getFilename(), PATHINFO_EXTENSION);?>
                            <tr>
                                <td>{{ $attachment->getType() }}</td>
                                <td>{{ $attachment->getFilename() }}</td>
                                <td>{{ $attachment->getBytes()  }}</td>
                                <td>
                                    @if($attachment->getType() == "image")
                                        <img src="data:application/octet-stream;{{  $attachment->getCharset() }};{{ $attachment->getSubtype() }};{{ $attachment->getEncoding() }},{{ $attachment->getContent() }}">
                                    @elseif($ext == "pdf")
                                        <a class="btn btn-success btn-rounded btn-condensed btn-sm" href="data:application/pdf;{{  $attachment->getCharset() }};{{ $attachment->getSubtype() }};{{ $attachment->getEncoding() }},{{ $attachment->getContent() }}" download="{{ $attachment->getFilename() }}">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @elseif($ext == "csv")
                                        <a class="btn btn-success btn-rounded btn-condensed btn-sm" href="data:application/csv;{{  $attachment->getCharset() }};{{ $attachment->getSubtype() }};{{ $attachment->getEncoding() }},{{ $attachment->getContent() }}" download="{{ $attachment->getFilename() }}">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @elseif($ext == "xlsx" || $ext == "xls" )
                                        <a class="btn btn-success btn-rounded btn-condensed btn-sm" href="data:application/vnd.ms-excel;{{ $attachment->getEncoding() }},{{ $attachment->getContent() }}" download="{{ $attachment->getFilename() }}">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        <?php $i++;?>
                        @endforeach
                    </table>

                </div>
                <div class="panel-body">
                    <div class="form-group push-up-20">
                        <label>Respuesta rapida</label>
                        <textarea class="form-control summernote_lite" rows="3" placeholder="Click to get editor"></textarea>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-success pull-right"><span class="fa fa-mail-reply"></span> Responder</button>
                </div>
            </div>
        </div>
        <!-- END CONTENT FRAME BODY -->
    </div>
@section('include_script')
    {{ Html::script('js/plugins/codemirror/codemirror.js') }}
    {{ Html::script('js/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}
    {{ Html::script('js/plugins/codemirror/mode/xml/xml.js') }}
    {{ Html::script('js/plugins/codemirror/mode/javascript/javascript.js') }}
    {{ Html::script('js/plugins/codemirror/mode/css/css.js') }}
    {{ Html::script('js/plugins/codemirror/mode/clike/clike.js') }}
    {{ Html::script('js/plugins/codemirror/mode/php/php.js') }}
    {{ Html::script('js/plugins/summernote/summernote.js') }}
@stop
<!-- END CONTENT FRAME -->
<script>
    $('#summernote').summernote({
        toolbar: [
            // [groupName, [list of button]]
            /*['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]*/
        ]
    });
</script>

@stop