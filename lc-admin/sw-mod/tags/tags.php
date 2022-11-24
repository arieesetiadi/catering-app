<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/$mod/proses.php";
$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='40' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);

if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);

$message='';
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}
switch(@$_GET['op']){ 
    default:?>
    <?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-book"></i>'._e('Tag Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Tag Management').'</li>
</ul>';

 if($read_access =='Y'){
  echo'
<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>

<div class="block full">
<div class="block-title">
<h2>'._e('Tag Management').'</h2>
  <div class="block-options pull-right">
      <div class="btn-group btn-group-sm">
<a href="#addCategory" class="btn btn-sm btn-default enable-tooltip" title="Tambah" data-toggle="modal"><i class="fa fa-plus"></i></a>
      </div>
  </div>
</div>


<div class="table-responsive">
<form id="validate" name="form1" method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="'.$mod.'" readonly>
<input type="hidden" name="aksi" value="multidelete" readonly>
<table id="sw-cms" class="table table-vcenter table-condensed">
<thead>
<tr>
  <th class="text-center"><i class="fa fa-check-circle-o"></i></th>
  <th>'._e('Title').'</th>
  <th>'._e('Title Seo').'</th>
  <th width="8%">'._e('Actions').'</th>
</tr>
</thead>
<tbody>';
$query="SELECT tags_id,title,seotitle from tags where type='1' order by tags.tags_id DESC";
$result = $connection->query($query) or die($conn->error.__LINE__);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
extract($row);
echo'<tr>
<td style="width:80px;">
<div class="text-center">
<input class="multicheck" type="checkbox" name="item[]" value="'.$tags_id.'">
</div>
</td>
<td>'.$title.'</td>
<td>'.$seotitle.'</td>
<td>
<div class="btn-group btn-group-xs">
<a href="#edit_form" class="btn btn-xs btn-default enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('title').value='<?PHP echo $title;?>';getElementById('id').value='<?PHP echo $tags_id;?>';"><i class="fa fa-pencil"></i></a>
<?PHP if($delete_access == 'Y'){
  echo'
<a href="javascript:void(0)" data-href="'.$gotoprocess.'?id='.$tags_id.'&aksi=delete" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';}
else {
    echo'
<a href="javascript:void(0)" data-toggle="modal" data-target="#akses" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';
}echo'
</div>
</td>
</tr>';}}
echo'
<tfoot>
<tr>
<td style="width:80px;" class="text-center">
<input type="checkbox" id="selecctall" data-toggle="tooltip" title="Select All"/>
</td>
<td colspan="3">';
if($delete_access == 'Y'){
    echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#modal-deleted"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';}
    else {
 echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#akses"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';
    }echo'
</td>
</tr>
</tfoot>

</tbody>
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
</div></div>

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

// tambah tag
if($read_access == 'Y'){
  echo'
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form id="validate" class="form" method="post" action="'.$gotoprocess.'">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">'._e('Add New Tag').'</h3>
            </div>
            <div class="modal-body">
              <input type="hidden" name="modul" value="'.$mod.'" readonly>
              <input type="hidden" name="aksi" value="add" readonly>
              <div class="form-group">
                <label>'._e('Title').'</label>
                <input class="form-control" type="text" name="title" placeholder="Tags baru" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-check"></i> '._e('Save').'</button>
            </div>
          </form>
        </div>
      </div>
    </div>';}

if($modify_access =='Y'){
  echo'
<!-- edir form -->
<div id="edit_form" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form id="validate" method="post" action="'.$gotoprocess.'">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">'._e('Edit Tags').'</h3>
            </div>
            <div class="modal-body">
            <input type="hidden" id="id" name="id" value="" readonly>
              <input type="hidden" name="modul" value="'.$mod.'" readonly>
               <input type="hidden" name="aksi" value="edit" readonly>
              <div class="form-group">
                <label>'._e('Title').'</label>
                <input id="title" class="required form-control" type="text" name="title" value="" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-info">
              <i class="fa fa-check"></i> '._e('Save').'</button>
            </div>
          </form>
        </div>
      </div>
    </div>';}

  }else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
    }?>
<?php break; } }else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}
echo'<!-- Modal akses -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>Anda tidak memiliki hak akses.!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>';}
