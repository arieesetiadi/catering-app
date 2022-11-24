<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) ){
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

// change theme color
if ($modul == 'home' AND $aksi == 'adtheme' ){ 
    $localAdTheme = $_POST['adtheme'];
$up=mysqli_query($connection, "UPDATE user SET colortheme='$localAdTheme' WHERE user_id='$rows_login[user_id]'");
    header('location:../../');
}

//change screen language
elseif ( $modul == 'home' AND $aksi == 'adlang' ){
  $langid = strip_tags($_POST['lang']);
  $up=mysqli_query($connection,"UPDATE user SET lang='$langid' WHERE user_id='$rows_login[user_id]'");

$query="SELECT langcode from language where id='$langid'";
$result=$connection->query($query);
$row_lang= $result->fetch_assoc();  
  $_SESSION['lang'] =$row_lang['langcode'];
 header('location:../../');
}

else {
_goto( '../../404.php');
}

}
