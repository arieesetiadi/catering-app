<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/$mod/proses.php";
$message='';
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}

$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='7' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);

if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);

switch(@$_GET['op']){ 
    default:?>
<?php echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="fa fa-tags"></i>'._e('Location Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Location Management').'</li>
</ul>';

if($read_access == 'Y'){
  echo'
<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>

<div class="block full">
<div class="block-title">
<h2>'._e('Location Management').'</h2>
  <div class="block-options pull-right">
      <div class="btn-group btn-group-sm">
<a href="#addCategory" class="btn btn-sm btn-default enable-tooltip" title="Tambah" data-toggle="modal"><i class="fa fa-plus"></i></a>
      </div>
  </div>
</div>


<div class="row">
<form id="validate" name="form1" method="post" action="'.$gotoprocess.'">';
$query="SELECT city_id,city_name,active from city order by city_id DESC";
$result = $connection->query($query) or die($connection->error.__LINE__);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    extract($row);

      if($row['active']=='Y'){
            $active="<button type='button' id='set$row[city_id]' data-id='$row[city_id]' class='btn btn-xs btn-success setactive' data-active='$row[active]'><i class='fa fa-eye'></i> Active</button>";
        }else{
            $active="<button type='button' id='set$row[city_id]' data-id='$row[city_id]' class='btn btn-xs btn-danger setactive' data-active='$row[active]'><i class='fa fa-eye-slash'></i> Deactive</button>";
        }

echo'<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
      <!-- Widget -->
      <div class="widget widget-hover-effect1">
          <div class="widget-simple">
              <div class="widget-icon pull-left themed-background animation-fadeIn">
                  <i class="fa fa-location-arrow"></i>
              </div>
              <div class="pull-right btn-group btn-group-xs">
                '.$active.'

                  <a href="#edit_form" class="btn btn-xs btn-default enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('city_name').value='<?PHP echo $city_name;?>';getElementById('id').value='<?PHP echo $city_id;?>';"><i class="fa fa-pencil"></i></a>

            <?PHP if($delete_access == 'Y'){
                  echo'<button type="button" data-href="'.$gotoprocess.'?id='.$city_id.'&aksi=delete" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></button>';} else {
                        echo'
                      <button type="button" data-toggle="modal" data-target="#akses" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></button>';
                      }
                  echo'
              </div>
              <h3 class="widget-content animation-pullDown visible-lg">
                  '.$city_name.'
              </h3>
          </div>
      </div>
      <!-- END Widget -->
  </div>';
}}

  else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Saat ini belum lokasi belum tersedia/kosong.!</p></div>
';}
echo'
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



if($write_access =='Y'){
  echo'
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form id="validate" class="form" method="post" action="'.$gotoprocess.'">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">'._e('Tambah Kota baru').'</h3>
            </div>
            <div class="modal-body">
              <input type="hidden" name="modul" value="'.$mod.'" readonly>
              <input type="hidden" name="aksi" value="add" readonly>
              <div class="form-group">
                <label>'._e('City').'</label>
                <input class="form-control" type="text" name="city_name" placeholder="Kota / Kecamatan baru" required>
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

if($modify_access == 'Y'){
  echo'
<!-- edit form -->
<div id="edit_form" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form id="validate" method="post" action="'.$gotoprocess.'">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title">'._e('Edit Location').'</h3>
            </div>
            <div class="modal-body">
            <input type="hidden" id="id" name="id" value="" readonly>
              <input type="hidden" name="modul" value="'.$mod.'" readonly>
               <input type="hidden" name="aksi" value="edit" readonly>
              <div class="form-group">
                <label>'._e('Title').'</label>
                <input id="city_name" class="form-control" type="text" name="city_name" value="" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-primary">
              <i class="fa fa-check"></i> '._e('Save').'</button>
            </div>
          </form>
        </div>
      </div>
    </div>';} else {
      echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>
';
    }

  }
    else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>
';}?>
<?php break; }
}else {
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
</div></div></div></div>';}?>
