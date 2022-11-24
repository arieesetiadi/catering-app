<?php 
session_start();
 if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../../login');
}else{
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


if ($modul=='profile' AND $aksi=='fullname'){
  $fullname= strip_tags($_POST['post']);
  if($fullname == ''){$fullname='--------';}
$up=mysqli_query($connection, "UPDATE user SET fullname='$fullname' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}
elseif ($modul=='profile' AND $aksi=='gender'){
  $gender= strip_tags($_POST['post']);
  if($gender == ''){$gender='------';}
$up=mysqli_query($connection, "UPDATE user_profile SET gender='$gender' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}
// tahun
elseif ($modul=='profile' AND $aksi=='birthday'){
  $birthday= strip_tags($_POST['post']);
  if($birthday == ''){$birthday='dd/mm/yyyy';}
$up=mysqli_query($connection, "UPDATE user_profile SET birthday='$birthday' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}

// Phone
elseif ($modul=='profile' AND $aksi=='phone'){
  $phone= strip_tags($_POST['post']);
  if($phone == ''){$phone='............';}
$up=mysqli_query($connection, "UPDATE user_profile SET phone='$phone' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}

elseif ($modul=='profile' AND $aksi=='email'){
  $email= strip_tags($_POST['post']);
  if($email == ''){$email='email@domian.com';}
$up=mysqli_query($connection, "UPDATE user SET user_email='$email' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}
elseif ($modul=='profile' AND $aksi=='facebook'){
  $facebook= strip_tags($_POST['post']);
  if($facebook == ''){$facebook='@facebook.com';}
$up=mysqli_query($connection, "UPDATE user_profile SET facebook='$facebook' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}
elseif ($modul=='profile' AND $aksi=='twitter'){
  $twitter= strip_tags($_POST['post']);
  if($twitter == ''){$facebook='@witter.com';}
$up=mysqli_query($connection, "UPDATE user_profile SET twitter='$twitter' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}
elseif ($modul=='profile' AND $aksi=='website'){
  $website= strip_tags($_POST['post']);
  if($website == ''){$website='----------';}
$up=mysqli_query($connection, "UPDATE user SET user_url='$website' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}
elseif ($modul=='profile' AND $aksi=='job'){
  $job= strip_tags($_POST['post']);
  if($job == ''){$facebook='---------';}
$up=mysqli_query($connection, "UPDATE user_profile SET job='$job' WHERE user_id='$rows_login[user_id]'"); 
//
$up=mysqli_query($connection, "UPDATE user SET title='$job' WHERE user_id='$rows_login[user_id]'");
  echo strip_tags($_POST['post']);
}
elseif ($modul=='profile' AND $aksi=='skills'){
  $skill= strip_tags($_POST['post']);
  if($skill == ''){$skill='---';}
$up=mysqli_query($connection, "UPDATE user SET skill='$skill' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}
elseif ($modul=='profile' AND $aksi=='about'){
  $about= strip_tags($_POST['post']);
  if($about == ''){$about='----------';}
$up=mysqli_query($connection, "UPDATE user_profile SET about='$about' WHERE user_id='$rows_login[user_id]'"); 
$up2=mysqli_query($connection, "UPDATE user SET description='$about' WHERE user_id='$rows_login[user_id]'"); 
  echo strip_tags($_POST['post']);
}

elseif ($modul=='profile' AND $aksi=='cover'){
$id = strip_tags($_POST['id']);
$cover= $_FILES["fupload"]["name"];
$lokasi_file = $_FILES['fupload']['tmp_name'];  
$ukuran_file = $_FILES['fupload']['size'];
$extension = getExtension($cover);
$extension = strtolower($extension);
$date = date("Y-m-d_H-i-s");
$cover =strtolower("cover-".$date."".$cover.".".$extension."");
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
   _goto('../../?mod='.$modul.'&id='.$id);
       $_SESSION['message'] ='Gambar yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,PNG..!';
 }
else{

if($extension=="jpg" || $extension=="jpeg" ){
$src = imagecreatefromjpeg($lokasi_file);}
else if($extension=="png"){
$src = imagecreatefrompng($lokasi_file);}
else {
$src = imagecreatefromgif($lokasi_file);}
list($width,$height)=getimagesize($lokasi_file);

$width_new =1900;
$height_new =248;
$ratio_ori = $width / $height_new;
$tmp=imagecreatetruecolor($width_new,$height_new);
imagecopyresampled($tmp,$src,0,0,0,0,$width_new,$height_new,$width,$height);
$directory= "../../../sw-content/upload/cover/".$cover;
$query ="SELECT cover FROM user_profile WHERE user_id='$rows_login[user_id]'"; 
$result = $connection->query($query);
$rows= $result->fetch_assoc();
$oldphoto =$rows['cover']; 
if($oldphoto !==''){
  unlink("../../../sw-content/upload/cover/$oldphoto");
}
$up=mysqli_query($connection, "UPDATE user_profile SET cover='$cover' WHERE user_id='$rows_login[user_id]'");
imagejpeg($tmp,$directory);
  _goto('../../?mod='.$modul.'&id='.epm_encode($id));
$_SESSION['message'] ='';
}}

elseif ($modul=='profile' AND $aksi=='avatar'){
$id = strip_tags($_POST['id']);
$avatar = $_FILES["fupload"]["name"];
$lokasi_file = $_FILES['fupload']['tmp_name'];  
$ukuran_file = $_FILES['fupload']['size'];
$extension = getExtension($avatar);
$extension = strtolower($extension);
$date = date("Y-m-d_H-i-s");
$avatar =strtolower("user-".$date."".$avatar.".".$extension."");
if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
 _goto('../../?mod='.$modul.'&id='.$id);
       $_SESSION['message'] ='Gambar yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,PNG..!';
}
else{

if($extension=="jpg" || $extension=="jpeg" ){
$src = imagecreatefromjpeg($lokasi_file);}
else if($extension=="png"){
$src = imagecreatefrompng($lokasi_file);}
else {
$src = imagecreatefromgif($lokasi_file);}
list($width,$height)=getimagesize($lokasi_file);

$width_new =300;
$height_new =300;
$ratio_ori = $width / $height_new;
$tmp=imagecreatetruecolor($width_new,$height_new);
imagecopyresampled($tmp,$src,0,0,0,0,$width_new,$height_new,$width,$height);
$directory= "../../../sw-content/upload/avatar/".$avatar;

$query = "SELECT photo FROM user WHERE user_id='$rows_login[user_id]'"; 
$result = $connection->query($query);
$rows= $result->fetch_assoc();
$oldphoto =$rows['photo']; 
if($oldphoto !==''){
    if(file_exists("../../../sw-content/upload/avatar/$oldphoto")){
            unlink("../../../sw-content/upload/avatar/$oldphoto");
         }
}

$up=mysqli_query($connection, "UPDATE user SET photo='$avatar' WHERE user_id='$rows_login[user_id]'");
  imagejpeg($tmp,$directory);
  _goto('../../?mod='.$modul.'&id='.epm_encode($id));
  $_SESSION['message'] ='';
}}
else 
{
  echo "error";
}
}

