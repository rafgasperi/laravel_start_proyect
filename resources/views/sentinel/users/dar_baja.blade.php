<div class="modal animated fadeIn" id="modal_bajar" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
   <div class="modal-dialog">
     <form method="POST" action="" class="form-horizontal" role="form">
          <input name="_token" value="{{ csrf_token() }}" type="hidden">
          <input name="_method" type="hidden" value="PUT">
          <input id="_redirect" name="redirect_to" type="hidden" value="{{ route('user.index') }}">
          <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
             <h4>Estas Seguro que deseas dar de baja a este usuario ?</h4>
          </div>
          <div class="modal-body form-horizontal form-group-separated">

            <div class="form-group">
                <label class="col-md-3 col-xs-5 control-label">Fecha Fin Contrato</label>
                <div class="col-md-9 col-xs-7 data" id="dp-3">
                    {{ Form::text("fecha_final_contrato",null,array('class'=>'form-control','required')) }}
                </div>
            </div>
          </div>
          <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="confirmBaja"><i class="fa fa-paper-plane"></i> Enviar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-minus"></i> Cancelar</button>
          </div>
    </div>
   </form>
  </div>
</div>
<script>
  $('#modal_bajar').on('show.bs.modal', function (e) {
      $action = $(e.relatedTarget).attr('data-action');
      $(this).find("form").attr('action',$action);

      // Pass form reference to modal for submission on yes/ok
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirmBaja').data('form', form);
  });

  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmBaja').find('.modal-footer #confirmBaja').on('click', function(){
      $(this).data('form').submit();
  });

   $("#dp-3 input").datepicker({format: 'yyyy-mm-dd'});
</script>