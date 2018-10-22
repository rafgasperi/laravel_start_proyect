@extends('main-layout')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb push-down-0">
        <li><a href="{{ redirect("/") }}">Home</a></li>
        <li><a href="{{ route("email.index") }}">Inbox</a></li>
        <li><a href="{{ route("email.deleted") }}" class="active">Papelera</a></li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- START CONTENT FRAME -->
    <div class="content-frame">
        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                <h2><span class="fa fa-trash"></span> Papelera <small>({{ $mailbox->count() }})</small></h2>
            </div>

            <div class="pull-right">
                <button class="btn btn-default"><span class="fa fa-cogs"></span> Configurar</button>
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
                    <a href="{{ route('email.index') }}" class="list-group-item "><span class="fa fa-inbox"></span> Bandeja de Entrada </a>
                    <a href="{{ route('email.sent') }}" class="list-group-item"><span class="fa fa-rocket"></span> Enviados</a>
                    <a href="{{ route('email.flagged') }}" class="list-group-item"><span class="fa fa-flag"></span> Destacados</a>
                    <a href="{{ route('email.deleted') }}" class="list-group-item active"><span class="fa fa-trash-o"></span> Papelera <span class="badge badge-danger">{{ $mailbox->count() }}</span></a>
                </div>
            </div>
        </div>
        <!-- END CONTENT FRAME LEFT -->

        <!-- START CONTENT FRAME BODY -->
        <div class="content-frame-body">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <label class="check mail-checkall">
                        <input type="checkbox" class="icheckbox"/>
                    </label>
                    <div class="btn-group">
                        <button class="btn btn-default"><span class="fa fa-star"></span></button>
                        <button class="btn btn-default"><span class="fa fa-flag"></span></button>
                    </div>
                    <button class="btn btn-default"><span class="fa fa-warning"></span></button>
                    @if(Sentinel::getUser()->hasAccess('email.destroy'))
                        <button class="btn btn-default on-trash"><span class="fa fa-trash-o"></span></button>
                    @endif
                    <div class="pull-right" style="width: 150px;">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="fa fa-calendar"></span></div>
                            <input class="form-control datepicker" type="text" data-orientation="left"/>
                        </div>
                    </div>
                </div>
                <div class="panel-body mail">
                    @foreach($emailList->reverse() as $index)
                        <?php $message = $mailbox->getMessage($index)->keepUnseen()?>
                        @if($message->getFrom() !== null)
                        <div class="mail-item  @if($message->isSeen()) mail-success @else mail-unread mail-info @endif">
                            <div class="mail-checkbox">
                                <input type="checkbox" class="icheckbox"/>
                            </div>
                            <div class="mail-star @if($message->getHeaders()->get('flagged') == 1) starred @endif">
                                <span class="fa fa-star-o"></span>
                            </div>
                            <div class="mail-user">
                                @if($message->getFrom()->getName() !== null)
                                    {{ substr($message->getFrom()->getName(),0,30) }}
                                @else
                                    {{ substr($message->getFrom()->getAddress(),0,30) }}
                                @endif
                            </div>
                            <a href="{{ route('email.show',$message->getNumber()) }}" class="mail-text">{{ $message->getSubject() }}</a>
                            <div class="mail-date">{{  time_elapsed_string($message->getDate()->format('Y-m-d H:i:s')) }}</div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <div class="panel-footer">
                    {{ $emailList->links() }}
                </div>
            </div>
            <!-- END CONTENT FRAME BODY -->
        </div>
        <!-- END CONTENT FRAME -->
    </div>
@stop