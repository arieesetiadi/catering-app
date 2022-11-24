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


// Proses Multi set

if ($modul=='order' AND $aksi == 'multistatus'){
        $idArr = $_POST['item'];
        $status = strip_tags($_POST['status']);
        //$redirect = strip_tags($_POST['redirect']);
        if($status !==''){
        foreach($idArr as $id){
        //   $status = strip_tags($_POST['status']);
        mysqli_query($connection,"UPDATE order_item SET order_status='$status' WHERE order_id=".$id);
  } 
     _goto( '../../?mod='.$modul.'');
    
  }

  else{
      _goto( '../../?mod='.$modul.'');
  }}



// Proses Update Traking di detail inovice

elseif ( $modul == 'order' AND $aksi == 'invoice-status'){
      $order_id         = strip_tags($_POST['order_id']);
      $order_status     = strip_tags($_POST['order_status']);
if($order_status && $order_id){
    $update="UPDATE order_item SET order_status='$order_status' WHERE order_id='$order_id'" or die($connection->error.__LINE__); 

if($connection->query($update) === false) { 
    _goto('../../?mod='.$modul.'&op=invoice&id='.epm_encode($order_id).''); // error
        
} else   {
   _goto('../../?mod='.$modul.'&op=invoice&id='.epm_encode($order_id).'');
     
} 

} else{

    _goto('../../?mod='.$modul.'&op=invoice&id='.epm_encode($order_id).''); // jika kosong
    $_SESSION['notif']='Pilih status dengan benar..!';
}}


if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection,@$_GET['aksi']);
$id =mysqli_real_escape_string($connection,epm_decode($_GET['id']));
if ($aksi=='delete'){
$delete="DELETE FROM order_item WHERE order_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($delete) === true) { 
  _goto( '../../?mod=order');
  $_SESSION['message']='';
} else { 
    _goto( '../../?mod=order');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


}
