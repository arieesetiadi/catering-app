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
plugins: 'codemirror, preview sh4tinymce wordcount, advlist, autolink, lists, link, image, charmap, print, preview, hr, anchor pagebreak searchreplace wordcount, visualblocks, visualchars, fullscreen, insertdatetime, media, nonbreaking, save, table, contextmenu, directionality, emoticons, paste, textcolor, colorpicker, textpattern',
//toolbar: 'undo redo | styleselect | bold italic  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote charmap| forecolor backcolor emoticons | table | link image media |  code preview sh4tinymce wordcount',
 contextmenu: "link image inserttable | cell row column deletetable",
  codemirror: {
    indentOnInit: true,
    path: 'codemirror-4.8',
    config: {
      lineNumbers: true       
    }
  },
toolbar1: "undo redo bold italic underline alignleft aligncenter alignright alignjustify bullist numlist outdent indent table blockquote charmap code sh4tinymce preview",
toolbar2: "fontselect fontsizeselect styleselect link unlink emoticons insertdatetime image media forecolor backcolor fullscreen",
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


/* ------------------- MODAL IMAGES --------------------- */
function openKCFinder(div) {
    $('#modal-id').modal('show');
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



oTable = $('#swtable').dataTable({
    "sAjaxSource": "./sw-mod/page/datatable.php",
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
        $(".setactive").click(function(){
            var id = $(this).attr("data-id");
            var active = $("#seth"+id).attr("data-active");
            if(active == "Y"){
            var dataactive = "N";
            }else{
            var dataactive = "Y";
            }
            var modul = 'page';
            var aksi = 'setactive';
            var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
            $("#seth"+id).html("waiting");
            $.ajax({
                type: "POST",
                url: "sw-mod/page/proses.php",
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

$('#tiny-text').click(function (e) {
    e.stopPropagation();
    tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'swEditorText');
});

$('#tiny-visual').click(function (e) {
    e.stopPropagation();
    tinymce.EditorManager.execCommand('mceAddEditor',true, 'swEditorText');
});


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
