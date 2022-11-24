$(document).ready(function() {
$('#title-1').on('input', function() {
        var permalink;
        permalink = $.trim($(this).val());
        permalink = permalink.replace(/\s+/g,' ');
        $('#seotitle').val(permalink.toLowerCase());
        $('#seotitle').val($('#seotitle').val().replace(/\W/g, ' '));
        $('#seotitle').val($.trim($('#seotitle').val()));
        $('#seotitle').val($('#seotitle').val().replace(/\s+/g, '-'));
        var gappermalink = $('#seotitle').val();
        $('#permalink').html(gappermalink);
    });
    $('#seotitle').on('input', function() {
        var permalink;
        permalink = $(this).val();
        permalink = permalink.replace(/\s+/g,' ');
        $('#seotitle').val(permalink.toLowerCase());
        $('#seotitle').val($('#seotitle').val().replace(/\W/g, ' '));
        $('#seotitle').val($('#seotitle').val().replace(/\s+/g, '-'));
        var gappermalink = $('#seotitle').val();
        $('#permalink').html(gappermalink);
    });

});

tinymce.init({
   selector: "#swEditorText",
   menubar : true,
   theme: "modern",
   skin: "custom",
content_style: "div, p { font-size: 15px; }",
plugins: 'codemirror, preview  wordcount, advlist, autolink, lists, link, image, charmap, print, preview, hr, anchor pagebreak searchreplace wordcount, visualblocks, visualchars, fullscreen, insertdatetime, media, nonbreaking, save, table, contextmenu, directionality, emoticons, paste, textcolor, colorpicker, textpattern',
//toolbar: 'undo redo | styleselect | bold italic  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote charmap| forecolor backcolor emoticons | table | link image media |  code preview sh4tinymce wordcount',
 contextmenu: "link image inserttable | cell row column deletetable",
  codemirror: {
    indentOnInit: true,
    path: 'codemirror-4.8',
    config: {
      lineNumbers: true       
    }
  },
toolbar1: "undo redo bold italic underline alignleft aligncenter alignright alignjustify bullist numlist outdent indent table blockquote preview",
toolbar2: "fontselect fontsizeselect styleselect link unlink emoticons image media forecolor backcolor fullscreen",
  content_css: [
    './sw-assets/css/tiny.css'
  ],
  theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;"+
                         "Arial Black=arial black,avant garde;"+
                         "Book Antiqua=book antiqua,palatino;"+
                         "Comic Sans MS=comic sans ms,sans-serif;"+
                         "Courier New=courier new,courier;"+
                         "Century Gothic=century_gothic;"+
                         "Georgia=georgia,palatino;"+
                         "Gill Sans MT=gill_sans_mt;"+
                         "Gill Sans MT Bold=gill_sans_mt_bold;"+
                         "Gill Sans MT BoldItalic=gill_sans_mt_bold_italic;"+
                         "Gill Sans MT Italic=gill_sans_mt_italic;"+
                         "Helvetica=helvetica;"+
                         "Impact=impact,chicago;"+
                         "Iskola Pota=iskoola_pota;"+
                         "Iskola Pota Bold=iskoola_pota_bold;"+
                         "Symbol=symbol;"+
                         "Tahoma=tahoma,arial,helvetica,sans-serif;"+
                         "Terminal=terminal,monaco;"+
                         "Times New Roman=times new roman,times;"+
                         "Trebuchet MS=trebuchet ms,geneva;"+
                         "Verdana=verdana,geneva",
image_advtab: true,
fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
relative_urls: false,
remove_script_host: false,
file_browser_callback: function(field, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: 'plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
        title: 'File Manager',
        width: 900,
        height: 500,
        inline: true,
        close_previous: false
    }, {
        window: win,
        input: field
    });
    return false;
}
});



