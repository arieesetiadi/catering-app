<?php error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
$pacth_url	='http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'';
$DB_HOST 	= "localhost";
$DB_USER 	= "root";
$DB_PASSWD  = "";
$DB_NAME 	= "db_catering";
		@define("DB_HOST", $DB_HOST);
		@define("DB_USER", $DB_USER);
		@define("DB_PASSWD" , $DB_PASSWD);
		@define("DB_NAME", $DB_NAME);
$connection = NEW mysqli( $DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME );
if ($connection->connect_error){
//header("location:".base_url."maintenance.html");
	echo 'Gagal koneksi ke database';
} else {
$site = "SELECT * FROM site LIMIT 1";
$result_site = $connection->query($site) or die($connection->error.__LINE__);
$rows_site= $result_site->fetch_assoc();
extract($rows_site);
$website_sub_url =$sub_url;}