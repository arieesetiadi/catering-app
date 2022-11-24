oTable = $('#sigerTable').dataTable({
    "sAjaxSource": "sw-mod/user/datatable.php",
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
    "iDisplayLength": 20,
        "aLengthMenu": [
            [20, 30, 50, -1],
            [20, 30, 50, "All"]
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
        $(".setuser").click(function(){
            var id = $(this).attr("data-id");
            var active = $("#setus"+id).attr("data-active");
            if(active == 1){
            var dataactive = eval(active)+eval(1);
            }else if(active == 2){
            var dataactive = eval(active)+eval(1);
            }else if(active == 3){
            var dataactive = eval(active)-eval(2);
            }
            var modul = 'user';
            var aksi = 'setuser';
            var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
            $("#setus"+id).html("waiting");
            $.ajax({
                type: "POST",
                url: "sw-mod/user/proses.php",
                data: dataString,
                cache: false,
                success: function(){
                    if(active == 1){
                        $("#setus"+id).attr("data-active","2");
                        $("#setus"+id).attr("class","btn btn-xs btn-success");
                        $("#setus"+id).html("<i class='gi gi-user'></i> User");
                    }else if(active == 2){                        
                        $("#setus"+id).attr("data-active","3");
                        $("#setus"+id).attr("class","btn btn-xs btn-primary");
                        $("#setus"+id).html("<i class='fa fa-user'></i> Member");
                    }else{                        
                        $("#setus"+id).attr("data-active","1");
                        $("#setus"+id).attr("class","btn btn-info");
                        $("#setus"+id).html("<i class='gi gi-old_man'></i> Administrator");
                    }
                }
            });
        });
        $(".setactive").click(function(){
            var id = $(this).attr("data-id");
            var active = $("#seth"+id).attr("data-active");
            if(active == "Y"){
            var dataactive = "N";
            }else{
            var dataactive = "Y";
            }
            var modul = 'user';
            var aksi = 'setactive';
            var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
            $("#seth"+id).html("waiting");
            $.ajax({
                type: "POST",
                url: "sw-mod/user/proses.php",
                data: dataString,
                cache: false,
                success: function(){
                    if(active == "Y"){
                        $("#seth"+id).attr("data-active","N");
                        $("#seth"+id).attr("class","btn btn-xs btn-warning");
                        $("#seth"+id).html("<i class='fa fa-eye-slash'></i> Deactive");
                    }else{
                        $("#seth"+id).attr("data-active","Y");
                        $("#seth"+id).attr("class","btn btn-xs btn-success");
                        $("#seth"+id).html("<i class='fa fa-eye'></i> Active</a>");
                    }
                }
            });
        });
    }
});

oTable2 = $('#sigerTable2').dataTable({
    "sAjaxSource": "sw-mod/user/userroletable.php",
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
    "bServerSide": false,
    "iDisplayLength": 20,
        "aLengthMenu": [
            [20, 30, 50, -1],
            [20, 30, 50, "All"]
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
        $(".alertdelu").click(function(){
            var id = $(this).attr("id");
            $('#alertdelu').modal('show');
            $('#delidu').val(id);
        });
        $(".raccess").click(function(){
          var id = $(this).attr("data-id");
          var active = $(this).attr("data-active");
          if(active == "Y"){
            var dataactive = "N";
          }else{
            var dataactive = "Y";
          }
          var modul = 'user';
          var aksi = 'raccess_pro';
          var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
          $("#r"+id).html("waiting");
          $.ajax({
            type: "POST",
            url: "sw-mod/user/proses.php",
            data: dataString,
            cache: false,
            success: function(){
              if(active == "Y"){
                $("#r"+id).attr("data-active","N");
                $("#r"+id).attr("class","btn btn-xs btn-warning raccess");
                $("#r"+id).html("<i class='fa fa-times'></i>");
              }else{
                $("#r"+id).attr("data-active","Y");
                $("#r"+id).attr("class","btn btn-xs btn-success raccess");
                $("#r"+id).html("<i class='fa fa-check'></i>");
              }
            }
          });
        });
        $(".waccess").click(function(){
          var id = $(this).attr("data-id");
          var active = $(this).attr("data-active");
          if(active == "Y"){
            var dataactive = "N";
          }else{
            var dataactive = "Y";
          }
          var modul = 'user';
          var aksi = 'waccess_pro';
          var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
          $("#w"+id).html('waiting');
          $.ajax({
            type: "POST",
            url: "sw-mod/user/proses.php",
            data: dataString,
            cache: false,
            success: function(){
              if(active == "Y"){
                $("#w"+id).attr("data-active","N");
                $("#w"+id).attr("class","btn btn-xs btn-warning waccess");
                $("#w"+id).html("<i class='fa fa-times'></i>");
              }else{
                $("#w"+id).attr("data-active","Y");
                $("#w"+id).attr("class","btn btn-xs btn-success waccess");
                $("#w"+id).html("<i class='fa fa-check'></i>");
              }
            }
          });
        });
        $(".maccess").click(function(){
          var id = $(this).attr("data-id");
          var active = $(this).attr("data-active");
          if(active == "Y"){
            var dataactive = "N";
          }else{
            var dataactive = "Y";
          }
          var modul = 'user';
          var aksi = 'maccess_pro';
          var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
          $("#m"+id).html("waiting");
          $.ajax({
            type: "POST",
            url: "sw-mod/user/proses.php",
            data: dataString,
            cache: false,
            success: function(){
              if(active == "Y"){
                $("#m"+id).attr("data-active","N");
                $("#m"+id).attr("class","btn btn-xs btn-warning maccess");
                $("#m"+id).html("<i class='fa fa-times'></i>");
              }else{
                $("#m"+id).attr("data-active","Y");
                $("#m"+id).attr("class","btn btn-xs btn-success maccess");
                $("#m"+id).html("<i class='fa fa-check'></i>");
              }
            }
          });
        });
        $(".daccess").click(function(){
          var id = $(this).attr("data-id");
          var active = $(this).attr("data-active");
          if(active == "Y"){
            var dataactive = "N";
          }else{
            var dataactive = "Y";
          }
          var modul = 'user';
          var aksi = 'daccess_pro';
          var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
          $("#d"+id).html("waiting");
          $.ajax({
            type: "POST",
            url: "sw-mod/user/proses.php",
            data: dataString,
            cache: false,
            success: function(){
              if(active == "Y"){
                $("#d"+id).attr("data-active","N");
                $("#d"+id).attr("class","btn btn-xs btn-warning daccess");
                $("#d"+id).html("<i class='fa fa-times'></i>");
              }else{
                $("#d"+id).attr("data-active","Y");
                $("#d"+id).attr("class","btn btn-xs btn-success daccess");
                $("#d"+id).html("<i class='fa fa-check'></i>");
              }
            }
          });
        });
    }
});

