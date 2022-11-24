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
if ($modul=='store' AND $aksi=='add'){
$error = array();

if (empty($_POST['store_name'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_name = mysqli_real_escape_string($connection, $_POST['store_name']);
    $_SESSION['store_name']=$store_name;
    }

if (empty($_POST['store_phone'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_phone = mysqli_real_escape_string($connection, $_POST['store_phone']);
    $_SESSION['store_phone']=$store_phone;
    }


if (empty($_POST['store_city'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_city = mysqli_real_escape_string($connection, $_POST['store_city']);
    $_SESSION['store_city']=$store_city;
    }

if (empty($_POST['store_address'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_address = mysqli_real_escape_string($connection, $_POST['store_address']);
    $_SESSION['store_address']=$store_address;
    }

if (empty($_POST['store_postal'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_postal = mysqli_real_escape_string($connection, $_POST['store_postal']);
    $_SESSION['store_postal']=$store_postal;
    }

if (empty($error)) { 
    // mencari title yang sama
$query ="SELECT store_id,store_name FROM store WHERE store_name='$store_name'";
$result= $connection->query($query) or die($connection->error.__LINE__);
$hasil= $result->num_rows;
if ($hasil== 0){
  $tambah= "INSERT INTO store (store_id,
                        user_id,
                        store_name,
                        store_phone,
                        store_city,
                        store_address,
                        store_postal,
                        active) values('$store_id',
                        '$author',
                        '$store_name', 
                        '$store_phone', 
                        '$store_city' ,
                        '$store_address',
                        '$store_postal',
                        'Y')" or die($connection->error.__LINE__); 
if($connection->query($tambah) === false) { 
  die($connection->error.__LINE__); 
    _goto('../../?mod='.$modul); // error
    $_SESSION['message'] ='Toko Tidak dapat di publish...!';
} else   {

_goto('../../?mod='.$modul); // sukses
    $_SESSION['store_name']='';
    $_SESSION['store_phone']='';
    $_SESSION['store_city']='';
    $_SESSION['store_address']='';
    $_SESSION['store_postal']='';
    $_SESSION['message']='';
} }

else   {
  _goto('../../?mod='.$modul); // error
  $_SESSION['message'] ='Toko sudah terdaftar sudah tersedia...!';
 }
}

else{
foreach ($error as $key => $values) {            
  _goto('../../?mod='.$modul);
  $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}

}
// edit
elseif ($modul=='store' AND $aksi=='update'){
 $error = array();

 $id = mysqli_real_escape_string($connection, $_POST['id']);
 $id = mysqli_real_escape_string($connection, $_GET['id']);

if (empty($_POST['store_name'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_name = mysqli_real_escape_string($connection, $_POST['store_name']);
    $_SESSION['store_name']=$store_name;
    }

if (empty($_POST['store_phone'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_phone = mysqli_real_escape_string($connection, $_POST['store_phone']);
    $_SESSION['store_phone']=$store_phone;
    }


if (empty($_POST['store_city'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_city = mysqli_real_escape_string($connection, $_POST['store_city']);
    $_SESSION['store_city']=$store_city;
    }

if (empty($_POST['store_address'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_address = mysqli_real_escape_string($connection, $_POST['store_address']);
    $_SESSION['store_address']=$store_address;
    }

if (empty($_POST['store_postal'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $store_postal = mysqli_real_escape_string($connection, $_POST['store_postal']);
    $_SESSION['store_postal']=$store_postal;
    }

if (empty($error)) { 
$update="UPDATE store SET store_name='$store_name',
                          store_phone='$store_phone',
                          store_city='$store_city',
                          store_address='$store_address',
                          store_postal='$store_postal' WHERE store_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
  die($connection->error.__LINE__); 
  _goto('../../?mod='.$modul); // error
$_SESSION['message'] ='Toko Tidak dapat di ubah...!';
} else   {

_goto('../../?mod='.$modul); // sukses
    $_SESSION['store_name']='';
    $_SESSION['store_phone']='';
    $_SESSION['store_city']='';
    $_SESSION['store_address']='';
    $_SESSION['store_postal']='';
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
$delete="DELETE FROM store WHERE store_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($delete) === true) { 
  _goto( '../../?mod=store'); // sukses
} else { 
_goto( '../../?mod=store');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


// Proses Multi Delete Post
elseif ($modul=='store' AND $aksi=='multidelete'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
          mysqli_query($connection,"DELETE FROM store WHERE store_id=".$id);
  }
 _goto( '../../?mod='.$modul.'');
}

}
