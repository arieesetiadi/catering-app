<?php
if(empty($_SESSION['SESION_LOGIN']) || !isset($_SESSION['SESION_LOGIN'])){ 
header('location:./login/');
 exit;}
 else {
echo'
<div id="sidebar">
    <div class="sidebar-scroll">
        <div class="sidebar-content">
<a href="./" class="sidebar-brand">';
if ($level_user == 1 ){echo'<strong>Admin</strong>istrator';} 
else if ($level_user == 2 ){echo'<strong>User</strong> menu';}?></a>
<?php echo'
<div class="sidebar-section sidebar-user clearfix">
<div class="sidebar-user-avatar">
<a href="?mod=profile&id='.epm_encode($author).'">';
if($photo !==NULL){
echo'<img src="../sw-content/upload/avatar/'.$photo.'" alt="avatar">';} else {
echo'<img src="./sw-assets/img/avatar.jpg" alt="avatar">';}
echo'</a>
</div>
<div class="sidebar-user-name text-shadow">'.substr($fullname,0,10).'</div>
<div class="sidebar-user-links">
    <a href="?mod=profile&id='.epm_encode($author).'" data-toggle="tooltip" data-placement="bottom" title="'._e('Profile').'"><i class="gi gi-user"></i></a>
    <a href="?mod=message" data-toggle="tooltip" data-placement="bottom" title="'._e('Messages').'"><i class="gi gi-envelope"></i></a>
    <a href="?mod=setting" data-toggle="tooltip" class="enable-tooltip" data-placement="bottom" title="'._e('Settings').'"><i class="gi gi-cogwheel"></i></a>';?>
 <a href="javascript:void();" onClick="location.href='./logout.php';" data-toggle="tooltip" data-placement="bottom" title="<?php echo _e('Logout');?>"><i class="gi gi-exit"></i></a>
</div>
</div>
<!-- Sidebar Navigation -->
<ul class="sidebar-nav text-shadow">
<li>
<a href="./"><i class="gi gi-home sidebar-nav-icon"></i> Dashboard</a></li>
<?PHP 
 $module ="SELECT * FROM module where parent_id=0 and active='Y' order by position";
 $result = $connection->query($module);
while($row= $result->fetch_assoc()){
    extract($row);

$query_role ="SELECT read_access FROM user_role where module_id='$row[module_id]' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);
$rows= $result_role->fetch_assoc();
$read = $rows['read_access'];

if($read == 'Y'){
if($link !== 'NULL'){
  echo'<li>
      <a href="'.$link.'"><i class="'.$icon.' sidebar-nav-icon"></i> '._e($displayname).'</a></li>';  
    }
else {
  
if($read == 'Y'){
echo'<li><a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="fa '.$icon.' sidebar-nav-icon"></i> '._e($displayname).'</a>';

$submenu ="SELECT * FROM module where parent_id='$module_id' and active='Y' order by position";
  $resultsubmenu = $connection->query($submenu);
if($resultsubmenu->num_rows > 0){
echo'<ul>';
while($rowsub = $resultsubmenu->fetch_assoc()){
echo'<li>
    <a href="'.$rowsub['link'].'"><i class="'.$rowsub['icon'].' sidebar-nav-icon"></i> '._e($rowsub['displayname']).'</a>
    </li>';
}}
echo'</ul></li>';} }}}?>
<li>
<a href="javascript:void();" onClick="location.href='./logout.php';">
	<i class="fa fa-sign-out sidebar-nav-icon"></i> <?php echo _e('Logout');?></a>
</li>
</ul>

        </div>
    </div>
</div>
 <?php }?>