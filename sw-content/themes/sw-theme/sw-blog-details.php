<?php if ($mod ==''){
    header('location:./404');
    echo'kosong';
}else{
if (isset($_GET['read_blog'])){
$read_blog = mysqli_real_escape_string($connection,$_GET['read_blog']);
$blog = str_replace('-',' ',$read_blog);
$query_read="SELECT post.*,user.fullname,user.photo,user_profile.about FROM post,user,user_profile where post.author=user.user_id and post.author=user_profile.user_id and post_status='1' and post.post_id='$read_blog'"; 
        $result_read=$connection->query($query_read) or die($connection->error.__LINE__);
        $row_read = $result_read->fetch_assoc();
            $post_id = $row_read['post_id'];
            $title = strip_tags($row_read['post_title']);
            $meta_description = strip_tags($row_read['post_description']);
            $content = $row_read['post_content'];
            $meta_img = ''.$website_url.'/'.$row_read['images'].'';
            $url = "./category/".$row_read['post_category'].".html";
            $page = str_replace('-',' ',ucfirst($row_read['post_category']));
            $page = ucfirst($page);
            $a_tags = htmlentities(strip_tags($row_read['post_tags']));
            $jumlah_tags = substr_count($a_tags,",");
            $a_tags = explode(',',$a_tags);
            if($title == NULL){$title ='404';}else{$title = $title;}
  }
    include_once "sw-content/themes/$folder/sw-header.php";
    include_once "sw-content/themes/$folder/breadcrumb.php";?>

<?php echo'<section class="sw-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">';
        if($result_read->num_rows > 0){
            extract($row_read);
            $category = str_replace('-',' ',$post_category);
            $category=ucfirst($category);

            $baca = $row_read['post_hits']+1;
            $stat=mysqli_query($connection,"UPDATE post SET post_hits='$baca' WHERE post_id='$post_id'") or die('Stat Article Error');
        echo'
        <article>
        <div class="blog-detail">
          <h1 class="title"><a href="#">'.$title.'</a></h1>
          <div class="post-meta">
            By <a href="javascript:void();">'.$fullname.'</a> <span>/</span> 
                <a href="javascript:void();">';if($timezone == 'ID'){echo''.tgl_indo($post_date).'';} else{echo''.$post_date.'';}echo'</a> <span>/</span>
                <a href="./category/'.$post_category.'.html">'.$category.'</a> 
                <span>/</span>
                <a href="javascript:void();">'.$post_hits.' Pembaca</a> <span>/</span>
                <a class="meta_comments disqus-comment-count" data-disqus-url="'.$website_url.'/blog/'.$post_id.'-'.$seotitle.'.html">0 Komentar</a>
          </div>

          <div class="entry_content">
            '.$post_content.'
          </div>


<div class="post-tags-social">
    <div class="row">
      <div class="col-md-6">
          <div class="entry_tags">
            <span><i class="fa fa-tags"></i></span>';
            $j_tags = 0; while($j_tags<=$jumlah_tags){$tags_me=$a_tags["$j_tags"];
                $link_tags=strtolower($tags_me);$link_tags = str_replace(" ", "-", $link_tags);
                echo'<a href="./tags/'.$link_tags.'.html">'.ucfirst($tags_me).'</a>';
                $j_tags++;}
            echo'
         </div>
      </div>

      <!-- social media -->
        <div class="col-md-6">
           <div class="post-social">
          <ul>
            <li><a href="http://www.facebook.com/sharer/sharer.php?u='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" target="_blank" class="fa fa-facebook"></a></li>

            <li><a  href="http://twitter.com/share?url='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" target="_blank" class="fa fa-twitter"></i></a></li>

            <li><a href="http://plus.google.com/share?url='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" target="_blank" class="fa fa-google-plus"></a></li>
            
            <li><a href="https://api.whatsapp.com/send?text='.$_SERVER["HTTP_HOST"].''.$_SERVER["REQUEST_URI"].'" data-action="share/whatsapp/share" target="_blank" class="fa fa-whatsapp"></a></li>
          </ul>
        </div>
        </div>
      <!-- end:social media -->
    </div>
</div>


  <div class="pages-prenxt-post">
    <div class="row">
      <div class="col-md-6">';
      $sqlback=mysqli_query($connection,"SELECT post_id,post_title,seotitle FROM post WHERE post_id >'$post_id'");
      $pageback=mysqli_fetch_assoc($sqlback);
      $back ="./".strip_tags($pageback['post_id'])."-".strip_tags($pageback['seotitle']).".html";
      if ($pageback > "".mysqli_real_escape_string($connection, $_GET['read_blog']).""){
      echo'
        <a href="'.$back.'">
          <p><i class="fa fa-arrow-circle-left"></i> Sebelumnya</p>
          <h5>'.ucfirst($pageback['post_title']).'</h5>
        </a>';}
        echo'
      </div>

     <div class="col-md-6">';
     //page next
      $sqlnext=mysqli_query($connection,"SELECT post_id,post_title,seotitle FROM post WHERE post_id <'$post_id' order by post_id desc");
      $pagenext=mysqli_fetch_assoc($sqlnext);
      $next ="./".strip_tags($pagenext['post_id'])."-".$pagenext['seotitle'].".html";
      if ($pagenext >"".mysqli_real_escape_string($connection,$_GET['read_blog']).""){
      echo'<a href="'.$next.'" class="text-right">
          <p>Selanjutnya <i class="fa fa-arrow-circle-right"></i></p>
          <h5>'.ucfirst($pagenext['post_title']).'</h5>
        </a>';}
      echo'
      </div>
    </div>

  </div>

          <!-- start: komentar -->
          <div class="sw-coments">
            <h3>Komentar :</h3>';
            if($komentar_mode== 'Y'){
                require_once'./sw-library/komentar.txt';
              }
              else{echo'<div class="alert alert-warning">
                      <i class="fa fa-lg fa-exclamation-triangle"></i> Saat ini Komentar Tidak tersedia.
                    </div>';
              }
            echo'
          </div>
          <!-- end:komentar -->
      </div>
  </article>';}else{
    echo'<div class="error-404">
          <div class="not-found">
              <img src="../sw-content/themes/'.$folder.'/assets/img/404.png">
          </div>
        <p>Maaf, halaman yang Anda minta tidak ditemukan. Atau halaman tersebut telah kami hapus.</p>
        <a href="'.$website_url.'/blog">Ke Halaman Blog</a>
    </div>';}?>

 </div>
        <!-- wrapper sidebar-->
          <?php include_once "sw-content/themes/$folder/sw-sidebar-blog.php";?>
        <!-- end wrapper sidebar -->
      </div>
    </div>
  </div>
</section>
<?php include_once "sw-content/themes/$folder/sw-footer.php";?>
</body>
</html>
<?php } ?>