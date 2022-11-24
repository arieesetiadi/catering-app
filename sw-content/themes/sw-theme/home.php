<?php if ($mod == '') {
  header('location:./404');
  echo 'kosong';
} else {
  include_once "sw-content/themes/$folder/sw-header.php";
  include_once "sw-content/themes/$folder/sw-slider.php";
  echo '
<!-- abouts us -->
<section class="sw-abouts-us">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="sw-abouts-us-body">
          <p class="top-title"><span>About us</span></p>
           <h3 class="title">' . $website_name . '</h3>
            <div class="desc">
              <p>' . $website_name . ' adalah layanan katering di Ponorogo. Kami dirikan untuk melayani kebutuhan konsumen yang mengutamakan kualitas dan cita rasa yang tinggi serta kehigienisan produk kami. Kami berusaha untuk memberikan pelayanan terbaik dengan menyuguhkan makanan yang lezat dan diolah dari bahan yang berkualitas baik, higienis namun tetap dengan harga yang terjangkau.</p>
              <p>Layanan kami meliputi Catering Wedding, ulang tahun, Acara Kantor/Meeting, Selamatan, Yasinan dll.</p>

              <a href="./abouts.html" class="btn btn-abouts" target="_blank">Selengkapnya</a>
            </div>
        </div>
      </div>

        <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="sw-abouts-us-body">
            <img src="sw-content/img-abouts.jpg" class="img-responsive">
          </div>
        </div>
    </div>
  </div>
</section>


<!-- service -->
<section class="sw-service">
<div class="container">
  <div class="row">
  	<div class="sw-title">
      <h3>Layanan ' . $website_name . '</h3>
    </div>
      
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-item text-center">
              <div class="icon">
                 <img src="sw-content/assets/icon-catering.png" class="img-responsive">
              </div>
              <div class="des">
                  <div class="s-title">Catering Prasmanan Wedding</div>
                <p>Kami menyediakan paket catering prasmanan wedding yang bervariasi dan menyesuaikan kebutuhan anda.</p>
              </div>
          </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-item text-center">
              <div class="icon">
                <img src="sw-content/assets/icon-catering.png" class="img-responsive">
              </div>
              <div class="des">
                  <div class="s-title">Catering Prasmanan Taysakuran</div>
                <p>Kami menyediakan paket catering prasmanan untuk acara taysakuran atau sunatan yang dapat menyesuaikan kebutuhan anda.</p>
              </div>
          </div>
      </div>


      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-item text-center">
              <div class="icon">
                <img src="sw-content/assets/icon-food.png" class="img-responsive">
              </div>
              <div class="des">
                  <div class="s-title">Catering Nasi Box</div>
                <p>Kami menyediakan layanan catering nasi box cocok untuk acara resmi, selamatan, meeting, rapat, seminar dll.</p>
              </div>
          </div>
      </div>


      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-item text-center">
              <div class="icon">
                <img src="sw-content/assets/icon-food.png" class="img-responsive">
              </div>
              <div class="des">
                  <div class="s-title">Catering Buka Puasa</div>
                <p>Kami menyediakan layanan catering box untuk acara amal / kegiatan sosial / acara buka puasa bersama bulan ramadhan.</p>
              </div>
          </div>
      </div>

  </div>
</div>
</section>'; ?>

  <!-- product -->
  <section class="sw-product">
    <div class="container">
      <div class="row">
        <div class="sw-title">
          <h3>Daftar Menu Katering</h3>
          <span id="categoryTitle">Semua</span>
        </div>
        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12">
          <!-- Ambil kategori dari database -->
          <?php
          $query = "SELECT * FROM category";
          $result = $connection->query($query) or die($connection->error . __LINE__);
          $kategori = [];
          while ($r = $result->fetch_assoc()) {
            $kategori[] = $r;
          }
          ?>

          <!-- Kategori List -->
          <h4>KATEGORI</h4>
          <ul id="categoryList" style="list-style-type: none; padding: 0;">
            <?php foreach ($kategori as $k) { ?>
              <li>
                <a class="link <?= $k['title'] == 'Semua' ? 'link-active' : '' ?>" onclick="changeCategory(event)"><?= $k['title'] ?></a>
              </li>
            <?php } ?>
          </ul>
        </div>

        <!-- Product List -->
        <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
          <?php foreach ($kategori as $k) { ?>
            <div id="<?= $k['title'] ?>" class="<?= $k['title'] == 'Semua' ? '' : 'hidden' ?> product-container">
              <?php
              $seoTitle = $k['seotitle'];
              $query = "SELECT product_id,product_name,seoname,product_img,product_price FROM product WHERE active='1' AND category LIKE '%$seoTitle%' ORDER BY product_id DESC";
              $result = $connection->query($query) or die($connection->error . __LINE__);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  extract($row);
                  if (strlen($product_name) > 100) $product_name = substr($product_name, 0, 100) . '..';

                  $review   = "SELECT product_id FROM review where product_id='$product_id'";
                  $r_review = $connection->query($review);

                  /* menghitung rating */
                  $rating1 = mysqli_query($connection, "SELECT SUM(rating) AS ttl FROM rating where product_id='$product_id'");
                  $rating2 = mysqli_query($connection, "SELECT COUNT(rating) AS rt FROM rating where product_id='$product_id'");
                  $l = mysqli_fetch_array($rating1);
                  $k = mysqli_fetch_array($rating2);
                  if ($r_review->num_rows > 0) {
                    $total_rating = (($l['ttl'] / $k['rt']) * 10);
                  } else {
                    $total_rating = 0;
                  }

                  echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                  <div class="product-grid">
                      <div class="block-img">';
                  if ($product_img == NULL) {
                    echo '<img src="timthumb?src=' . $website_url . '/sw-content/sw-medium.jpg&h=140&w=300" class="img-responsive" alt="' . $row['product_name'] . '"/>';
                  } else {
                    echo '<img src="timthumb?src=' . $product_img . '&h=250&w=300" alt="' . $product_name . '" class="img-responsive" alt="' . $row['title'] . '"/>';
                  }
                  echo '
                      </div>
                      <div class="info">
                        <div class="price">
                            Rp' . format_angka($product_price) . '
                        </div>
                        <h3><a href="' . $website_url . '/product/' . $product_id . '-' . $seoname . '.html">' . $product_name . '</a></h3>
                        
                        <div class="sw-meta">
                          <div class="rating-box">';
                  if ($r_review->num_rows > 0) {
                    echo '<span class="stars">' . $total_rating . '</span>';
                  } else {
                    echo '<span class="stars">0.1</span>';
                  }
                  echo '
                          </div>
                          <span>Per item</span>
                        </div>
                      </div>
                      <a href="' . $website_url . '/product/' . $product_id . '-' . $seoname . '.html" class="btn btn-product-order">Lihat</a>
                  </div>
                </div>';
                }
              } else {
                echo '<p>Product dengan kategori "' . $k['title'] . '" belum tersedia untuk saat ini.</p>';
              }
              ?>
            </div>
          <?php } ?>
        </div>
      </div>

    </div>
  </section>
  <!-- end:product -->

  <!-- reservation -->
  <?php echo '
