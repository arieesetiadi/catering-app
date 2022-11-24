<?php if (empty($connection)) {
  header('location:./404');
} else {
  if ($mod == 'home' or $mod == 'sw-product-details' or $mod == 'sw-keranjang') {
    echo '
<div id="modal-alert" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Terimakasih sudah memesan</h4>
          </div>
          <div class="modal-body">
              <div class="alert alert-info" id="info-alert" style="display: none">
                
              </div>
              <p><b>Kami akan segera menghubungi Anda dalam waktu 1x24 jam.</b></p><br>
              <p>
              CARA PEMESANAN NASI KOTAK DENGAN MUDAH<br>
                1. Pilih paket nasi kotak yang diinginkan<br>
                2. Minimum pemesanan 20 kotak<br>
                3. Pemesanan dapat dilakukan paling lambat H-2<br>
                4. Pembayaran bisa dilakukan dengan cara transfer ke nomor rekening bank kami.<br>
                5. Pembayaran Minimal DP 50% dari jumlah Total tagihan<br>
                6. Pesanan siap di produksi oleh team kami<br>
                7. Pelunasan pembayaran dilakukan 1 hari sebelum pengiriman atau saat pengiriman<br>
                8. Kami akan melakukan konfirmasi kembali pesanan anda untuk pengantaran.

              </p>
              <hr>
              
              <h5>PEMBAYARAN BISA MELALUI TRANSFER BANK</h5>
              <div class="row">
                <div class="col-md-5">
                  <div class="text-center">
                    <img src="' . $website_url . '/sw-content/assets/bank-bsm.jpg" class="img-responsive text-center">
                  </div>
                </div>
                <div class="col-md-6">
                  <br>
                  <p>
                  Nama Bank : Bank Syariah Mandiri<br>
                  Atas Nama : Yulianti<br>
                  No Rek    : 709297XXX</p>
                </div>
              </div>
              <div class="alert alert-warning">
                Hati-hati dalam melakukan transaksi mengatas namakan Y & A Catering, Kami hanya memiliki No Rekening diatas saja dan selalu tertera pada website ini.<br>
                Kami akan selalu memberi konfirmasi saat melakukan pembayaran salah satunya melalui Email, Telp maupun WhatsApp.
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>';
  }

  echo '
<section class="subscribe-section">
    <div class="subscribe-wrapper">
      <div class="container">
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-8 col-sm-offset-0 col-lg-offset-2">
      <div class="subscribe-heading">
        <h3 class="title">Subcribe Us Now</h3>
        <div class="des">Get more news and delicious dishes everyday from us</div>
      </div>
      <form action="javascript:void();" id="subscribe" class="widget-newsletter">
        <input class="form-control" name="subcribe_email" id="subcribe_email" placeholder="E-mail Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
        <button type="button" class="submit" onclick="sendSubclribe();"><i class="fa fa-paper-plane"></i></button>
        </a>
      </form>
    </div>
    </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="ft-widget-area">
          
            <div class="sw-wget-about">
              <div class="clearfix">
              <div class="wget-logo">
                <img src="' . $website_url . '/sw-content/logo1.png" class="img-responsive">
              </div>
    
              <ul class="socials-about">
                  <li><a href="' . $social_facebook . '" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="' . $social_twitter . '" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="' . $social_instagram . '" target="_blank"><i class="fa fa-instagram"></i></a></li>
                  <li><a href="' . $social_google . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
                    <div class="wget-about-content">
                          <p>Y & A Catering adalah layanan katering di Ponorogo. Kami dirikan untuk melayani kebutuhan konsumen yang mengutamakan kualitas dan cita rasa yang tinggi serta kehigenisan produk kami. Kami berusaha untuk memberikan pelayanan terbaik dengan menyuguhkan makanan yang lezat dan diolah dari bahan yang berkualitas baik, higenis namun tetap dengan harga yang terjangkau.</p>
                    </div>
            </div>

            <!-- contact -->
            <div class="about-contact-info clearfix">
                          <div class="address-info">
                            <div class="info-icon"><i class="fa fa-map-marker"></i></div>
                            <div class="info-content">
                              <p>' . $website_addres . '</p>
                            </div>
                          </div>

                          <div class="phone-info">
                            <div class="info-icon"><i class="fa fa-phone"></i></div>
                            <div class="info-content">
                              <p>' . $website_phone . '<br>
                                  ' . $website_phone_2 . '</p>
                            </div>
                          </div>

                          <div class="email-info">
                            <div class="info-icon"><i class="fa fa-envelope-o"></i></div>
                            <div class="info-content">
                              <p>' . $website_email . '<br>
                              ' . $mail_info . '</p>
                            </div>
                          </div>
              </div>

              <div class="payment-list">
                <div class="row">
                  <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="text-center">
                      <img src="' . $website_url . '/sw-content/assets/bank-bsm.png" class="img-responsive">
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <p>Nama Bank : Bank Syariah Mandiri<br>
                        Atas Nama : Yulianti<br>
                        No Rek : 709297XXXXX</p>
                  </div>

                </div>
                
              </div>
        </div>
      </div>

          <!-- open office -->
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <div class="ft-fixed-area">
                    <div class="reservation-box">
                      <div class="reservation-wrap">
                        <h3 class="res-title">Open Hour</h3>

                          <div class="res-date-time text-center">
                            <ul>
                              <li>Senin :.................. 07.00 - 19.00</li>
                              <li>Selasa :................. 07.00 - 19.00</li>
                              <li>Rabu :................... 07.00 - 19.00</li>
                              <li>Kamis :.................. 07.00 - 19.00</li>'; ?>
  <li>Jum'at :................. 07.00 - 19.00</li>
  <li>Sabtu :.................. 07.00 - 19.00</li>
  <li>Minggu :............... 07.00 - 16.00</li>
  </ul>
  </div>
  <h3 class="res-title">Reservation Numbers</h3>
  <h4 class="res-title"><?php echo $website_phone; ?></h4>
  </div>
  </div>
  </div>
  </div>
  <!-- end -->
  </div>
  </div>
  <?php echo '  
<!-- credit -->
  <div class="sw-credits">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p>COPYRIGHT © 2022 Y & A CATERING |  DESIGN BY : </p>
        </div>
      </div>
    </div>
  </div>
</footer>

<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<!-- jQuery JS -->
<script src="' . $website_url . '/sw-content/themes/' . $folder . '/assets/js/jquery-1.11.3.min.js"></script>
<script src="' . $website_url . '/sw-content/themes/' . $folder . '/assets/js/custom.js"></script>
<script src="' . $website_url . '/sw-content/themes/' . $folder . '/assets/js/sw-plugins.js"></script>';
  if ($mod == 'home' or $mod == 'sw-product-details') {
    echo '
<script src="' . $website_url . '/sw-content/themes/' . $folder . '/assets/js/bootstrap-datepicker.js"></script>
';
  }
  echo '<script src="' . $website_url . '/sw-content/themes/' . $folder . '/assets/js/sw-main.js"></script>'; ?>

  <script type="text/javascript">
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', '<?php echo $id_googlean; ?>', 'auto');
    ga('send', 'pageview');
  </script>

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "<?php echo $website_url; ?>",
      "logo": "<?php echo $website_url; ?>/sw-content/meta-img.jpg",
      "contactPoint": [{
        "@type": "ContactPoint",
        "telephone": "<?php echo $website_phone; ?>",
        "contactType": "Customer service"
      }]
    }
  </script>

  <?php echo $live_cat;
  if ($mod == 'sw-product-details' or $mod == 'sw-blog-details') {
    echo '<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a4764f64b32d32f"></script>';
  } ?>

  <?php if ($mod == 'home' or $mod == 'sw-product-details') { ?>
    <script type="text/javascript">
      $('.datepicker').datepicker({
        //startDate: date,
        format: 'dd/mm/yyyy',
        todayHighlight: true,
      });
    </script>
  <?php } ?>
<?php } ?>