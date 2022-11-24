<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../login' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include( '../../../sw-library/sw-function.php');
$config = get_parse_ini('../../../sw-library/config.ini.php');
require_once '../../../sw-library/ini.php';
$ini_file = "../../../sw-library/config.ini.php";
define ("MAX_SIZE","100");
$modul='';$aksi='';

if(!empty($_POST['modul'])){
$modul = strip_tags($_POST['modul']);
}

if(!empty($_POST['aksi'])){
$aksi = strip_tags($_POST['aksi']);
}


// Proses Add
if ($modul=='slider' AND $aksi=='setting'){
  $slider_width  = strip_tags($_POST['slider_width']);
  $slider_height = strip_tags($_POST['slider_height']);
if($slider_width && $slider_height){
  $ini_value = get_parse_ini($ini_file);

  $ini_value['config']['slider_width'] = $slider_width;
  put_ini_file("$ini_file", $ini_value, $i = 0);

  $ini_value['config']['slider_height'] = $slider_height;
  put_ini_file("$ini_file", $ini_value, $i = 0);
    _goto( '../../?mod='.$modul.'');
    $_SESSION['message'] ='';
}else{
_goto( '../../?mod='.$modul.'');
  $_SESSION['message'] ='Bidang yang anda pilih kosong..!';
}
}


elseif ( $modul == 'slider' AND $aksi == 'add' ){
$error = array();
if (empty($_POST['slider_url'])) { 
        $error[] = 'tidak boleh kosong';
    } else { 
$slider_url = mysqli_real_escape_string($connection, $_POST['slider_url']); 
    $_SESSION['slider_url']=$slider_url;
  }

$photo = $_FILES["photo"]["name"];
$lokasi_file = $_FILES['photo']['tmp_name'];  
$ukuran_file = $_FILES['photo']['size'];
$MAX_FILE_SIZE = 100000;

$extension = getExtension($photo);
$extension = strtolower($extension);
$photo=strip_tags(md5($photo));
$photo="slider-".$photo.".".$extension."";
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
    {
    
_goto( '../../?mod='.$modul.'&op=add'); 
 $_SESSION['message'] ='Gambar yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF.!';
    }
    else
    {

if ($ukuran_file > $MAX_FILE_SIZE)
{
_goto( '../../?mod='.$modul.'&op=add');
 $_SESSION['message'] ='Gambar yang di unggah terlalu besar Maksimal Size 1MB..!';

}

if($extension=="jpg" || $extension=="jpeg" ){
$src = imagecreatefromjpeg($lokasi_file);

}
else if($extension=="png"){
$src = imagecreatefrompng($lokasi_file);}
else {
$src = imagecreatefromgif($lokasi_file);
}


list($width,$height)=getimagesize($lokasi_file);

$width_new = $slider_width;
$height_new = $slider_height;
$ratio_ori = $width / $height_new;
$tmp=imagecreatetruecolor($width_new,$height_new);
//imagefill ( $thumb_p, 0, 0, $bg );
imagecopyresampled($tmp,$src,0,0,0,0,$width_new,$height_new,$width,$height);

if (empty($error)) { 

  $query="SELECT position from slider order by position";
  $result =$connection->query($query);
  $row = $result->fetch_assoc();
  $position =$row['position'] + 1;

$directory= "../../../sw-content/slider/".$photo;
$tambah="INSERT INTO slider (slider_url,
                      photo,
                      position,
                      active)
                      values( '$slider_url',
                      '$photo',
                      '$position',
                      'Y')" or die($connection->error.__LINE__); 
          if($connection->query($tambah) === false) { 
          _goto( '../../?mod='.$modul.'');
          $_SESSION['message'] ='Slider Tidak dapat di simpan...!';
          } else   {
          _goto( '../../?mod='.$modul);
           imagejpeg($tmp,$directory,100);
          $_SESSION['slider_url']='';
          $_SESSION['message']='';
          } }

          else{
          foreach ($error as $key => $values) {            
          _goto( '../../?mod='.$modul.'');
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
      }}}
}