<section class="reservation">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
          <div class="form-pos-01 form-dark-wrapper section-dark">
            <form action="javascript:void();" id="sw-reservation" class="contact-form">
              <div class="sw-contact-form dark mtl">
                <div class="row">
                          <div class="sw-title text-center">
                            <h3 class="title-white">Pemesanan</h3>
                              <p class="title-white">Anda bisa menghubungi kami langsung di ' . $website_phone . '</p>
                          </div>
                    <form>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                          <input type="text" name="msg_name" id="msg_name" class="form-control" placeholder="Nama kamu">
                        </div>
                      </div>
                    </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-at"></i></div>
                          <input type="email" name="msg_email" id="msg_email" placeholder="Email kamu" class="form-control">
                        </div>
                      </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                          <input type="text" name="msg_phone" id="msg_phone" placeholder="No Telp / Wa kamu" class="form-control" pattern="[0-9]*">
                        </div>
                      </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-shopping-basket"></i></div>
                          <input type="number" name="msg_quantity" id="msg_quantity" placeholder="Jumlah Pemesanan" class="form-control">
                        </div>
                      </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          <input type="text" name="msg_date" id="msg_date" placeholder="Tanggal Pemesanan" class="form-control datepicker">
                        </div>
                      </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                            <select name="msg_time" id="msg_time" class="form-control text-center" required="required">';
  $start = strtotime('07:00 AM');
  $end   = strtotime('09:59 PM');
  for ($i = $start; $i <= $end; $i += 1800) {
    echo '<option value="' . date('G:i', $i) . '">' . date('G:i', $i) . '</option>';
  }
  echo '
                            </select>
                        </div>
                      </div>
                      </div>

                        <div class="col-md-12">
                          <div class="form-group">
                              <textarea name="msg_content" id="msg_content" class="form-control" placeholder="Pesan dan alamat lengkap kamu"></textarea>
                            </div>
                        </div>

                            <div class="form-group">
                              <div class="text-center">'; ?>
  <button type="button" onClick="sendReservation();" class="btn btn-loading btn-reservation" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing">KIRIM</button>
  </div>
  </div>

  </div>
  </div>
  </form>
  </div>
  </div>
  </div>
  </div>
  </section>
  <!-- End :reservation -->

  <?php include_once "sw-content/themes/$folder/sw-footer.php"; ?>
  </body>

  </html>
<?php } ?>