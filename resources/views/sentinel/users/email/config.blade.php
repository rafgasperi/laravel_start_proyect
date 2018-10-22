<!-- Modal -->
<div class="modal fade" id="configEmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="panel-heading">
        {{Form::open(array("method" => "POST","action" => 'EmailController@config',"role" => "form",'class'=>'form-horizontal'))}}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Configurar cuenta de correo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Password</label>
                            <div class="col-md-10 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                    {{ Form::password('password',  array("class" => "form-control" , 'required' => 'required'))  }}
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>