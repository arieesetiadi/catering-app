<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/$mod/proses.php";
$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='13' AND level_id='$level_user'"; 
if($result_role->num_rows > 0){

$result_role = $connection->query($query_role);
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);
 $title='';
 $seotitle='';
 $page_keyword=''; $page_description=''; 
 $images='';$content='';$message='';
if(!empty($_SESSION['title'])){$title=$_SESSION['title'];}
if(!empty($_SESSION['seotitle'])){$seotitle=$_SESSION['seotitle'];}
if(!empty($_SESSION['page_keyword'])){$page_keyword=$_SESSION['page_keyword'];}
if(!empty($_SESSION['page_description'])){$page_description=$_SESSION['page_description'];}
if(!empty($_SESSION['images'])){$images =$_SESSION['images'];}
if(!empty($_SESSION['content'])){$content=$_SESSION['content'];}
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}

//============ session KCFINDER ======================
$_SESSION['KCFINDER']['uploadURL'] = "../../../sw-content/pages/";

switch(@$_GET['op']){ default: ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-book"></i>'._e('Page Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Page Management').'</li>
</ul>';

if($write_access =='Y'){
    echo'
<div class="block full">
<div class="block-title">
<h2>'._e('Page Management').'</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
<a href="?mod=page&op=add" class="btn btn-sm btn-default enable-tooltip" title="'._e('Add').'"><i class="fa fa-plus"></i></a>
</div>
</div>
</div>

<div class="table-responsive">
            <form id="form-multi" method="post" action="<?=$gotoprocess?>">
            <input type="hidden" name="modul" value="page">
            <input type="hidden" name="aksi" value="multidelete">
            <input type="hidden" value="0" name="totaldata" id="totaldata">
            <table id="swtable" class="table table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center">
                        <i class="fa fa-check-circle-o"></i></th>
                        <th>'._e('Title').'</th>
                        <th class="text-center">'._e('Active').'</th>
                        <th class="text-center">'._e('Action').'</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td style="width:80px;" class="text-center">
                        <input type="checkbox" id="titleCheck" data-toggle="tooltip" title="Select All" /></td>
                        <td colspan="3">';
if($delete_access == 'Y'){
    echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#modal-deleted"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';}
    else {
 echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#akses"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';
    }echo'
                        </td>
                    </tr>
                </tfoot>
            </table>

<!-- multi deleted -->
<div class="modal fade" id="modal-deleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> '._e('Delete').'</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>

            </form>
        </div>
    </div>
    
<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> '._e('Delete').'</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>';
}
else{
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}?>


<!-- new -->
<?php break; case 'add': ?>
<?PHP
echo'
    <div class="content-header">
        <div class="header-section">
            <h1><i class="gi gi-book"></i>'._e('Page Management').'<br></h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="./"><i class="fa fa-home"></i>'._e('Dashboard').'</a></li>
        <li><a href="?mod=page">'._e('Page Management').'</a></li>
        <li>'._e('Add New').'</li>
    </ul>';
if($read_access =='Y'){
    echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';

echo'<form id="validate" method="post" action="'.$gotoprocess.'" autocomplete="of">
<input type="hidden" name="modul" value="'.$mod.'" readonly>
<input type="hidden" name="aksi" value="add" readonly>
<div class="block full">
<div class="form-group">
<label>'._e('Title').'</label>
<input type="text" id="title-1" name="title" class="required form-control" placeholder="Masukkan Judul" value="'.$title.'" required>
<input type="hidden" name="seotitle" id="seotitle" value="'.$seotitle.'" required>
<small class="text-primary">';
if($seotitle ==''){
echo'<i>Permalink : '.$sub_url.'/pages/<span id="permalink"></span>.html</i>';}
else{
echo'<i>Permalink : '.$sub_url.'/pages/<span id="permalink">'.$seotitle.'</span>.html</i>';
}
echo'</small>
</div>
<hr>
<div class="form-group">
<label>'._e('Description Post').'</label>
<textarea name="page_description" class="required form-control" style="min-height:89px;max-height:100px;" required>'.$page_description.'</textarea>
</div>
<hr>

<div class="modal fade" id="modal-id">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">File Manager</h4>
      </div>
       <div id="kcfinder_1"></div>
    </div>
  </div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<div class="upload-media" onclick="openKCFinder(this)" title="Unggah Gambar" style="background:';if($images== NULL){echo'#fff';}else {echo'url(../timthumb?src='.$images.'&h=70&w=70)';}echo'; no-repeat center center;">';
if($images== NULL){echo'<img src="./sw-assets/img/media.png">';}
else {echo'<img class="images" src="./sw-assets/img/media.png">';}
echo'
</div>
</div>
</div>
</div>
<input type="hidden" name="images" id="inputgambar" class="required" value="'.$images.'" readonly required>
<br/>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="label-control"><i class="fa fa-paper-plane-o"></i> <span class="text-success" id="stat">Publish</span></label> 
<a id="edit_publish" style="cursor:pointer" class="label label-info">EDIT</a>

<div class="row publish" style="display:none">
<div class="col-md-6">
<select class="form-control" data-init-plugin="select2" name="active" style="width:100%">
<option value="N">Draft</option>
<option value="Y" selected>Publish</option>
</select>
</div>

<div class="col-md-6">
<a class="btn btn-sm btn-info" id="confirm_ok">Ok</a>
<a class="btn btn-sm btn-default close_publish_au">Cancel</a>
</div>
</div>
</div></div>

<div class="col-md-6">
<div class="form-group">
<div class="pull-right">
<div class="input-group">
<span class="btn-group">
<a class="btn btn-info" id="tiny-visual"><i class="fa fa-file-text"></i> Visual</a>
<a class="btn btn-info" id="tiny-text"><i class="fa fa-code"></i> Text</a>
</span>
</div></div></div>
</div>
</div>
<textarea class="required form-control" id="swEditorText" name="page_content" style="height:380px;" required>'.$content.'
</textarea>
<hr>
<div class="form-group form-actions">
<div class="row">
<div class="col-md-9">
<button type="submit" class="btn btn-block btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>
</div>
<div class="col-md-3">
<button type="button" class="btn btn-block btn-warning" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
</div>
</div>

</div>
</div>
</form>';} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}
?>


<!-- edit ==================================================== -->
<?php break; case 'edit': ?>
<?PHP echo'<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-book"></i>'._e('Page Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="?mod=page">'._e('Page Management').'</a></li>
<li>'._e('Edit').'</li>
</ul>';
if($modify_access == 'Y'){
    echo'
<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';

if(!empty($_GET['page'])){
$page=  mysqli_real_escape_string($connection,$_GET['page']); 
$update = "SELECT * FROM page WHERE page_id='$page'";
$result_update = $connection->query($update) or die($connection->error.__LINE__);
if($result_update->num_rows > 0){
 while($rows= $result_update->fetch_assoc()){
extract($rows);
$page_content = htmlentities($rows['page_content']);

echo'
<form id="validate" method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="page" readonly>
<input type="hidden" name="aksi" value="edit" readonly>
<input type="hidden" name="id" value="'.$page_id.'" readonly>
<div class="block full">
<div class="form-group">
<label>'._e('Title').'</label>
<input type="text" id="title-1" name="title" class="required form-control" placeholder="Masukkan Judul" value="'.$title.'" required>
<input type="hidden" name="seotitle" id="seotitle" value="'.$seotitle.'" required>
<small class="text-primary">';
if($seotitle ==''){
echo'<i>Permalink : '.$sub_url.'/pages/<span id="permalink"></span>.html</i>';}
else{
echo'<i>Permalink : '.$sub_url.'/pages/<span id="permalink">'.$seotitle.'</span>.html</i>';
}
echo'</small>
</div>
<hr>
<div class="form-group">
<label>'._e('Description Post').'</label>
<textarea name="page_description" class="required form-control" style="min-height:89px;max-height:100px;" required>'.$page_description.'</textarea>
</div>
<hr>
<div class="modal fade" id="modal-id">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">File Manager</h4>
      </div>
       <div id="kcfinder_1"></div>
    </div>
  </div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<div class="upload-media" onclick="openKCFinder(this)" title="Unggah Gambar" style="background:';if($images== NULL){echo'#fff';}else {echo'url(../timthumb?src='.$images.'&h=70&w=70)';}echo'; no-repeat center center;">';
if($images== NULL){echo'<img src="./sw-assets/img/media.png">';}
else {echo'<img class="images" src="./sw-assets/img/media.png">';}
echo'
</div>
</div>
</div>
</div>
<input type="hidden" name="images" id="inputgambar" class="required" value="'.$images.'" readonly required>
<br/>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="label-control"><i class="fa fa-paper-plane-o"></i> <span class="text-success" id="stat">';
if($active=='Y'){
echo'Publish';}
else{echo'Draft';}
echo'</span></label> 
<a id="edit_publish" style="cursor:pointer" class="label label-info">EDIT</a>

<div class="row publish" style="display:none">
<div class="col-md-6">
<select class="form-control" data-init-plugin="select2" name="active" style="width:100%">';
if($active=='N'){echo'<option value="N" selected>Draft</option>';}
else{
echo'<option value="N">Draft</option>';
}
if($active=='Y'){echo'<option value="Y" selected>Publish</option>';}
else{
echo'<option value="Y">Publish</option>';
}
echo'
</select>
</div>

<div class="col-md-6">
<a class="btn btn-sm btn-info" id="confirm_ok">Ok</a>
<a class="btn btn-sm btn-default close_publish_au">Cancel</a>
</div>
</div>
</div></div>

<div class="col-md-6">
<div class="form-group">
<div class="pull-right">
<div class="input-group">
<span class="btn-group">
<a class="btn btn-info" id="tiny-visual"><i class="fa fa-file-text"></i> Visual</a>
<a class="btn btn-info" id="tiny-text"><i class="fa fa-code"></i> Text</a>
</span>
</div></div></div>
</div>
</div>
<textarea class="required form-control" id="swEditorText" name="page_content" style="height:380px;" required>';
if($content !==''){echo $content;}else{echo $page_content;}
echo'
</textarea>
<hr>
<div class="form-group form-actions">
<div class="row">
<div class="col-md-9">
<button type="submit" class="btn btn-block btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>
</div>
<div class="col-md-3">
<button type="button" class="btn btn-block btn-warning" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
</div>
</div>

</div>
</div>
</form>
    </form>';}} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}}
} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}
?>

<?php break;  }
}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}}
