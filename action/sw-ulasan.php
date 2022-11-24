<?php //error_reporting(0);
    require_once'../sw-library/config.php'; 
    require_once'../sw-library/sw-function.php';
    $config = get_parse_ini('../sw-library/config.ini.php');
    require_once '../sw-library/ini.php';

if(isset($_POST['product_id'])){
    $product_id      = mysqli_real_escape_string($connection,$_POST['product_id']);
    $review_name     = mysqli_real_escape_string($connection,$_POST['review_name']);
    $review_email    = mysqli_real_escape_string($connection,$_POST['review_email']);
    $review_message  = mysqli_real_escape_string($connection,$_POST['review_message']);
    $rating          = mysqli_real_escape_string($connection,$_POST['rating']);

if (empty($_POST['rating'])) {
      $rating='1';
    } else {
      $rating=mysqli_real_escape_string($connection,$_POST['rating']);
}

if($product_id && $review_name && $review_email && $review_message){
if (filter_var($review_email, FILTER_VALIDATE_EMAIL)) {

  $pesan = '<html><body>';
  $pesan .= '<strong>Ulasan</strong>';
  $pesan .= '<strong>Dikirim Oleh</strong> : '.$review_name.'';
  $pesan .= '<strong>Message:</strong>'.$review_message.'';
  $pesan .= "</body></html>";
  $to = $mail_info;
  $subject = 'Ulasan Produk';
  $headers = "From: " . $review_message." <".$review_email.">\r\n";// email domain info@s-widodo.com
  $headers .= "Reply-To: ". $msg_email. "\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$add_review = "INSERT INTO review(product_id,
                      user_id,
                      review_name,
                      review_email,
                      review_message,
                      review_rate,
                      datetime,
                      ip) values('$product_id',
                      '0',
                      '$review_name',
                      '$review_email',
                      '$review_message',
                      '$rating',
                      '$timeNow',
                      '$host_ip')" or die($connection->error.__LINE__);

$add_rating ="INSERT INTO rating(product_id,
                      rating,
                      rating_ip,
                      datetime) values('$idp',
                      '$rating',
                      '$host_ip',
                      '$timeNow')" or die($connection->error.__LINE__);

if($connection->query($add_review) === false) { 
    echo'Pesan Ulasan tidak dapat dikirim, Silakan coba lagi..!';

} else {
    $connection->query($add_rating);
    echo'Terimakasih '.$review_name.' Ulasan Anda berhasil dikirim..!';
    mail($to, $subject, $pesan, $headers);
}}

else {
    echo'Alamat Email yang Anda masukkan salah..!';
}}

else {
    echo'Bidang Inputan tidak boleh ada yang kosong...!';
}}

?>
