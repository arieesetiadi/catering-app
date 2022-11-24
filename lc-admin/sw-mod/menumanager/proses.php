<?php
@session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include( '../../../sw-library/sw-function.php');

$modul='';
$aksi='';

if(!empty($_POST['modul'])){
$modul = $_POST['modul'];
}

if(!empty($_POST['aksi'])){
$aksi = $_POST['aksi'];
}

// add
if ($modul=='menumanager' AND $aksi=='add'){
$error = array();
if (empty($_POST['title'])) {
$error[] = 'tidak boleh kosong';
} else {
$title = mysqli_real_escape_string($connection, $_POST['title']);
}
if (empty($error)) { 
  $tambah = "INSERT INTO menu_group (title) VALUES ('$title')";
if($connection->query($tambah) === false) { 
_goto("../../?mod=$modul");

} else { 
echo"ok";
} } 
else{ foreach ($error as $key => $values) { 
_goto("../../?mod=$modul");
}}
}

//Edit
if ($modul=='menumanager' AND $aksi=='editgroup'){
$error = array();
if (empty($_POST['title'])) {
$error[] = 'tidak boleh kosong';
} else {
$title = mysqli_real_escape_string($connection, $_POST['title']);
}
$id = $_POST['id'];
if (empty($error)) { 
  $update = "UPDATE menu_group SET title='$title' WHERE id='$id'";
if($connection->query($update) === false) { 
_goto("../../?mod=$modul&group_id=$id");

} else { 
_goto("../../?mod=$modul&group_id=$id");
} } 
else{ foreach ($error as $key => $values) { 
_goto("../../?mod=$modul&group_id=$id");
}}
}

// add
if ($modul=='menumanager' AND $aksi=='addmenu'){
$error = array();
if (empty($_POST['title'])) {
$error[] = 'tidak boleh kosong';
} else {
$title = mysqli_real_escape_string($connection, $_POST['title']);
}

if (empty($_POST['url'])) {
$error[] = 'tidak boleh kosong';
} else {
$url = mysqli_real_escape_string($connection, $_POST['url']);
}

$class = mysqli_real_escape_string($connection, $_POST['class']);
$id = $_POST['id'];
if (empty($error)) { 
  $query="SELECT position from menu where group_id='$id' order by position DESC limit 1";
  $result =$connection->query($query);
  $row = $result->fetch_assoc();
  $position =$row['position'] + 1;
  $tambah = "INSERT INTO menu (parent_id, title, url, class, position, group_id) VALUES ('0', '$title', '$url', '$class', '$position', '$id')";
if($connection->query($tambah) === false) { 
_goto("../../?mod=$modul&group_id=$id");

} else { 
_goto("../../?mod=$modul&group_id=$id");
} } 
else{ foreach ($error as $key => $values) { 
_goto("../../?mod=$modul&group_id=$id");
}}
}

// edit
elseif($modul=='menumanager' AND $aksi=='edit'){
 $error = array();
 $id = mysqli_real_escape_string($connection, $_POST['id']);
$group_id = mysqli_real_escape_string($connection, $_POST['group_id']);
if (empty($_POST['title'])) {
        $error[] ='';
    } else {
$title = mysqli_real_escape_string($connection, $_POST['title']);}

if (empty($_POST['url'])) {
        $error[] ='';
    } else {
$url = mysqli_real_escape_string($connection, $_POST['url']);}
$class = mysqli_real_escape_string($connection, $_POST['class']);

if (empty($error)) { 
$update="UPDATE menu SET title='$title',url='$url',class='$class' WHERE id='$id'" or die($conn->error.__LINE__); 
if($connection->query($update) === false) { 
  die($connection->error.__LINE__); 
_goto('../../?mod='.$modul.'&group_id='.$group_id.''); // error
$_SESSION['message'] ='Menu Tidak dapat di ubah...!';
} else   {

_goto('../../?mod='.$modul.'&group_id='.$group_id.''); // error
$_SESSION['message']='';
} }


else{
foreach ($error as $key => $values) {            
_goto('../../?mod='.$modul);
 $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}
}

// delete
elseif(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection, $_GET['id']);
$group_id =mysqli_real_escape_string($connection, $_GET['group_id']);
if ($aksi=='delete'){
$delete="DELETE FROM menu WHERE id='$id'" or die($conn->error.__LINE__); 
if($connection->query($delete) === true) { 
_goto("../../?mod=menumanager&group_id=$group_id");// sukses
} else { 
_goto("../../?mod=menumanager&group_id=$group_id&error");
 //   $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


else{ echo 'Error'; }

} // session
