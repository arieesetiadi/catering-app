<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../login' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include('../../../sw-library/sw-function.php');

$modul='';
$aksi='';

if(!empty($_POST['modul'])){
$modul = $_POST['modul'];
}

if(!empty($_POST['aksi'])){
$aksi = $_POST['aksi'];
}

// add
if ($modul=='categori' AND $aksi=='add'){
$error = array();
if (empty($_POST['title'])) {//if no name has been supplied 
        $error[] = 'tidak boleh kosong';//add to array "error"
    } else {
$title = mysqli_real_escape_string($connection, $_POST['title']);
$seotitle = seo_title($title);
$_SESSION['title']=$title;
    }

if (empty($error)) { 
    // mencari title yang sama
$query ="SELECT title FROM category WHERE title ='$title' and type='1'";
$result= $connection->query($query) or die($connection->error.__LINE__);
$hasil= $result->num_rows;
if ($hasil== 0){

$tambah= "INSERT INTO category(title,seotitle,type,parent_type) values('$title', '$seotitle', '1' ,'0')" or die($connection->error.__LINE__); 
if($connection->query($tambah) === false) { 
  die($connection->error.__LINE__); 
_goto('../../?mod='.$modul); // error
  $_SESSION['message'] ='Kategori Tidak dapat di publish...!';
} else   {

_goto('../../?mod='.$modul); // sukses
  $_SESSION['title']='';
  $_SESSION['message']='';
} }

else   {
_goto('../../?mod='.$modul); // error
    $_SESSION['message'] ='Kategori sudah tersedia...!';
 }
}

else{
foreach ($error as $key => $values) {            
_goto('../../?mod='.$modul);
  $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}

}
// edit
elseif ($modul=='categori' AND $aksi=='edit'){
 $error = array();
 $id = mysqli_real_escape_string($connection, $_POST['id']);
if (empty($_POST['title'])) {//if no name has been supplied 
        $error[] = 'tidak boleh kosong';//add to array "error"
    } else {
$title = mysqli_real_escape_string($connection, $_POST['title']);
$seotitle = seo_title($title);
$_SESSION['title']=$title;
    }

if (empty($error)) { 
$update="UPDATE category SET title='$title',seotitle='$seotitle' WHERE category_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
  die($connection->error.__LINE__); 
  _goto('../../?mod='.$modul); // error
$_SESSION['message'] ='Kategori Tidak dapat di ubah...!';
} else   {

_goto('../../?mod='.$modul); // sukses
  $_SESSION['title']='';
  $_SESSION['message']='';
} }
else{
foreach ($error as $key => $values) {            
  _goto('../../?mod='.$modul);
  $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}
}


if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection, $_GET['id']);
if ($aksi=='delete'){
$delete="DELETE FROM category WHERE category_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($delete) === true) { 
  _goto( '../../?mod=categori'); // sukses
} else { 
_goto( '../../?mod=categori');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


// Proses Multi Delete Post
elseif ($modul=='categori' AND $aksi=='multidelete'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
          mysqli_query($connection,"DELETE FROM category WHERE category_id=".$id);
  }
 _goto( '../../?mod='.$modul.'');
}

}
