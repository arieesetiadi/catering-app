$(function() {
    $('#idparent').hide();
    $('#status').change(function(){
        if($('#status').val() == '2') {
            $('#idparent').show();
        } else {
            $('#idparent').hide();
        }
    });
});


$(".alertdel").click(function(){
    var id = $(this).attr("id");
    $('#alertdel').modal('show');
    $('#delid').val(id);
});


// remove
$('#form-delete').submit(function(e){
    $('#form-delete .btn-danger').addClass('disabled');
    $.growl({ title: "", message: "Processing..." });
    $.ajax({
        url: "sw-mod/module/proses.php",
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            $('#alertdel').modal('hide');
            $('#form-delete .btn-danger').removeClass('disabled');
            $('input[type="text"]').val('');
            console.log(data);
            if(data == "ok"){
                $("#growls .growl-default").hide();
                $.growl.notice({ message: "Berhasil Dihapus", duration: 1000 });
                 window.location.replace("./?mod=menumanager";
                // oTable.fnDraw(true);
                // oTable.fnReloadAjax();
            } else if(data == "error"){
                $.growl.error({ message: "Error", duration: 1000 });
            }
        }
    });
    e.preventDefault();
    return false;
});

