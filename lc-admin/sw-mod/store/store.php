<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/$mod/proses.php";
 $store_name='';
 $store_phone='';
 $store_city ='';
 $store_address='';
 $store_postal='';
 $active='';
 $city_id ='';

 $message='';
 if(!empty($_SESSION['store_name'])){$store_name=$_SESSION['store_name'];}
if(!empty($_SESSION['store_phone'])){$store_phone=$_SESSION['store_phone'];}
if(!empty($_SESSION['store_city'])){$store_city=$_SESSION['store_city'];}
if(!empty($_SESSION['store_address'])){$store_address=$_SESSION['store_address'];}
if(!empty($_SESSION['store_postal'])){$store_postal=$_SESSION['store_postal'];}
if(!empty($_SESSION['active'])){$active=$_SESSION['active'];}
if(!empty($_SESSION['city_id'])){$city_id=$_SESSION['city_id'];}
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}
$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='7' AND level_id='$level_user'"; 
    $result_role = $connection->query($query_role);
    if($result_role->num_rows > 0){
    $rows_akses= $result_role->fetch_assoc();
    extract($rows_akses);
?>


<?php switch(@$_GET['op']){ 
    default:?>
<?php  echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-table"></i>'._e('Store Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Store Management').'</li>
</ul>

<div class="block full">
<div class="block-title">
<h2>'._e('Store Management').'</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
    <a href="?mod='.$mod.'&op=add" class="btn btn-sm btn-default enable-tooltip" title="'._e('Add').'"><i class="fa fa-plus"></i></a>
</div>
</div></div>';

if($read_access == 'Y'){
echo'
<div class="table-responsive">
<form id="validate" name="form1" method="post" action="'.$gotoprocess.'">
    <input type="hidden" name="modul" value="'.$mod.'" readonly>
    <input type="hidden" name="aksi" value="multidelete" readonly>
<table id="sw-cms" class="table table-vcenter table-condensed">
<thead>
<tr>
  <th class="text-center"><i class="fa fa-check-circle-o"></i></th>
  <th>'._e('Name').'</th>
  <th>'._e('Phone').'</th>
  <th>'._e('City').'</th>
  <th>'._e('Address').'</th>
  <th width="11%">'._e('Actions').'</th>
</tr>
</thead>
<tbody>';
$query="SELECT store_id,store_name,store_phone,store_city,store_address from store order by store_id DESC";
$result = $connection->query($query) or die($connection->error.__LINE__);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    extract($row);
echo'<tr>
<td style="width:80px;">
    <div class="text-center">
        <input class="multicheck" type="checkbox" name="item[]" value="'.$store_id.'">
    </div>
</td>
<td>'.$store_name.'</td>
<td>'.$store_phone.'</td>
<td>'.$store_city.'</td>
<td>'.$store_address.'</td>
<td>
<div class="btn-group btn-group-xs">

<a href="?mod='.$mod.'&op=view&store_id='.epm_encode($store_id).'" class="btn btn-xs btn-default enable-tooltip" title="View">
<i class="fa fa-eye"></i></a>

<a href="?mod='.$mod.'&op=edit&store_id='.epm_encode($store_id).'" class="btn btn-xs btn-default enable-tooltip" title="Edit">
<i class="fa fa-pencil"></i></a>';

if($delete_access == 'Y'){
  echo'
<a href="javascript:void(0)" data-href="'.$gotoprocess.'?id='.$store_id.'&aksi=delete" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';} else {
  echo'
<a href="javascript:void(0)" data-toggle="modal" data-target="#akses" class="btn btn-xs btn-danger enable-tooltip" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';
}
echo'
</div>
</td>
</tr>';}}
echo'
<tfoot>
<tr>
<td style="width:80px;" class="text-center">
<input type="checkbox" id="selecctall" data-toggle="tooltip" title="Select All"/>
</td>
<td colspan="5">';
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
</div></div></div>';

} else {
    echo'
    <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}
echo'

<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-lantailedby="myModallantai" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-store_phone" id="myModallantai"><i class="fa fa-exclamation-triangle text-danger"></i> </i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> '._e('Delete').'</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div></div>';?>

<?PHP break; case "add": ?>
<?php 

echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-notes_2"></i>'._e('Store Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="?mod='.$mod.'">'._e('Store Management').'</a></li>
        <li>'._e('Add New').'</li>
</ul>';?>

<?PHP if($write_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<i class="fa fa-close close" data-dismiss="alert"></i>'.$message.'</div>

<div class="block">
<form name="store" method="post" class="form-horizontal form-bordered" id="validate" action="'.$gotoprocess.'" autocomplete="of">
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="add">
   
        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Store Name').'</label>
            <div class="col-md-6">
                <input type="text"  name="store_name" class="required form-control" placeholder="Masukkan Nama Toko" value="'.$store_name.'" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Phone').'</label>
            <div class="col-md-6">
                 <input type="text" name="store_phone" class="required number form-control" placeholder="Masukkan No telp" value="'.$store_phone.'" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('City').'</label>
            <div class="col-md-6">
                <input type="text" name="store_city" class="required form-control" placeholder="Masukkan kota kamu" value="'.$store_city.'" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Address').'</label>
            <div class="col-md-6">
                <textarea name="store_address" class="required form-control" rows="3" required="required" placeholder="Alamat lengkap kamu">'.$store_address.'</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Postal').'</label>
            <div class="col-md-6">
                <input type="text" name="store_postal" class="required form-control" placeholder="Masukkan kode pos kamu" value="'.$store_postal.'" required>
            </div>
        </div>

        <div class="form-group form-actions">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-4">
              <button type="submit" class="btn btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>
                <button type="button" class="btn  btn-warning" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
            </div>
        </div>
    </form>
    </div>
';}
else{
  echo'  <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}?>


<?php break; case "edit":?>
<?php echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-notes_2"></i>'._e('Store Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="?mod='.$mod.'">'._e('Store Management').'</a></li>
        <li>Edit</li>
</ul>';

if($modify_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<i class="fa fa-close close" data-dismiss="alert"></i>'.$message.'</div>';
if(!empty($_GET['store_id'])){
$store_id =  mysqli_real_escape_string($connection,epm_decode($_GET['store_id'])); 
    $update = "SELECT * FROM store WHERE store_id='$store_id'";
    $result_update = $connection->query($update) or die($connection->error.__LINE__);
    if($result_update->num_rows > 0){
     while($rows= $result_update->fetch_assoc()){
    extract($rows);
echo'

<div class="block">
<form name="store" method="post" class="form-horizontal form-bordered" id="validate" action="'.$gotoprocess.'?id='.$store_id.'" autocomplete="of">
<input type="hidden" name="modul" value="'.$mod.'" readonly>
<input type="hidden" name="aksi" value="update" readonly>
<input type="hidden" name="store_id" value="'.$store_id.'" readonly>
   
        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Store Name').'</label>
            <div class="col-md-6">
                <input type="text"  name="store_name" class="required form-control" placeholder="Masukkan Nama Toko" value="'.$store_name.'" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Phone').'</label>
            <div class="col-md-6">
                 <input type="text" name="store_phone" class="required number form-control" placeholder="Masukkan No telp" value="'.$store_phone.'" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('City').'</label>
            <div class="col-md-6">
                <input type="text" name="store_city" class="required form-control" placeholder="Masukkan kota kamu" value="'.$store_city.'" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Address').'</label>
            <div class="col-md-6">
                <textarea name="store_address" class="required form-control" rows="3" required="required" placeholder="Alamat lengkap kamu">'.$store_address.'</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">'._e('Postal').'</label>
            <div class="col-md-6">
                <input type="text" name="store_postal" class="required form-control" placeholder="Masukkan kode pos kamu" value="'.$store_postal.'" required>
            </div>
        </div>

        <div class="form-group form-actions">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-4">
              <button type="submit" class="btn btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>
                <button type="button" class="btn  btn-warning" onClick="self.history.back(-1);"><i class="fa fa-history"></i> '._e('Back').'</button>
            </div>
        </div>
    </form>
    </div>';

}} else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}}
}
    else {
        echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}

break;
case 'view':?>
<?php  echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-table"></i>'._e('Store Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Store Management').'</li>
</ul>';

if($read_access == 'Y'){
    echo'
<div class="block full">
    <div class="block-title">
        <h2>'._e('Store Abouts').'</h2>

    </div>';

if(!empty($_GET['store_id'])){
    $store_id =  mysqli_real_escape_string($connection,epm_decode($_GET['store_id'])); 
    $view = "SELECT * FROM store WHERE store_id='$store_id'";
    $result = $connection->query($view) or die($connection->error.__LINE__);
    if($result->num_rows > 0){
     while($row= $result->fetch_assoc()){
    extract($row);
echo'<table class="table table-borderless table-striped">
    <tbody>
        <tr>
            <td style="width: 20%;"><strong>Name</strong></td>
            <td>'.$store_name.'</td>
        </tr>
        <tr>
            <td><strong>No Telepon</strong></td>
            <td>'.$store_phone.'</td>
        </tr>
        <tr>
            <td><strong>Kota</strong></td>
            <td>'.$store_city.'</td>
        </tr>
        <tr>
            <td><strong>Alamat</strong></td>
            <td>'.$store_address.'</td>
        </tr
        <tr>
            <td><strong>Kode pos</strong></td>
            <td>'.$store_postal.'</td>
        </tr>  
    </tbody>
</table>
    
    <button class="btn btn-sm btn-default" onClick="self.history.back();">Kembali</button>
    
</div>';
}} else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}}
}
    else {
        echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}

break;
 }}else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}


 echo'
<!-- Modal akses -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-lantailedby="myModallantai" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-store_phone" id="myModallantai"><i class="fa fa-exclamation-triangle text-danger"></i> Hapus Item</h4></div>
<div class="modal-body">
<p>Anda tidak memiliki hak akses.!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div></div></div></div>';} ?>