oTable3 = $('#sigerTable3').dataTable({
    "sAjaxSource": "sw-mod/user/userleveltable.php",
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
        $(".alertdellevel").click(function(){
            var id = $(this).attr("id");
            $('#alertdellevel').modal('show');
            $('#delidlevel').val(id);
        });
        $(".setactive").click(function(){
            var id = $(this).attr("data-id");
            var active = $("#seth"+id).attr("data-active");
            if(active == "Y"){
            var dataactive = "N";
            }else{
            var dataactive = "Y";
            }
            var modul = 'user';
            var aksi = 'setlact';
            var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
            $("#seth"+id).html("waiting");
            $.ajax({
                type: "POST",
                url: "sw-mod/user/proses.php",
                data: dataString,
                cache: false,
                success: function(){
                    if(active == "Y"){
                        $("#seth"+id).attr("data-active","N");
                        $("#seth"+id).attr("class","btn btn-xs btn-warning");
                        $("#seth"+id).html("<i class='fa fa-eye-slash'></i> Deactive");
                    }else{
                        $("#seth"+id).attr("data-active","Y");
                        $("#seth"+id).attr("class","btn btn-xs btn-success");
                        $("#seth"+id).html("<i class='fa fa-eye'></i> Active</a>");
                    }
                }
            });
        });
        $('.edit').click(function(){
            var id = $(this).attr("data-id");
            var data = 'id=' + id;  
            $.ajax({
                url : "sw-mod/user/datalevel.php",
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id"]').val(data.level_id);
                    $('[name="title"]').val(data.title);
                    $('#modal_form').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        });
    }
});

$("#passwordClick").click(function(){
  $('#passwordInput').show();
  $("#passwordChange").hide();
});
$("#passwdCancel").click(function(){
  $('#passwordChange').show();
  $("#passwordInput").hide();
});
function checkPasswordMatch(){
  var post = $('#passwdText').val();
  var cpassword = $("#cpasswdText").val();
  if (post != cpassword)
    $("#divCheckPasswordMatch").html("<span class='text-danger'>Password tidak sama!</span>");
  else
    $("#divCheckPasswordMatch").html("<span class='text-success'>Password sama!</span>");
} 
$("#passwdCommit").click(function(){
  var post = $('#passwdText').val();
  var cpassword = $("#cpasswdText").val();
  var modul = 'user';
  var aksi =  'passwordChange'; 
  var id = $('#id').val();
  var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi + '&id='+ id;
  if (post != cpassword)
    $("#divCheckPasswordMatch").html("<span class='text-danger'>Password tidak sama!</span>");
  else
  $.ajax({
    type: "POST",
    url: "sw-mod/user/proses.php",
    data: dataString,
    cache: false,
    success: function(html){
      // $('#passwordChange').html(html);
      $('#passwordInput').hide();
      $('#passwordChange').show();
    }
  });
  return false;
});

$('#addLevel').on('shown.bs.modal', function(){
  $('#leveltitle').focus();
});

// add user level
$('.modalAdd').submit(function(e){
    $('.modalAdd #sModalAdd').addClass('disabled');
    $.growl({ title: "", message: "Processing..." });
    $.ajax({
        url: 'sw-mod/user/proses.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            $('#addLevel').modal('hide');
            $('.modalAdd #sModalAdd').removeClass('disabled');
            $('input[type="text"]').val('');
            console.log(data);
            if(data == "ok"){
                $("#growls .growl-default").hide();
                $.growl.notice({ message: "Berhasil Ditambah", duration: 1000 });
                otable3 =  $('#sigerTable3').dataTable({bRetrieve : true});
                otable3.fnDraw(true); 
            } else if(data == "error"){
                $.growl.error({ message: "Error", duration: 1000 });
            }
        }
    });
    e.preventDefault();
    return false;
});

// delete user level
$('#mDelLevel').submit(function(e){
    $('#mDelLevel .sMDelLevel').addClass('disabled');
    $.growl({ title: "", message: "Processing..." });
    $.ajax({
        url: "sw-mod/user/proses.php",
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            $('#alertdellevel').modal('hide');
            $('#mDelLevel .sMDelLevel').removeClass('disabled');
            $('input[type="text"]').val('');
            console.log(data);
            if(data == "ok"){
                $("#growls .growl-default").hide();
                $.growl.notice({ message: "Berhasil Dihapus", duration: 1000 });
               otable3 =  $('#sigerTable3').dataTable({bRetrieve : true});
               otable3.fnDraw(true);
            } else if(data == "error"){
                $.growl.error({ message: "Error", duration: 1000 });
            }
        }
    });
    e.preventDefault();
    return false;
});


