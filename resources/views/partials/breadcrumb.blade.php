<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
    <li><a  href="{{ route($ruta) }}">{{ $modulo }}</a></li>
    <li class="active">{{ $accion }}</li>
</ul>
<!-- END BREADCRUMB -->