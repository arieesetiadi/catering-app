<?php if ($mod == '') {
  header('location:./404');
  echo 'kosong';
} else {
  if (isset($_GET['read_product'])) {
    $read_product = mysqli_real_escape_string($connection, $_GET['read_product']);
    $produk = str_replace('-', ' ', $read_product);

    $query_read = "SELECT * FROM product WHERE product.product_id='$read_product' and product.active='1'";
    $result_read = $connection->query($query_read) or die($connection->error . __LINE__);
    $row_read = $result_read->fetch_assoc();
    $product_id = $row_read['product_id'];
    $title = strip_tags(ucfirst($row_read['product_name']));
    $meta_description = strip_tags($row_read['description']);
    $meta_img = '' . $website_url . '' . $row_read['product_img'] . '';
    //$page = str_replace('-',' ',ucfirst($row_read['category']));
    //$url="../category/".$row_read['category'].".html";
    if ($title == NULL) {
      $title = '404';
    } else {
      $title = $title;
    }
  }

  // Fungsi untuk tambah keranjang
  if (isset($_POST['tambah_keranjang'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_discount = $_POST['product_discount'];
    $product_img = $_POST['product_img'];
    $quantity = 1;

    // Buat session keranjang jika belum ada
    if (!isset($_SESSION['keranjang'])) {
      $_SESSION['keranjang'] = [];
    }

    // Cek apakah produk sudah ada sebelumnya
    for ($i = 0; $i < count($_SESSION['keranjang']); $i++) {
      if ($_SESSION['keranjang'][$i]['product_id'] == $product_id) {
        $exist = $i;
      }
    }

    if (isset($exist)) {
      // Tambah quantity jika sudah ada di keranjang sebelumnya
      $_SESSION['keranjang'][$exist]['quantity'] += 1;
    } else {
      // Tambahkan produk baru ke keranjang
      $_SESSION['keranjang'][] = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_discount' => $product_discount,
        'product_img' => $product_img,
        'quantity' => $quantity
      ];
    }
  }

  include_once "sw-content/themes/$folder/sw-header.php";
  include_once "sw-content/themes/$folder/breadcrumb.php"; ?>

  <?php
  if ($result_read->num_rows > 0) {
    extract($row_read);
    $harga_diskon = $product_price * $product_discount / 100;
    $total_discount = $product_price - $harga_diskon;
    $baca = $row_read['stats'] + 1;

    $stats = mysqli_query($connection, "UPDATE product SET stats='$baca' WHERE product_id='$product_id'") or die('Stat produk Error');

    /* ulasan roduk ================================= */
    $q_ulasan = "SELECT * FROM review where product_id='$product_id'";
    $result_ulasan = $connection->query($q_ulasan);

    /* menghitung rating */
    $rating1 = mysqli_query($connection, "SELECT SUM(rating) AS ttl FROM rating where product_id='$product_id'");
    $rating2 = mysqli_query($connection, "SELECT COUNT(rating) AS rt FROM rating where product_id='$product_id'");

    $l = mysqli_fetch_array($rating1);
    $k = mysqli_fetch_array($rating2);
    if ($result_ulasan->num_rows > 0) {
      $total_rating = (($l['ttl'] / $k['rt']) * 10);
    } else {
      $total_rating = 1;
    }
    echo '
<section class="sw-container">
  <div class="container">
    <div class="row">
  <!-- Detail Product -->  
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="row">
      <div class="sw-singgle-product">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="block-img-product">';
    if ($product_img == NULL) {
      echo '<img src="timthumb?src="' . $website_url . '/sw-content/sw-big.jpg&h=140&w=300" class="img-responsive" alt="' . $title . '"/>';
    } else {
      echo '<img src="../timthumb?src=' . $product_img . '&h=400&w=600" alt="' . $title . '" class="img-responsive" alt="' . $title . '"/>';
    }
    echo '
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="single-heading">
              <h3>' . $title . '</h3>
            </div>
          <div class="sw-summary">
            <div class="summary-top">
                <div class="rating-box">';
    if ($r_review->num_rows > 0) {
      echo '<span class="stars">' . $total_rating . '</span>';
    } else {
      echo '<span class="stars">0.1</span>';
    }
    echo '
                </div>
                <a href="javascript:void();">' . $result_ulasan->num_rows . ' Ulasan</a> <span> / </span> 
                <a  href="#ulasan" aria-expanded="false"><i class="fa fa-pencil"></i> Tambah ulasan</a>
            </div>
          </div>

           <div class="desc-product">
              <div class="sumary-price">';
    if ($product_discount == 0) {
      echo '<h5 class="price">Rp' . format_angka($product_price) . '</h5>';
    } else {
      echo '<h5 class="price">Rp' . format_angka($total_discount) . '</h5>
                <p class="old">Rp' . format_angka($product_price) . '</p>';
    }
    echo ' 
              </div>
              <p>' . $description . '</p>
           </div>
            <hr>
            <form action="" method="POST" style="display: inline-block">
              <input type="hidden" name="product_id" value="' . $product_id . '">
              <input type="hidden" name="product_name" value="' . $product_name . '">
              <input type="hidden" name="product_price" value="' . $product_price . '">
              <input type="hidden" name="product_discount" value="' . $product_discount . '">
              <input type="hidden" name="product_img" value="' . $product_img . '">
              <button type="submit" name="tambah_keranjang" class="btn btn-order bg-hijau">
                <i class="fa fa-cart-plus"></i>Tambah ke Keranjang
              </button>
            </form>
            
            <a href="https://api.whatsapp.com/send?phone=62' . $website_phone_2 . '&text=Hai, saya ingin memesan ' . ucfirst($title) . '%0AJumlah: %0ANama : %0AAlamat Lengkap :%0A%0A%0A' . $_SERVER["HTTP_HOST"] . '' . $_SERVER["REQUEST_URI"] . '" class="btn btn-order bg-blue" target="_blank"><i class="fa fa-whatsapp"></i>Pesan Via WhaShap</a>
            <a href="tel:' . $website_phone . '" class="btn btn-order bg-red" data-toggle="tooltip" title="Saya Berminat, Silahkan SMS ke Nomor ' . $website_phone . '"><i class="fa fa-phone"></i>Hubungi</a>
        </div>

      </div>
      <!-- end detail product -->

      <div class="share-wrapper">
          <h3>Bagikan :</h3>
          <div class="share-item">
              <ul>
                <li><a class="fb" href="http://www.facebook.com/sharer/sharer.php?u=' . $_SERVER["HTTP_HOST"] . '' . $_SERVER["REQUEST_URI"] . '" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>

                <li><a class="tw" href="http://twitter.com/share?url=' . $_SERVER["HTTP_HOST"] . '' . $_SERVER["REQUEST_URI"] . '" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
                 
                 <li><a class="google" href="http://plus.google.com/share?url=' . $_SERVER["HTTP_HOST"] . '' . $_SERVER["REQUEST_URI"] . '" target="_blank"><i class="fa fa-google"></i><span>Google +</span></a></li>

                <li><a class="wa" href="https://api.whatsapp.com/send?text=' . $_SERVER["HTTP_HOST"] . '' . $_SERVER["REQUEST_URI"] . '" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a></li>
              </ul>
          </div>
       </div>

    <!-- tab product -->
  <div class="sw-product-tab">
        <div class="sw-pro-tab">
                <ul class="sw-pro-tab-list">
                    <li><a data-toggle="tab" href="#pro-ulasan" aria-expanded="false">Ulasan</a></li>
                    <li><a data-toggle="tab" href="#comments" aria-expanded="false">Komentar</a></li>
                </ul>
               ';
  ?>


    <div class="tab-pane" id="pro-ulasan">
      <div class="row">
        <!-- menapilkan ulasan -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <ul class="comment-list">
            <?php if ($result_ulasan->num_rows > 0) {
              while ($ru = $result_ulasan->fetch_assoc()) {
                echo '<li>
                      <div class="sin-comment fix">
                        <div class="comment-box">
                          <div class="comment-author">
                            <p class="com-name"><strong>' . strip_tags($ru['review_name']) . '</strong></p>
                              <span class="rate">';
                for ($i = 1; $i <= $ru['review_rate']; $i++) {
                  echo '<i class="fa fa-star"></i>';
                }
                echo '</span> 
                              <a class="repost-link" href="#"> ' . strip_tags($ru['datetime']) . '</a>
                          </div>
                          <div class="comment-text">
                            <p>' . strip_tags($ru['review_message']) . '</p>
                          </div>
                        </div>
                      </div>
                      </li>';
              }
            } else {
              echo '<div class="comment-blank">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>';
              echo '<p>Belum ada Ulasan untuk Produk ini!</p>
                        </div>';
            } ?>
          </ul>

        </div>
        <!-- end ulasan -->

        <?php echo '
    <!-- menampilkan form ulasan -->
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
             <div class="review">
              <div class="row">
                <form id="form-ulasan" id="ulasan" action="javascript:void();" method="post">
                  <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                       <h3>Ulas Produk ini!</h3>
                       <p>Berikan Rating</p>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                      <fieldset class="starability-basic">
                        <input type="radio" id="rate5" name="rating" value="5">
                        <label for="rate5" title="Amazing" aria-label="Amazing, 5 stars"></label>

                        <input type="radio" id="rate4" name="rating" value="4">
                        <label for="rate4" title="Very good" aria-label="Very good, 4 stars"></label>

                        <input type="radio" id="rate3" name="rating" value="3">
                        <label for="rate3" title="Average" aria-label="Average, 3 stars"></label>

                        <input type="radio" id="rate2" name="rating" value="2">
                        <label for="rate2" title="Not good" aria-label="Not good, 2 stars"></label>

                        <input type="radio" id="rate1" name="rating" value="1">
                        <label for="rate1" title="Terrible" aria-label="Terrible, 1 star"></label>
                      </fieldset>
                  </div>
              </div>
        
            <hr>
              <input type="hidden" name="product_id" id="product_id" value="' . $product_id . '" readonly>
                <div class="form-group">
                    <label>Nama</label> <span id="review_name-info" class="required"></span>
                    <input type="text" name="review_name" id="review_name" class="form-control" placeholder="Isi nama Anda" required="">
                </div>

                <div class="form-group">
                    <label>Email</label> <span id="review_email-info" class="required"></span>
                    <input type="text" name="review_email" id="review_email" class="form-control" placeholder="Isi Email Anda" required="">
                </div>
                <div class="form-group">
                    <label>Pesan Ulasan</label> <span id="review_message-info" class="required"></span>
                    <textarea name="review_message" id="review_message" class="form-control" rows="4" placeholder="Pesan ulsasan Anda" required="required"></textarea>
                </div>

                <div class="form-group">'; ?>
        <button type="button" id="sendulasan" class="btn btn-loading btn-ulasan" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing">
          <i class="fa fa-arrow-circle-right"></i> Kirim Ulasan</button>
      </div>
      </form>
      <!-- end form -->
    </div>
    </div>
    </div>
    </div>
    <!-- komentar -->
    <div class="tab-pane" id="comments">
      <?php if ($komentar_mode == 'Y') {
        require_once './sw-library/komentar.txt';
      } else {
        echo '<div class="alert alert-warning">
                    <i class="fa fa-lg fa-exclamation-triangle"></i> Saat ini Komentar Tidak tersedia.
                </div>';
      } ?>
    </div>
    <!-- end Komentar -->

    </div>
    </div>
    </div>
    <!-- tab product -->
    </div>
    </div>
    </div>
    </div>
    </section>

  <?php
  } else {
    echo '<div class="error-404">
        <div class="not-found">
            <img src="../sw-content/themes/' . $folder . '/assets/img/404.png">
        </div>
        <p>Maaf, halaman yang Anda minta tidak ditemukan. Atau halaman tersebut telah kami hapus.</p>

        <a href="#">Ke Halaman Depan</a>
    </div>';
  } ?>


  <?php include_once "sw-content/themes/$folder/sw-footer.php"; ?>
  </body>

  </html>
<?php } ?>