oTable = $('#sigerTable').dataTable({
    "sAjaxSource": "sw-mod/product/datatable.php",
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


/* ------------------- MODAL IMAGES --------------------- */
function openKCFinder(div) {
    $('#modal-id').modal('show');
    $(".modal-title").html("File Manager");
    //var div = document.getElementById('kcfinder_1');
       if (div.style.display == "block") {
        div.style.display = 'none';
        div.innerHTML = '';
        return;
    }

    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            //div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                var img = document.getElementById('img');
                //document.getElementById("inner_value").innerHTML= url;
                document.getElementById("inputgambar").value = url;
        
            $('#modal-id').modal('hide');

             var o_w = img.offsetWidth;
                            var o_h = img.offsetHeight;
                            var f_w = div.offsetWidth;
                            var f_h = div.offsetHeight;
                            if ((o_w > f_w) || (o_h > f_h)) {
                                if ((f_w / f_h) > (o_w / o_h))
                                    f_w = parseInt((o_w * f_h) / o_h);
                                else if ((f_w / f_h) < (o_w / o_h))
                                    f_h = parseInt((o_h * f_w) / o_w);
                                img.style.width = f_w + "px";
                                img.style.height = f_h + "px";
                            } else {
                                f_w = o_w;
                                f_h = o_h;
                            }

                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
            }
        }
    };

 document.getElementById("kcfinder_1").innerHTML ='<iframe src="plugins/kcfinder/?type=image" ' +
        'frameborder="0" width="100%" height="600px" marginwidth="0" marginheight="0" scrolling="no" />';
}



function openKCFinder2(div) {
    $('#modal-id').modal('show');
    $(".modal-title").html("File Manager");
    //var div = document.getElementById('kcfinder_1');
       if (div.style.display == "block") {
        div.style.display = 'none';
        div.innerHTML = '';
        return;
    }

    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            //div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                var img = document.getElementById('img');
                //document.getElementById("inner_value").innerHTML= url;
                document.getElementById("inputgambar2").value = url;
        
            $('#modal-id').modal('hide');

             var o_w = img.offsetWidth;
                            var o_h = img.offsetHeight;
                            var f_w = div.offsetWidth;
                            var f_h = div.offsetHeight;
                            if ((o_w > f_w) || (o_h > f_h)) {
                                if ((f_w / f_h) > (o_w / o_h))
                                    f_w = parseInt((o_w * f_h) / o_h);
                                else if ((f_w / f_h) < (o_w / o_h))
                                    f_h = parseInt((o_h * f_w) / o_w);
                                img.style.width = f_w + "px";
                                img.style.height = f_h + "px";
                            } else {
                                f_w = o_w;
                                f_h = o_h;
                            }

                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
            }
        }
    };

        document.getElementById("kcfinder_1").innerHTML ='<iframe src="plugins/kcfinder/?type=image" ' +
        'frameborder="0" width="100%" height="600px" marginwidth="0" marginheight="0" scrolling="no" />';
}




function openKCFinder3(div) {
    $('#modal-id').modal('show');
    $(".modal-title").html("File Manager");
    //var div = document.getElementById('kcfinder_1');
       if (div.style.display == "block") {
        div.style.display = 'none';
        div.innerHTML = '';
        return;
    }

    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            //div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                var img = document.getElementById('img');
                //document.getElementById("inner_value").innerHTML= url;
                document.getElementById("inputgambar3").value = url;
        
            $('#modal-id').modal('hide');

             var o_w = img.offsetWidth;
                            var o_h = img.offsetHeight;
                            var f_w = div.offsetWidth;
                            var f_h = div.offsetHeight;
                            if ((o_w > f_w) || (o_h > f_h)) {
                                if ((f_w / f_h) > (o_w / o_h))
                                    f_w = parseInt((o_w * f_h) / o_h);
                                else if ((f_w / f_h) < (o_w / o_h))
                                    f_h = parseInt((o_h * f_w) / o_w);
                                img.style.width = f_w + "px";
                                img.style.height = f_h + "px";
                            } else {
                                f_w = o_w;
                                f_h = o_h;
                            }

                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
            }
        }
    };
        document.getElementById("kcfinder_1").innerHTML ='<iframe src="plugins/kcfinder/?type=image" ' +
        'frameborder="0" width="100%" height="600px" marginwidth="0" marginheight="0" scrolling="no" />';
}



