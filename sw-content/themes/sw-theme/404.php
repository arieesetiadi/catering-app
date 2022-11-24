<?php if ($mod ==''){
    header('location:./404');
    echo'kosong';
}else{
    $page='Page Not Found :(';
    $title= $page;
    include_once "sw-content/themes/$folder/sw-header.php";
    include_once "sw-content/themes/$folder/breadcrumb.php";?>
<?php echo'
<section class="sw-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="error-404">
          <div class="not-found">
            <img src="'.$website_url.'/sw-content/themes/'.$folder.'/assets/img/404.png" class="img-responsive" oncontextmenu="return false;">
          </div>
          <p>Maaf, halaman yang Anda minta tidak ditemukan. Atau halaman tersebut telah kami hapus.</p>

          <a href="'.$website_url.'">Ke Halaman Depan</a>
        </div>

      </div>
    </div>
  </div>
</section>';?>

<?php include_once "sw-content/themes/$folder/sw-footer.php";?>
</body>
</html>
<?php } ?>