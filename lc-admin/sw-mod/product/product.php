<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/$mod/proses.php";
 $product_code='';
 $product_name='';
 $seoname ='';
 $category='';
 $product_price='';
 $product_discount='';
 $product_img='';
 $description='';
 $active='';
 $message='';
 if(!empty($_SESSION['product_code'])){$product_code=$_SESSION['product_code'];}
if(!empty($_SESSION['product_name'])){$product_name=$_SESSION['product_name'];}
if(!empty($_SESSION['seoname'])){$seoname=$_SESSION['seoname'];}
if(!empty($_SESSION['category'])){$category=$_SESSION['category'];}
if(!empty($_SESSION['product_price'])){$product_price=$_SESSION['product_price'];}
if(!empty($_SESSION['product_discount'])){$product_discount=$_SESSION['product_discount'];}
if(!empty($_SESSION['description'])){$description=$_SESSION['description'];}
//Images
if(!empty($_SESSION['product_img'])){$product_img=$_SESSION['product_img'];}
if(!empty($_SESSION['active'])){$active=$_SESSION['active'];}
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}
$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='7' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);
if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);
//============ session KCFINDER ======================
$_SESSION['KCFINDER']['uploadURL'] = "../../../sw-content/product/";
?>


<?php switch(@$_GET['op']){ 
    default:?>
<?php  echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-table"></i>'._e('Product Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Product Management').'</li>
</ul>

<div class="block full">
<div class="block-title">
<h2>'._e('Product Management').'</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
<a href="?mod='.$mod.'&op=add" class="btn btn-sm btn-default enable-tooltip" product_name="'._e('Add').'"><i class="fa fa-plus"></i></a>
</div>
</div></div>';

if($read_access == 'Y'){
echo'
<div class="table-responsive">
<form id="form-multi" method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="'.$mod.'" readonly>
<input type="hidden" name="aksi" value="multidelete" readonly>
<table id="sigerTable" class="table table-vcenter table-condensed">
    <thead>
        <tr>
            <th class="text-center"><i class="fa fa-check-circle-o"></i></th>
            <th class="text-center" width="40"><i class="fa fa-picture-o"></i></th>
            <th>'._e('Title').'</th>
            <th>'._e('Price').'</th>
            <th>'._e('Date').'</th>
            <th class="text-center">'._e('Actions').'</th>
        </tr>
    </thead>
    <tfoot>
<tr>
    <td style="width:80px;" class="text-center">
        <input type="checkbox" id="titleCheck" data-toggle="tooltip" title="" />
        </td>
    <td colspan="5">';
  if($delete_access == 'Y'){
    echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#modal-deleted"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';}
    else {
 echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#akses"><i class="fa fa-trash-o"></i> '._e('Delete Selected Item').'</button>';
    }
    echo'</td>
    </tr>
</tfoot>
</table>

<!-- multi deleted -->
<div class="modal fade" id="modal-deleted" tabindex="-1" role="dialog" aria-lantailedby="myModallantai" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-product_name" id="myModallantai"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> '._e('Delete').'</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>
</div>

</form>
<!-- end:table -->';
} else {
    echo'
    <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}
echo'

<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-lantailedby="myModallantai" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-product_name" id="myModallantai"><i class="fa fa-exclamation-triangle text-danger"></i> </i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> '._e('Delete').'</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div></div>';?>

<?PHP break; case "add": ?>
<?php 
  $query="SELECT product_id from product order by product_id DESC";
  $result=$connection->query($query);
  $row=$result->fetch_assoc();
  $product_id=$row['product_id'] + 1;

  function acakangkahuruf($panjang){
    $karakter= '1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};}
  return $string;}
  $product_code  ='CL-'.$product_id.''.acakangkahuruf(5).'';

echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-notes_2"></i>'._e('Product Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="?mod='.$mod.'">'._e('Product Management').'</a></li>
        <li>'._e('Add New').'</li>
</ul>';?>

<?PHP if($write_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<i class="fa fa-close close" data-dismiss="alert"></i>'.$message.'</div>

<form name="discountCalculator" method="post" id="validate" action="'.$gotoprocess.'" autocomplete="of">
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="insert">
    <div class="row">
        <div class="col-md-8">
            <div class="block">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="form-group">
                <label>'._e('Product code').'</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i>
                </span>
                 <input type="text" name="product_code" style="background:#fff;" class="required form-control" id="enabled2" value="';if($product_code == ''){echo $product_code;}else{echo $product_code;}echo'" readonly>
                 <span class="input-group-btn">
                <button type="button" id="edit2" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                </span>
                </div>
                </div>
                </div>
                </div>

                <div class="form-group">
                    <label>'._e('Post Title').'</label>
                        <input type="text" id="title-1" name="product_name" class="required form-control" placeholder="Masukkan Judul" value="'.$product_name.'" required>
                        <input type="hidden" name="seoname" id="seotitle" value="'.$seoname.'" required>
                            <small class="text-primary">';
                        if($seoname ==''){
                        echo'<i>Permalink : '.$site_url.'/product/'.$product_id.'-<span id="permalink"></span>.html</i>';}
                            else{
                        echo'<i>Permalink : '.$site_url.'/product/'.$product_id.'-<span id="permalink">'.$product_name.'</span>.html</i>';
                        }
                    echo'</small>
                </div>
                <hr>
            
                <div class="form-group">
                <label>'._e('Category').'</label>
                <div class="input-group">
                    <div id="selectcatdata">
                    <select class="required select-chosen" name="category" style="width:100%!important;" data-placeholder="Pilih Kategori" required>';
                        $query="SELECT title,seotitle from category  where type='1' order by title asc"; 
                        $result = $connection->query($query) or die($connection->error.__LINE__);
                        while($row = $result->fetch_assoc()) { 
                            $categories = strip_tags($row['title']);
                            $seotitle = strip_tags($row['seotitle']);
                            if($seotitle == $category){
                              echo"<option value='$seotitle' selected>$categories</option>";}
                                else{
                              echo"<option value='$seotitle'>$categories</option>";
                        }}
                        echo'
                    </select>
                    </div>
                    <span class="input-group-btn">
                        <button type="button" id="tbladdcat" class="btn btn-primary">Tambah</button>
                    </span>
                </div>
                </div>
                <hr>
                
                <div class="clearfix">
                <div class="form-group">
                     <div class="upload-media" onclick="openKCFinder(this)" title="Unggah Gambar" style="background:';if($product_img== NULL){echo'#fff';}else {echo'url(../timthumb?src='.$product_img.'&h=70&w=70)';}echo'; no-repeat center center;">';
                        if($product_img== NULL){echo'<img src="./sw-assets/img/media.png">';}
                        else {echo'<img class="images" src="./sw-assets/img/media.png">';}
                        echo'
                    </div>
                    <input type="hidden" name="product_img" id="inputgambar" class="required" value="'.$product_img.'" readonly required>
                </div>
                </div>
                <hr>

                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">File Manager</h4>
                      </div>
                       <div id="kcfinder_1"></div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label-control"><i class="fa fa-paper-plane-o"></i>
                            <span class="text-success" id="stat">
                                Publish
                            </span></label> 
                            <a id="edit_publish" style="cursor:pointer" class="label label-info">EDIT</a>

                            <div class="row publish" style="display:none">
                            <div class="col-md-6">
                            <select class="form-control" id="select-stat" data-init-plugin="select2" name="active" style="width:100%">';
                            if($active=='1'){echo'<option value="1" selected>Publish</option>';}
                            else{echo'<option value="1">Publish</option>';}

                            if($active=='2'){echo'<option value="2" selected>Draft</option>';}
                            else{echo'<option value="2">Draft</option>';}
                            
                            echo'
                            </select>
                            </div>

                    <div class="col-md-6">
                        <a class="btn btn-sm btn-info" id="confirm_ok">Ok</a>
                        <a class="btn btn-sm btn-default close_publish_au">Cancel</a>
                    </div>
                </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="pull-right">
                            <div class="input-group">
                                <span class="btn-group">
                                    <a class="btn btn-default" id="tiny-visual"><i class="fa fa-file-text"></i> Visual</a>
                                    <a class="btn btn-default" id="tiny-text"><i class="fa fa-code"></i> Text</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <textarea class="required form-control" id="swEditorText" name="description" style="height:380px;" required>'.$description.'</textarea>
                <hr>
            </div>
        </div>

        <div class="col-md-4">
            <div class="block">
                    <div class="form-group">
                    <label>'._e('Store').'</label>
                    <select class="required select-chosen" name="store_id" style="width:100%!important;" data-placeholder="Pilih Store" required>';
                            $query="SELECT store_id,store_name from store order by store_name asc"; 
                            $result = $connection->query($query) or die($connection->error.__LINE__);
                            while($row = $result->fetch_assoc()) { 
                                $store_id = strip_tags($row['store_id']);
                                $store_name = strip_tags($row['store_name']);
                                     echo"<option value='$store_id'>$store_name</option>";
                                }

                            echo'
                        </select>
                </div>
                <hr>
                <div class="form-group">
                    <label>'._e('Price').'</label>
                        <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                            <input type="text" name="product_price" class="required digits form-control" value="'.$product_price.'" min="100" placeholder="000">
                        </div>
                        <span class="status"></span>
                        <small class="themed-color-night">Berikan harga produk dengan nominal saja contoh : 10000</small>      
                </div>
                
                <hr>
                <div class="form-group">
                    <label>'._e('Discount').'<small class="text-primary">
                        <i>kosongkan jika tidak ada <b>discount</b></i></small></label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" id="edit" class="btn btn-primary">Tambah</button>
                        </span>
                        <input type="text" name="discount" id="enabled" class="form-control"  placeholder="0" onkeyup="calculate()" value="';if($product_discount == ''){echo'0';}else{echo $product_discount;}echo'" readonly>
                        <span class="input-group-addon">%</span>
                    </div>
                        <small class="text-info">Harga Setelah Diskon : Rp 
                        <input type="text" id="tanpa-rupiah" name="afterDiscount" style="background:transparent!important;border:none!important;font-weight:600" disabled></small>
                </div>
                <hr>
                <h4 class="sub-header">Waktu & Tanggal Publikasi</h4>

                <div class="form-group">
                <label>'._e('Time').'</label>
                    <div class="input-group bootstrap-timepicker">
                        <span class="input-group-btn">
                            <a href="javascript:void(0)" class="btn btn-primary"><i class="fa fa-clock-o"></i></a>
                        </span>
                        <input type="text" id="example-timepicker24" name="time" class="form-control input-timepicker24" value="'.$time.'">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                <label>'._e('Date').'</label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" id="example-datepicker" name="date" class="form-control input-datepicker" value="'.$date.'" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                    </div>
                </div>
                <hr>
            </div>
            </div>
       
    </div>

<div class="form-group form-actions">
    <div class="row">
        <div class="col-md-8">
            <button type="submit" class="btn btn-block btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-block btn-warning" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
        </div>
    </div>
</div>
 </form>
<br>
';}
else{
  echo'  <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}?>

<?php echo'
<div id="modaladdext" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="form-validation" class="addnewext" method="post" action="javascript:void();" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modul" name="modul" value="'.$mod.'">
                        <input type="hidden" id="aksi" name="aksi" value="">
                        <div class="form-group">
                            <label id="labelmodal"></label>
                            <div id="titlebox">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title Here" required></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnsubmitext" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> '._e('Save').'</button>
                    </div>
                </form>
            </div>
        </div>
    </div>';?>

<?php break; case "edit":?>
<?php echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-notes_2"></i>'._e('Product Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="?mod='.$mod.'">'._e('Product Management').'</a></li>
        <li>Edit</li>
</ul>';

if($modify_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'">
<i class="fa fa-close close" data-dismiss="alert"></i>'.$message.'</div>';
if(!empty($_GET['product'])){
$product=  mysqli_real_escape_string($connection,epm_decode($_GET['product'])); 
$update = "SELECT * FROM product WHERE product_id='$product'";
$result_update = $connection->query($update) or die($connection->error.__LINE__);
if($result_update->num_rows > 0){
 while($rows= $result_update->fetch_assoc()){
extract($rows);
$description = htmlentities($rows['description']);
echo'


<form name="discountCalculator" method="post" id="validate" action="'.$gotoprocess.'?id='.$product_id.'" autocomplete="of">
<input type="hidden" name="modul" value="'.$mod.'" readonly>
<input type="hidden" name="aksi" value="update" readonly>
<input type="hidden" name="product_id" value="'.$product_id.'" readonly>

<div class="row">
        <div class="col-md-8">
            <div class="block">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                <div class="form-group">
                <label>'._e('Product code').'</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i>
                </span>
                 <input type="text" name="product_code" style="background:#fff;" class="required form-control" id="enabled2" value="';if($product_code == ''){echo $product_code;}else{echo $product_code;}echo'" readonly>
                 <span class="input-group-btn">
                <button type="button" id="edit2" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                </span>
                </div>
                </div>
                </div>
                </div>

                <div class="form-group">
                    <label>'._e('Post Title').'</label>
                        <input type="text" id="title-1" name="product_name" class="required form-control" placeholder="Masukkan Judul" value="'.$product_name.'" required>
                        <input type="hidden" name="seoname" id="seotitle" value="'.$seoname.'" required>
                            <small class="text-primary">';
                        if($seoname ==''){
                        echo'<i>Permalink : '.$site_url.'/product/'.$product_id.'-<span id="permalink"></span>.html</i>';}
                            else{
                        echo'<i>Permalink : '.$site_url.'/product/'.$product_id.'-<span id="permalink">'.$seoname.'</span>.html</i>';
                        }
                    echo'</small>
                </div>
                <hr>
            
                <div class="form-group">
                <label>'._e('Category').'</label>
                <div class="input-group">
                    <div id="selectcatdata">
                    <select class="required select-chosen" name="category" style="width:100%!important;" data-placeholder="Pilih Kategori" required>';
                        $query="SELECT title,seotitle from category  where type='1' order by title asc"; 
                        $result = $connection->query($query) or die($connection->error.__LINE__);
                        while($row = $result->fetch_assoc()) { 
                            $categories = strip_tags($row['title']);
                            $seotitle = strip_tags($row['seotitle']);
                            if($seotitle == $category){
                              echo"<option value='$seotitle' selected>$categories</option>";}
                                else{
                              echo"<option value='$seotitle'>$categories</option>";
                        }}
                        echo'
                    </select>
                    </div>
                    <span class="input-group-btn">
                        <button type="button" id="tbladdcat" class="btn btn-primary">Tambah</button>
                    </span>
                </div>
                </div>
                <hr>
                
                <div class="clearfix">
                <div class="form-group">
                     <div class="upload-media" onclick="openKCFinder(this)" title="Unggah Gambar" style="background:';if($product_img== NULL){echo'#fff';}else {echo'url(../timthumb?src='.$product_img.'&h=70&w=70)';}echo'; no-repeat center center;">';
                        if($product_img== NULL){echo'<img src="./sw-assets/img/media.png">';}
                        else {echo'<img class="images" src="./sw-assets/img/media.png">';}
                        echo'
                    </div>
                    <input type="hidden" name="product_img" id="inputgambar" class="required" value="'.$product_img.'" readonly required>
                </div>
                </div>
                <hr>

                <div class="modal fade" id="modal-id">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">File Manager</h4>
                      </div>
                       <div id="kcfinder_1"></div>
                    </div>
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="label-control"><i class="fa fa-paper-plane-o"></i>
                            <span class="text-success" id="stat">
                                Publish
                            </span></label> 
                            <a id="edit_publish" style="cursor:pointer" class="label label-info">EDIT</a>

                            <div class="row publish" style="display:none">
                            <div class="col-md-6">
                            <select class="form-control" id="select-stat" data-init-plugin="select2" name="active" style="width:100%">';
                            if($active=='1'){echo'<option value="1" selected>Publish</option>';}
                            else{echo'<option value="1">Publish</option>';}

                            if($active=='2'){echo'<option value="2" selected>Draft</option>';}
                            else{echo'<option value="2">Draft</option>';}
                        
                            echo'
                            </select>
                            </div>

                    <div class="col-md-6">
                        <a class="btn btn-sm btn-info" id="confirm_ok">Ok</a>
                        <a class="btn btn-sm btn-default close_publish_au">Cancel</a>
                    </div>
                </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="pull-right">
                            <div class="input-group">
                                <span class="btn-group">
                                    <a class="btn btn-default" id="tiny-visual"><i class="fa fa-file-text"></i> Visual</a>
                                    <a class="btn btn-default" id="tiny-text"><i class="fa fa-code"></i> Text</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <textarea class="required form-control" id="swEditorText" name="description" style="height:380px;" required>'.$description.'</textarea>
                <hr>
            </div>
        </div>

        <div class="col-md-4">
            <div class="block">
                <div class="form-group">
                    <label>'._e('Store').'</label>
                    <select class="required select-chosen" name="store_id" style="width:100%!important;" data-placeholder="Pilih Store" required>';
                            $query="SELECT store_id,store_name from store order by store_name asc"; 
                            $result = $connection->query($query) or die($connection->error.__LINE__);
                            while($row = $result->fetch_assoc()) { 
                                $store_id = strip_tags($row['store_id']);
                                $store_name = strip_tags($row['store_name']);
                            if($store_id == $rows['store_id']){
                              echo"<option value='$store_id' selected>$store_name</option>";}
                                else{
                              echo"<option value='$store_id'>$store_name</option>";
                        }}

                            echo'
                        </select>
                </div>
                <hr>
                <div class="form-group">
                    <label>'._e('Price').'</label>
                        <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                            <input type="text" name="product_price" class="required digits form-control" value="'.$product_price.'" min="100" placeholder="000">
                        </div>
                        <span class="status"></span>
                        <small class="themed-color-night">Berikan harga produk dengan nominal saja contoh : 10000</small>      
                </div>
                
                <hr>
                <div class="form-group">
                    <label>'._e('Discount').'<small class="text-primary">
                        <i>kosongkan jika tidak ada <b>discount</b></i></small></label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" id="edit" class="btn btn-primary">Tambah</button>
                        </span>
                        <input type="text" name="discount" id="enabled" class="form-control"  placeholder="0" onkeyup="calculate()" value="';if($product_discount == ''){echo'0';}else{echo $product_discount;}echo'" readonly>
                        <span class="input-group-addon">%</span>
                    </div>
                        <small class="text-info">Harga Setelah Diskon : Rp 
                        <input type="text" id="tanpa-rupiah" name="afterDiscount" style="background:transparent!important;border:none!important;font-weight:600" disabled></small>
                </div>
                <hr>
                <h4 class="sub-header">Waktu & Tanggal Publikasi</h4>

                <div class="form-group">
                <label>'._e('Time').'</label>
                    <div class="input-group bootstrap-timepicker">
                        <span class="input-group-btn">
                            <a href="javascript:void(0)" class="btn btn-primary"><i class="fa fa-clock-o"></i></a>
                        </span>
                        <input type="text" id="example-timepicker24" name="time" class="form-control input-timepicker24" value="'.$time.'">
                    </div>
                </div>
                <hr>

                <div class="form-group">
                <label>'._e('Date').'</label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" id="example-datepicker" name="date" class="form-control input-datepicker" value="'.$date.'" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                    </div>
                </div>
                <hr>
            </div>
            </div>
       
    </div>

<div class="form-group form-actions">
    <div class="row">
        <div class="col-md-8">
            <button type="submit" class="btn btn-block btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-block btn-warning" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
        </div>
    </div>
</div>
 </form>
 <br>
';

}} else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}}
}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}

break;
 }}else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}


 echo'
<!-- Modal akses -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-lantailedby="myModallantai" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-product_name" id="myModallantai"><i class="fa fa-exclamation-triangle text-danger"></i> Hapus Item</h4></div>
<div class="modal-body">
<p>Anda tidak memiliki hak akses.!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div></div></div></div>';} ?>