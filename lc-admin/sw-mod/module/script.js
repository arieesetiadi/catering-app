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
oTable = $('#sigerTable').dataTable({
    "sAjaxSource": "sw-mod/module/datatable.php",
    "sDom": "<'row'<'col-sm-6 col-xs-5'l><'col-sm-6 col-xs-7'f>r>t<'row'<'col-sm-5 hidden-xs'i><'col-sm-7 col-xs-12 clearfix'p>>",
    "sPaginationType": "bootstrap",
    "oLanguage": {
        "sLengthMenu": "_MENU_",
            "sSearch": '<div class="input-group">_INPUT_<span class="input-group-addon"><i class="fa fa-search"></i></span></div>',
            "sInfo": "<strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
            "oPaginate": {
                "sPrevious": "",
                "sNext": ""
            }
    },
    "bJQueryUI": false,
    "bAutoWidth": false,
    "bSort": false,
    "bStateSave": true,
    "fnStateSave": function (oSettings, oData) {
        localStorage.setItem('DataTables_'+window.location.pathname, JSON.stringify(oData));
    },
    "fnStateLoad": function (oSettings) {
        return JSON.parse(localStorage.getItem('DataTables_'+window.location.pathname));
    },
    "bServerSide": true,
    "iDisplayLength": 10,
        "aLengthMenu": [
            [10, 30, 50, -1],
            [10, 30, 50, "All"]
        ],
    "fnDrawCallback": function( oSettings ) {
        $("#titleCheck").click(function() {
            var checkedStatus = this.checked;
            $("table tbody tr td div:first-child input[type=checkbox]").each(function() {
                this.checked = checkedStatus;
                if (checkedStatus == this.checked) {
                    $(this).closest('table tbody tr').removeClass('danger');
                    $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                    $('#totaldata').val($('form input[type=checkbox]:checked').size());
                }
                if (this.checked) {
                    $(this).closest('table tbody tr').addClass('danger');
                    $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                    $('#totaldata').val($('form input[type=checkbox]:checked').size());
                }
            });
        });
        $('table tbody tr td div:first-child input[type=checkbox]').on('click', function () {
            var checkedStatus = this.checked;
            this.checked = checkedStatus;
            if (checkedStatus == this.checked) {
                $(this).closest('table tbody tr').removeClass('danger');
                $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                $('#totaldata').val($('form input[type=checkbox]:checked').size());
            }
            if (this.checked) {
                $(this).closest('table tbody tr').addClass('danger');
                $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                $('#totaldata').val($('form input[type=checkbox]:checked').size());
            }
        });
        $('table tbody tr td div:first-child input[type=checkbox]').change(function() {
            $(this).closest('tr').toggleClass("danger", this.checked);
        });
        $(".alertdel").click(function(){
            var id = $(this).attr("id");
            $('#alertdel').modal('show');
            $('#delid').val(id);
        });
    }
});

$(".alertdel").click(function(){
    var id = $(this).attr("id");
    $('#alertdel').modal('show');
    $('#delid').val(id);
});

// modal add
$('#form-validation').submit(function(e){
    $('#form-validation .btn-primary').addClass('disabled');
    $.growl({ title: "", message: "Processing..." });
    $.ajax({
        url: "sw-mod/module/proses.php",
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            $('#addModule').modal('hide');
            $('#form-validation .btn-primary').removeClass('disabled');
            $('input[type="text"]').val('');
            console.log(data);
            if(data == "ok"){
                $("#growls .growl-default").hide();
                $.growl.notice({ message: "Berhasil Ditambah", duration: 1000 });
             window.location.replace("./?mod=module");
                // oTable.fnDraw(true);
                // oTable.fnReloadAjax();
            }
              else
                if(data == "error"){
                $.growl.error({ message: "Error", duration: 1000 });
            }
        }
    });
    e.preventDefault();
    return false;
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
                 window.location.replace("./?mod=module");
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

