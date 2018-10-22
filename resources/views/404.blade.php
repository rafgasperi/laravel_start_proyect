@extends('main-layout')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
        <li class="active">404</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="error-container">
                    <div class="error-code">404</div>
                    <div class="error-text">{{ $exception->getMessage() }}</div>
                    <div class="error-subtext">Por desgracia estamos teniendo problemas para cargar la página que está buscando. Por favor, espere un momento y vuelva a intentarlo o usar la acción a continuación.</div>
                    <div class="error-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-info btn-block btn-lg" href="{{ route('dashboard') }}">Volver al dashboard</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-primary btn-block btn-lg" href="{{ URL::previous() }}">Volver Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop