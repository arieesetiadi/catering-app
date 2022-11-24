<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/$mod/proses.php";
$message='';
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}

$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='7' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);

if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);


// --------- status order Selesai --------------------
$q="SELECT order_id FROM order_item where order_status='1'";
$result1 = $connection->query($q);
$proses = $result1->num_rows;

$q2="SELECT order_id FROM order_item where order_status='2'";
$result2 = $connection->query($q2);
$bayar = $result2->num_rows;

$q3="SELECT order_id FROM order_item where order_status='3'";
$result3 = $connection->query($q3);
$complete = $result3->num_rows;

switch(@$_GET['op']){ 
    default:?>
<?php  echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="fa fa-list-alt"></i>'._e('Order Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Order Management').'</li>
</ul>';

echo'
<div class="block full">
<div class="block-title">
  <h2>'._e('Order Management').'</h2>
<div class="block-options pull-right">
<div class="btn-group btn-group-sm">
<button class="btn btn-sm btn-danger">Proses '.$proses.'</button>
<button class="btn btn-sm btn-warning">Dibayar '.$bayar.'</button>
  <button class="btn btn-sm btn-success">Selesai '.$complete.'</button>
</div>
</div></div>';
if($read_access == 'Y'){
echo'
<div class="table-responsive">
<form id="form-multi" method="post" action="'.$gotoprocess.'">
    <input type="hidden" name="modul" value="'.$mod.'" readonly>
    <input type="hidden" name="aksi" value="multistatus" readonly>
<table id="sigerTable" class="table table-vcenter table-condensed">
    <thead>
        <tr>
            <th class="text-center" width="8">
            <i class="fa fa-check-circle-o"></i></th>
            <th>ID Order</th>
            <th>'._e('City').'</th>
            <th>'._e('Date').'</th>
            <th>'._e('Price').'</th>
            <th>'._e('Quantity').'</th>
            <th class="text-right">'._e('Total').'</th>
            <th class="text-right">Aksi</th>
        </tr>
    </thead>
    <tfoot>
<tr>

    <td style="width:20px;" class="text-center"><input type="checkbox" id="titleCheck" data-toggle="tooltip" title="" /></td>
    <td colspan="7">';

if($modify_access == 'Y'){
    echo'<select name="status" id="input" class="form-control" style="float:left;width:200px;margin-right:10px;" required="required">
      <option value="">Pilih Status</option>
      <option value="1">Proses</option>
      <option value="2">Dibayar DP/Lunas</option>
      <option value="3">Selesai</option>
    </select>
    <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#modal-status"><i class="fa fa-save"></i> '._e('Update').'</button>';}
    else {
 echo'<button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#akses"><i class="fa fa-save"></i> '._e('Update').'</button>';
    }
    echo'</td>
</tr>
</tfoot>
</table>
</div>

<!-- multi status -->
<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Ubah Status Pemesanan').'</h4></div>
<div class="modal-body">
<p>'._e('Anda yakin ingin mengubah status item ini..?').'</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-save"></i> '._e('Save').'</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>

<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> </i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> '._e('Delete').'</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>';
echo'</div>';
 } else {
    echo'
    <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}?>


<?PHP break; case "invoice": ?>
<?php echo'
<div class="content-header">
<div class="header-section"><h1>
<i class="gi gi-notes_2"></i>'._e('Order Management').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
  <li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
  <li><a href="./?mod='.$mod.'">'._e('Order Management').'</a></li>
  <li>Detail Tagihan</li>
</ul>';

if($read_access == 'Y'){
  if(!empty($_GET['id'])){
  $id=mysqli_real_escape_string($connection,epm_decode($_GET['id']));

   $qInvoice="SELECT order_item.order_id,order_item.order_name,order_item.order_city,order_item.order_address,order_item.order_phone,order_item.order_date,order_item.order_time,order_item.order_messages,order_item.order_status,product.product_id,product.store_id,store.store_name,store.store_city,store.store_phone,store.store_address FROM order_item,product,store where order_item.product_id=product.product_id and order_item.order_id='$id'";

      $resultInvoice= $connection->query($qInvoice) or die($connection->error.__LINE__);
      if($resultInvoice->num_rows > 0){
       $rowInvoice=$resultInvoice->fetch_assoc();

      $query_store ="SELECT store_name,store_phone,store_city,store_address FROM store where store_id='$rowInvoice[store_id]'"; 
      $result_store = $connection->query($query_store);
      $rowstore = $result_store->fetch_assoc();


 echo'<div class="block full">
                        <!-- Invoice Title -->
                        <div class="block-title">
                            <h2><strong>Tagihan</strong> #'.$id.'</h2>
                        </div>
                        <!-- END Invoice Title -->
                  
                        <div class="row block-section">
                            <!-- Company Info -->
                            <div class="col-sm-6">
                                <h3>Penerima</h3>
                                <address>
                                Nama : <a href="#" class="label label-warning" target="_blank">
                                '.strtoupper($rowInvoice['order_name']).'</a>
                                <br>
                                Alamat : '.$rowInvoice['order_address'].'<br>
                                Kecamatan : '.$rowInvoice['order_city'].'<br>
                                No. Telp : '.$rowInvoice['order_phone'].'<br>
                                </address>

                            </div>
                            <!-- END Company Info -->

                            <!-- Client Info -->
                            <div class="col-sm-6 text-right">
                                <h2>Penjual</h2>
                                <address>
                                    Nama : <a href="#" class="label label-warning" target="_blank">
                                      '.strtoupper($rowstore['store_name']).'</a>
                                <br>
                                  Alamat : '.$rowstore['store_address'].'<br>
                                  Kecamatan : '.$rowstore['store_city'].'<br>
                                  No. Telp : '.$rowInvoice['store_phone'].'<br>
                                </address>                            
                            </div>
                        </div>
                        <!-- END 2 Column grid -->

                        <div class="well">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <h3>Kode Tagihan  
                      <b>#'.$rowInvoice['order_id'].'</b></h3>
                      <p><b>Tanggal Pemesanan :
                        <label class="label label-info">'.$rowInvoice['order_date'].' Jam '.$rowInvoice['order_time'].'</label></b><br/>
                      <b>Catatan Pembeli</b>
                      <br/>'.strip_tags($rowInvoice['order_messages']).'</p>
                        </div>

                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-right">
                        <h3>Catatan Penjual</h3>
                        <p>Lakukan pengiriman sebelum waktu yang ditentukan.<p>
                      </div>
                    </div>
                    </div>
              <hr>';
    $no=0; 
    $qInvoiceItem="SELECT order_item.order_price,order_item.order_quantity,order_item.order_total,order_item.order_status,product.product_id,product.product_name,product.seoname FROM product,order_item where order_item.product_id=product.product_id and order_item.order_id='$rowInvoice[order_id]'"; 
      $resultInvoiceItem=$connection->query($qInvoiceItem)or die($connection->error.__LINE__);
        if($resultInvoiceItem->num_rows > 0){?>

          <!-- Table -->
            <div class="table-responsive">
            <table class="table table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width: 60%;">Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>

      <?PHP while($rItem= $resultInvoiceItem->fetch_assoc()){
          $no++;
            
            // menghitung total dan Grantoal------------
            $grandtotal = $rItem['order_total'];

            if($rItem['order_status']== 1){
                $status = "<label class='label label-warning'>Proses</label>";
            }

            else if($rItem['order_status']== 2){
                $status = "<label class='label label-info'>Dibayar DP/Lunas</label>";
            }

            else if($rItem['order_status']== 3){
                $status = "<label class='label label-info'>Selesai</label>";
            }
        

            if($order_status !== ''){
              $status_discount ='<label class="label label-default">Discount</label>';
            }
            else{
              $status_discount ='';
            }
              echo'<tr>
                      <td class="text-center">'.$no.'</td>
                      <td>
                         <h4><a class="themed-color-night" href="../product/'.$rItem['product_id'].'-'.$rItem['seoname'].'.html" target="_blank">
                        '.$rItem['product_name'].' <small>'.$status_discount.'</small></a></h4>
                      </td>
                      <td class="text-center"><strong>Rp'.format_angka($rItem['order_price']).'
                       </strong></td>
                      <td class="text-center"><strong>x <span class="badge">
                      '.$rItem['order_quantity'].'</span><strong></td>
                      <td class="text-right"><span class="label label-primary">Rp'.format_angka($rItem['order_total']).'</span></td>
                  </tr>';}
                echo'
                  <tr class="active">
                      <td colspan="4" class="text-right"><span class="h4">HARGA TOTAL BARANG</span></td>
                      <td class="text-right"><span class="h4">Rp. '.format_angka($grandtotal).'</span></td>
                  </tr>

              </tbody>
              </table>
              ';}
              echo'
                        </div>
                        <!-- END Table -->

                     
                        <!-- END Invoice Content -->
                    </div>';

                  echo'
    <div class="block">
        <!-- Blockquote Left Title -->
        <div class="block-title">
            <h4><strong>Status :</strong></h4>
            <h3>'.$status.'</h3>
        </div>

  <div class="row">
    <div class="col-md-6">
      <form name="form" action="'.$gotoprocess.'" method="post" autocomplete="of">
          <input type="hidden" name="modul" value="'.$mod.'">
         <input type="hidden" name="aksi" value="invoice-status">
          <input type="hidden" name="order_id" value="'.$rowInvoice['order_id'].'">
        <div class="form-group">
        <label class="col-md-2 control-label">Status</label>
          <div class="col-md-8">
            <select name="order_status" class="form-control"  class="form-horizontal form-bordered"  required="required" onchange="this.form.submit()">
                <option value="">Pilih Status</option>';
              // ------ Status Admin
              if($rowInvoice['order_status'] =='1'){
              echo'<option value="2" selected>Proses</option>';}
              else{echo'<option value="2">Proses</option>';}

            if($rowInvoice['order_status'] =='2'){
              echo'<option value="2" selected>Dibayar DP/Lunas</option>';}
              else{echo'<option value="2">Dibayar DP/Lunas</option>';}
          
            if($rowInvoice['order_status'] =='3'){
              echo'<option value="3" selected>Selesai</option>';}
              else{echo'<option value="3">Selesai</option>';}
            echo'
            </select>
            </div>
            </div>
        </form>
      </div>
    </div>
    <br>
  </div>';
}}
} 

else {
    echo'
    <div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}?>




<!-- END BREAK -->
<?php 
  break; }
}
else {
    echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}
echo'<!-- Modal akses -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>Anda tidak memiliki hak akses.!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>';}?>
