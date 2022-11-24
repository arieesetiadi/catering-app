<?php //error_reporting(0);
    require_once'../sw-library/config.php'; 
    require_once'../sw-library/sw-function.php';
    $config = get_parse_ini('../sw-library/config.ini.php');
    require_once '../sw-library/ini.php';

if(isset($_POST['msg_name'])){
    $msg_name     = mysqli_real_escape_string($connection,$_POST['msg_name']);
    $msg_email     = mysqli_real_escape_string($connection,$_POST['msg_email']);
    $msg_phone  = mysqli_real_escape_string($connection,$_POST['msg_phone']);
    $msg_quantity  = mysqli_real_escape_string($connection,$_POST['msg_quantity']);
    $msg_date  = mysqli_real_escape_string($connection,$_POST['msg_date']);
    $msg_time  = mysqli_real_escape_string($connection,$_POST['msg_time']);
    $msg_content  = mysqli_real_escape_string($connection,$_POST['msg_content']);


if($msg_name && $msg_email && $msg_phone && $msg_quantity && $msg_date && $msg_content){
if (filter_var($msg_email, FILTER_VALIDATE_EMAIL)) {
  $pesan = '<html><body>';
  $pesan .= '<strong>Subject</strong> : Memesan Katering';
  $pesan .= '<strong>Dikirim Oleh</strong> : '.$msg_name.'';
  $pesan .= '<strong>Detail Pemesanan</strong><br>
            Nama : '.$msg_name.'<br>
            Email : '.$msg_email.'<br>
            No Telepon : '.$msg_phone.'<br>
            Jumlah Pemesanan : '.$msg_quantity.'<br>
            Tanggal & Jam : '.$msg_date.' / '.$msg_time.'<br>
            Pesan :<br>'
            .$msg_content.'';

  $msg_subject ='Pesan Katering ('.$msg_name.')';
  $pesan .= "</body></html>";
  $to = $mail_info;
  $subject = 'Reservation dari ('.$msg_name.')';
  $headers = "From: " . $msg_name." <".$msg_email.">\r\n";
  $headers .= "Reply-To: ". $msg_email. "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  $msg_details ='Nama : '.$msg_name.'<br>
            Email : '.$msg_email.'<br>
            No Telepon : '.$msg_phone.'<br>
            Jumlah Pemesanan : '.$msg_quantity.'<br>
            Tanggal & Jam : '.$msg_date.' / '.$msg_time.'<br>
            Pesan :<br>
            '.$msg_content.'';

$tambah="INSERT INTO message (msg_name,
msg_subject,
msg_mail,
msg_content,
msg_time,
msg_type,
msg_tab,
msg_status) values('$msg_name', '$msg_subject', '$msg_email', '$msg_details', '$timeNow', '1', '1' ,'N')" or die($connection->error.__LINE__); 
if($connection->query($tambah) === false) { 
    echo'Pesan tidak dapat dikirim, Silakan coba lagi..!';
} else {
    echo'Terimakasih '.ucfirst($msg_name).' Pesan Anda berhasil dikirim..!';
    mail($to, $subject, $pesan, $headers);
}}

else {
    echo'Alamat Email yang Anda masukkan salah..!';
}}

else {
    echo'Bidang Inputan tidak boleh ada yang kosong...!';
}}


?>xxxxxxxxxxxxx
