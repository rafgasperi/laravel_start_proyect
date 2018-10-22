<!-- Modal -->
<div class="modal fade" id="EstatusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="panel-heading">
    <form id="form-estatus" method="POST" action="" class="form-horizontal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <h3 id="title"></h3>
                    {{ Form::hidden('flag',null,array('id'=>'flag','required')) }}
                    {{ csrf_field() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success">Si</button>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>
 <script>
   $(".on-flag" ).click(function() {

       var checkedElements = $('.mail').find('input[type="checkbox"]:checked');
       var total = checkedElements.length;
       console.log("Total Elements "+total);
       if(total > 0)
       {

           $("#myModalLabel").html("Marcar mensaje(s) como importante");
           $("#title").html("Esta seguro que desea marcar como destacado este(os) mensaje(s) ?");
           $("#form-estatus").attr('action','<?php echo route('email.set_flag',Request::segment(2))?>');
           $("#flag").val("\\Flagged");

           checkedElements.each(function () {

                $("#EstatusModal").find(".modal-body").append("<input name='emails[]' type='hidden' value='"+$(this).val()+"'>");
            });

            $("#EstatusModal").modal();
       }
       else
       {
           alert("Debe seleccionar al menos un mensaje");
       }
   });

   $(".on-unseen" ).click(function() {

       var checkedElements = $('.mail').find('input[type="checkbox"]:checked');
       var total = checkedElements.length;
       console.log("Total Elements "+total);
       if(total > 0)
       {
           $("#myModalLabel").html("Marcar mensaje(s) como no leido(s)");
           $("#title").html("Esta seguro que desea marcar como no leido este(os) mensaje(s) ?");
           $("#form-estatus").attr('action','<?php echo route('email.set_flag',Request::segment(2))?>');
           $("#flag").val("\\Seen");

           checkedElements.each(function () {

               $("#EstatusModal").find(".modal-body").append("<input name='emails[]' type='hidden' value='"+$(this).val()+"'>");
           });

           $("#EstatusModal").modal();
       }
       else
       {
           alert("Debe seleccionar al menos un mensaje");
       }
   });

   $(".on-trash" ).click(function() {

       var checkedElements = $('.mail').find('input[type="checkbox"]:checked');
       var total = checkedElements.length;
       console.log("Total Elements "+total);
       if(total > 0)
       {
           checkedElements.each(function () {

               $("#EstatusModal").find(".modal-body").append("<input name='emails[]' type='hidden' value='"+$(this).val()+"'>");
           });

           $("#myModalLabel").html("Eliminar Mensaje(s)");
           $("#title").html("Esta seguro que desea eliminar estos mensajes ?");

           $("#form-estatus").attr('action','<?php echo route('email.move',array(Request::segment(2),'Trash'))?>');

           $("#EstatusModal").modal();
       }
       else
       {
           alert("Debe seleccionar al menos un mensaje");
       }

   });
</script>
