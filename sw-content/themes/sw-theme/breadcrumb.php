<?php if(!empty($connection)){ 
if ( $mod == "" ){
  header('location:404');
} else { 
echo'
<section class="title_page">
  <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
          <div class="content-breadcrumbs">';
if (!empty($_GET['read_pages'])){
  if($read_pages == $read_pages){// page
echo'<h2>'.$title.'</h2>
       <nav id="breadcrumbs">
            <ul>
      <li itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem">
      <a itemscope itemtype="http://schema.org/Thing"
             itemprop="item" href="'.$website_url.'/">Beranda</a>
             <meta itemprop="position" content="1" /></li>

      <li itemprop="itemListElement" itemscope
            itemtype="http://schema.org/ListItem">
      <a itemscope itemtype="http://schema.org/Thing"
             itemprop="item" href="#">Pages</a>
        <meta itemprop="position" content="2" /></li>
        </nav>';

}}

elseif (!empty($_GET['read_product'])){
  if($read_product == $read_product){
echo'<h2>Detail</h2>
<nav id="breadcrumbs">
  <ul>
<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="'.$website_url.'/">Beranda</a>
       <meta itemprop="position" content="1" /></li>


  <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="'.$website_url.'/product">Semua Produk</a>
       <meta itemprop="position" content="2" /></li>
  </ul>';

}}


elseif (!empty($_GET['read_blog'])){
  if($read_blog == $read_blog){//blog
echo'
  <h2>Blog Detail</h2>
<nav id="breadcrumbs">
  <ul>
<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="'.$website_url.'/">Beranda</a>
       <meta itemprop="position" content="1" /></li>

  <li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="'.$website_url.'/blog">Blog</a>
       <meta itemprop="position" content="2" /></li>

<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="'.$url.'">'.$page.'</a>
<meta itemprop="position" content="3" /></li>
  </ul>
';

}}

else if(!empty($page)){// menampilkan page depan
if($page == $page){
echo'
<h2>'.$title.'</h2>
<nav id="breadcrumbs">
      <ul>
<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="'.$website_url.'/">Beranda</a>
       <meta itemprop="position" content="1" /></li>

<li itemprop="itemListElement" itemscope
      itemtype="http://schema.org/ListItem">
<a itemscope itemtype="http://schema.org/Thing"
       itemprop="item" href="#">'.$title.'</a>
  <meta itemprop="position" content="2" /></li>
    </ul>
  </nav>';}}

else {
// kosong
}
}
echo'</div>
        </div>
      </div>
  </div>
</section>
    ';
}?>