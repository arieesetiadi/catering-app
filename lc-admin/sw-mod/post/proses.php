<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../login' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include( '../../../sw-library/sw-function.php' );

$modul='';
$aksi='';

if(!empty($_POST['modul'])){
$modul = $_POST['modul'];
}

if(!empty($_POST['aksi'])){
$aksi = $_POST['aksi'];
}


if ( $modul == 'post' AND $aksi == 'insert' ){
$post_content = htmlentities(trim($_POST['post_content']));
$_SESSION['post_content']=$post_content;

 $error = array();
if (empty($_POST['post_title'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$post_title = mysqli_real_escape_string($connection,$_POST['post_title']);
//$seotitle= seo_title($post_title);
$_SESSION['post_title']=$post_title;
    }

if (empty($_POST['seotitle'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$seotitle= mysqli_real_escape_string($connection,$_POST['seotitle']);
$_SESSION['seotitle']=$seotitle;
    }

if (empty($_POST['post_description'])) { 
        $error[] = 'tidak boleh kosong';
    } else { 
    $post_description = mysqli_real_escape_string($connection, $_POST['post_description']); 
    $_SESSION['post_description']=$post_description;
  }

if (empty($_POST['post_content'])) { 
        $error[] = 'post_content';
    } else {
$post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
 }

if (empty($_POST['images'])) { 
        $error[] = 'images';
    } else {
$images = mysqli_real_escape_string($connection, $_POST['images']);
$_SESSION['images']=$images;
 }

if (empty($_POST['post_category'])) { 
$error[] = 'post_category';
    } else {
$post_category = strip_tags($_POST['post_category']);}

if (empty($_POST['post_tags'])) { 
$error[] = 'post_tags';
    } else {
$post_tags = $_POST['post_tags'];
$post_tags= implode($post_tags, ',');}


if (empty($_POST['post_status'])) { 
$error[] = 'status';
    } else {
$post_status = strip_tags($_POST['post_status']);}

if (empty($error)) { 
$tambah="INSERT INTO post (post_title,
                              seotitle,     
                              author, 
                              post_description,
                              post_content,
                              images,
                              post_category,
                              post_tags,
                              post_time,
                              post_date,
                              post_hits,
                              post_status)
                              values('$post_title', 
                                '$seotitle', 
                                '$author',  
                                '$post_description', 
                                '$post_content', 
                                '$images', 
                                '$post_category', 
                                '$post_tags', 
                                '$time', 
                                '$date', 
                                '0', '$post_status')" or die($connection->error.__LINE__); 
          if($connection->query($tambah) === false) { 
          _goto( '../../?mod='.$modul.'&op=add');
          $_SESSION['message'] ='Artikel Tidak dapat di publish...!';
          } else   {
          _goto( '../../?mod='.$modul);
          $_SESSION['post_title']='';
          $_SESSION['seotitle']='';
          $_SESSION['post_description']='';
          $_SESSION['post_content']='';
          $_SESSION['images']='';
          $_SESSION['message']='';

          } }


          else{
          foreach ($error as $key => $values) {            
           _goto( '../../?mod='.$modul.'&op=add');
            //echo $values;
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
          }}}
            

// Proses Update Post
elseif ( $modul == 'post' AND $aksi == 'update' ){
$post_content = htmlentities(trim($_POST['post_content']));
$_SESSION['post_content']=$post_content;
$post_id=$_POST['post_id'];
$id=mysqli_real_escape_string($connection, $_GET['id']);
 $error = array();
if (empty($_POST['post_title'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
$seotitle= seo_title($post_title);
$_SESSION['post_title']=$post_title;
    }

if (empty($_POST['seotitle'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$seotitle= mysqli_real_escape_string($connection,$_POST['seotitle']);
$_SESSION['seotitle']=$seotitle;
    }

if (empty($_POST['post_description'])) { 
        $error[] = 'tidak boleh kosong';
    } else { 
    $post_description = mysqli_real_escape_string($connection, $_POST['post_description']); 
    $_SESSION['post_description']=$post_description;
  }

if (empty($_POST['post_content'])) { 
        $error[] = 'post_content';
    } else {
$post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
 }

if (empty($_POST['images'])) { 
        $error[] = 'images';
    } else {
$images = mysqli_real_escape_string($connection, $_POST['images']);
$_SESSION['images']=$images;
 }

if (empty($_POST['post_category'])) { 
$error[] = 'post_category';
    } else {
$post_category = strip_tags($_POST['post_category']);}


if (empty($_POST['post_tags'])) { 
$error[] = 'post_tags';
    } else {
$post_tags = $_POST['post_tags'];
$post_tags = implode($post_tags,',');}

if (empty($_POST['post_status'])) { 
$error[] = 'status';
    } else {
$post_status = strip_tags($_POST['post_status']);}

if (empty($error)) {
$update="UPDATE post SET post_title='$post_title',seotitle='$seotitle',post_description='$post_description',post_content='$post_content',images='$images',post_category='$post_category',post_tags='$post_tags',post_time='$time',post_date='$date',post_status='$post_status' WHERE post_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
_goto( '../../?mod='.$modul.'&op=edit&post='.$post_id.'');
//die($connection->error.__LINE__);
 $_SESSION['message'] ='Artikel Tidak dapat di ubah...!';
} else   {
 _goto('../../?mod='.$modul);
    $_SESSION['post_title']='';
    $_SESSION['seotitle']='';
    $_SESSION['post_description']='';
    $_SESSION['post_content']='';
    $_SESSION['images']='';
    $_SESSION['post_category']='';
    $_SESSION['message']='';
} } 

else{
foreach ($error as $key => $values) {            
  _goto( '../../?mod='.$modul.'&op=edit&post='.$post_id.'');
    $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}}


if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection,@$_GET['aksi']);
$id =mysqli_real_escape_string($connection,epm_decode($_GET['id']));
if ($aksi=='delete'){
$delete="DELETE FROM post WHERE post_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($delete) === true) { 
_goto( '../../?mod=post');
$_SESSION['message']='';
} else { 
_goto( '../../?mod=post');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


// Proses Multi Delete Post
elseif ($modul=='post' AND $aksi == 'multidelete'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
          mysqli_query($connection,"DELETE FROM post WHERE post_id=".$id);
  }
 _goto( '../../?mod='.$modul.'');
 $_SESSION['message']='';
}

// Proses Insert Category
elseif ( $modul == 'post' AND $aksi == 'insertCategory'){
  $title    = $_POST['title'];
  $seotitle = seo_title($title);
  if($title == ""){ echo "<span class='text-danger'>Bidang tidak boleh kosong</span>"; }
  else {

// mencari title yang sama
$query ="SELECT title FROM category WHERE title ='$title' and type='2'";
$result= $connection->query($query) or die($connection->error.__LINE__);
$hasil= $result->num_rows;
if ($hasil== 0){

$tambah= "INSERT INTO category(title,
seotitle,     
type)
values('$title', '$seotitle', '2')" or die($connection->error.__LINE__); 
if($connection->query($tambah) === false) { 
die($connection->error.__LINE__);//error
} 
else  {  
  $_SESSION['message']='';
// sukses
} }
else {
echo"<span class='text-danger'>Kategori sudah ada..</span>";
$_SESSION['message']='';
}}
$modul='';
$aksi='';
    echo'<select class="select-chosen" name="post_category" style="width:280px;" data-placeholder="Choose a Category">';
$query="SELECT title,seotitle from category  where type='2' order by title asc"; 
$result = $connection->query($query) or die($connection->error.__LINE__);
 while($row = $result->fetch_assoc()) { 
$title = strip_tags($row['title']);
$seotitle = strip_tags($row['seotitle']); echo "<option value='$seotitle'>$title</option>";
      }
      echo '</select>
      <script type="text/javascript">
        $(".select-chosen").chosen({
          width: "100%"
        })
      </script>';
}
elseif ( $modul == 'post' AND $aksi == 'insertTag' ){
$post = $_POST['tag'];
if( $post == "" ){ echo "error"; }
else {
  $pecah = explode( ",", $post );
  $total = count( $pecah );
   for ($i=0; $i<$total; $i++) {
    $tag_title = $pecah[$i];
    $tag_seo = seo_title($tag_title);
$tambah= "INSERT INTO tags(title,
seotitle,     
type)
values('$tag_title', '$tag_seo', '2')" or die($connection->error.__LINE__); 
    $connection->query($tambah);
    $_SESSION['message']='';
}

echo'<select class="required select-chosen" name="post_tags[]" multiple tabindex="4" data-placeholder="Pilih Tags" style="width:280px;" required>';
$query_tags ="SELECT title,seotitle from tags  where type='2' order by title asc";  
$result_tags = $connection->query($query_tags) or die($connection->error.__LINE__);
 while($row_tags = $result_tags->fetch_assoc()) { 
$tags = $row_tags['title'];
$tags_seo = $row_tags['seotitle'];
echo "<option value='$tags_seo'>$tags</option>";}?>
<script type="text/javascript">
  $(".select-chosen").chosen({
    width: "100%"
  })
</script>
      <?php
}}
else {
  echo 'error';
}

}
