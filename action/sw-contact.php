<?php error_reporting(0);
    require_once'../sw-library/config.php'; 
    require_once'../sw-library/sw-function.php';
    $config = get_parse_ini('../sw-library/config.ini.php');
    require_once '../sw-library/ini.php';

if(isset($_POST['msg_name'])){
    $msg_name     = mysqli_real_escape_string($connection,$_POST['msg_name']);
    $msg_email     = mysqli_real_escape_string($connection,$_POST['msg_email']);
    $msg_subject  = mysqli_real_escape_string($connection,$_POST['msg_subject']);
    $msg_content  = mysqli_real_escape_string($connection,$_POST['msg_content']);

if($msg_name && $msg_email && $msg_subject && $msg_content){
if (filter_var($msg_email, FILTER_VALIDATE_EMAIL)) {

  $pesan = '<html><body>';
  $pesan .= '<strong>Subject</strong> : '.$msg_subject.'';
  $pesan .= '<strong>Dikirim Oleh</strong> : '.$msg_name.'';
  $pesan .= '<strong>Message:</strong>'.$msg_content.'';
  $pesan .= "</body></html>";
  $to = $mail_info;
  $subject = $msg_subject;
  $headers = "From: " . $msg_name." <".$msg_email.">\r\n";// email domain
  $headers .= "Reply-To: ". $msg_email. "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$tambah="INSERT INTO message (msg_name,
msg_subject,
msg_mail,
msg_content,
msg_time,
msg_type,
msg_tab,
msg_status) values('$msg_name', '$msg_subject', '$msg_email', '$msg_content', '$timeNow', '1', '1' ,'N')" or die($connection->error.__LINE__); 
if($connection->query($tambah) === false) { 
    echo'Pesan tidak dapat dikirim, Silakan coba lagi..!';
} else {
    echo'Terimakasih '.$msg_name.' Pesan kamu berhasil dikirim..!';
    mail($to, $subject, $pesan, $headers);
}}


else {
    echo'Alamat Email yang Anda masukkan salah..!';
}}

else {
    echo'Bidang Inputan tidak boleh ada yang kosong...!';
}}


?>
