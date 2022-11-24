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

if(!empty($_POST['modul'])){$modul = strip_tags($_POST['modul']);}
if(!empty($_POST['aksi'])){$aksi = strip_tags($_POST['aksi']);}

if ( $modul == 'product' AND $aksi == 'insert' ){
  $description = htmlentities(trim($_POST['description']));
  $_SESSION['description']=$description;

$error = array();
if (empty($_POST['product_code'])) { 
        $error[] = 'code';
    } else {
$product_code = mysqli_real_escape_string($connection,$_POST['product_code']);
$_SESSION['product_code']=$product_code;
    }

if (empty($_POST['store_id'])) { 
  $error[] = 'store_id';
    } else {
    $store_id=mysqli_real_escape_string($connection,$_POST['store_id']);
    $_SESSION['store_id']=$store_id;
} 


if (empty($_POST['product_name'])) { 
        $error[] = 'name';
    } else {
      $product_name=mysqli_real_escape_string($connection,$_POST['product_name']);
      $_SESSION['product_name']=$product_name;
    }

if (empty($_POST['seoname'])) { 
        $error[] = 'seoname';
    } else { 
    $seoname = mysqli_real_escape_string($connection,$_POST['seoname']); 
    $_SESSION['seoname']=$seoname;
  }


if (empty($_POST['category'])) { 
$error[] = 'category';
    } else {
    $category=mysqli_real_escape_string($connection,$_POST['category']);
    $_SESSION['category']=$category;
} 



if (empty($_POST['product_img'])) { 
        $error[] = 'product_img';
    } else {
$product_img = mysqli_real_escape_string($connection, $_POST['product_img']);
$_SESSION['product_img']=$product_img;
 }

if (empty($_POST['description'])) { 
        $error[] = 'description';
    } else {
  $description= mysqli_real_escape_string($connection, $_POST['description']);
  $_SESSION['description']=$description;
 }

 if (empty($_POST['product_price'])) { 
        $error[] = 'harga';
    } else {
    $product_price= mysqli_real_escape_string($connection,$_POST['product_price']);
    $_SESSION['product_price']=$product_price;
 }

if($_POST['product_discount']== ''){
    $product_discount='0';
  }
else{
  $product_discount=strip_tags($_POST['product_discount']);
  $_SESSION['product_discount']=$product_discount;
}


if (empty($_POST['time'])) { 
  $error[] = 'time';
    } else {
  $time = strip_tags($_POST['time']);
}


if (empty($_POST['date'])) { 
  $error[] = 'date';
    } else {
  $date = strip_tags($_POST['date']);
}


if (empty($_POST['active'])) { 
$error[] = 'status';
    } else {
$active = strip_tags($_POST['active']);}

if (empty($error)) { 
  $query="SELECT product_id from product order by product_id DESC";
  $result=$connection->query($query);
    $row=$result->fetch_assoc();
    $product_id=$row['product_id'] + 1;

$tambah ="INSERT INTO product (product_id,
                              author,
                              product_code,
                              store_id, 
                              product_name,     
                              seoname,
                              category,
                              product_price,
                              product_discount,
                              product_img,
                              description,
                              time,
                              date,
                              stats,
                              active)
                              values('$product_id',  
                                '$author',
                                '$product_code',  
                                '$store_id',
                                '$product_name', 
                                '$seoname',
                                '$category',
                                '$product_price',
                                '$product_discount',
                                '$product_img',
                                '$description',
                                '$time', 
                                '$date', 
                                '0', 
                                '$active')" or die($connection->error.__LINE__);
          if($connection->query($tambah) === false) { 
                _goto( '../../?mod='.$modul.'&op=add');
                $_SESSION['message'] ='Produk Tidak dapat di publish...!';
                //die($connection->error.__LINE__);
          } else   {
             _goto( '../../?mod='.$modul);
                $connection->query($add_images);
                $_SESSION['product_code']='';
                $_SESSION['store_id'] ='';
                $_SESSION['product_name']='';
                $_SESSION['seoname']='';
                $_SESSION['category']='';
                $_SESSION['description']='';
                $_SESSION['active']='';
                $_SESSION['store_id']='';
                $_SESSION['product_price']='';
                $_SESSION['product_discount']='';
                $_SESSION['product_img']='';
                $_SESSION['message']='';
          } }
          else{
          foreach ($error as $key => $values) {            
         // _goto( '../../?mod='.$modul.'&op=add');
           echo $values;
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}}
      

