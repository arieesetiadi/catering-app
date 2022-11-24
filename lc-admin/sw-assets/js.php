 <script src="sw-assets/js/plugins.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="sw-assets/js/menu/ferromenu.js"></script>
<script src="sw-assets/js/jquery.growl.js"></script>
 <script src="sw-assets/js/highcharts.js"></script>
 <script src="sw-assets/js/jquery.nestable.js"></script>
<script src="sw-assets/js/angular.min.js" type="text/javascript"></script>
<script src="sw-assets/js/ui-bootstrap-tpls-0.10.0.min.js"></script>
            <script src="plugins/validasi/jquery.validate.js"></script> 
            <script src="plugins/validasi/messages_id.js"></script>
      
<?php
if ($mod == "theme" OR $mod == "setting" OR $mod == "layout"){ ?>
<script src="sw-assets/js/codemirror/lib/codemirror.js"></script>
<script src="sw-assets/js/codemirror/addon/fold/xml-fold.js"></script>
<script src="sw-assets/js/codemirror/addon/edit/matchtags.js"></script>
<script src="sw-assets/js/codemirror/addon/edit/closetag.js"></script>
<script src="sw-assets/js/codemirror/addon/edit/closebrackets.js"></script>
<script src="sw-assets/js/codemirror/addon/selection/active-line.js"></script>
<script src="sw-assets/js/codemirror/addon/display/fullscreen.js"></script>
<script src="sw-assets/js/codemirror/addon/hint/show-hint.js"></script>
<script src="sw-assets/js/codemirror/addon/hint/xml-hint.js"></script>
<script src="sw-assets/js/codemirror/addon/hint/html-hint.js"></script>
<script src="sw-assets/js/codemirror/addon/dialog/dialog.js"></script>
<script src="sw-assets/js/codemirror/addon/search/searchcursor.js"></script>
<script src="sw-assets/js/codemirror/addon/search/search.js"></script>
<script src="sw-assets/js/codemirror/mode/clike/clike.js"></script>
<script src="sw-assets/js/codemirror/mode/css/css.js"></script>
<script src="sw-assets/js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="sw-assets/js/codemirror/mode/javascript/javascript.js"></script>
<script src="sw-assets/js/codemirror/mode/php/php.js"></script>
<script src="sw-assets/js/codemirror/mode/xml/xml.js"></script>

<?php } ?>

<?php
if(!empty($_GET['op'])){
$op= htmlentities(@$_GET['op']);
if ($mod == "message" and $op == "edit-theme"){ ?>
<script src="sw-assets/js/codemirror/lib/codemirror.js"></script>
<script src="sw-assets/js/codemirror/addon/fold/xml-fold.js"></script>
<script src="sw-assets/js/codemirror/addon/edit/matchtags.js"></script>
<script src="sw-assets/js/codemirror/addon/edit/closetag.js"></script>
<script src="sw-assets/js/codemirror/addon/edit/closebrackets.js"></script>
<script src="sw-assets/js/codemirror/addon/selection/active-line.js"></script>
<script src="sw-assets/js/codemirror/addon/display/fullscreen.js"></script>
<script src="sw-assets/js/codemirror/addon/hint/show-hint.js"></script>
<script src="sw-assets/js/codemirror/addon/hint/xml-hint.js"></script>
<script src="sw-assets/js/codemirror/addon/hint/html-hint.js"></script>
<script src="sw-assets/js/codemirror/addon/dialog/dialog.js"></script>
<script src="sw-assets/js/codemirror/addon/search/searchcursor.js"></script>
<script src="sw-assets/js/codemirror/addon/search/search.js"></script>
<script src="sw-assets/js/codemirror/mode/clike/clike.js"></script>
<script src="sw-assets/js/codemirror/mode/css/css.js"></script>
<script src="sw-assets/js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="sw-assets/js/codemirror/mode/javascript/javascript.js"></script>
<script src="sw-assets/js/codemirror/mode/php/php.js"></script>
<script src="sw-assets/js/codemirror/mode/xml/xml.js"></script>

<?php }}?>

<script src="sw-assets/js/app.js"></script>

<?php if(file_exists("sw-mod/$mod/script.js")){?>
<script src="sw-mod/<?PHP echo $mod?>/script.js"></script>
<?php } ?>
<script type="text/javascript">
$(document).ready(function() {
$("#validate").validate();
});

 function PreviewImage(no) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
        };
    }


/********************************
kostum input file
********************************/

$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            document.getElementById("value").innerHTML =log;
            //if( log ) alert(log);
        }
        
    });
});

</script>

        <script type="text/javascript">
        $('#hapus').on('show.bs.modal', function(e) {
    $(this).find('#btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

        $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.multicheck').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "multicheck"               
            });
        }else{
            $('.multicheck').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "multicheck"                       
            });         
        }
    });
    
}); 
 </script>

<script>
    $("#klikTheme").click(function(){
      var themecolor = $("#klikTheme").attr("data-theme");
      var modul = 'home';
      var aksi =  'themecolor';
      var dataString = 'themecolor='+ themecolor + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/home/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
         $("#klikTheme").html();
        }
      });
      return false;
    });
</script>