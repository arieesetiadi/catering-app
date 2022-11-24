<?php if(!empty($connection)){ 
if ( $mod == "" ){
  header('location:./404');
}
else {
if(!empty($_GET['search'])){// pencarian 
if($search == $search){
  $metasocial_title   = ''.$title.' - ';
  $metasocial_name    = $website_name;
  $metasocial_url     = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'';
  $metasocial_desc    = $meta_description;
  $metasocial_key     = $meta_keyword;
  $metasocial_img     =''.$website_url.'/sw-content/meta-img.jpg';

}}


elseif(!empty($_GET['read_pages'])){// halaman detail pages 
if($read_pages == $read_pages){
  $metasocial_title   = ''.$title.' - ';
  $metasocial_name    = $website_name;
  $metasocial_url     = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'';
  $metasocial_desc    = $meta_description;
  $metasocial_key     = $meta_keyword;
  $metasocial_img     = $meta_img;

}}


else if(!empty($_GET['read_product'])){// detail produk
if($read_product == $read_product){
  $metasocial_title   = ''.$title.' - ';
  $metasocial_name    = $website_name;
  $metasocial_url     = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'';
  $metasocial_desc    = $meta_description;
  $metasocial_key     = $meta_keyword;
  $metasocial_img     = $meta_img;

}}



else if(!empty($_GET['read_blog'])){// detail blog
if($read_blog == $read_blog){
  $metasocial_title   = ''.$title.' - ';
  $metasocial_name    = $website_name;
  $metasocial_url     = $pacth_url;
  $metasocial_desc    = $meta_description;
  $metasocial_key     = $meta_keyword;
  $metasocial_img     = $meta_img;

}}



else if(!empty($page)){// menampilkan page depan tentang,contak dll
if($page == $page){
      $metasocial_title   = ''.$page.' - ';
      $metasocial_name    = $website_name;
      $metasocial_url     = $pacth_url;
      $metasocial_desc    = $meta_description;
      $metasocial_key     = $meta_keyword;
      $metasocial_img     = ''.$website_url.'/sw-content/meta-img.jpg';

}}
else {// menampilkan home
      $metasocial_title   = '';
      $metasocial_name    = $website_name;
      $metasocial_url     = $website_url;
      $metasocial_desc    = $meta_description;
      $metasocial_key     = $meta_keyword;
      $metasocial_img     = ''.$website_url.'/sw-content/meta-img.jpg';
}
}
// koneksi
}?>