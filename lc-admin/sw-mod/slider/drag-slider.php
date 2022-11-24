<?php
@session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../login' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
$update='';

if(!empty($_POST['update'])){
$update = $_POST['update'];
}

$array	= $_POST['arrayorder'];
if ($_POST['update'] == "update"){
	$count = 1;
	foreach ($array as $idval) {
	$query = "UPDATE slider SET position=".$count." WHERE id=".$idval;
	mysqli_query($connection,$query) or die('Error, insert query failed');
		$count ++;	}
	echo 'Slider berhasil disimpan..!';
}

}
?>