<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../login' );
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

// Proses Add
if ( $modul == 'page' AND $aksi == 'add'){
$page_content = htmlentities(trim($_POST['page_content']));
$_SESSION['content']=$page_content;

 $error = array();
if (empty($_POST['title'])) { 
        $error[] = 'title tidak boleh kosong';
    } else {
$title = mysqli_real_escape_string($connection, $_POST['title']);
$_SESSION['title']=$title;
    }

if (empty($_POST['seotitle'])) { 
        $error[] = 'seo tidak boleh kosong';
    } else {
$seotitle =mysqli_real_escape_string($connection,$_POST['seotitle']);
$_SESSION['seotitle']=$seotitle;
    }

if (empty($_POST['page_description'])) { 
        $error[] = 'des tidak boleh kosong';
    } else { 
$page_description = mysqli_real_escape_string($connection, $_POST['page_description']); 
    $_SESSION['page_description']=$page_description;
  }

if (empty($_POST['page_content'])) { 
        $error[] = 'page_content';
    } else {
$page_content = mysqli_real_escape_string($connection, $_POST['page_content']);
 }

if (empty($_POST['images'])) { 
        $error[] = 'images';
    } else {
$images = mysqli_real_escape_string($connection, $_POST['images']);
$_SESSION['images']=$images;
 }
$active =strip_tags($_POST['active']);
if (empty($error)) { 
$tambah="INSERT INTO page (title,
                              seotitle,     
                              page_description,
                              images,
                              page_content,
                              page_time,
                              page_date,
                              page_hits,
                              active)
                              values('$title', 
                                '$seotitle', 
                                '$page_description', 
                                '$images',  
                                '$page_content', 
                                '$time', 
                                '$date', 
                                '0', '$active')" or die($connection->error.__LINE__); 
          if($connection->query($tambah) === false) { 
          _goto( '../../?mod='.$modul.'&op=add');
          $_SESSION['message'] ='Halaman Tidak dapat di publish...!';
          } else   {
          _goto( '../../?mod='.$modul);
          $_SESSION['title']='';
          $_SESSION['seotitle']='';
          $_SESSION['page_description']='';
          $_SESSION['content']='';
          $_SESSION['images']='';
          $_SESSION['message']='';
          } }

          else{
          foreach ($error as $key => $values) {            
           _goto( '../../?mod='.$modul.'&op=add');
            echo $values;
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
          }}}



// Proses Edit
elseif($modul=='page' AND $aksi=='edit'){
$page_content = htmlentities(trim($_POST['page_content']));
$_SESSION['content']=$page_content;
$id=mysqli_real_escape_string($connection, $_POST['id']);

 $error = array();
if (empty($_POST['title'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$title = mysqli_real_escape_string($connection, $_POST['title']);
$_SESSION['title']=$title;
    }

if (empty($_POST['seotitle'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$seotitle =mysqli_real_escape_string($connection,$_POST['seotitle']);
$_SESSION['seotitle']=$seotitle;
    }

if (empty($_POST['page_description'])) { 
        $error[] = 'tidak boleh kosong';
    } else { 
$page_description = mysqli_real_escape_string($connection, $_POST['page_description']); 
    $_SESSION['page_description']=$page_description;
  }


if (empty($_POST['page_content'])) { 
        $error[] = 'page_content';
    } else {
$page_content = mysqli_real_escape_string($connection, $_POST['page_content']);
 }

if (empty($_POST['images'])) { 
        $error[] = 'images';
    } else {
$images = mysqli_real_escape_string($connection, $_POST['images']);
$_SESSION['images']=$images;
 }

$active=strip_tags($_POST['active']);
if (empty($error)) { 
$update="UPDATE page SET title='$title',
      seotitle='$seotitle',
      page_description='$page_description',
      images='$images',
      page_content='$page_content',
      page_time='$time',
      page_date='$date',
      active='$active' WHERE page_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
_goto( '../../?mod='.$modul.'&op=edit&page='.$id.'');
 $_SESSION['message'] ='Halaman Tidak dapat di ubah...!';
} else   {
 _goto('../../?mod='.$modul);
$_SESSION['title']='';
$_SESSION['seotitle']='';
$_SESSION['page_description']='';
$_SESSION['content']='';
$_SESSION['images']='';
$_SESSION['message']='';
} } 

else{
foreach ($error as $key => $values) {            
  _goto( '../../?mod='.$modul.'&op=edit&page='.$id.'');
    $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}}


if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection, $_GET['id']);
if ($aksi=='delete'){
$delete="DELETE FROM page WHERE page_id='$id'"; 
if($connection->query($delete) === true) { 
_goto( '../../?mod=page'); // sukses
$_SESSION['message'] ='';
} else { 
_goto( '../../?mod=page');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


// Proses Multi Delete Post
elseif ($modul=='page' AND $aksi=='multidelete'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
          mysqli_query($connection,"DELETE FROM page WHERE page_id=".$id);
  }
 _goto( '../../?mod='.$modul.'');
}


// Proses SetActive
elseif ( $modul == 'page' AND $aksi == 'setactive' ){
    $id = $_POST['id'];
    $active = $_POST['active'];
    $update="UPDATE page SET active='$active' WHERE page_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
 echo 'error'; 
}
else{ echo 'sukses..'; 
}}

}
