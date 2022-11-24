<?php
@session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include( '../../../sw-library/sw-function.php' );

$modul='';
$aksi='';

if(!empty($_POST['modul'])){
$modul = $_POST['modul'];
}

if(!empty($_POST['aksi'])){
$aksi = $_POST['aksi'];
}

// add
if ($modul=='module' AND $aksi=='add'){
  $parent_id    = mysqli_real_escape_string($connection,$_POST['parent_id']);
  $modulename   = mysqli_real_escape_string($connection,$_POST['modulename']);
  $icon         = mysqli_real_escape_string($connection,$_POST['icon']);
  $displayname  = mysqli_real_escape_string($connection,$_POST['displayname']);
  $link         = mysqli_real_escape_string($connection,$_POST['link']);
  if($link !==''){
$link = mysqli_real_escape_string($connection,$_POST['link']);
  }
  else {
    $link='NULL';
  }
  isset($_POST["active"])=="on" ? $active = "Y" : $active = "N";
  $sql1 = "INSERT INTO module (parent_id,modulename,icon,displayname,link,active) VALUES ('$parent_id','$modulename','$icon','$displayname','$link','$active')";
  $connection->query($sql1);

  $sql2 = "INSERT INTO user_role (level_id,module_id,read_access,write_access,modify_access,delete_access) VALUES ('1',LAST_INSERT_ID(),'Y','Y','Y','Y')";
  $connection->query($sql2);

  $sql3 = "INSERT INTO user_role (level_id,module_id,read_access,write_access,modify_access,delete_access) VALUES ('2',LAST_INSERT_ID(),'N','N','N','N')";
  $connection->query($sql3);

  $sql4 = "INSERT INTO user_role (level_id,module_id,read_access,write_access,modify_access,delete_access) VALUES ('3',LAST_INSERT_ID(),'N','N','N','N')";
$connection->query($sql4);
 //_goto("../../?mod=$modul");
  echo 'ok';
}

// edit
elseif($modul=='module' AND $aksi=='edit'){

  //$parent_id    = mysqli_real_escape_string($connection,$_POST['parent_id']);
  $modulename   = mysqli_real_escape_string($connection,$_POST['modulename']);
  $icon         = mysqli_real_escape_string($connection,$_POST['icon']);
  $displayname  = mysqli_real_escape_string($connection,$_POST['displayname']);
  $link         = mysqli_real_escape_string($connection,$_POST['link']);
  if($link !==''){
$link = mysqli_real_escape_string($connection,$_POST['link']);}
  else {$link='NULL';}

isset($_POST["active"])=="on" ? $active = "Y" : $active = "N";
$id = mysqli_real_escape_string($connection,$_POST['id']);

$update="UPDATE module SET icon='$icon',
modulename='$modulename',
link='$link',
displayname='$displayname',
active='$active' WHERE module_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
_goto('../../?mod='.$modul.'&op=edit&id='.$id.'');
$_SESSION['message']='Module tidak dapat di edit..!';
} else {
_goto('../../?mod='.$modul.''); //sukses
$_SESSION['message']='';
}


// delete
}elseif ($modul=='module' AND $aksi=='delete'){
  $id           = $_POST['id'];
$delete="DELETE FROM module WHERE module_id='$id'";
$delete2="DELETE FROM user_role WHERE module_id='$id'";
if($connection->query($delete) === true) { 
  echo 'ok';
  $connection->query($delete2);
}}

else{ echo 'Error'; }

} // session
