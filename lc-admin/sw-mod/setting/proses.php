<?php
session_start();
 if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include('../../../sw-library/sw-function.php');
$config = get_parse_ini('../../../sw-library/config.ini.php');
require_once '../../../sw-library/ini.php';
$ini_file = "../../../sw-library/config.ini.php";

$modul='';
$aksi='';
$modul2='';
$aksi2='';


if(!empty($_POST['modul'])){
$modul = $_POST['modul'];
}

if(!empty($_POST['aksi'])){
$aksi = $_POST['aksi'];
}

if(!empty($_POST['modul2'])){
$modul2 = $_POST['modul2'];
}

if(!empty($_POST['aksi'])){
$aksi2 = $_POST['aksi'];
}


// Sitename
if ( $modul == 'setting' AND $aksi == 'site_name'){
  if(!empty($_POST['post'])){
    $sitename = strip_tags($_POST['post']);
$update=mysqli_query($connection, "UPDATE site SET site_name='$sitename' WHERE site_id=1");
  }else{
    $sitename = '.......';
$update=mysqli_query($connection, "UPDATE site SET site_name='$sitename' WHERE site_id=1");
  }
  echo strip_tags($_POST['post']);
}

elseif ( $modul == 'setting' AND $aksi == 'site_url' ){
  $site_url = mysqli_real_escape_string($connection,$_POST['post']);
  if($site_url == ''){$site_url ='#';}
$up=mysqli_query($connection, "UPDATE site SET site_url='$site_url' WHERE site_id=1");
  echo strip_tags($_POST['post']);
}

elseif ( $modul == 'setting' AND $aksi == 'sub_url' ){
  $sub_url = mysqli_real_escape_string($connection,$_POST['post']);
  if($sub_url == ''){$site_url ='#';}
$up=mysqli_query($connection, "UPDATE site SET sub_url='$sub_url' WHERE site_id=1");
  echo strip_tags($_POST['post']);
}

elseif ( $modul == 'setting' AND $aksi == 'site_owner'){
  $site_owner = mysqli_real_escape_string($connection,$_POST['post']);
  if($site_owner == ''){$site_owner='CMS s-widodo.com';}
$up=mysqli_query($connection, "UPDATE site SET site_owner='$site_owner' WHERE site_id=1");
  echo strip_tags($_POST['post']);
}

elseif ($modul=='setting' AND $aksi=='site_email'){
  $site_email = mysqli_real_escape_string($connection,$_POST['post']);
  if($site_email == ''){$site_email='swidodocom@yahoo.com';}
$up=mysqli_query($connection, "UPDATE site SET site_email='$site_email' WHERE site_id=1");
  echo strip_tags($_POST['post']);

}

elseif ($modul=='setting' AND $aksi=='site_phone'){
  if(!empty($_POST['post'])){
  $phone=mysqli_real_escape_string($connection,$_POST['post']);
$up=mysqli_query($connection, "UPDATE site SET site_phone='$phone' WHERE site_id=1");
  }else{
  $phone='.......';
$up=mysqli_query($connection, "UPDATE site SET site_phone='$phone' WHERE site_id=1");
  }
  echo strip_tags($phone);
}

elseif ($modul=='setting' AND $aksi=='site_phone_2'){
  if(!empty($_POST['post'])){
  $phone_2=mysqli_real_escape_string($connection,$_POST['post']);
$up=mysqli_query($connection, "UPDATE site SET site_phone_2='$phone_2' WHERE site_id=1");
  }else{
  $phone_2='.......';
$up=mysqli_query($connection, "UPDATE site SET site_phone_2='$phone_2' WHERE site_id=1");
  }
  echo strip_tags($phone_2);
}


