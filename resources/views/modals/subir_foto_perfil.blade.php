<div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
    <div class="modal-dialog">
        {{ Form::model($usuario, array('route' => array('user.subir_foto', $usuario->id),'class' => 'form-horizontal', 'method' => 'PUT' , 'role' => 'form','files'=>true)) }}
        {{ Form::hidden('redirect_to',route('user.perfil',array($usuario->id))) }}
        {{ Form::hidden('path',public_path().'/uploads/users/' . $usuario->id . '/') }}
        {{ Form::hidden('web_path',URL::to('/uploads/users/' . $usuario->id . '/')) }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="smallModalHead">Cambiar foto</h4>
            </div>
            <div class="modal-body form-horizontal form-group-separated">
                <div class="form-group">
                    <label class="col-md-4 control-label">Nueva Foto</label>
                    <div class="col-md-4">
                        {{ Form::file('file',array('id'=>'','class'=>'fileinput btn-info',"data-filename-placement"=>"inside","title"=>"Seleccionar Archivo")) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-custom btn-success">Guardar</button>
                <button type="button" class="btn btn-custom btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>