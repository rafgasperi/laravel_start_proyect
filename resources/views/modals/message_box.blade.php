<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Cerrar <strong>Sesión</strong> ?</div>
            <div class="mb-content">
                <p>¿Seguro que quieres desconectarte?</p>
                <p>Presione No si quiere continuar trabajando. Presione Sí para desconectarse del usuario actual.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a class="btn btn-success btn-lg" href="{{ route('sentinel.logout') }}"><i class="fa fa-sign-out"></i> Si</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->