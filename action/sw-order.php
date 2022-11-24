<?php
error_reporting(0);
require_once '../sw-library/config.php';
require_once '../sw-library/sw-function.php';
$config = get_parse_ini('../sw-library/config.ini.php');
require_once '../sw-library/ini.php';

$product_table = '';
$grand_total = 0;

// Ambil data form order
$order_name     = mysqli_real_escape_string($connection, $_POST['order_name']);
$order_phone     = mysqli_real_escape_string($connection, $_POST['order_phone']);
$order_city  = mysqli_real_escape_string($connection, $_POST['order_city']);
$order_address  = mysqli_real_escape_string($connection, $_POST['order_address']);
$order_messages  = mysqli_real_escape_string($connection, $_POST['order_messages']);
$order_date  = mysqli_real_escape_string($connection, $_POST['order_date']);
$order_time  = mysqli_real_escape_string($connection, $_POST['order_time']);

// Insert order item
foreach ($_SESSION['keranjang'] as $i => $item) {
  $product_id = $item['product_id'];
  $product_name = $item['product_name'];
  $product_price = $item['product_price'];
  $order_quantity = $item['quantity'];

  // Count discount
  $product_discount = $item['product_discount'];
  $product_price -= ($product_price * $product_discount / 100);
  $order_total = $product_price * $order_quantity;
  $grand_total += $order_total;

  $status = $product_discount != 0 ? 'Diskon' : '';

  // Insert database order
  $tambah = "INSERT INTO order_item (product_id,
                        order_date,
                        order_time,
                        order_name,
                        order_phone,
                        order_city,
                        order_address,
                        order_messages,
                        order_price,
                        order_quantity,
                        order_total,
                        time,
                        date,
                        status,
                        order_status) values(
                        '$product_id',
                        '$order_date', 
                        '$order_time', 
                        '$order_name', 
                        '$order_phone', 
                        '$order_city', 
                        '$order_address',
                        '$order_messages',
                        '$product_price',
                        '$order_quantity',
                        '$order_total',
                        '$time',
                        '$date',
                        '$status',
                        '1')" or die($connection->error . __LINE__);

  $connection->query($tambah);

  // Generate product table
  $product_table .= "
    <tr>
      <td>$product_name</td>
      <td>Rp. " . format_angka($product_price) . "</td>
      <td>$order_quantity</td>
      <td>Rp. " . format_angka($order_total) . "</td>
    </tr>
  ";
}

/* ----------- KIRIM PESAN EMAIL ------------------ */
$pesan = '<html><body>';
$pesan .= '<strong>Subject</strong> : Memesan Katering';
$pesan .= '<strong>Dikirim Oleh</strong> : ' . $order_name . '';
$pesan .= '<strong>Detail Pemesanan</strong><br>
              Nama : ' . $order_name . '<br>
              No Telepon : ' . $order_phone . '<br>
              Kecamatan : ' . $order_city . '<br>
              Alamat : ' . $order_address . '<br>
              Tanggal & Jam : ' . $order_date . ' / ' . $order_time . '
              <hr>
              <table class="table">
                <tr>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Jumlah (pcs)</th>
                  <th>Total</th>
                </tr>
                ' . $product_table . '
              </table>
              <hr>
              Total Harga : ' . format_angka($grand_total) . '<br>
            ';

$pesan .= 'Pesan :<br>' . $order_messages;
$pesan .= "</body></html>";

$msg_subject = 'Pesan Katering (' . $order_name . ')';
$to = "swidodocom@yahoo.com";
$subject = 'Pesan Katering (' . $order_name . ')';
$headers = "From:" . $order_name . " <" . $review_email . ">\r\n";
//$headers .= "Reply-To: ". $order_phone. "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//mail($to, $subject, $pesan, $headers);

// Pesan popup
echo 'Terimakasih ' . ucfirst($order_name) . ', Pesan Anda berhasil dikirim..! <hr>
    <table class="table">
          <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah (pcs)</th>
            <th>Total</th>
          </tr>
          ' . $product_table . '
        </table>
        <hr>
        Total Harga :Rp. <b>' . format_angka($grand_total) . '</b><br>
        Biaya pengiriman gratis!<hr>
        Silahkan catat atau screenshot halaman ini';

unset($_SESSION['keranjang']);
