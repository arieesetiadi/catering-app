oTable = $('#sigerTable').dataTable({
    "sAjaxSource": "sw-mod/order/datatable.php",
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
    "bAutoWidth": true,
    "bSort": false,
    "bStateSave": true,
    "bDestroy" : true,
    "ssSorting" : [[0, 'desc']],

    "fnStateSave": function (oSettings, oData) {
        localStorage.setItem('DataTables_'+window.location.pathname, JSON.stringify(oData));
    },
    "fnStateLoad": function (oSettings) {
        return JSON.parse(localStorage.getItem('DataTables_'+window.location.pathname));
    },
    "bServerSide": true,
    "iDisplayLength": 25,
        "aLengthMenu": [
            [25, 30, 50, -1],
            [25, 30, 50, "All"]
        ],

    "fnDrawCallback": function( oSettings ) {
        $("#titleCheck").click(function() {
            var checkedStatus = this.checked;
            $("table tbody tr td div:first-child input[type=checkbox]").each(function() {
                this.checked = checkedStatus;
                if (checkedStatus == this.checked) {
                    $(this).closest('table tbody tr').removeClass('warning');
                    $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                    $('#totaldata').val($('form input[type=checkbox]:checked').size());
                }
                if (this.checked) {
                    $(this).closest('table tbody tr').addClass('warning');
                    $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                    $('#totaldata').val($('form input[type=checkbox]:checked').size());
                }
            });
        });
        $('table tbody tr td div:first-child input[type=checkbox]').on('click', function () {
            var checkedStatus = this.checked;
            this.checked = checkedStatus;
            if (checkedStatus == this.checked) {
                $(this).closest('table tbody tr').removeClass('warning');
                $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                $('#totaldata').val($('form input[type=checkbox]:checked').size());
            }
            if (this.checked) {
                $(this).closest('table tbody tr').addClass('warning');
                $(this).closest('table tbody tr').find('input:hidden').attr('disabled', !this.checked);
                $('#totaldata').val($('form input[type=checkbox]:checked').size());
            }
        });
        $('table tbody tr td div:first-child input[type=checkbox]').change(function() {
            $(this).closest('tr').toggleClass("warning", this.checked);
        });
        $(".alertdel").click(function(){
            var id = $(this).attr("id");
            $('#alertdel').modal('show');
            $('#delid').val(id);
        });
    }
});


//no_resi
    $("#no_resi").on("click",function(e) {
        e.preventDefault()
        $("#noresi").toggle(true);
        $("#no_resi").toggle(false);
    });
    $("#noresi").on("click",function(e) {
        e.stopPropagation();
    });
    $("#no_resi").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#no_resi"){
            $("#noresi").toggle(false);
            $("#no_resi").toggle(true);
        }
    });
    $("#noresiOK").click(function(){
      var post = $('#text_noresi').val();
      var id = $('#text_order').val();
      var modul = 'order';
      var aksi =  'no_resi';
      var dataString = 'post='+ post + '&id='+ id + '&modul='+ modul + '&aksi='+ aksi;
        if (post == '' || id == '') {
        alert("Silahkan masukkan Nomer Resi dengan benar");
        } 
        else{
      $.ajax({
        type: "POST",
        url: "sw-mod/order/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_noresi').val(html);
          $('#no_resi').html(html);
          $('#noresi').hide();
          $('#no_resi').show();
        }
      });
  }
      return false;
    });

