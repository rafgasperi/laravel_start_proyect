<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>LARAVEL BACKEND STARTER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ URL::to('favicon.png') }}" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/theme-default.css?time='.time()) }}" id="theme"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/custom.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/bower_components/bootstrap-fileinput/css/fileinput.min.css') }}"/>
    <!-- EOF CSS INCLUDE -->
    @yield('css')

    @include("includes.scripts")

    @yield('scripts')
</head>
<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container" id="app">
        @include('partials.sidebar')
           <!-- PAGE CONTENT -->
           <div class="page-content">
              @include('partials.x-navigation-horizontal')
              @yield('content')
           </div>
          <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

    @include('modals.message_box')
    @include('modals.delete')

    @yield('post_scripts')

    {{ Html::script('js/plugins.js') }}
    {{ Html::script('js/actions.js') }}
    {{ Html::script('js/custom.js') }}
<script>
    $(".alert-success").fadeTo(10000, 1000).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });
    function delete_row(row,modulo){

        var box = $("#mb-remove-row");
        box.addClass("open");
        $("#form-delete").attr('action',row);

        box.find(".mb-control-yes").on("click",function(){

            box.removeClass("open");
            $("#"+row).hide("slow",function(){
                $(this).remove();
            });
        });
    }


    function removeRow(row) {
        row.remove();
    }
</script>
</body>
</html>