elseif ($modul=='setting' AND $aksi=='site_address'){
 $site_address = mysqli_real_escape_string($connection,$_POST['post']);
 if($site_address == ''){$site_address='#';}
$up=mysqli_query($connection, "UPDATE site SET site_office_address='$site_address' WHERE site_id=1");
  echo strip_tags($_POST['post']);
}
elseif ($modul=='setting' AND $aksi=='site_description'){
$site_description = mysqli_real_escape_string($connection,$_POST['post']);
if($site_description == ''){$site_description='#';}
$up=mysqli_query($connection, "UPDATE site SET site_description='$site_description' WHERE site_id=1");
  echo strip_tags($_POST['post']);
}

elseif ($modul=='setting' AND $aksi=='site_keyword'){
$site_keyword = mysqli_real_escape_string($connection,$_POST['post']);
if($site_keyword == ''){$site_keyword='#';}
$up=mysqli_query($connection, "UPDATE site SET site_keyword='$site_keyword' WHERE site_id=1");

  echo strip_tags($_POST['post']);

}

elseif ($modul=='setting' AND $aksi=='maintenance_mode'){
$active = strip_tags($_POST['post']);
$up=mysqli_query($connection, "UPDATE site SET maintenance_mode='$active' WHERE site_id=1");
}


elseif ($modul=='setting' AND $aksi=='social_fb'){
$facebook= mysqli_real_escape_string($connection,$_POST['post']);
if($facebook == ''){$facebook='#';}
$up=mysqli_query($connection, "UPDATE site SET social_facebook='$facebook' WHERE site_id=1");
  echo mysqli_real_escape_string($connection,$_POST['post']);

}

elseif ($modul=='setting' AND $aksi=='social_twit'){
$twitter = mysqli_real_escape_string($connection,$_POST['post']);
if($twitter == ''){$twitter='#';}
$up=mysqli_query($connection, "UPDATE site SET social_twitter='$twitter' WHERE site_id=1");
  echo mysqli_real_escape_string($connection,$_POST['post']);

}

elseif ($modul=='setting' AND $aksi=='social_google')
{
$google = mysqli_real_escape_string($connection,$_POST['post']);
$up=mysqli_query($connection, "UPDATE site SET social_google='$google' WHERE site_id=1");
  echo mysqli_real_escape_string($connection,$_POST['post']);
}

elseif ($modul=='setting' AND $aksi=='social_instagram'){
$instagram = mysqli_real_escape_string($connection,$_POST['post']);
if($instagram == ''){$instagram='@username';}
$up=mysqli_query($connection, "UPDATE site SET social_instagram='$instagram' WHERE site_id=1");
  echo mysqli_real_escape_string($connection,$_POST['post']);
}


elseif ($modul=='setting' AND $aksi=='social_line'){
$line= mysqli_real_escape_string($connection,$_POST['post']);
if($line == ''){$line='username';}
$up=mysqli_query($connection, "UPDATE site SET social_line='$line' WHERE site_id=1");
  echo mysqli_real_escape_string($connection,$_POST['post']);
}

elseif ($modul=='setting' AND $aksi=='social_bbm'){
$bbm= mysqli_real_escape_string($connection,$_POST['post']);
if($bbm == ''){$bbm='PIN BBM';}
$up=mysqli_query($connection, "UPDATE site SET social_bbm='$bbm' WHERE site_id=1");
  echo mysqli_real_escape_string($connection,$_POST['post']);
}


elseif ($modul=='setting' AND $aksi=='social_rss'){
$rss = mysqli_real_escape_string($connection,$_POST['post']);
if($rss == ''){$rss='#';}
$up=mysqli_query($connection, "UPDATE site SET social_rss='$rss' WHERE site_id=1");
  echo mysqli_real_escape_string($connection,$_POST['post']);

}


elseif ($modul=='setting' AND $aksi=='livecat'){
$live_cat = mysqli_real_escape_string($connection,$_POST['live_cat']);
$up=mysqli_query($connection, "UPDATE site SET live_cat='$live_cat' WHERE site_id=1");
 _goto( '../../?mod='.$modul);
}




