@extends('main-layout')
@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
        <li class="active">{{ $module_name }}</li>
    </ul>
    <!-- END BREADCRUMB -->
    <!-- PAGE TITLE -->
    <div class="page-title">
        <h2><span class="fa {{ $icono }}"></span> {{ $module_name }}</h2>
    </div>
    <!-- END PAGE TITLE -->
    <!-- PAGE CONTENT WRAPPER -->

    <div class="page-content-wrap">
        <div class="row">
            @include('partials.message')
            <div class="col-md-12">
                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(Sentinel::getUser()->hasAccess($route.".create"))
                            <h3 class="panel-title">
                                <a href="{{ route($route.'.create') }}" class="btn btn-primary btn-rounded btn-condensed btn-sm" title="Nuevo(a)"><span class="fa fa-plus"></span> Nuevo(a)</a>
                            </h3>
                        @endif
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        @yield('list_content')
                    </div>
                    </div>
                </div>
                <!-- END DEFAULT DATATABLE -->
            </div>
        </div>
    </div>
    @section('scripts')
        {{   Html::script('js/plugins/datatables/jquery.dataTables.min.js') }}
    @stop
<script>
    $('.datatable').DataTable( {
        language: { search: "" },
    } );

</script>
@stop