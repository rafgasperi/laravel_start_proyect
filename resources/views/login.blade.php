<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>LARAVEL BACKEND STARTER</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="{{ URL::to('favicon.png') }}" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{URL::to('css/theme-default.css')}}"/>
    <!-- EOF CSS INCLUDE -->
    @include("includes.scripts")
</head>
<body>

<div class="login-container">
    <div class="login-box animated fadeInDown">
        <div class="text-center">
            LOGO HERE
            {{--}}<img src="{{ url('img/logo2.png') }}" width="100%" style="max-width: 192px">{{--}}
        </div>

        <div class="login-body">
            <div class="login-title"><strong>Bienvenido (a)</strong>, Por Favor Ingresar</div>
            {{Form::open(array("method" => "POST","action" => 'Auth\LoginController@login',"role" => "form",'class'=>'form-horizontal'))}}
                <div class="small-6 large-centered columns">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input placeholder="Email" autofocus="autofocus" name="email" type="email"  value="{{ Request::old('email') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input class="form-control" placeholder="Password" name="password" value="" type="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-10 small-offset-2 columns">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <input class="btn  btn-success btn-block" value="Ingresar" type="submit">
                        </div>
                    </div>

                </div><p>&nbsp;</p>
            @include('partials.message')
            </form>
        </div>
    </div>
</div>
</body>
</html>





