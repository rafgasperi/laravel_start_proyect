$(function() {


    /*var options = {
        fields: {
            'key[]': {
                validators: {
                    notEmpty: {
                        message: 'The Field Name is required'
                    }
                }
            },
            'value[]': {
                validators: {
                    notEmpty: {
                        message: 'The Value is required'
                    }
                }
            }
        }
    };
    //$('#campaignForm').bootstrapValidator(options);*/

    var template = $('#line_0').clone();
    $('#cloneButton').click(function () {
        console.log('add row');
        var rowId = $('.entry').length;
        var klon = template.clone();
        klon.attr('id', 'line_' + rowId)
            .insertAfter($('.row').last())
            .find('input')
            .each(function () {
                $(this).attr('id', $(this).attr('id').replace(/_(\d*)$/, "_"+rowId));
            })

        $("#line_" + rowId).find("#cloneButton").hide();
        $("#line_" + rowId).removeClass('hide');
        $("#line_" + rowId).find("#removeButton").removeClass('hide');

        $('#campaignForm')
            .data('bootstrapValidator')
            .addField(klon.find('input[name="key[]"]'))
            .addField(klon.find('input[name="value[]"]'));
    });


    $('#campaignForm').on('click', '#removeButton', function(e)
    {
        $(this).parents('.entry:first').remove();
        e.preventDefault();
        return false;
    });

    $("#archivo").fileinput({
        allowedFileExtensions : ['csv'],
        showUpload: false,
        maxFileSize: 10000,
        maxFilesNum: 1,
        overwriteInitial: false,
        //allowedFileTypes: ['image', 'video', 'flash'],
        initialPreview: [
            '<img src="http://placehold.it/200x150" class="file-preview-image" alt="The Moon" title="The Moon">',

        ],
        initialPreviewConfig: [

        ]

    });

    function delete_row(row,modulo){

        var box = $("#mb-remove-row");
        box.addClass("open");
        $("#form-delete").attr('action',row);

        box.find(".mb-control-yes").on("click",function(){

            box.removeClass("open");
            $("#"+row).hide("slow",function(){
                $(this).remove();
            });
        });
    }

    $('#modalAnular').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id');
        var route = button.data('route');
        var module = button.data('module');
        var redirect_to = button.data('redirect_to');
        var estatus = button.data('estatus');
        console.log('Estatus :'+estatus)
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('ANULAR/NEGAR '+module+" #"+id);
        $('#form-anular').attr('action',route);
        $('#redirect_to').val(redirect_to);
        $('#estatus').val(estatus);

    })

    $('#modal_bajar').on('show.bs.modal', function (e) {
        $action = $(e.relatedTarget).attr('data-action');
        $(this).find("form").attr('action',$action);
        var redirect_to = $(e.relatedTarget).attr('data-redirect');
        console.log("Redirect Value "+redirect_to);

        $(".redirect_to").attr('value',redirect_to);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirmBaja').data('form', form);
    });

    <!-- Form confirm (yes/ok) handler, submits form -->
    $('#confirmBaja').find('.modal-footer #confirmBaja').on('click', function(){
        $(this).data('form').submit();
    });


    $('.dataTables_filter input').attr("placeholder", "Buscar...");


});