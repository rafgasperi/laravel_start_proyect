
<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>Actulizar Contrasena - Qh System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
</head>
<body>

<div class="registration-container">
    <div class="registration-box animated fadeInDown">
        <h1 style="color: #fff;text-align: center;font-size: 3vw;">QH SYSTEM</h1>
        <div class="registration-body">
            <div class="registration-title"><strong>Actualizar Contraseña</strong></div>
            <div class="registration-subtitle">Su contraseña de poseer al menos 4 caracteres.</div>

                {{Form::open(array("method" => "POST","action" => 'UserController@complete',"role" => "form",'class'=>'form-horizontal'))}}
                <div class="form-group">
                    <div class="col-md-12">
                        {{ Form::text('email',$data->email,array("class" => "form-control" , 'required' => 'required','placeholder'=>"Email")) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{ Form::password('password',array("class" => "form-control" , 'required' => 'required','placeholder'=>"Contraseña")) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        {{ Form::password('password_confirmation',array("class" => "form-control" , 'required' => 'required','placeholder'=>"Confirmar Contraseña")) }}
                    </div>
                </div>

                <div class="form-group push-up-30">
                    <div class="col-md-6">
                        {{ Form::hidden('user_id',$data->id) }}
                        <input name="_token" value="{{ csrf_token() }}" type="hidden">
                        <button class="btn btn-success btn-block">Actualizar</button>
                    </div>
                </div>
            </form><p>&nbsp;</p>
            @include('partials.message')
        </div>
        <div class="registration-footer">
            <div class="pull-left">
                &copy; 2016 AppName
            </div>
        </div>
    </div>
</div>
</body>
</html>





