@extends('main-layout')
@section('content')
    <?php $user = \App\User::find(Sentinel::getUser()->id);?>
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb push-down-0">
        <li><a href="{{ route("dashboard") }}">Home</a></li>
        <li><a href="#" class="active">{{ parseInboxName(Request::segment(2)) }}</a></li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- START CONTENT FRAME -->
    <div class="content-frame">

        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                 <h1><i class="fa fa-inbox"></i> {{ parseInboxName(Request::segment(2)) }}</h1>

            </div>

            <div class="pull-right">
                <button class="btn btn-default" data-toggle="modal" data-target="#configEmailModal"><span class="fa fa-cogs"></span> Configurar</button>
                <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
            </div>
        </div>

        <!-- END CONTENT FRAME TOP -->
        <div class="col-md-12">
            @if(!$haveConfig)
            <h3>Nota : Si su correo es gmail debe habilitar la funcion imap en la configuracion de su cuenta para mayor informacion ingrese <a href="https://support.google.com/mail/answer/7126229?visit_id=1-636171663952041159-3839419754&hl=es&rd=1">aqui</a> </h3>
            @endif
            @if (count($errors->all()) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach($errors->all() as $e)
                            <li/>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('message.error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ Session::get('message.error') }}
                </div>
            @endif
            @if (Session::has('message.success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ Session::get('message.success') }}
                </div>
            @endif
        </div>

        @if($haveConfig)

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
                       <?php /* <a href="{{ route('email.index') }}" class="list-group-item active"><span class="fa fa-inbox"></span> Bandeja de Entrada <span class="badge badge-success">{{ $mailbox->count() }}</span></a>
                        <a href="{{ route('email.sent') }}" class="list-group-item"><span class="fa fa-rocket"></span> Enviados</a>
                        <a href="{{ route('email.flagged') }}" class="list-group-item"><span class="fa fa-flag"></span> Destacados</a>
                        <a href="{{ route('email.deleted') }}" class="list-group-item"><span class="fa fa-trash-o"></span> Papelera</a>--> */?>
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
                        <button class="btn btn-default on-flag"><span class="fa fa-star"></span></button>
                        <button class="btn btn-default on-unseen"><span class="fa fa-eye-slash"></span></button>
                        @if(Sentinel::getUser()->hasAccess('email.destroy'))
                            <button class="btn btn-default on-trash"><span class="fa fa-trash-o"></span></button>
                        @endif
                        <div class="pull-right" style="width: 150px;">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="fa fa-search"></span></div>
                                <input class="form-control" type="text" data-orientation="left" id="q"/>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body mail">
                        @foreach($emailList->reverse() as $index)
                            <?php $message = $mailbox->getMessage($index)->keepUnseen()?>
                            @if($message->getFrom() !== null)
                            <div class="data-block"
                                 data-from="{{ $message->getFrom()->getName() }}"
                                 data-date="{{ $message->getDate()->format('Y-m-d') }}"
                                 data-subject="{{ $message->getSubject() }}">
                                <div class="mail-item  @if($message->isSeen()) mail-success @else mail-unread mail-info @endif">
                                    <div class="mail-checkbox">
                                        <input type="checkbox" class="icheckbox" value="{{ $message->getNumber() }}"/>
                                    </div>
                                    <div class="mail-star @if($message->getHeaders()->get('flagged') == "F") starred @endif">
                                        <span class="fa fa-star-o"></span>
                                    </div>
                                    <div class="mail-user">
                                        @if($message->getFrom()->getName() !== null)
                                            {{ substr($message->getFrom()->getName(),0,30) }}
                                        @else
                                            {{ substr($message->getFrom()->getAddress(),0,30) }}
                                        @endif
                                    </div>
                                    <a href="{{ Request::segment(2) }}/{{  $message->getNumber() }}" class="mail-text">{{ $message->getSubject() }}</a>
                                    <div class="mail-date">{{  time_elapsed_string($message->getDate()->format('Y-m-d H:i:s')) }}</div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default on-flag"><span class="fa fa-star"></span></button>
                        <button class="btn btn-default on-unseen"><span class="fa fa-eye-slash"></span></button>
                        <button class="btn btn-default on-trash"><span class="fa fa-trash-o"></span></button>

                       {{ $emailList->links() }}

                    </div>
                    </div>

            </div>
            <!-- END CONTENT FRAME BODY -->
        @endif
    </div>
    <!-- END CONTENT FRAME -->



    <script>

        $(document).ready(function() {

            $('#q').on("change keyup", function() {
                var str = $(this).val().toLowerCase();
                $(".data-block").hide().filter(function() {
                    var rtnData = "";
                    regExName 	    = new RegExp(str.trim(), "ig");

                    rtnData = (
                            $(this).attr("data-from").match(regExName) ||
                            $(this).attr("data-date").match(regExName) ||
                            $(this).attr("data-subject").match(regExName)
                    );

                    return rtnData;
                }).show();
            });

        });


    </script>

    @include("sentinel.users.email.modal")
    @include("sentinel.users.email.config")
@stop