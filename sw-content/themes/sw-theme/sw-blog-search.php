<?php if ($mod ==''){
    header('location:./404');
    echo'kosong';
}else{
    if (isset($_GET['search'])){
        $search  = mysqli_real_escape_string($connection,$_GET['search']);
        $title   = str_replace('-',' ',$search);
        $title   =ucfirst($title);
        $page = $title;

    }

    include_once "sw-content/themes/$folder/sw-header.php";
    include_once "sw-content/themes/$folder/breadcrumb.php";?>

<?php echo'<section class="sw-container">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">';?>
       <?php $limit = $item_artikel; 
        if(isset($_GET['pages'])){ $pages = mysqli_real_escape_string($connection,$_GET['pages']);}
        else{$pages = 1;} $offset = ($pages - 1) * $limit;
        $query="SELECT post.post_id,post.post_title,post.seotitle,post.author,post.post_content,post.post_category,post.images,post.post_date,post.post_time,post.post_hits,user.fullname FROM post,user where post.author = user.user_id and post.post_status='1' and post_title like '%$title%' order by post.post_id DESC LIMIT $offset, $limit";
        $result = $connection->query($query) or die($connection->error.__LINE__);
        if($result->num_rows > 0){
     echo'<div class="row blog-grid">';
        while($rows= $result->fetch_assoc()){
        extract($rows);
            if(strlen($post_title ) > 40)$post_title= substr($post_title,0,40).'..';
            $post_content= trim(stripslashes(strip_tags($post_content)));
            if(strlen($post_content)>60)$post_content=substr($post_content,0,60).'..';
            $category = str_replace('-',' ',$post_category);
        echo'<div class="col-xs-4 col-sm-4 col-md-6 col-lg-6">
                <article class="sw-blog-grid">
                    <div class="blog-featured-img">';
                      if ($images == NULL){   
                    echo'<img src="'.$website_url.'/timthumb?src='.$website_url.'/sw-content/sw-medium.jpg&h=300&w=600" alt="'.$post_title.'"/>';
                    } else {
                      echo'<img src="'.$website_url.'/timthumb?src='.$images.'&h=300&w=600" title="'.$post_title.'"/>';
                      }
                      echo'
                    </div>

                    <div class="blog-content">
                      <p class="category">'.$category.'</p>
                      <div class="blog-info-item">
                        <i class="fa fa-user-o"></i> '.$fullname.' <span class="split">/</span> <i class="fa  fa-calendar"></i> ';if($timezone == 'ID'){echo''.tgl_indo($post_date).'';}else{echo''.$post_date.'';}
                      echo' 
                      </div>

                      <h3>
                        <a href="'.$website_url.'/blog/'.$post_id.'-'.$seotitle.'.html">'.ucfirst($post_title).'</a>
                      </h3>
                      <div class="desc">
                        <p>'.ucfirst($post_content).'</p>
                      </div>

                      <div class="blog-readmore">
                          <a href="'.$website_url.'/blog/'.$post_id.'-'.$seotitle.'.html">Read More <i class="fa fa-angle-double-right"></i></a></div>

                    </div>
                </article>  
            </div>';}?>

         </div>        
        <div class="paginations text-center margin-top-20">
            <ul>
        <?PHP $pagination = mysqli_query($connection,"SELECT COUNT(post_id) AS jumData FROM post where post_status='1'") or die ('Pagination error');
                $data  = mysqli_fetch_assoc($pagination);
                $pagination=''.$website_url.'/blog/search/'.$search.'-p-';
                $jumData = $data['jumData'];
                $jumPage = ceil($jumData/$limit);
            //menampilkan link << Previou
            if ($pages > 1){echo '<li class="prev"><a href="'.$pagination.''.($pages-1).'"><i class="fa fa-angle-left"></i></a></li>';}
            //menampilkan urutan paging
                for($i = 1; $i <= $jumPage; $i++){
            //mengurutkan agar yang tampil i+3 dan i-3
                if ((($i >= $pages - 1) && ($i <= $pages + 5)) || ($i == 1) || ($i == $jumPage)){
                    if($i==$jumPage && $pages <= $jumPage-5)
                        echo'<li class="disabled"><a href="#">..</a></li>';
                        if ($i == $pages) echo '<li class="active"><span>'.$i.'</span></a></li>';
                        else echo '<li><a href="'.$pagination.''.$i.'">'.$i.'</a></li>';
                if($i==1 && $pages >= 5) echo '<li class="disabled"><a href="#">..</a></li>';
            }}
            //menampilkan link Next >>
            if ($pages < $jumPage){echo'<li class="next"><a href="'.$pagination.''.($pages+1).'"><i class="fa fa-angle-right"></i></a></li>';}?>
              </ul>
       </div>
<!-- End:Paginations -->
        <?php }else {
        echo'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="alert alert-warning text-center">
                    <h1><i class="fa fa-frown-o"></i></h1>
                    <p>Kami tidak menemukan Blog/Artikel yang anda cari!</p>
                </div>
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