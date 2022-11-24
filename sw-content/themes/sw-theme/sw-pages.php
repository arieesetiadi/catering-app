<?php if ($mod ==''){
    header('location:./404');
    echo'kosong';
}else{
if (isset($_GET['read_pages'])){
      $read_pages = mysqli_real_escape_string($connection,$_GET['read_pages']);
      $page = str_replace('-',' ',$read_pages);
     $query_read="SELECT * FROM page where seotitle='$read_pages' and active='Y'"; 
        $result_read = $connection->query($query_read) or die($connection->error.__LINE__);
        $row_read = $result_read->fetch_assoc();
            $page_id = $row_read['page_id'];
            $title = strip_tags($row_read['title']);
            $meta_description = strip_tags($row_read['page_description']);
            $content = $row_read['page_content'];
            $meta_img = ''.$website_url.'/'.$row_read['images'].'';
            if($title == NULL){$title ='404';}else{$title = $title;}
}
    include_once "sw-content/themes/$folder/sw-header.php";
    include_once "sw-content/themes/$folder/breadcrumb.php";?>
<?php echo'


<section class="sw-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">';
  if($result_read->num_rows > 0){
    extract($row_read);
    $baca = $row_read['page_hits']+1;
    $stat=mysqli_query($connection,"UPDATE page SET page_hits='$baca' WHERE page_id='$page_id'") or die('Stat Article Error');
      echo'
        <article class="page-detail">
          <h1 class="title"><a href="'.$_SERVER["REQUEST_URI"].'">'.ucfirst($title).'</a></h1>
        <div class="post-meta">
          <i class="fa fa-calendar"></i><a href="#"> ';if($timezone == 'ID'){echo''.tgl_indo($page_date).'';} else{echo''.$page_date.'';}echo'</a> <span>/</span> 
          <i class="fa  fa-eye"></i> Dibaca : <a href="#">'.$page_hits.'</a>
        </div>

          <div class="entry_content">
            '.$page_content.'
          </div>

        </article>

        <div class="share-wrapper">
          <h3>Bagikan :</h3>
          <div class="share-item">
              <ul>
                <li><a class="fb" href="http://www.facebook.com/sharer/sharer.php?u='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>

                <li><a class="tw" href="http://twitter.com/share?url='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
                 
                 <li><a class="google" href="http://plus.google.com/share?url='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" target="_blank"><i class="fa fa-google"></i><span>Google +</span></a></li>

                <li><a class="wa" href="https://api.whatsapp.com/send?text='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a></li>
              </ul>
          </div>
       </div>
       ';}
        echo'
      </div> 
    </div>
  </div>
</section>';?>


<?php include_once "sw-content/themes/$folder/sw-footer.php";?>
</body>
</html>
<?php } ?>