// Proses UpdatPost
elseif ( $modul == 'product' AND $aksi == 'update' ){
$product_id=$_POST['product_id'];
$id=mysqli_real_escape_string($connection, $_GET['id']);

  $description = htmlentities(trim($_POST['description']));
  $_SESSION['description']=$description;

$error = array();
if (empty($_POST['product_code'])) { 
        $error[] = 'code';
    } else {
$product_code = mysqli_real_escape_string($connection,$_POST['product_code']);
$_SESSION['product_code']=$product_code;
    }

if (empty($_POST['store_id'])) { 
  $error[] = 'store_id';
    } else {
    $store_id=mysqli_real_escape_string($connection,$_POST['store_id']);
    $_SESSION['store_id']=$store_id;
} 


if (empty($_POST['product_name'])) { 
        $error[] = 'name';
    } else {
      $product_name=mysqli_real_escape_string($connection,$_POST['product_name']);
      $_SESSION['product_name']=$product_name;
    }

if (empty($_POST['seoname'])) { 
        $error[] = 'seoname';
    } else { 
    $seoname = mysqli_real_escape_string($connection,$_POST['seoname']); 
    $_SESSION['seoname']=$seoname;
  }


if (empty($_POST['category'])) { 
$error[] = 'category';
    } else {
    $category=mysqli_real_escape_string($connection,$_POST['category']);
    $_SESSION['category']=$category;
} 



if (empty($_POST['product_img'])) { 
        $error[] = 'product_img';
    } else {
$product_img = mysqli_real_escape_string($connection, $_POST['product_img']);
$_SESSION['product_img']=$product_img;
 }

if (empty($_POST['description'])) { 
        $error[] = 'description';
    } else {
  $description= mysqli_real_escape_string($connection, $_POST['description']);
  $_SESSION['description']=$description;
 }

 if (empty($_POST['product_price'])) { 
        $error[] = 'harga';
    } else {
    $product_price= mysqli_real_escape_string($connection,$_POST['product_price']);
    $_SESSION['product_price']=$product_price;
 }

if($_POST['product_discount']== ''){
    $product_discount='0';
  }
else{
  $product_discount=strip_tags($_POST['product_discount']);
  $_SESSION['product_discount']=$product_discount;
}


if (empty($_POST['time'])) { 
  $error[] = 'time';
    } else {
  $time = strip_tags($_POST['time']);
}


if (empty($_POST['date'])) { 
  $error[] = 'date';
    } else {
  $date = strip_tags($_POST['date']);
}


if (empty($_POST['active'])) { 
$error[] = 'status';
    } else {
$active = strip_tags($_POST['active']);}

if (empty($error)) {
$update="UPDATE product SET product_code='$product_code',
                  store_id='$store_id',
                  product_name='$product_name',
                  seoname='$seoname',
                  category='$category',
                  product_price='$product_price',
                  product_discount='$product_discount',
                  product_img='$product_img',
                  description='$description',
                  time='$time',
                  date='$date',
                  active='$active' WHERE product_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
    _goto( '../../?mod='.$modul.'&op=edit&product='.epm_decode($product_id).'');
//die($connection->error.__LINE__);
    $_SESSION['message'] ='Property Tidak dapat di ubah...!';
} else   {
     _goto('../../?mod='.$modul);
        $_SESSION['product_code']='';
        $_SESSION['store_id'] ='';
        $_SESSION['product_name']='';
        $_SESSION['seoname']='';
        $_SESSION['category']='';
        $_SESSION['description']='';
        $_SESSION['active']='';
        $_SESSION['store_id']='';
        $_SESSION['product_price']='';
        $_SESSION['product_discount']='';
        $_SESSION['product_img']='';
        $_SESSION['message']='';

} } 

else{
foreach ($error as $key => $values) {            
  _goto( '../../?mod='.$modul.'&op=edit&product='.epm_decode($product_id).'');
    $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}}


if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection,@$_GET['aksi']);
$id =mysqli_real_escape_string($connection,epm_decode($_GET['id']));
if ($aksi=='delete'){
$delete="DELETE FROM product WHERE product_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($delete) === true) { 
  _goto( '../../?mod=product');
  $_SESSION['message']='';
} else { 
    _goto( '../../?mod=product');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


if(!empty($_GET['id'])){ 
  $aksi=mysqli_real_escape_string($connection,@$_GET['aksi']);
  $id=mysqli_real_escape_string($connection,epm_decode($_GET['id']));
if ($aksi=='sold'){
    $update="UPDATE product SET status='2' WHERE product_id='$id'" or die($connection->error.__LINE__); 
    if($connection->query($update) === false) { 
  _goto( '../../?mod=product');
  $_SESSION['message'] ='';
} else { 
    _goto( '../../?mod=product');
    $_SESSION['message'] ='';
}}}


if(!empty($_GET['id'])){ 
  $aksi=mysqli_real_escape_string($connection,@$_GET['aksi']);
  $id=mysqli_real_escape_string($connection,epm_decode($_GET['id']));
if ($aksi=='sale'){
    $update="UPDATE product SET status='1' WHERE product_id='$id'" or die($connection->error.__LINE__); 
    if($connection->query($update) === false) { 
  _goto( '../../?mod=product');
  $_SESSION['message'] ='';
} else { 
    _goto( '../../?mod=product');
    $_SESSION['message'] ='';
}}}



// Proses Multi Delete Post
elseif ($modul=='product' AND $aksi == 'multidelete'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
          mysqli_query($connection,"DELETE FROM product WHERE product_id=".$id);
  }
 _goto( '../../?mod='.$modul.'');
 $_SESSION['message']='';
}

// Proses Insert Category
elseif ( $modul == 'product' AND $aksi == 'insertCategory'){
  $title    = $_POST['title'];
  $seotitle = seo_title($title);
  if($title == ""){
    echo "<span class='text-danger'>Bidang tidak boleh kosong</span>"; }
  else {

// mencari title yang sama
$query ="SELECT title FROM category WHERE title ='$title' and type='1'";
  $result= $connection->query($query) or die($connection->error.__LINE__);
  $hasil= $result->num_rows;
  if ($hasil== 0){
    $tambah= "INSERT INTO category(title,seotitle,type) values('$title', '$seotitle', '1')" or die($connection->error.__LINE__); 
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
    echo'<select class="select-chosen" name="category" style="width:280px;" data-placeholder="Choose a Category">';
$query="SELECT title,seotitle from category  where type='1' order by title asc"; 
$result = $connection->query($query) or die($connection->error.__LINE__);
 while($row = $result->fetch_assoc()) { 
    $title = strip_tags($row['title']);
    $seotitle = strip_tags($row['seotitle']); 
    echo "<option value='$seotitle'>$title</option>";
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
