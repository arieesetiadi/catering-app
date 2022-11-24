<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess="sw-mod/$mod/proses.php";
$config = get_parse_ini('../sw-library/config.ini.php');
require_once '../sw-library/ini.php';

$query_role="SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='26' AND level_id='$level_user'"; 
if($result_role->num_rows > 0){
$result_role = $connection->query($query_role);
$rows_akses = $result_role->fetch_assoc();
extract($rows_akses);
 $slider_url='';
 $description_2='';
 $description_3='';
 $button_name=''; 
 $slider_url='';
 $message='';
if(!empty($_SESSION['slider_url'])){$slider_url=$_SESSION['slider_url'];}
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}
switch(@$_GET['op']){ default: ?>
  <style>
ul {
  padding:0px;
  margin: 0px;
}
#list-main li {
  margin:auto;
  display: table; width:100%;
  list-style: none;
  cursor:move;
}

#list-main li .table tr td{
  padding:10px 10px!important;
}
#list-main .thumbnail{
  margin-bottom: 0px!important;
}
</style>

<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="fa fa-picture-o"></i>'._e('Slider Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Slider Management').'</li>
</ul>';

if($write_access =='Y'){
    echo'
<div class="block full">
  <div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fa fa-times-circle"></i> '.$message.'</div>';
echo'
<div class="block-title">
<h2>'._e('Slider Management').'</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
<a href="#setting" class="btn btn-sm btn-default enable-tooltip" title="Setelan Slider" data-toggle="modal"><i class="fa fa-gears"></i> Setting</a>
    <a href="#add" class="btn btn-sm btn-default enable-tooltip" title="Tambah" data-toggle="modal"><i class="fa fa-plus"></i></a>
</div>
</div>
</div>

<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	Silahkan Lakukan penyetelan Ukuran gambar jika belum sesuai, Unggah Gambar harus format JPG,JPEG dengan ukuran Lebar : <label class="label label-warning">'.$slider_width.'px</label> x Tinggi : <label class="label label-warning">'.$slider_height.'px</label>, Silahkan drag and drop untuk memindahkan posisi slider.
</div>
<div class="table-responsive">
<table  class="table table-vcenter table-condensed">
<thead>
<tr>
  <th class="text-left" width="140">'._e('Photo').'</th>
  <th class="text-left" width="240">'._e('Url Slider').'</th>
  <th width="8%" class="text-center">'._e('Actions').'</th>
</tr>
</thead>
</table>

<div id="response" class="alert alert-success alert-dismissable" style="display:none">
</div>';

echo'<div id="list-main">
  <div class="table-responsive"><ul>';
$query="SELECT * from slider order by  position ASC";
$result=$connection->query($query) or die($connection->error.__LINE__);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
extract($row);
if($row['active']=='Y'){
            $active="<button type='button' id='set$row[id]' data-id='$row[id]' class='btn btn-xs btn-success setactive' data-active='$row[active]'><i class='fa fa-eye'></i> Active</button>";
        }else{
            $active="<button type='button' id='set$row[id]' data-id='$row[id]' class='btn btn-xs btn-danger setactive' data-active='$row[active]'><i class='fa fa-eye-slash'></i> Deactive</button>";
        }

  echo'<li id="arrayorder_'.$id.'">
        <table class="table table-striped table-vcenter table-bordered">
        <tbody>
          <tr>
         <td width="80" class="sm-hidden text-center">';
        if($photo ==NULL){
        echo'
        <img src="./sw-assets/img/noimages.jpg" class="thumbnail" oncontextmenu="return false;" width="60" height="60">';}
        else {
        echo'
        <img src="../timthumb?src='.$site_url.'/sw-content/slider/'.$photo.'&h=60&w=60" alt="avatar" class="thumbnail" oncontextmenu="return false;">';
        }echo'
        </td>
              <td width="240">'.$slider_url.'</td>
          <td class="text-center" width="100">
            <div class="btn-group">
            '.$active.'
          <a href="#edit" class="btn btn-xs btn-default enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('url').value='<?PHP echo $slider_url;?>';getElementById('id').value='<?PHP echo $id;?>';"><i class="fa fa-pencil"></i></a>
          <?php 
            if($delete_access == 'Y'){
          echo'
        <a href="javascript:void(0)" data-href="'.$gotoprocess.'?id='.$id.'&aksi=delete" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';} else {
          echo'
        <a href="javascript:void(0)" data-toggle="modal" data-target="#akses" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';
        }echo'
        </div>
        </td>
          </tr>
        </tbody>
        </table>
      </li>';}}
echo'</ul>
</div>
</form>
</div></div>

<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-warning"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> '._e('Delete').'</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>';
}

if($write_access =='Y'){
  echo'
<div id="setting" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form name="form" id="validate" class="form" method="post" action="'.$gotoprocess.'">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">Setelan Slider</h3>
            </div>
            <div class="modal-body">
              <input type="hidden" name="modul" value="'.$mod.'" readonly>
              <input type="hidden" name="aksi" value="setting" readonly>
              <div class="form-group">
                <label>'._e('Url Slider').'</label>
                <div class="input-group">
                      <input type="text" name="slider_width" class="form-control text-center" placeholder="Width" value="'.$slider_width.'">
                      <span class="input-group-addon">X</span>
                      <input type="text"  name="slider_height" class="form-control text-center" placeholder="Height" value="'.$slider_height.'">
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-check"></i> '._e('Save').'</button>
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>';
  }
else{
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}?>

<?php  if($write_access =='Y'){
  echo'
<div id="add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="validate" class="form" method="post" action="'.$gotoprocess.'" enctype="multipart/form-data">
        <input type="hidden" name="modul" value="'.$mod.'" readonly>
        <input type="hidden" name="aksi" value="add" readonly>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">'._e('Add Slider').'</h3>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>'._e('Url Slider').'</label>
                <input class="form-control" type="text" name="slider_url" placeholder="Url" value="'.$slider_url.'" required>
                <small>Masukkan Link Promo/Blog, Jika tidak ada beri tanda pagar(#)</small>
              </div>
        <hr>
      <div class="form-group">
        <label>'._e('Photo').'</label>
          <div class="input-group">
              <span class="input-group-btn">
              <span class="btn btn-primary btn-file"><i class="fa fa-camera"></i> Upload
                <input type="file" class="upload" name="photo" accept=".jpg, .jpeg"/>
              </span></span><input type="text" class="form-control" placeholder="Upload gambar dengan format png,jpg" readonly>
          </div>
            <br>
              <div class="alert alert-warning fade in">Perhatikan sebelum upload berkas atau gambar, gambar harus format JPEG,JPG. File berukuran maksimal 1MB Lebar: '.$slider_width.' x  Tinggi: '.$slider_height.' pixel 
              </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-check"></i> '._e('Save').'</button>
            </div>
          </form>
        </div>
      </div>
</div>';
  }else {
echo'
    <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
  }
?>


<?php 
if($modify_access == 'Y'){
 echo'
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <form id="validate" class="form" method="post" action="'.$gotoprocess.'" enctype="multipart/form-data">
        <input type="hidden" name="modul" value="'.$mod.'" readonly>
        <input type="hidden" name="aksi" value="edit" readonly>
        <input type="hidden" id="id" name="id" value="" readonly>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">'._e('Edit Slider').'</h3>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>'._e('Url Slider').'</label>
                <input class="form-control" type="text" name="slider_url" placeholder="Url" value="'.$slider_url.'" id="url" required>
                <small>Masukkan Link Promo/Blog, Jika tidak ada beri tanda pagar(#)</small>
              </div>
        <hr>
            <div class="form-group">
              <label>'._e('Photo').'</label>
                <div class="input-group">
                  <span class="input-group-btn">
                  <span class="btn btn-primary btn-file"><i class="fa fa-camera"></i> Upload
                    <input type="file" class="upload" name="photo" accept=".jpg, .jpeg"/>
                  </span></span><input type="text" class="form-control" placeholder="Upload gambar dengan format png,jpg" readonly>
               </div>
                  <br>
                    <div class="alert alert-warning fade in">Perhatikan sebelum upload berkas atau gambar, gambar harus format JPEG,JPG. File berukuran maksimal 1MB Lebar: '.$slider_width.' x  Tinggi: '.$slider_height.' pixel 
                    </div>
             </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-check"></i> '._e('Save').'</button>
            </div>
          </form>
        </div>
      </div>
</div>';
} else{
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}?>

<?php break; }
  } else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}

echo'<!-- Modal akses -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-warning"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>Anda tidak memiliki hak akses.!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div></div>';
} 
