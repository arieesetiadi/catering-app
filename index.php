<?php //error_reporting(0);
  ob_start();
  session_start();
  include_once 'sw-library/config.php';
  include_once 'sw-library/sw-function.php';
  $config = get_parse_ini('sw-library/config.ini.php');
  require_once 'sw-library/ini.php';
  //ob_start("minify_html");
  $dbhostsql      = DB_HOST;
  $dbusersql      = DB_USER;
  $dbpasswordsql  = DB_PASSWD;
  $dbnamesql      = DB_NAME;
  $connection     = mysqli_connect($dbhostsql, $dbusersql, $dbpasswordsql, $dbnamesql ) or die( mysqli_error($connection));
  
$query = "SELECT folder FROM theme where active='Y'"; 
$result = $connection->query($query) or die($connection->error.__LINE__);
$rows= $result->fetch_assoc();
$folder	=$rows['folder'];
  $website_phone      = $rows_site['site_phone'];
  $website_phone_2    = $rows_site['site_phone_2'];
  $website_email      = $rows_site['site_email'];
  $website_addres     = $rows_site['site_office_address'];
  $google_map         = $rows_site['google_map'];
  $website_name       = $rows_site['site_name'];
  $website_url        = $rows_site['site_url'];
  $website_sub_url    = $rows_site['sub_url'];
  $meta_description   = $rows_site['site_description'];
  $meta_keyword       = $rows_site['site_keyword'] ;
  $favicon            =''.$website_url.'/'.$rows_site['site_favicon'].'';
  $website_logo       = $rows_site['site_logo'];
  $mode_maintenance   = $rows_site['maintenance_mode'];
  $social_facebook    = $rows_site['social_facebook'];
  $social_twitter     = $rows_site['social_twitter'];
  $social_google      = $rows_site['social_google'];
  $social_rss         = $rows_site['social_rss'];
  $ipstat      = $_SERVER['REMOTE_ADDR'];
  $tanggalstat = date("Y-m-d-");
  $waktustat   = time();
  $shortby     ='';
$iB = getBrowser();
$browser= $iB['name'];
$host_name =gethostbyaddr($_SERVER['REMOTE_ADDR']);

  $querystat="SELECT hits from statistic where ip='$ipstat' AND tanggal='$tanggalstat'";
  $resultstat=$connection->query($querystat)or die($connection->error.__LINE__);
if($resultstat->num_rows > 0){
    $rowstat= $resultstat->fetch_assoc();
    $hitspro     = $rowstat['hits'];
    $hitspro     = $hitspro+1;

$update="UPDATE statistic SET hits='$hitspro',
online='$waktustat' WHERE ip='$ipstat' AND tanggal='$tanggalstat'" or die($connection->error.__LINE__); 
$connection->query($update) or die($connection->error.__LINE__); 

  }else{
//insert statisctic
$insert="INSERT INTO statistic (ip, tanggal, hits, online) values('$ipstat', '$tanggalstat', '1', '$waktustat')" or die($connection->error.__LINE__);
$connection->query($insert) or die($connection->error.__LINE__);
}

  if ($mode_maintenance == "Y"){
      //header('location:maintenance.html');
  }else{
//$mod = "home";
if(!empty($_GET['mod'])){ $mod = mysqli_escape_string($connection, @$_GET['mod']);}
else {$mod ='home';}
if(file_exists("sw-content/themes/$folder/$mod.php")){
    $cacheuri  = $_SERVER['REQUEST_URI'];
   require_once("sw-content/themes/$folder/$mod.php");
}else{
  require_once("sw-content/themes/$folder/404.php");
  }}
ob_end_flush(); // minify_html
?>