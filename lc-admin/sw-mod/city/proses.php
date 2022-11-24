<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../login' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include('../../../sw-library/sw-function.php');

$modul='';$aksi='';

if(!empty($_POST['modul'])){$modul = $_POST['modul'];}

if(!empty($_POST['aksi'])){$aksi = $_POST['aksi'];}

// add
if ($modul=='city' AND $aksi=='add'){
$error = array();
if (empty($_POST['city_name'])) {//if no name has been supplied 
        $error[] = 'tidak boleh kosong';//add to array "error"
    } else {
    $city_name = mysqli_real_escape_string($connection, $_POST['city_name']);
    }

if (empty($error)) { 
    // mencari city_name yang sama
$query ="SELECT city_name FROM city WHERE city_name ='$city_name'";
$result= $connection->query($query) or die($connection->error.__LINE__);
$hasil= $result->num_rows;
if ($hasil== 0){

$tambah= "INSERT INTO city(city_name,active) values('$city_name','Y')" or die($connection->error.__LINE__); 
if($connection->query($tambah) === false) { 
  die($connection->error.__LINE__); 
  _goto('../../?mod='.$modul); // error
  $_SESSION['message'] ='Lokasi Tidak dapat di publish...!';
} else   {

_goto('../../?mod='.$modul); // sukses
  $_SESSION['message']='';
} }

else   {
_goto('../../?mod='.$modul); // error
  $_SESSION['message'] ='Alamat Kota Tidak dapat di publish...!';
 }
}

else{
foreach ($error as $key => $values) {            
    _goto('../../?mod='.$modul);
   $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}

}


// edit
elseif ($modul=='city' AND $aksi=='edit'){
 $error = array();
 $id = mysqli_real_escape_string($connection, $_POST['id']);
if (empty($_POST['city_name'])) {//if no name has been supplied 
        $error[] = 'tidak boleh kosong';//add to array "error"
    } else {
        $city_name = mysqli_real_escape_string($connection, $_POST['city_name']);
    }

if (empty($error)) { 
$update="UPDATE city SET city_name='$city_name' WHERE city_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
    _goto('../../?mod='.$modul); // error
    $_SESSION['message'] ='Lokasi Tidak dapat di publish...!';

} else   {
  _goto('../../?mod='.$modul); // sukses
  $_SESSION['message']='';
} }

else{
foreach ($error as $key => $values) {            
  _goto('../../?mod='.$modul);
  $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}
}


if($modul=='city' AND $aksi=='setactive'){
    $id = $_POST['id'];
    $active = $_POST['active'];
    $update="UPDATE city  SET active='$active' WHERE city_id='$id'" or die($connection->error.__LINE__); 
    if($connection->query($update) === false) { 
      echo 'error'; 
}
  else{
      echo 'sukses..'; 
}}


if(!empty($_GET['id'])){ 
    $aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
    $id =mysqli_real_escape_string($connection, $_GET['id']);

if ($aksi=='delete'){
    $delete="DELETE FROM city WHERE city_id='$id'" or die($connection->error.__LINE__); 
  if($connection->query($delete) === true) { 
    _goto( '../../?mod=city'); // sukses
} else { 
    _goto( '../../?mod=city');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}



}
