<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location:404.php');
}else{
  include_once "../../../sw-library/sw-process.php";
  include_once "../../../sw-library/sw-function.php";

  $id = $_POST['id'];
  $instance = new SigerTable( 'user_level' );
  $data = $instance->selectAll( "level_id = '$id'" )->current();
  echo json_encode( $data );

}
