<?php if ($mod ==''){
    header('location:./404');
    echo'kosong';
}else{
    $title ='Tentang kami';
    $page = $title;
    include_once "sw-content/themes/$folder/sw-header.php";
    include_once "sw-content/themes/$folder/breadcrumb.php";?>

<?php echo'
<!-- abouts us -->
<section class="sw-abouts-us">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="sw-abouts-us-body">
          <p class="top-title"><span>About us</span></p>
           <h3 class="title">'.$website_name.'</h3>
            <div class="desc">
              <p>'.$website_name.' adalah layanan katering di Ponorogo. Kami dirikan untuk melayani kebutuhan konsumen yang mengutamakan kualitas dan cita rasa yang tinggi serta kehigienisan produk kami. Kami berusaha untuk memberikan pelayanan terbaik dengan menyuguhkan makanan yang lezat dan diolah dari bahan yang berkualitas baik, higienis namun tetap dengan harga yang terjangkau.</p>
              <p>Layanan kami meliputi Catering Wedding, ulang tahun, Acara Kantor/Meeting, Selamatan, Yasinan dll.</p>
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

<!-- SERVICE -->
<div class="services-block">
  <div class="container">
    <div class="row">
       <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-block-item">
            <div class="icon">
              <i class="fa fa-thumbs-o-up"></i>
              <span class="number">1</span>
            </div>
            <div class="service-block-info">
                <h3>Terjamin Halal</h3>
                <p>Semua yang kami sajikan halal</p>
            </div>
          </div>
       </div>

       <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-block-item">
            <div class="icon">
              <i class="fa fa-clock-o"></i>
              <span class="number">2</span>
            </div>
            <div class="service-block-info">
                <h3>Amanah dan tepat waktu</h3>
                <p>Selalu memberikan pelayanan terbaik
            </div>
          </div>
       </div>


       <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-block-item">
            <div class="icon">
              <i class="fa fa-smile-o"></i>
              <span class="number">3</span>
            </div>
            <div class="service-block-info">
                <h3>Bisa atur jadwal pemesanan</h3>
                <p>Sibuk tidak bisa menyiapkan</p>
            </div>
          </div>
       </div>


       <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="service-block-item">
            <div class="icon">
              <i class="fa fa-handshake-o"></i>
              <span class="number">4</span>
            </div>
            <div class="service-block-info">
                <h3>Garansi 100%</h3>
                <p>Bayar sesuai transaksi, tanpa biaya tambahan lagi.</p>
            </div>
          </div>
       </div>

    </div>
  </div>
</div>

<!-- service -->
<section class="sw-service">
<div class="container">
  <div class="row">
    <div class="sw-title">
      <h3>Layanan '.$website_name.'</h3>
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
</section>

<!-- service -->
<section class="sw-front_service">
  <div class="container">
    <div class="row">
      <div class="sw-title">
        <h3>Kenapa Memilih Kami?</h3>
      </div>

        <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="front_service">
            <div class="icon_service">
              <i class="fa fa-usd"></i>
              <h3>Menghemat Pengeluaran</h3>
            </div>
            <div class="fr_content">
              <p>Dengan memakai layanan '.$website_name.' kamu nggak perlu lagi mengeluarkan biaya sebesar kalau pergi ke restoran.</p>
            </div>
          </div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="front_service">
            <div class="icon_service">
              <i class="fa fa-clock-o"></i>
              <h3>Menghemat Waktu</h3>
            </div>
            <div class="fr_content">
              <p>Kamu tidak perlu repot-repot lagi untuk mempersiapkan menu untuk segala acara, biar '.$website_name.' yang menyiapkan semua.</p>
            </div>
          </div>
        </div>

       <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="front_service">
            <div class="icon_service">
              <i class="fa fa-map-marker"></i>
              <h3>Bisa Diantar ke Lokasi Manapun</h3>
            </div>
            <div class="fr_content">
              <p>Bisa diantar ke lokasi manapun tentu saja selama masih dalam jangkauan pengantaran tempat catering tersebut ya.</p>
            </div>
          </div>
        </div>



       <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="front_service">
            <div class="icon_service">
              <i class="fa fa-clock-o"></i>
              <h3>One Time</h3>
            </div>
            <div class="fr_content">
              <p>Dalam Proses pengiriman yg tepat waktu sangat kami utamakan.</p>
            </div>
          </div>
        </div>



       <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="front_service">
            <div class="icon_service">
              <i class="fa fa-handshake-o"></i>
              <h3>Terjamin Halal</h3>
            </div>
            <div class="fr_content">
              <p>Semua yang kami sajikan terjamin halal dan kebersihan selalu kami jaga.</p>
            </div>
          </div>
        </div>

       <div class="col-sm-4 col-md-4 col-lg-4">
          <div class="front_service">
            <div class="icon_service">
              <i class="fa fa-users"></i>
              <h3>Bisa Dipercaya</h3>
            </div>
            <div class="fr_content">
              <p>Alasan terakhir harus memilih catering kami adalah kami benar-benar bisa dipercaya. karena kepercayaan Anda adalah kebanggaan kami.</p>
            </div>
          </div>
        </div>


    </div>
  </div>
</section>';?>
<?php include_once "sw-content/themes/$folder/sw-footer.php";?>
</body>
</html>
<?php } ?>