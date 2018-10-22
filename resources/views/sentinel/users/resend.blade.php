<html lang="en" class="body-full-height"><head>
    <!-- META SECTION -->
    <title>QH System - Recuperar Contrsena</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css">
    <!-- EOF CSS INCLUDE -->
</head>
<body>

<div class="registration-container">
    <div class="registration-box animated fadeInDown">
        <h1 style="color: #fff;text-align: center;font-size: 3vw;">QH SYSTEM</h1>
        <div class="registration-body">
            <div class="registration-title"><strong>Recuperar</strong> Contrasena?</div>
            <div class="registration-subtitle">Se le enviara un correo con un enlaze al formulario de recuperacion de contrasena. </div>
            <form method="POST" action="{{ route('password_recovery_send') }}" accept-charset="UTF-8" class="form-horizontal">
                <h4>Tu Email</h4>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="email" type="email" class="form-control" placeholder="email@domain.com" required>
                    </div>
                </div><p>&nbsp;</p>
                <div class="form-group push-up-20">
                    <div class="col-md-6">
                        <a href="{{ route('home') }}" class="btn btn-info btn-block">Ingresar</a>
                    </div>
                    <div class="col-md-6">
                        <input name="_token" value="{{ csrf_token() }}" type="hidden">
                        <button type="submit" class="btn btn-success btn-block">Enviar</button>
                    </div>
                </div>
            </form><p>&nbsp;</p>
            @include('partials.message')
        </div>
        <div class="registration-footer">
            <div class="pull-left">
                © 2016 QH System
            </div>
        </div>
    </div>

</div>

</body>
</html>