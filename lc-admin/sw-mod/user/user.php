<?php
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location:../login');

    }else{
 $username='';  $firstname=''; $lastname=''; 
 $email='';$message='';
        if(!empty($_SESSION['username'])){$username=$_SESSION['username'];}
        if(!empty($_SESSION['firstname'])){$firstname=$_SESSION['firstname'];}
        if(!empty($_SESSION['lastname'])){$lastname=$_SESSION['lastname'];}
        if(!empty($_SESSION['email'])){$email =$_SESSION['email'];}
        if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}
        $gotoprocess = "sw-mod/$mod/proses.php";

$query_role ="SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='15' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);
if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);

switch(@$_GET['op']){ default: ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-book"></i>'._e('User Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('User Management').'</li>
</ul>';

 if($read_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';
echo'
    <div class="block full">
        <div class="block-title">
            <h2>Manajemen User</h2>
            <div class="block-options pull-right">
                <div class="btn-group btn-group-sm">
                    <a href="?mod='.$mod.'&op=add" class="btn btn-sm btn-default enable-tooltip" title="Tambah" data-toggle="modal"><i class="fa fa-plus"></i></a>
                </div>
                <div class="btn-group btn-group-sm">
                    <a href="javascript:void(0)" class="btn btn-sm btn-default dropdown-toggle enable-tooltip" data-toggle="dropdown" title="Options"><span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                        <li>
                            <a href="?mod='.$mod.'&op=userlevel"><i class="gi gi-cloud pull-right"></i>User Level</a>
                            <a href="?mod='.$mod.'&op=userrole"><i class="gi gi-airplane pull-right"></i>User Role</a>
                        </li>
                    </ul>
                </div>
            </div>  
        </div>
        

        <div class="table-responsive">
            <form method="post" action="'.$gotoprocess.'">
            <input type="hidden" name="modul" value="user">
            <input type="hidden" name="aksi" value="multidelete">   
            <table id="sigerTable" class="table table-vcenter">
                <thead>
                    <tr>
                        <th style="width:50px;" class="text-center"><i class="fa fa-check-circle-o"></i></th>
                        <th class="text-center">Avatar</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Artikel</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td style="width:50px;" class="text-center"><input type="checkbox" id="titleCheck" data-toggle="tooltip" title="" /></td>
                        <td colspan="6">
                            <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#multideleted"><i class="fa fa-trash-o"></i> Hapus item dipilih</button>
                        </td>
                    </tr>
                </tfoot>
            </table>

<!-- multi deleted -->
<div class="modal fade" id="multideleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> Hapus Item</h4></div>
<div class="modal-body">
<p>Apakah anda yakin ingin menghapus..?</p>
</div>
<div class="modal-footer">
<button type="submit" name="multidelete" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

</div></div></div></div>
            </form>
        </div>   
    </div>';}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
    }?>

<!-- new ==================================================== -->
<?php break; case 'add': ?>
<?php echo'
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-book"></i>Manajemen User<br>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="./"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="?mod=user">Manajemen User</a></li>
        <li>Tambah Baru</li>
    </ul>';
if($read_access == 'Y'){
    echo'
    <div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>

    <div class="block">
<form id="form-validation" action="'.$gotoprocess.'" method="post" class="form-bordered">
    <input type="hidden" name="modul" value="user">
    <input type="hidden" name="aksi" value="add">
    <div class="form-group">
        <label>Username <span class="text-danger">*</span></label>
        <div>
            <input id="username" type="text" name="username" class="form-control" value="'.$username.'" placeholder="Type username here">
        </div>
    </div>
    <div class="form-group">
        <label>Password <span class="text-danger">*</span></label>
        <div>
            <input id="password" type="password" name="password" class="form-control" placeholder="Type password here">
        </div>
    </div>
            <div class="form-group">
                <label>Retype Password </label>
                <div>
                    <input id="cpassword" type="password" name="cpassword" class="form-control" placeholder="Retype password here">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Depan <span class="text-danger">*</span></label>
                        <div>
                            <input type="text" name="firstname" value="'.$firstname.'" class="form-control" placeholder="Type firstname here">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Belakang <span class="text-danger">*</span></label>
                        <div>
                            <input id="lastname" type="text" name="lastname" class="form-control" value="'.$lastname.'" placeholder="Type lastname here" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Email <span class="text-danger">*</span></label>
                <div>
                    <input id="email" type="email" name="email" class="form-control" value="'.$email.'" placeholder="Type email here">
                </div>
            </div>
            <div class="form-group">
                <label>Level </label>
                <select class="select-chosen-no-search" name="level" style="width:280px;" data-placeholder="Choose Level">';
        $query = "SELECT level_id,level FROM user_level where active='Y'"; 
        $result = $connection->query($query) or die($connection->error.__LINE__);
        while($rows= $result->fetch_assoc()){  
                    extract($rows);
                        if($rows['level_id'] == 2){
                            echo "<option value='$level_id' selected>$level</option>";
                        }
                        echo "<option value='$level_id'>$level</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group form-actions">
                <button  type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Simpan</button>
                <button type="button" class="btn btn-sm btn-warning pull-right" onclick="history.back();"><i class="fa fa-repeat"></i> <?=_e('Cancel')?></button>
            </div>
        </form>
    </div>
<?php }else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
    }?>

<!-- edit ==================================================== -->
<?php break; case 'edit': ?>
<?php echo'<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-book"></i>'._e('User Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'">'._e('User Management').'</a></li>
<li>'._e('Edit').'</li>
</ul>';
if($modify_access =='Y'){
    echo'
    <div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>

<div class="block">';
if(!empty($_GET['user'])){
$user = mysqli_real_escape_string($connection, epm_decode($_GET['user'])); 
$update = "SELECT * FROM user WHERE user_id='$user'";
$result_up = $connection->query($update) or die($connection->error.__LINE__);
if($result_up->num_rows > 0){
 while($rows= $result_up->fetch_assoc()){
extract($rows);
$name = explode(' ',$fullname);

if(empty($name[1])){
    $lastname='';
} else{
   $lastname=$name[1];
}

if($level_user == 1){
echo'<form id="form-validation" action="'.$gotoprocess.'" method="post" class="form-bordered">
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="edit">
<input type="hidden" name="id" value="'.$user_id.'">
<div class="form-group">
    <label>Username <span class="text-danger">*</span></label>
    <div>
        <input type="text" name="username" class="form-control" value="'.$user_login.'" placeholder="Type username here">
    </div>
</div>
            <div id="passwordChange" class="form-group">
                <label>Password</label>
                <div class="row">
                    <div class="col-sm-12">
                        <label id="passwordClick" class="label label-default" style="cursor:pointer;">Ganti Password</label>
                    </div>
                </div>
            </div>
<div id="passwordInput" style="display:none;">
<div class="form-group">
<label>Password <span class="text-danger">*</span></label><div>
<input id="id" type="hidden" name="id" value="'.$user_id.'">
<input id="passwdText" type="password" name="passwdText" class="form-control" placeholder="Type New password here">
    </div>
</div>
    <div class="form-group">
        <label>Retype Password</label>
<input id="cpasswdText" type="password" name="cpasswdText" class="form-control" placeholder="Retype New password here" onkeyup="checkPasswordMatch();">
<div id="divCheckPasswordMatch"></div>
    </div>            
    <div class="form-group">
 <button id="passwdCommit" type="button" class="btn btn-success btn-xs">Simpan</button>
    <button id="passwdCancel" type="button" class="btn btn-warning btn-xs">Cancel</button>
    </div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Firstname <span class="text-danger">*</span></label>
<div>
<input type="text" name="firstname" class="required form-control" value="'.$name[0].'" placehoder="Type Firstname here">
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Lastname</label>
<div>
<input type="text" name="lastname" class="form-control" value="'.$lastname.'" placeholder="Type Lastname here">
</div>
</div>
</div>
</div>
<div class="form-group">
    <label>Email <span class="text-danger">*</span></label>
    <div>
        <input type="email" name="email" class="form-control" value="'.$user_email.'" placeholder="Type Email here">
    </div>
</div>
<div class="form-group form-actions">
<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Update</button>
<button type="button" class="btn btn-sm btn-warning pull-right" onclick="history.back();"><i class="fa fa-repeat"></i> Cancel</button>
</div>
</form>';}
elseif ($session==$_SESSION['SESION_LOGIN'] && $user_id==$_SESSION['SESION_USER']) {
 echo'<form id="form-validation" action="'.$gotoprocess.'" method="post" class="form-bordered">
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="edit">
<input type="hidden" name="id" value="'.$user_id.'">
<div class="form-group">
    <label>Username <span class="text-danger">*</span></label>
    <div>
        <input type="text" name="username" class="form-control" value="'.$user_login.'" placeholder="Type username here">
    </div>
</div>
            <div id="passwordChange" class="form-group">
                <label>Password</label>
                <div class="row">
                    <div class="col-sm-12">
                        <label id="passwordClick" class="label label-default" style="cursor:pointer;">Ganti Password</label>
                    </div>
                </div>
            </div>
<div id="passwordInput" style="display:none;">
<div class="form-group">
<label>Password <span class="text-danger">*</span></label><div>
<input id="id" type="hidden" name="id" value="'.$user_id.'">
<input id="passwdText" type="password" name="passwdText" class="form-control" placeholder="Type New password here">
    </div>
</div>
    <div class="form-group">
        <label>Retype Password</label>
<input id="cpasswdText" type="password" name="cpasswdText" class="form-control" placeholder="Retype New password here" onkeyup="checkPasswordMatch();">
<div id="divCheckPasswordMatch"></div>
    </div>            
    <div class="form-group">
 <button id="passwdCommit" type="button" class="btn btn-info btn-xs">Simpan</button>
    <button id="passwdCancel" type="button" class="btn btn-warning btn-xs">Cancel</button>
    </div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Firstname <span class="text-danger">*</span></label>
<div>
<input type="text" name="firstname" class="required form-control" value="'.$name[0].'" placehoder="Type Firstname here">
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Lastname</label>
<div>
<input type="text" name="lastname" class="form-control" value="'.$lastname.'" placeholder="Type Lastname here">
</div>
</div>
</div>
</div>
<div class="form-group">
    <label>Email <span class="text-danger">*</span></label>
    <div>
        <input type="email" name="email" class="form-control" value="'.$user_email.'" placeholder="Type Email here">
    </div>
</div>
<div class="form-group form-actions">
<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Update</button>
<button type="button" class="btn btn-sm btn-warning pull-right" onclick="history.back();"><i class="fa fa-repeat"></i> Cancel</button>
</div></div>
</form>';
 }else{ echo"<div class='alert alert-danger alert-dismissable'><h4><i class='fa fa-times-circle'></i> Error</h4>
    Maaf anda tidak memiliki hak akses ke halaman ini..!
    <a href='javascript:void(0)' onclick='history.back();'' class='alert-link'>Kembali</a></div>";}}

}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
    }}

else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}}?>

<?php 
/*user level*/
break; case 'userlevel':?>

<?php 
echo'<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-book"></i>'._e('User Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'">'._e('User Management').'</a></li>
<li>'._e('Level User').'</li>
</ul>';

echo'
<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';

if($level_user == 1){
echo'<div class="block full">
<div class="block-title">
<h2>Level User</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
<a href="#addLevel" class="btn btn-sm btn-default enable-tooltip" title="Add" data-toggle="modal"><i class="fa fa-plus"></i></a>
</div>
<div class="btn-group btn-group-sm">
<a href="javascript:void(0)" class="btn btn-sm btn-default dropdown-toggle enable-tooltip" data-toggle="dropdown" title="Options"><span class="caret"></span></a>
<ul class="dropdown-menu dropdown-custom dropdown-menu-right">
<li>
    <a href="?mod='.$mod.'&op=userlevel"><i class="gi gi-cloud pull-right"></i>Level User</a>
    <a href="?mod='.$mod.'&op=userrole"><i class="gi gi-airplane pull-right"></i>User Role</a>
</li>
</ul>
</div>
</div>
</div>';?>

        <div class="table-responsive">
            <form id="form-multi" method="post" action="<?=$gotoprocess?>">
            <input type="hidden" name="modul" value="user">
            <input type="hidden" name="aksi" value="multideletelevel"> 
            <input type="hidden" value="0" name="totaldata" id="totaldata">
            <table id="sigerTable3" class="table table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center"><i class="fa fa-check-circle-o"></i></th>
                        <th>Level User</th>
                        <th class="text-center">Aktif</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

</table>

<div class="modal fade" id="multideleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> Hapus Item</h4></div>
<div class="modal-body">
<p>Apakah anda yakin ingin menghapus..?</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
<button type="submit" name="multideletelevel" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</button>
</div></div></div></div></form>
        </div></div>

<!-- add level -->
<div id="addLevel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<form id="form-validation" class="modalAdd" method="post" action="" autocomplete="off">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 class="modal-title">Tambah Level User</h3>
</div>
<div class="modal-body">
    <input type="hidden" name="modul" value="user">
    <input type="hidden" name="aksi" value="addLevel">
    <div class="form-group">
        <label>Title</label>
        <input class="form-control" type="text" id="leveltitle" name="title" placeholder="Type Title here" required>
    </div>
</div>
<div class="modal-footer">
    <button id="sModalAdd" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Simpan</button>
</div>
</form>
</div>
</div>
</div>
<?php } 
else {echo"
<div class='block'>
  <div class='alert alert-danger alert-dismissable'><h4><i class='fa fa-times-circle'></i> Error</h4>
    Maaf anda tidak memiliki hak akses ke halaman ini..!
    <a href='javascript:void(0)' onclick='history.back();'' class='alert-link'>Kembali</a></div>
    </div>";
 
}
break; case 'userrole':?>
<?php
echo'<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-book"></i>'._e('User Management').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'">'._e('User Management').'</a></li>
<li>'._e('User Role').'</li>
</ul>';

echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';

if ($level_user == 1 ){
echo'
<div class="block full">
<div class="block-title">
<h2>User Role</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
<a href="#rolenewmodal" class="btn btn-sm btn-default enable-tooltip" title="Add" data-toggle="modal"><i class="fa fa-plus"></i></a>
</div>
<div class="btn-group btn-group-sm">
<a href="javascript:void(0)" class="btn btn-sm btn-default dropdown-toggle enable-tooltip" data-toggle="dropdown" title="Options"><span class="caret"></span></a>
<ul class="dropdown-menu dropdown-custom dropdown-menu-right">
    <li>
        <a href="?mod='.$mod.'&op=userlevel"><i class="gi gi-cloud pull-right"></i>User Level</a>
        <a href="?mod='.$mod.'&op=userrole"><i class="gi gi-airplane pull-right"></i>User Role</a>
    </li>
</ul>
</div></div> </div>

<div class="table-responsive">
<form method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="multideleteuserrole">   
<table id="sigerTable2" class="table table-vcenter table-condensed table-bordered">
<thead>
    <tr>
        <th class="text-center"><i class="fa fa-check-circle-o"></i></th>
        <th>Level Nama</th>
        <th>Module</th>
        <th>Read</th>
        <th>Write</th>
        <th>Edit</th>
        <th>Hapus</th>
        <th class="text-center">Aksi</th>
    </tr>
</thead>
<tfoot>
<tr>
<td style="width:80px;" class="text-center"><input type="checkbox" id="titleCheck" data-toggle="tooltip" title="" /></td>
<td colspan="7">
<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#multideleted"><i class="fa fa-trash-o"></i> Hapus item dipilih</button>
</td>
</tr>
</tfoot>
</table>

<!-- multi deleted -->
<div class="modal fade" id="multideleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> Hapus Item</h4></div>
<div class="modal-body">
<p>Apakah anda yakin ingin menghapus..?</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
<button type="submit" name="multideleteuserrole" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</button>
</div></div></div></div>
</form>';?>
</div>

<!-- modal add -->
<div id="rolenewmodal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<form id="form-validation" method="post" action="<?=$gotoprocess;?>" autocomplete="off">
<div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3 class="modal-title">Tambah User Role</h3>
</div>
<div class="modal-body">
    <input type="hidden" name="modul" value="user">
    <input type="hidden" name="aksi" value="adduserrole">
    <div class="form-group">
  <label>Level <span class="text-danger">*</span></label>
<select class="select-chosen-no-search" name="level" style="width:280px;" data-placeholder="Choose Level">
<?php
$query = "SELECT level_id,level FROM user_level"; 
$result = $connection->query($query) or die($connection->error.__LINE__);
while($rows= $result->fetch_assoc()){extract($rows);
echo "<option value='$level_id'>$level</option>";
}?>
</select>
</div>
<div class="form-group">
<label>Module <span class="text-danger">*</span></label>
<select class="select-chosen-no-search" name="module_id" style="width:280px" data-placeholder="Choose Level">
<?php 
$query_mod = "SELECT module_id,modulename,link FROM module"; 
$result_mod = $connection->query($query_mod) or die($connection->error.__LINE__);
while($rows_mod= $result_mod->fetch_assoc()){extract($rows_mod);
echo "<option value='$module_id'>$link -> $modulename</option>";
}
?> </select></div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Read <span class="text-danger">*</span></label>
<select class="select-chosen-no-search" name="read_access" style="width:280px;">
    <option value="Y">Y</option>
    <option value="N">N</option>
</select>
</div>
<div class="form-group">
<label>Write <span class="text-danger">*</span></label>
<select class="select-chosen-no-search" name="write_access" style="width:280px;">
    <option value="Y">Y</option>
    <option value="N">N</option>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Modify <span class="text-danger">*</span></label>
<select class="select-chosen-no-search" name="modify_access" style="width:280px;">
    <option value="Y">Y</option>
    <option value="N">N</option>
</select>
</div>
<div class="form-group">
<label>Delete <span class="text-danger">*</span></label>
<select class="select-chosen-no-search" name="delete_access" style="width:280px;">
    <option value="Y">Y</option>
    <option value="N">N</option>
</select>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Simpan</button>
</div>
</form>
</div>
</div>
</div>
</div>
<?php }
else {echo"
<div class='block'>
  <div class='alert alert-danger alert-dismissable'><h4><i class='fa fa-times-circle'></i> Error</h4>
    Maaf anda tidak memiliki hak akses ke halaman ini..!
    <a href='javascript:void(0)' onclick='history.back();'' class='alert-link'>Kembali</a></div>
    </div>";
 
}
break;
}
}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}}
?>

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
</div></div></div></div>

<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> Hapus Item</h4></div>
<div class="modal-body">
<p>Apakah anda yakin ingin menghapus..?</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> Hapus</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div></div></div></div>