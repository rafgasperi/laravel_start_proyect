<div class="modal animated fadeIn" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        {{ Form::model($usuario, array('route' => array('user.change_password', $usuario->id),'class' => 'form-horizontal', 'method' => 'PUT' , 'role' => 'form')) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="smallModalHead">Cambiar contrasena</h4>
            </div>
            <div class="modal-body">
                {{ Form::hidden('redirect_to',route('user.edit',array($usuario->id))) }}
                <p>La contrasena debe tener al menos 4 caracteres.</p>
            </div>
            <div class="modal-body form-horizontal form-group-separated">
                <div class="form-group">
                    <label class="col-md-3 control-label">Nueva Contraseña</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Repetir Contraseña</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password_confirmation" required/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom btn-danger" data-dismiss="modal"><i class="fa fa-minus"></i> Cancelar</button>
                <button type="submit" class="btn btn-custom btn-success"><i class="fa fa-paper-plane"></i> Enviar</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>