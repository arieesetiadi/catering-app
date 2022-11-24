<?php if ($mod == '') {
  header('location:./404');
  echo 'kosong';
} else {
  $title = 'Semua Paket';
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

        <?php $limit = $item_produk;
        if (isset($_GET['pages'])) {
          $pages = mysqli_real_escape_string($connection, $_GET['pages']);
        } else {
          $pages = 1;
        }
        $offset = ($pages - 1) * $limit;
        $query = "SELECT * FROM product where product.active='1' order by product.product_id  DESC LIMIT $offset, $limit";
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

            echo '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
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

          // Pagination
          echo '
          <div class="paginations text-center margin-top-20">
            <ul>';
          $pagination = mysqli_query($connection, "SELECT COUNT(product_id) AS jumData FROM product where product.active='1'") or die('Pagination error');
          $data  = mysqli_fetch_assoc($pagination);
          $pagination = '' . $website_url . '/product-';
          $jumData = $data['jumData'];
          $jumPage = ceil($jumData / $limit);
          //menampilkan link << Previous
          if ($pages > 1) {
            echo '<li class="prev"><a href="' . $pagination . '' . ($pages - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
          }
          //menampilkan urutan paging
          for ($i = 1; $i <= $jumPage; $i++) {
            //mengurutkan agar yang tampil i+3 dan i-3
            if ((($i >= $pages - 1) && ($i <= $pages + 5)) || ($i == 1) || ($i == $jumPage)) {
              if ($i == $jumPage && $pages <= $jumPage - 5)
                echo '<li class="disabled"><a href="#">..</a></li>';
              if ($i == $pages) echo '<li class="active"><span>' . $i . '</span></a></li>';
              else echo '<li><a href="' . $pagination . '' . $i . '">' . $i . '</a></li>';
              if ($i == 1 && $pages >= 5) echo '<li class="disabled"><a href="#">..</a></li>';
            }
          }
          //menampilkan link Next >>
          if ($pages < $jumPage) {
            echo '<li class="next"><a href="' . $pagination . '' . ($pages + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
          }
          echo '
              </ul>
       </div>
        <!-- End:Paginations -->';
        } else {
          echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="alert alert-warning text-center">
                    <h1><i class="fa fa-frown-o"></i></h1>
                    <p>Kami tidak menemukan Produk  yang anda cari!</p>
                </div>
            </div>
          </div>';
        } ?>
      </div>
    </div>
    </div>
  </section>
  <?php include_once "sw-content/themes/$folder/sw-footer.php"; ?>
  </body>

  </html>
<?php } ?>