
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