// Proses Edit
elseif($modul=='slider' AND $aksi=='edit'){
  $id=mysqli_real_escape_string($connection, $_POST['id']);
$error = array();

if (empty($_POST['slider_url'])) { 
      $error[] = 'tidak boleh kosong';
    } else { 
      $slider_url = mysqli_real_escape_string($connection, $_POST['slider_url']); 
      $_SESSION['slider_url']=$slider_url;
  }

$photo = $_FILES["photo"]["name"];
$lokasi_file = $_FILES['photo']['tmp_name'];  
$ukuran_file = $_FILES['photo']['size'];
$MAX_FILE_SIZE = 100000;

if($photo == ""){ 
if (empty($error)) { 
$update="UPDATE slider SET slider_url='$slider_url' WHERE id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
    _goto( '../../?mod='.$modul.'&op=edit&id='.$id.'');
    $_SESSION['message'] ='Slider Tidak dapat di ubah...!';
} else   {
    _goto('../../?mod='.$modul);
          $_SESSION['slider_url']='';
          $_SESSION['message']='';
} } 

else{
foreach ($error as $key => $values) {            
    _goto( '../../?mod='.$modul.'&op=edit&ido='.$id.'');
    $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}}

else{
$cari= mysqli_query($connection,"SELECT photo from slider where id='$id'");
$data=mysqli_fetch_assoc($cari);
$images_delete = strip_tags($data['photo']);
$tmpfile = "../../../sw-content/slider/".$images_delete;

$extension = getExtension($photo);
$extension = strtolower($extension);
$photo=strip_tags(md5($photo));
$photo="slider-".$photo.".".$extension."";
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
    {
    
_goto( '../../?mod='.$modul.'&op=add'); 
 $_SESSION['message'] ='Gambar yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,GIF.!';
    }
    else
    {

if ($ukuran_file > $MAX_FILE_SIZE)
{
_goto( '../../?mod='.$modul.'&op=add');
 $_SESSION['message'] ='Gambar yang di unggah terlalu besar Maksimal Size 1MB..!';

}

if($extension=="jpg" || $extension=="jpeg" ){
$src = imagecreatefromjpeg($lokasi_file);

}
else if($extension=="png"){
$src = imagecreatefrompng($lokasi_file);}
else {
$src = imagecreatefromgif($lokasi_file);
}


list($width,$height)=getimagesize($lokasi_file);

$width_new = $slider_width;
$height_new = $slider_height;
$ratio_ori = $width / $height_new;
$tmp=imagecreatetruecolor($width_new,$height_new);
//imagefill ( $thumb_p, 0, 0, $bg );
imagecopyresampled($tmp,$src,0,0,0,0,$width_new,$height_new,$width,$height);

$directory= "../../../sw-content/slider/".$photo;
$update="UPDATE slider SET slider_url='$slider_url',
                photo='$photo' WHERE id='$id'" or die($connection->error.__LINE__);  
if($connection->query($update) === false) { 
    _goto( '../../?mod='.$modul.'&op=edit&id='.$id.'');
     $_SESSION['message'] ='Slider Tidak dapat di ubah/error...!';

} else   {
      if(file_exists("../../../sw-content/slider/$images_delete")){
          unlink ($tmpfile);
       }

 _goto('../../?mod='.$modul);
          imagejpeg($tmp,$directory,100);
          $_SESSION['description_1']='';
          $_SESSION['slider_url']='';
          $_SESSION['message']='';
} }}}



if($modul=='slider' AND $aksi=='setactive'){
    $id = strip_tags($_POST['id']);
    $active =strip_tags($_POST['active']);
    $update="UPDATE slider SET active='$active' WHERE id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
 echo 'error'; 
}
else{ echo 'sukses..'; 
}}



if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection, $_GET['id']);
if ($aksi=='delete'){

$cari= mysqli_query($connection,"SELECT photo from slider where id='$id'");
$data=mysqli_fetch_assoc($cari);
$images_delete = strip_tags($data['photo']);
$tmpfile = "../../../sw-content/slider/".$images_delete;

$delete="DELETE FROM slider WHERE id='$id'"; 
if($connection->query($delete) === true) { 
_goto( '../../?mod=slider'); // sukses
$_SESSION['message'] ='';
unlink ($tmpfile);
} else { 
_goto( '../../?mod=slider');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}

else{ echo 'sukses..'; 
}

}
