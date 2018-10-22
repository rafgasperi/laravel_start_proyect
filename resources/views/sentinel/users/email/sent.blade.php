@extends('main-layout')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb push-down-0">
        <li><a href="{{ redirect("/") }}">Home</a></li>
        <li><a href="{{ route("email.index") }}">Inbox</a></li>
        <li><a href="{{ route("email.sent") }}" class="active">Enviados</a></li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- START CONTENT FRAME -->
    <div class="content-frame">
        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                <h2><span class="fa fa-send"></span> Enviados <small>({{ $mailbox->count() }})</small></h2>
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
                    <a href="{{ route('email.sent') }}" class="list-group-item active"><span class="fa fa-rocket"></span> Enviados <span class="badge badge-success">{{ $mailbox->count() }}</span></a>
                    <a href="{{ route('email.flagged') }}" class="list-group-item"><span class="fa fa-flag"></span> Destacados</a>
                    <a href="{{ route('email.deleted') }}" class="list-group-item"><span class="fa fa-trash-o"></span> Papelera</a>
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
                    @if(Sentinel::getUser()->hasAccess('email.destroy'))
                        <button class="btn btn-default on-trash"><span class="fa fa-trash-o"></span></button>
                    @endif
                    <button class="btn btn-default on-unseen"><span class="fa fa-eye-slash"></span></button>
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
                        <div class="data-block"
                                 data-from="{{ $message->getFrom()->getName() }}"
                                 data-date="{{ $message->getDate()->format('Y-m-d') }}"
                                 data-subject="{{ $message->getSubject() }}">
                            <div class="mail-item  @if($message->isSeen()) mail-success @else mail-unread mail-info @endif">
                                <div class="mail-checkbox">
                                    <input type="checkbox" class="icheckbox"/>
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
                                <a href="{{  $message->getNumber() }}?mailbox=[Gmail]/Enviados" class="mail-text">{{ $message->getSubject() }}</a>

                                <div class="mail-date">{{  time_elapsed_string($message->getDate()->format('Y-m-d H:i:s')) }}</div>
                            </div>
                        </div>

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

@stop