<?php
if ($mod == '') {
  header('location:./404');
  echo 'kosong';
} else {
  $title = 'Keranjang';
  $page = $title;
  include_once "sw-content/themes/$folder/sw-header.php";
  include_once "sw-content/themes/$folder/breadcrumb.php";

  // $_SESSION['keranjang'] = [
  //   [
  //     'product_id' => 1,
  //     'product_name' => 'Ayam Bakar',
  //     'product_price' => 15000,
  //     'product_discount' => 5,
  //     'product_img' => '/cateringapp/sw-content/product/image/Paket_Katering_2.jpg',
  //     'quantity' => 2
  //   ],
  //   [
  //     'product_id' => 2,
  //     'product_name' => 'Cake',
  //     'product_price' => 120000,
  //     'product_discount' => 0,
  //     'product_img' => '/cateringapp/sw-content/product/image/287972b1-3c03-4ab5-94f6-588e8c8ad858.JPG',
  //     'quantity' => 1
  //   ],
  // ];

  // unset($_SESSION['keranjang']);

  // Hapus item jika ada
  if (isset($_POST['hapus_item'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['keranjang'] = array_filter($_SESSION['keranjang'], function ($item) use ($product_id) {
      return $item['product_id'] != $product_id;
    });
  }

  // Ubah quantity jika ada
  if (isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    for ($i = 0; $i < count($_SESSION['keranjang']); $i++) {
      if ($_SESSION['keranjang'][$i]['product_id'] == $product_id && is_numeric($quantity)) {
        $_SESSION['keranjang'][$i]['quantity'] = $quantity;
      }
    }
  }

  $grandTotal = 0;
?>

  <section class="sw-product" style="font-size: 120%;">
    <div class="container">
      <div class="row">
        <?php if (!isset($_SESSION['keranjang']) || count($_SESSION['keranjang']) == 0) { ?>
          <!-- Keranjang kosong -->
          <p class="text-center">Keranjang belanja anda sedang kosong.</p>
        <?php } else { ?>
          <!-- List product -->
          <div class="col-lg-12">
            <table class="table">
              <thead id="keranjangHead">
                <tr>
                  <th>#</th>
                  <th>Gambar</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Jumlah (pcs)</th>
                  <th>Total</th>
                </tr>
              </thead>
              <?php foreach ($_SESSION['keranjang'] as $i => $item) { ?>
                <tr>
                  <!-- No -->
                  <td><?= $i + 1 ?></td>

                  <!-- Gambar -->
                  <td>
                    <img id="keranjangImg" width="70px" src="<?= $item['product_img'] ?>" class="img-responsive" alt="<?= $item['product_name'] ?>" />
                  </td>

                  <!-- Name -->
                  <td><?= $item['product_name'] ?></td>

                  <!-- Price -->
                  <td>Rp. <?= format_angka($item['product_price']) ?></td>

                  <!-- Discount -->
                  <td>
                    <?php if ($item['product_discount'] != 0) { ?>
                      <span class="text-success"><?= $item['product_discount'] ?>%</span>
                    <?php } else { ?>
                      <span>-</span>
                    <?php } ?>
                  </td>

                  <!-- Qty -->
                  <td>
                    <form id="quantityForm<?= $item['product_id'] ?>" action="" method="POST" style="display: inline-block;">
                      <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                      <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="form-control" onchange="submitQty(<?= $item['product_id'] ?>)">
                      <script>
                        function submitQty(id) {
                          const quantityForm = document.getElementById('quantityForm' + id);
                          quantityForm.submit();
                        }
                      </script>
                    </form>
                  </td>

                  <!-- Total -->
                  <td>Rp.
                    <?php
                    $total = $item['product_price'] * $item['quantity'];
                    $total = $total - ($total * $item['product_discount'] / 100);
                    $grandTotal += $total;
                    echo format_angka($total);
                    ?>
                  </td>

                  <!-- Aksi -->
                  <td>
                    <form action="" method="POST">
                      <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                      <button type="submit" name="hapus_item" class="btn btn-danger" title="Hapus Item">x</button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="6">
                  <h4 class="text-center">Grand Total</h4>
                </td>
                <td colspan="2">
                  <h4>Rp. <?= format_angka($grandTotal) ?></h4>
                </td>
              </tr>
              <tr>
                <td colspan="8"></td>
              </tr>
            </table>
          </div>

          <!-- Form transaksi -->
          <div class="col-lg-12">
            <div class="sw-product-tab">
              <div class="sw-pro-tab">
                <ul class="sw-pro-tab-list">
                  <li class="active"><a data-toggle="tab" href="#pro-order">Pesan Sekarang</a></li>
                </ul>

                <div class="sw-pro-tab-container tab-content fix" id="order">
                  <div class="tab-pane active" id="pro-order">
                    <div class="alert alert-info">
                      <p>Untuk memesan paket ini, silahkan lengkapi data dibawah ini dengan benar dan lengkap<br>
                        Minimum pemesanan 20 item kecuali untuk catering acara wedding,tasyakuran yang prasmanan<br>
                        setelah mengirim data team kami akan segera menghubungi anda untuk memastikan kembali.
                      </p>
                    </div>

                    <form action="javascript:void();" id="sw-Order" class="validate" method="POST">
                      <div class="row">
                        <div class="sw-form-contact">
                          <!-- Left Form -->
                          <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <!-- Tanggal dan Jam -->
                            <div class="row">
                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                  <label>Tangal</label>
                                  <input type="date" id="order_date" class="datepicker form-control text-center" placeholder="Tanggal Pesanan">
                                </div>
                              </div>

                              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                  <label>Waktu</label>
                                  <select name="order_time" id="order_time" class="form-control text-center" required="required">
                                    <?php
                                    $start = strtotime('07:00 AM');
                                    $end   = strtotime('09:59 PM');
                                    ?>

                                    <?php for ($i = $start; $i <= $end; $i += 1800) { ?>
                                      <option value='<?php echo date('G:i', $i); ?>'><?php echo date('G:i', $i); ?></option>;
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <!-- Nama lengkap -->
                            <div class="form-group">
                              <label>Nama Lengkap</label>
                              <input type="text" name="order_name" class="required form-control" id="order_name" placeholder="Isi nama kamu" required>
                            </div>

                            <!-- Nomor -->
                            <div class="form-group">
                              <label>No Telp</label>
                              <input type="text" name="order_phone" class="required number form-control" id="order_phone" maxlength="15" placeholder="Isi no telp kamu">
                            </div>

                            <!-- Kecamatan -->
                            <div class="form-group">
                              <label>Kecamatan</label>
                              <select name="order_city" class="form-control" onchange="TotalOrder()" id="order_city" required="required">
                                <!-- Ambil data kecamatan -->
                                <?php
                                $query = "SELECT city_name from city order by city_name DESC";
                                $result = $connection->query($query) or die($connection->error . __LINE__);
                                ?>

                                <option value="" selected hidden>Pilih Kota / Kecamatan kamu</option>

                                <?php while ($row = $result->fetch_assoc()) { ?>
                                  <option value="<?= ucfirst($row['city_name']) ?>"><?= ucfirst($row['city_name']) ?></option>
                                <?php } ?>

                                <option value="Lain-lain">Lain-lain</option>
                              </select>
                            </div>
                          </div>

                          <!-- Right form -->
                          <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="sw-form-contact">
                              <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="order_address" id="order_address" class="form-control" rows="2" placeholder="Alamat lengkap kamu" required="required"></textarea>
                              </div>

                              <div class="form-group">
                                <label>Pesan Untuk Y & A Catering</label>
                                <textarea name="order_messages" id="order_messages" class="form-control" rows="3" placeholder="Pesan untuk kami" required="required"></textarea>
                              </div>

                              <div class="form-group">
                                <button type="button" class="btn btn-loading btn-send btn-lg" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order" onClick="sendOrder('<?= $website_url ?>');">Order Sekarang</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
  </section>


  <?php include_once "sw-content/themes/$folder/sw-footer.php"; ?>
  </body>

  </html>
<?php } ?>