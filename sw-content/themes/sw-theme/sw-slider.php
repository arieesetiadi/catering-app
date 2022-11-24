<?PHP if(!empty($connection)){
$query_slider ="SELECT slider_url,photo FROM slider WHERE active='Y' ORDER BY position ASC";
    $result_slider = $connection->query($query_slider);
  echo'<div class="home-slider carousel slide" data-ride="carousel" id="carousel-example-generic" data-interval="10000" data-pause="hover">
          <!-- Wrapper for slides -->
          <div class="carousel-inner">';
          $active_slider=0;
    if($result_slider->num_rows > 0){
        while ($row_slider = $result_slider->fetch_assoc()) {
           $active_slider++;
          if($active_slider ==1){
            echo'<div class="item active">';}
            else{echo'<div class="item">';}
            echo'
            <a href="'.$row_slider['slider_url'].'" target="_blank">
              <img src="sw-content/slider/'.$row_slider['photo'].'" alt="'.$website_name.'">
            </a>
          </div>';
  }}
    echo'
          </div>
          <!-- Controls -->
          <a class="left carousel-control" data-slide="prev" href="#carousel-example-generic">
              <span class="icon-prev">
              </span>
          </a>
          <a class="right carousel-control" data-slide="next" href="#carousel-example-generic">
              <span class="icon-next">
              </span>
          </a>
  </div>
<!-- end:slider -->

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
';
}?>