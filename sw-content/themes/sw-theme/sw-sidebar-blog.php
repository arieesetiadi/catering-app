<?PHP if(empty($connection)){
    header('location:./404');
} else {
    echo'<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
         <div class="sidebar-wrapper sidebar">
            <div class="sidebar-search">
                <meta itemprop="url" content="'.$website_url.'/search-blog"/>
                    <form action="'.$website_url.'/search-blog" method="get" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
                    <div class="input-group">
                      <meta itemprop="target" content="'.$website_url.'/search?q={search_term_string}"/>
                        <input type="text" name="search_term_string" class="form-control" placeholder="Cari Artikel...">
                        <span class="input-group-btn">
                            <button type="submit" class="btn-search btn"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>

            <div class="sw-sidebar">
                <div class="sw-title"><h3>Kategori</h3></div>
                    <div class="sidebar-body">
                        <div class="category">
                            <ul>';
                    $query_category ="SELECT title,seotitle FROM category WHERE type='2' ORDER BY title ASC";
                    $result_category = $connection->query($query_category);
                    if($result_category->num_rows > 0){;
                    while ($row_category = $result_category->fetch_assoc()) {
                    extract($row_category);
                        $query_count ="SELECT post_id FROM post WHERE post_category='$row_category[seotitle]'";
                            $result_count = $connection->query($query_count) or die ($connection->error.__LINE__);

                        echo'<li><a href="'.$website_url.'/blog/category/'.$seotitle.'.html"><i class="fa fa-dot-circle-o"></i>'.ucfirst($title).'<span>'.$result_count->num_rows.'</span></a></li>';}}
                        echo'
                            </ul>
                        </div>
                    </div>
            </div>

            <div class="sw-sidebar">
                <div class="sw-title"><h3>Populer Artikel</h3></div>
                <div class="sidebar-body">
                    <ul>';
        $recent_footer="SELECT post_id,post_title,seotitle,images,post_date FROM post WHERE post_status='1' ORDER BY RAND() limit 5";
          $result_r_footer = $connection->query($recent_footer);
          if($result_r_footer->num_rows > 0){
            while ($row = $result_r_footer->fetch_assoc()) {
              $post_title = $row['post_title'];
              if(strlen($post_title)>25) $post_title = substr($post_title,0,25).'..';
        echo'<li><a href="'.$website_url.'/blog/'.$row['post_id'].'-'.$row['seotitle'].'.html"  class="post-thumb">';
                if ($row['images'] == NULL){   
                    echo'<img src="'.$website_url.'/timthumb?src='.$website_url.'/sw-content/sw-small.jpg&h=70&w=70"/>';
                    } else {
                    echo'<img src="'.$website_url.'/timthumb?src='.$row['images'].'&h=70&w=70" alt="'.$post_title.'"/>';
                  }
            echo'</a>
            <div class="post-info fix">
                 <a href="'.$website_url.'/blog/'.$row['post_id'].'-'.$row['seotitle'].'.html" title="'.$row['post_title'].'">'.ucfirst($post_title).'</a><span><i class="fa fa-clock-o"></i> '.tgl_indo($row['post_date']).'</span>
            </div>
            </li>';
            }
        }
            echo'</ul>
            </div>
        </div>
    </div>
</div>';}?>