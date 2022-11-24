<?php if ($mod ==''){
    header('location:./404');
    echo'kosong';
}else{
    $title ='Kontak';
    $page = $title;
    include_once "sw-content/themes/$folder/sw-header.php";?>
<?php echo'
<section class="google-map">
   <iframe src="'.$google_map.'" width="100%" height="500" frameborder="0" style="border:0">
</iframe>
</section>

<section class="sw-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="sw-contact-us">
          <div class="sw-contact-info">
              <div class="row">

                <div class="col-md-4">
                  <div class="sw-contact-info-wrap">
                    <i class="fa fa-phone"></i>
                    <h5>Call Us At</h5>
                    <p>'.$website_phone.'</p>
                    <p>'.$website_phone_2.'
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="sw-contact-info-wrap">
                    <i class="fa fa-envelope-o"></i>
                    <h5>Email</h5>
                    <p>'.$website_email.'</p>
                    <p>'.$mail_info.'</p>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="sw-contact-info-wrap">
                    <i class="fa fa-map-marker"></i>
                    <h5>MEET US AT</h5>
                    <p>'.$website_addres.'</p>
                  </div>
                </div>


              <div class="sw-contact-form_2">
                <form method="post" class="myform" id="sw-contact" action="javascript:void();">
                  <div class="col-md-4">
                    <div class="form-group">
                       <input type="text" id="msg_name" name="msg_name" class="form-control-form" placeholder="Masukkan nama kamu" required> 
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                   <div class="form-group">
                    <input type="email" name="msg_email" id="msg_email" class="form-control-form" placeholder="Masukkan email kamu" pattern=".{5,100}" required>
                    </div>
                  </div>

                  <div class="col-md-4">
                   <div class="form-group">
                   <input type="text" name="msg_subject" id="msg_subject"  class="form-control-form" placeholder="Masukkan judul email kamu" required> 
                   </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea id="msg_content" name="msg_content" class="form-control" style="height:180px;"  data-msg-required="Masukkan pesan kamu" maxlength="2000" placeholder="Masukkan pesan anda"></textarea>
                    </div>';?>

                    <div class="form-group">
                      <button type="button" class="btn btn-loading btn-send btn-lg"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing" onclick="sendContact()">Kirim pesan</button>
                    </div> 

                  </div>            
                </form>
              </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php include_once "sw-content/themes/$folder/sw-footer.php";?>
</body>
</html>
<?php } ?>