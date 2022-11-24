<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/$mod/proses.php";
 $post_title='';
 $seotitle='';
 $post_keyword=''; $post_description=''; 
 $images='';$post_content='';$message='';
if(!empty($_SESSION['post_title'])){$post_title=$_SESSION['post_title'];}
if(!empty($_SESSION['seotitle'])){$seotitle=$_SESSION['seotitle'];}
if(!empty($_SESSION['post_description'])){$post_description=$_SESSION['post_description'];}
if(!empty($_SESSION['images'])){$images =$_SESSION['images'];}
if(!empty($_SESSION['post_content'])){$post_content=$_SESSION['post_content'];}
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}

$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='7' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);
if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);
//============ session KCFINDER ======================
$_SESSION['KCFINDER']['uploadURL'] = "../../../sw-content/blog/";
?>


<?php switch(@$_GET['op']){ 
    default:?>
<?php  echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-table"></i>'._e('Post Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Post Management').'</li>
</ul>

<div class="block full">
<div class="block-title">
<h2>'._e('Post Management').'</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
<a href="?mod=post&op=add" class="btn btn-sm btn-default enable-tooltip" title="'._e('Add').'"><i class="fa fa-plus"></i></a>
</div>
</div></div>';

if($read_access == 'Y'){
echo'
<div class="table-responsive">
<form id="form-multi" method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="post" readonly>
<input type="hidden" name="aksi" value="multidelete" readonly>
<table id="sigerTable" class="table table-vcenter table-condensed">
    <thead>
        <tr>
            <th class="text-center"><i class="fa fa-check-circle-o"></i></th>
            <th>'._e('Title').'</th>
            <th>'._e('Tag').'</th>
            <th>'._e('Date').'</th>
            <th class="text-center">'._e('Actions').'</th>
        </tr>
    </thead>
    <tfoot>
<tr>
    <td style="width:80px;" class="text-center"><input type="checkbox" id="titleCheck" data-toggle="tooltip" title="" /></td>
    <td colspan="4">';
  if($delete_access == 'Y'){
    echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#modal-deleted"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';}
    else {
 echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#akses"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';
    }
    echo'</td>
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
</div>

</form>
<!-- end:table -->';
} else {
    echo'
    <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}
echo'

<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> </i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> '._e('Delete').'</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div></div>';?>

<?PHP break; case "add": ?>
<?php echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-notes_2"></i>'._e('Post Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="?mod=post">'._e('Post Management').'</a></li>
        <li>'._e('Add New').'</li>
</ul>';?>

<?PHP if($write_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<i class="fa fa-close close" data-dismiss="alert"></i>'.$message.'</div>

<form  method="post" id="validate" action="'.$gotoprocess.'" autocomplete="of">
<div class="block full">
<div class="form-group">
<label>'._e('Post Title').'</label>
<input type="text" id="title-1" name="post_title" class="required form-control" placeholder="Masukkan Judul" value="'.$post_title.'" required>
<input type="hidden" name="seotitle" id="seotitle" value="'.$seotitle.'" required>
<small class="text-primary">';
if($seotitle ==''){
echo'<i>Permalink : '.$sub_url.'/<span id="permalink"></span>.html</i>';}
else{
echo'<i>Permalink : '.$sub_url.'/<span id="permalink">'.$seotitle.'</span>.html</i>';
}
echo'</small>
</div>
<hr>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="form-group">
<label>'._e('Category').'</label>
<div id="selectcatdata">
<select class="required select-chosen" name="post_category" style="width:100%!important;" data-placeholder="Pilih Kategori" required>';
$query="SELECT title,seotitle from category  where type='2' order by title asc"; 
$result = $connection->query($query) or die($connection->error.__LINE__);
 while($row = $result->fetch_assoc()) { 
$categories = strip_tags($row['title']);
$seotitle = strip_tags($row['seotitle']);
echo "<option value='$seotitle'>$categories</option>";}
echo'
</select>
</div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    <div class="form-group">
<a id="tbladdcat" class="btn mtop-25 btn-sm btn-complete"><i class="fa fa-plus"></i></a>
    </div>
</div>
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="form-group">
<label>'._e('Tags').'</label>
<div id="selecttagdata">
<select class="required select-chosen" name="post_tags[]" multiple tabindex="4" data-placeholder="Pilih Tags" style="width:100%;" required>';
$query_tags ="SELECT title,seotitle from tags  where type='2' order by title asc";  
$result_tags = $connection->query($query_tags) or die($connection->error.__LINE__);
 while($row_tags = $result_tags->fetch_assoc()) { 
$tags = $row_tags['title'];
$tagsseo = $row_tags['seotitle'];
echo "<option value='$tagsseo'>$tags</option>";}
echo'
</select>
</div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    <div class="form-group">
        <a id="tbladdtag" class="btn mtop-25 btn-sm btn-complete"><i class="fa fa-plus"></i></a>
    </div>
</div>
</div>  
</div>  
</div>
<hr>
<div class="form-group">
<label>'._e('Description Post').'</label>
<textarea name="post_description" class="required form-control" style="min-height:89px;max-height:100px;" required>'.$post_description.'</textarea>
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
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="insert">
<br>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="label-control"><i class="fa fa-paper-plane-o"></i> <span class="text-success" id="stat">Publish</span></label> 
<a id="edit_publish" style="cursor:pointer" class="label label-info">EDIT</a>

<div class="row publish" style="display:none">
<div class="col-md-6">
<select class="form-control" id="select-stat" data-init-plugin="select2" name="post_status" style="width:100%">
<option value="2">Draft</option>
<option value="1" selected>Publish</option>
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
<textarea class="required form-control" id="swEditorText" name="post_content" style="height:380px;" required>'.$post_content.'</textarea>
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
</form>';}
else{
  echo'  <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}
echo'
<!-- modal kategory -->

    <div id="modaladdext" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="form-validation" class="addnewext" method="post" action="#" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modul" name="modul" value="post">
                        <input type="hidden" id="aksi" name="aksi" value="">
                        <div class="form-group">
                            <label id="labelmodal"></label>
                            <div id="titlebox">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title Here" required></div>
                            <div id="tagbox">
                            <input type="text" id="tag" name="tag" class="input-tags" placeholder="Enter Title Here" required><p><i>Dapat memasukan lebih dari satu tag (,)</i></p></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnsubmitext" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> '._e('Save').'</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';?>

<?php break; case "edit":?>
<?php echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-notes_2"></i>'._e('Post Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="?mod=post">'._e('Post Management').'</a></li>
        <li>Edit</li>
</ul>';

if($modify_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<i class="fa fa-close close" data-dismiss="alert"></i>'.$message.'</div>';
if(!empty($_GET['post'])){
$post=  mysqli_real_escape_string($connection,epm_decode($_GET['post'])); 
$update = "SELECT * FROM post WHERE post_id='$post'";
$result_update = $connection->query($update) or die($connection->error.__LINE__);
if($result_update->num_rows > 0){
 while($rows= $result_update->fetch_assoc()){
extract($rows);
$post_content = htmlentities($rows['post_content']);
$jumlah_tags = substr_count($post_tags,",");
$post_tags = explode(',',$post_tags);
echo'
<form  method="post" id="validate" action="'.$gotoprocess.'?id='.$post_id.'" autocomplete="of">
<input type="hidden" name="modul" value="post" readonly>
<input type="hidden" name="aksi" value="update" readonly>
<input type="hidden" name="post_id" value="'.$post_id.'" readonly>

<div class="block full">
<div class="form-group">
<label>'._e('Post Title').'</label>
<input type="text" id="title-1" name="post_title" class="required form-control" placeholder="Masukkan Judul" value="'.$post_title.'" required>
<input type="hidden" name="seotitle" id="seotitle" value="'.$seotitle.'" required>
<small class="text-primary">';
if($seotitle ==''){
echo'<i>Permalink : '.$sub_url.'/<span id="permalink"></span>.html</i>';}
else{
echo'<i>Permalink : '.$sub_url.'/<span id="permalink">'.$seotitle.'</span>.html</i>';
}
echo'
</small>
</div>
<hr>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="form-group">
<label>'._e('Category').'</label>
<div id="selectcatdata">
<select class="required select-chosen" name="post_category" style="width:100%;" data-placeholder="Pilih Kategori" required>';
$query="SELECT title,seotitle from category  where type='2' order by title asc"; 
$result = $connection->query($query) or die($connection->error.__LINE__);
 while($row = $result->fetch_assoc()) { 
$cat_title = strip_tags($row['title']);
$cat_seo = strip_tags($row['seotitle']);
if($cat_seo == $post_category){
echo "<option value='$cat_seo' selected>$cat_title</option>";} 
else {
 echo "<option value='$cat_seo'>$cat_title</option>";   
}}
echo'
</select></div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    <div class="form-group">
<a id="tbladdcat" class="btn mtop-25 btn-sm btn-complete"><i class="fa fa-plus"></i></a>
    </div>
</div>
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="form-group">
<label>'._e('Tags').'</label>
<div id="selecttagdata">
<select class="required select-chosen" name="post_tags[]" multiple tabindex="4" data-placeholder="Pilih Tags" style="width:100%;" required>';
$j_tags=0;while($j_tags<= $jumlah_tags){
$title_tags = str_replace('-',' ',$post_tags["$j_tags"]);
$title_tags=ucfirst($title_tags);
echo "<option selected value='$title_tags'>$title_tags</option>";
$disabled ="post_tags!=$title_tags";$j_tags++;}
$query_tags ="SELECT title,seotitle from tags  where type='2' order by title asc";  
$result_tags = $connection->query($query_tags) or die($connection->error.__LINE__);
 while($row_tags = $result_tags->fetch_assoc()) { 
$tags =$row_tags['title'];
$tagsseo = $row_tags['seotitle'];
echo "<option value='$tagsseo'>$tags</option>";}
echo'
</select></div>
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    <div class="form-group">
<a id="tbladdtag" class="btn mtop-25 btn-sm btn-complete"><i class="fa fa-plus"></i></a>
    </div>
</div>
</div>  
</div>  
</div>
<hr>
<div class="form-group">
<label>'._e('Description Post').'</label>
<textarea name="post_description" class="required form-control" style="min-height:89px;max-height:100px;" required>'.$post_description.'</textarea>
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
<br>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="label-control"><i class="fa fa-paper-plane-o"></i>
<span class="text-success" id="stat">';
        if($post_status=='1'){echo'Publish';}else{echo'Draft';}
echo'</span></label> 
<a id="edit_publish" style="cursor:pointer" class="label label-info">EDIT</a>

<div class="row publish" style="display:none">
<div class="col-md-6">
<select class="form-control" id="select-stat" data-init-plugin="select2" name="post_status" style="width:100%">';
if($post_status=='2'){echo'<option value="2" selected>Draft</option>';}
else{echo'<option value="2">Draft</option>';}
if($post_status=='1'){echo'<option value="1" selected>Publish</option>';}
else{echo'<option value="1">Publish</option>';}
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
<textarea class="required form-control" id="swEditorText" name="post_content" style="height:380px;" required>'.$post_content.'</textarea>
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
</form>';
echo'
<!-- modal kategory -->

    <div id="modaladdext" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="form-validation" class="addnewext" method="post" action="#" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modul" name="modul" value="post">
                        <input type="hidden" id="aksi" name="aksi" value="">
                        <div class="form-group">
                            <label id="labelmodal"></label>
                            <div id="titlebox">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title Here" required></div>
                            <div id="tagbox">
                            <input type="text" id="tag" name="tag" class="input-tags" placeholder="Enter Title Here" required><p><i>Dapat memasukan lebih dari satu tag (,)</i></p></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnsubmitext" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> '._e('Save').'</button>
                    </div>
                </form>
            </div>
        </div></div>
    </div>';
    }} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}}
}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}
break;
 }}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}

 echo'
<!-- Modal akses -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> Hapus Item</h4></div>
<div class="modal-body">
<p>Anda tidak memiliki hak akses.!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div></div></div></div>';} ?>