elseif ($modul=='setting' AND $aksi=='id_map'){
$google_map = mysqli_escape_string($connection,$_POST['post']);
$up=mysqli_query($connection, "UPDATE site SET google_map='$google_map' WHERE site_id=1");
  echo mysqli_escape_string($connection,$_POST['post']);

}


// id google
elseif ($modul=='setting' AND $aksi=='id_googleweb'){
$id_googleweb= mysqli_real_escape_string($connection,$_POST['post']);
if($id_googleweb== ''){$id_googleweb='#';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['id_googleweb'] = $id_googleweb;
put_ini_file("$ini_file", $ini_value, $i = 0);
  echo mysqli_real_escape_string($connection,$_POST['post']);
}

// id google analistik
elseif ($modul=='setting' AND $aksi=='id_googlean'){
$id_googlean= mysqli_real_escape_string($connection,$_POST['post']);
if($id_googlean == ''){$id_googlean='#';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['id_googlean'] = $id_googlean;
put_ini_file("$ini_file", $ini_value, $i = 0);
  echo mysqli_real_escape_string($connection,$_POST['post']);
}

// id alexa
elseif ($modul=='setting' AND $aksi=='id_alexa'){
$id_alexa= mysqli_real_escape_string($connection,$_POST['post']);
if($id_alexa == ''){$id_alexa='#';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['id_alexa'] = $id_alexa;
put_ini_file("$ini_file", $ini_value, $i = 0);
  echo mysqli_real_escape_string($connection,$_POST['post']);
}

// id bing
elseif ($modul=='setting' AND $aksi=='id_bing'){
$id_bing= mysqli_real_escape_string($connection,$_POST['post']);
if($id_bing == ''){$id_bing='#';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['id_bing'] = $id_bing;
put_ini_file("$ini_file", $ini_value, $i = 0);
  echo mysqli_real_escape_string($connection,$_POST['post']);
}

// id yahoo
elseif ($modul=='setting' AND $aksi=='id_yahoo'){
$id_yahoo= mysqli_real_escape_string($connection,$_POST['post']);
if($id_yahoo == ''){$id_yahoo='http://yahoo.com';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['id_yahoo'] = $id_yahoo;
put_ini_file("$ini_file", $ini_value, $i = 0);
  echo mysqli_real_escape_string($connection,$_POST['post']);

}

// facebook
elseif ($modul=='setting' AND $aksi=='id_facebook'){
$id_facebook= mysqli_real_escape_string($connection,$_POST['post']);
if($id_facebook == ''){$id_facebook='http://facebook.com';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['id_facebook'] = $id_facebook;
put_ini_file("$ini_file", $ini_value, $i = 0);
  echo mysqli_real_escape_string($connection,$_POST['post']);
}

// format tanggal
elseif ($modul=='setting' AND $aksi=='format_tanggal'){
$timezone= strip_tags($_POST['post']);
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['timezone'] = $timezone;
put_ini_file("$ini_file", $ini_value, $i = 0);

if($timezone == 'ID'){$post=''.tgl_indo($tanggal).' '.$jam_sekarang;}
else{$post=''.$tgl_jam.'';}
  echo strip_tags($post);
}

// Item Artikel
elseif ($modul=='setting' AND $aksi=='item_artikel'){
$item_artikel= strip_tags($_POST['post']);
if($item_artikel == ''){$item_artikel='0';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['item_artikel'] = $item_artikel;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);
}

// Item Artikel
elseif ($modul=='setting' AND $aksi=='item_related_artikel'){
$item_related_artikel= strip_tags($_POST['post']);
if($item_related_artikel == ''){$item_related_artikel='0';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['item_related_artikel'] = $item_related_artikel;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);
}

// Item Produk
elseif ($modul=='setting' AND $aksi=='item_produk'){
$item_produk= strip_tags($_POST['post']);
if($item_produk == ''){$item_produk='0';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['item_produk'] = $item_produk;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);
}

// Item Produk terkait
elseif ($modul=='setting' AND $aksi=='item_related_produk'){
$item_related_produk= strip_tags($_POST['post']);
if($item_related_produk == ''){$item_related_produk='0';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['item_related_produk'] = $item_related_produk;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);

}

// KOmentar MOde
elseif ($modul=='setting' AND $aksi=='komentar_mode'){
$komentar_mode= strip_tags($_POST['post']);
if($komentar_mode == ''){$komentar_mode='N';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['komentar_mode'] = $komentar_mode;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);}

//kometar id
elseif ( $modul == 'setting' AND $aksi == 'komentar'){
  //if( $modify_access == "Y" ){
    $filename = "../../../sw-library/komentar.txt";
    if ( file_exists("$filename") ){
      $data = $_POST['meta_content'];
      $newdata = stripslashes($data);
      if ( $newdata != '' ){
        $fw = fopen( $filename, 'w' ) or die( 'Could not open file!' );
        $fb = fwrite( $fw, $newdata ) or die( 'Could not write to file' );
        fclose( $fw );
      }
    }
    _goto( '../../?mod='.$modul);
  }

  // Mail info
elseif ($modul=='setting' AND $aksi=='mail_info'){
$mail_info= mysqli_real_escape_string($connection,$_POST['post']);
if($mail_info == ''){$mail_info='info@domain.com';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['mail_info'] = $mail_info;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);

}

// Mail no reply
elseif ($modul=='setting' AND $aksi=='mail_noreply'){
$mail_noreply= mysqli_real_escape_string($connection,$_POST['post']);
if($mail_noreply == ''){$mail_noreply ='noreply@domain.com';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['mail_noreply'] = $mail_noreply;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);
}

// Protocol
elseif ($modul=='setting' AND $aksi=='protocol'){
$protocol= mysqli_real_escape_string($connection,$_POST['post']);
if($protocol == ''){$protocol ='0';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['protocol'] = $protocol;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);

}
// Hostname
elseif ($modul=='setting' AND $aksi=='hostname'){
$hostname= mysqli_real_escape_string($connection,$_POST['post']);
if($hostname == ''){$hostname ='#';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['hostname'] = $hostname;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);

}

// Hostname
elseif ($modul=='setting' AND $aksi=='usermail'){
$usermail= mysqli_real_escape_string($connection,$_POST['post']);
if($usermail == ''){$usermail ='#';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['usermail'] = $usermail;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);

}

// passmail
elseif ($modul=='setting' AND $aksi=='passmail'){
$passmail= mysqli_real_escape_string($connection,$_POST['post']);
if($passmail == ''){$passmail ='#';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['passmail'] = $passmail;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);
}

// Port
elseif ($modul=='setting' AND $aksi=='portmail'){
$portmail= mysqli_real_escape_string($connection,$_POST['post']);
if($portmail == ''){$portmail ='0';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['portmail'] = $portmail;
put_ini_file("$ini_file", $ini_value, $i = 0);
echo strip_tags($_POST['post']);
}

elseif ($modul=='setting' AND $aksi=='site_favicon') {
  $extensionList = array("jpg", "png", "ico");
  $fileName       = $_FILES['file']['name'];
  $tmpName        = $_FILES['file']['tmp_name'];
  $fileType       = $_FILES['file']['type'];
  $fileSize       = $_FILES['file']['size'];
  $pecah          = explode(".", $fileName);
  $ekstensi       = $pecah[1];
  $nama_file      = "favicon.";
  $nama_file_unik = $nama_file.$ekstensi;
  $namaDir        = '../../../';
  $pathFile       = $namaDir.$nama_file_unik;
    if ($fileSize < 100000) {
  if ( !empty($tmpName) )
  {
        if ( in_array($ekstensi, $extensionList) ){
          $query = "SELECT site_favicon FROM site"; 
          $result = $connection->query($query);
          $rows= $result->fetch_assoc();
          $favicon = $rows['site_favicon'];
          if(file_exists("../../../sw-content/upload/galery/".$rows['site_favicon']."")){
          unlink( "../../../$favicon" );}
          move_uploaded_file( $tmpName, $pathFile );
$up=mysqli_query($connection, "UPDATE site SET site_favicon='$nama_file_unik' WHERE site_id=1");
 _goto( '../../?mod='.$modul);
    $_SESSION['message'] = '';

        }else{
        _goto( '../../?mod='.$modul);
      $_SESSION['message'] ='Favicon tidak berhasil diubah..!';
        }
  }
  else{
       _goto( '../../?mod='.$modul);
        $_SESSION['message'] ='Gambar yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,PNG..!';
  }
}
else{_goto( '../../?mod='.$modul);
        $_SESSION['message'] ='Gambar yang di unggah terlalu besar, maksimal 100 KB..!';
}}

// site logo
elseif ($modul=='setting' AND $aksi=='site_logo'){
  $extensionList = array("jpg", "png", "ico");
  $fileName       = $_FILES['file']['name'];
  $tmpName        = $_FILES['file']['tmp_name'];
  $fileType       = $_FILES['file']['type'];
  $fileSize       = $_FILES['file']['size'];
  $pecah          = explode(".", $fileName);
  $nama_logo      = $pecah[0];
  $ekstensi       = $pecah[1];
  $nama_file      = "sw-$nama_logo.";
  $nama_file_unik = $nama_file.$ekstensi;
  $namaDir        = '../../../sw-content/';
  $pathFile       = $namaDir.$nama_file_unik;
    if ($fileSize < 100000) {
  if ( !empty($tmpName) )
  {
        if ( in_array($ekstensi, $extensionList) ){
          $query = "SELECT site_logo FROM site"; 
          $result = $connection->query($query);
          $rows= $result->fetch_assoc();
        	$logo = $rows['site_logo'];
        	if(file_exists("../../../sw-content/upload/galery/$logo")){
          	unlink( "../../../sw-content/$logo" );
        }
          move_uploaded_file( $tmpName, $pathFile );
$up=mysqli_query($connection, "UPDATE site SET site_logo='$nama_file_unik' WHERE site_id=1");
 _goto( '../../?mod='.$modul);

    $_SESSION['message'] = '';

        }else{
        _goto( '../../?mod='.$modul);
    $_SESSION['message'] ='Logo Website tidak berhasil diubah..!';
        }
  }
  else{
       _goto( '../../?mod='.$modul);

        $_SESSION['message'] ='Gambar yang di unggah tidak sesuai dengan format, Berkas harus berformat JPG,JPEG,PNG..!';
  }
}
else{_goto( '../../?mod='.$modul);

        $_SESSION['message'] ='Gambar yang di unggah terlalu besar, maksimal 100 KB..!';
}}

// size logo
elseif ($modul=='setting' AND $aksi=='logo_size'){
$logo_size= strip_tags($_POST['post']);
if($logo_size == ''){$logo_size='200x100';}
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['logo_size'] = $logo_size;
put_ini_file("$ini_file", $ini_value, $i = 0);
  echo strip_tags($_POST['post']);
}
// backup database
elseif ($modul=='setting' AND $aksi=='backup'){
$DB_HOST    = DB_HOST;
$DB_USER    = DB_USER;
$DB_PASSWD  = DB_PASSWD;
$DB_NAME    = DB_NAME;
$connection = mysqli_connect($DB_HOST , $DB_USER , $DB_PASSWD, $DB_NAME) or die(mysqli_error($connection));

$tables = '*';

//get all of the tables
if($tables == '*'){
  $tables = array();
  $result = mysqli_query($connection,'SHOW TABLES');
  while($row = mysqli_fetch_row($result)){
    $tables[] = $row[0];
  }
}else{
  $tables = is_array($tables) ? $tables : explode(',',$tables);
}

//cycle through
foreach($tables as $table){
  $result = mysqli_query($connection,'SELECT * FROM '.$table);
  $num_fields = mysqli_num_fields($result);

  $return.= 'DROP TABLE IF EXISTS '.'`'.$table.'`'.';';
  $row2 = mysqli_fetch_row(mysqli_query($connection,'SHOW CREATE TABLE `'.$table.'`'));
  $return.= "\n\n".$row2[1].";\n\n";
  for ($i = 0; $i < $num_fields; $i++) {
    while($row = mysqli_fetch_row($result)){
      $return.= 'INSERT INTO `'.$table.'` VALUES(';
      for($j=0; $j<$num_fields; $j++) {
        $row[$j] = addslashes($row[$j]);
        $row[$j] = preg_replace("/\r\n/","\\r\\n",$row[$j]);
        if (isset($row[$j])) { $return.= '\''.$row[$j].'\'' ; } else { $return.= '\'\''; }
        if ($j<($num_fields-1)) { $return.= ','; }
      }
      $return.= ");\n";
    }
  }
  $return.="\n\n\n";
}

//save file
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=db-backup".date("Ymd")."-".date('Hi').".sql");
header("Pragma: no-cache");
header("Expires: 0");
print "$return";

}
elseif ($modul=='setting' AND $aksi=='restore'){
$extensionList = array("sql");
$fileName = $_FILES['fupload']['name'];
$tmpName = $_FILES['fupload']['tmp_name'];
$fileType = $_FILES['fupload']['type'];
$fileSize = $_FILES['fupload']['size'];
$pecah = explode(".", $fileName);
$ekstensi = $pecah[1];
$title = $pecah[0];
$seotitle = seo_title($title);
$acak = rand(000000,999999);
$nama_file = "-Sw.";
$nama_file_unik = $seotitle.'-'.$acak.$nama_file.'.'.$ekstensi;
$namaDir = '../../../sw-content/upload/';
$pathFile = $namaDir.$nama_file_unik;

if (!empty($tmpName)){
  if (in_array($ekstensi, $extensionList)){
    move_uploaded_file($tmpName, $pathFile);
    $path = "../../../sw-content/upload/";
    $sql_filename = "$nama_file_unik";

    $DB_HOST  = DB_HOST;
    $DB_USER  = DB_USER;
    $DB_PASSWD = DB_PASSWD;
    $DB_NAME  = DB_NAME;
    $connection = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWD,$DB_NAME) or die (mysqli_error($connection));

    $templine = '';
    $lines = file($pathFile);
    foreach ($lines as $line)
    {
        if(substr($line, 0, 2) == '--' || $line == '')
            continue;

        $templine .= $line;

        if(substr(trim($line), -1, 1) == ';')
        {
            mysqli_query($connection, $templine) or print('Query gagal \'<strong>' .$templine. '\' : ' .mysqli_error() . '<br/><br/>');

          $templine = '';
        }
    }

    unlink("../../../sw-content/uploads/$nama_file_unik");
    _goto('../../?mod=home');
  }else{
    _goto('index.html');
  }
}else{
  _goto('index.html');
}
}

elseif ( $modul == 'setting' AND $aksi == 'metasocial' ){
  //if( $modify_access == "Y" ){
    $filename = "../../../sw-library/meta-social.txt";
    if ( file_exists("$filename") ){
      $data = $_POST['meta_content'];
      $newdata = stripslashes($data);
      if ( $newdata != '' ){
        $fw = fopen( $filename, 'w' ) or die( 'Could not open file!' );
        $fb = fwrite( $fw, $newdata ) or die( 'Could not write to file' );
        fclose( $fw );
      }
    }
    _goto( '../../?mod='.$modul);
  }
  //else{
  // _goto( '../../?mod='.$modul);
  // $_SESSION['message'] ='Meta Sosial tidak berhasil diubah...!';
  //}
else
{
  echo "Tidak punya akses ke halaman ini";
}
}
