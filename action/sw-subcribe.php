<?php //error_reporting(0);
    require_once'../sw-library/config.php'; 
    require_once'../sw-library/sw-function.php';

if(isset($_POST['subcribe_email'])){
    $subcribe_email     = mysqli_real_escape_string($connection,$_POST['subcribe_email']);

if($subcribe_email){
if (filter_var($subcribe_email, FILTER_VALIDATE_EMAIL)) {

$tambah="INSERT INTO  subcribe (subcribe_email,
subcribe_send,
active,
time,
date) values('$subcribe_email', '0', '1', '$time', '$date')" or die($connection->error.__LINE__); 
if($connection->query($tambah) === false) { 
    echo'Email tidak dapat dikirim, Silakan coba lagi..!';
} else {
    echo'Terimakasih Email '.$subcribe_email.' sudah berlangganan..!';
}}

else {
    echo'Alamat Email yang Anda masukkan salah..!';
}}

else {
    echo'Bidang Inputan tidak boleh ada yang kosong...!';
}}


?>