$('#tiny-text').click(function (e) {
    e.stopPropagation();
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'swEditorText');
});

$('#tiny-visual').click(function (e) {
    e.stopPropagation();
    tinymce.EditorManager.execCommand('mceAddEditor',true, 'swEditorText');
});

$('#tbladdcat').click(function () {
    $('#modaladdext').modal('show');
    $(".modal-title").html("");
    $(".modal-title").html("Tambah Kategori");
    $("#labelmodal").html("Title");
    $("#aksi").val("");
    $("#aksi").val("insertCategory");
    $("#titlebox").show();
    $("#titlebox #title").val("");
    $("#tagbox").hide();
    $("#aksi").hide();
});

$('#tbladdtag').click(function () {
    $('#modaladdext').modal('show');
    $(".modal-title").html("");
    $(".modal-title").html("Tambah Tag");
    $("#labelmodal").html("Tags");
    $("#aksi").val("");
    $("#aksi").val("insertTag");
    $("#titlebox").hide();
    $("#tag_tagsinput").val("");
    $("#tagbox").show();
});

$('#btnsubmitext').click(function () {
    var modact = $('#aksi').val();
    if(modact == "insertCategory"){
        var dataString = $(".addnewext").serialize();
        $.ajax({
            type: "POST",
            url: "sw-mod/product/proses.php",
            data: dataString,
            cache: false,
            success: function(data){
                if(data == "error"){
                    $("#titlebox").append("<div class='help-block animation-slideDown' style='color:red;'>Please enter a data</div>");
                }else{
                    $('#selectcatdata').html('');
                    $('#selectcatdata').html(data);
                    $('#modaladdext').modal('hide');
                }
            }
        });
        return false;
    }else{
        var dataString = $(".addnewext").serialize();
        $.ajax({
            type: "POST",
            url: "sw-mod/property/proses.php",
            data: dataString,
            cache: false,
            success: function(data){
                if(data == "error"){
                    $("#tagbox").append("<div class='help-block animation-slideDown' style='color:red;'>Please enter a data</div>");
                }else{
                    $('#selecttagdata').html('');
                    $('#selecttagdata').html(data);
                    $('#modaladdext').modal('hide');
                }
            }
        });
        return false;
    }
});

$('#modaladdext').on('shown.bs.modal', function () {
  $('#title').focus();
});
$('body').on('shown.bs.modal', '#modaladdext', function () {
    $('input:visible:enabled:first', this).focus();
})

$(function() {
    $('.subtitle').click(function(){
        $('#subtitle').show();
        $('.subtitle').hide();
    });

    $('.close_st').click(function(){
        $('#subtitle').hide();
        $('.subtitle').show();
    });
    $('.publish').hide();
    $('#edit_publish').click(function(){
        $('.publish').show();
    });
    $('.close_publish_au').click(function(){
        $('.publish').hide();
    });
     $('#confirm_ok').click(function(){
        $('.publish').hide();
        var data = $('#select-stat').val();
        if(data == 1){
        $('#stat').html('Publish');
        }
        else{
        $('#stat').html('Draft');
        }
    });

});



/* edit */
$("#edit").click(function(){
 //$("#sender", this).attr("disabled", false);
 $( "#enabled" ).prop( "readonly", false );
 });

/* edit */
$("#edit2").click(function(){
 //$("#sender", this).attr("disabled", false);
 $( "#enabled2" ).prop( "readonly", false );
 });


function calculate() {
   var product_price=0, discount=0, afterDiscount=0;
    product_price = document.discountCalculator.product_price.value;
    discount = document.discountCalculator.discount.value;
    afterDiscount=product_price-(product_price*discount/100);
   document.discountCalculator.product_price.value=product_price;
   document.discountCalculator.discount.value=discount;
   document.discountCalculator.afterDiscount.value=afterDiscount;
}


/* Tanpa Rupiah */
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
