<?php if ($mod == '') {
  header('location:./404');
  echo 'kosong';
} else {
  $title = 'Menu';
  $page = $title;

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

  <section class="sw-product">
    <div class="container">
      <div class="row">
        <!-- <div class="sw-title">
          <h3>Daftar Menu Katering</h3>
          <span id="categoryTitle">Semua</span>
        </div> -->

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
              $query = "SELECT * FROM product WHERE active='1' AND category LIKE '%$seoTitle%' ORDER BY product_id DESC";
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
                      <form action="" method="POST">
                        <input type="hidden" name="product_id" value="' . $product_id . '">
                        <input type="hidden" name="product_name" value="' . $product_name . '">
                        <input type="hidden" name="product_price" value="' . $product_price . '">
                        <input type="hidden" name="product_discount" value="' . $product_discount . '">
                        <input type="hidden" name="product_img" value="' . $product_img . '">
                        <button type="submit" name="tambah_keranjang" class="btn btn-product-order" style="width:100%">
                          + Keranjang
                        </button>
                      </form>
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
  <?php include_once "sw-content/themes/$folder/sw-footer.php"; ?>
  </body>

  </html>
<?php } ?>