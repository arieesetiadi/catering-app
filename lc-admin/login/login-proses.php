<?PHP session_start();
require_once'../../sw-library/config.php'; 
require_once('../sw-library/injection.php');
include_once('../../sw-library/sw-function.php');
$salt = '$%7sadg387435@#&*!=xx^67eywye{a911}+';
$ip_login = $_SERVER['REMOTE_ADDR'];
$time_login= date('Y-m-d H:i:s');
$iB = getBrowser();
$browser= $iB['name'].' '.$iB['version'];
// generate random session
if (isset($_GET['username'])){
	$user_login = $_GET['username'];
	$user_pass = hash('sha256',$salt.$_GET['password']);
	$rd = md5(md5(rand(1000,9999).rand(1,9999).date('ymdhisss')));

$update_user = mysqli_query($connection,"UPDATE user SET time_login='$time_login', ip='$ip_login', browser='$browser', session='$rd' WHERE user_pass='$user_pass'");

$query_login = "SELECT * FROM user WHERE user_login='$user_login' AND user_pass='$user_pass'  AND approve='Y' AND active='Y'"; //login
$result_login = $connection->query($query_login) or die($connection->error.__LINE__);
$login_num = $result_login->num_rows;
$rows= $result_login->fetch_assoc();
		$SESION_LOGIN	= 	$rows['session'];
		$fullname		=	$rows['fullname'];
		$user_login		=	strip_tags($rows['user_login']);
		$SESION_USER 	=	strip_tags($rows['user_id']);

$pesan = "Halo ".$fullname." Saat ini kamu Sedang Membuka Halaman Admin atau Online
[Detail Akun] :
Nama  	  : ".$fullname."
Username  : ".$user_login."
Ip		  : ".$ip_login."
Tgl Login : ".$time_login."
Browser : ".$browser."
\n
Hormat Kami,Tim s-widodo.com\n
Pesan noreply";
  $to = 'notifikasiemail@gmail.com';//notifikasi ke email saat login
  $subject = 'Admin Online';
  $headers = "From: info@domain.com <info@domain.com>\r\n";//domain web kamu
if($login_num == '0'){
	  echo '{"response":{"error": "0"}}';
	} 
else {
	echo '{"response":{"error": "1"}}';
///session
	$_SESSION['SESION_LOGIN']	= $SESION_LOGIN;
	$_SESSION['SESION_USER']	= $SESION_USER;
// language
	$query="SELECT langcode from language where id='$rows[lang]'";
	$result=$connection->query($query);
	$row_lang= $result->fetch_assoc();  
	$_SESSION['lang'] =$row_lang['langcode'];

$_SESSION['KCFINDER']=array();
$_SESSION['KCFINDER']['disabled'] = false;
//$_SESSION['KCFINDER']['uploadURL'] = "../../../sw-content/upload/";
$_SESSION['KCFINDER']['uploadDir'] = "";
//mail($to, $subject, $pesan, $headers);// aktifkan kirim email
}}