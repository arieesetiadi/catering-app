<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
   header('location:../../');
}else{
    require_once'../../../sw-library/config.php';
    include_once '../../../sw-library/sw-function.php';
    $gotoprocess = "sw-mod/product/proses.php";
    $aColumns = ['product_id','store_id','author','product_code','product_img',' product_name','seoname','category','product_price','product_discount','time','date','active'];
    $sIndexColumn = "product_id";
    $sTable = "product";
    $gaSql['user'] = DB_USER;
    $gaSql['password'] = DB_PASSWD;
    $gaSql['db'] = DB_NAME;
    $gaSql['server'] = DB_HOST;

    $gaSql['link'] =  new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db']);

    $sLimit = "";
    if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1')
    {
        $sLimit = "LIMIT ".mysqli_real_escape_string($gaSql['link'], $_GET['iDisplayStart']).", ".
            mysqli_real_escape_string($gaSql['link'], $_GET['iDisplayLength']);
    }

    $sOrder = "ORDER BY product_id DESC";
    if (isset($_GET['iSortCol_0']))
    {
        $sOrder = "ORDER BY product_id DESC";
        for ($i=0; $i<intval($_GET['iSortingCols']) ; $i++)
        {
            if ($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true")
            {
                $sOrder .= $aColumns[ intval($_GET['iSortCol_'.$i])]."
                    ".mysqli_real_escape_string($gaSql['link'], $_GET['sSortDir_'.$i]) .", ";
            }
        }

        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY product_id DESC")
        {
            $sOrder = "ORDER BY product_id DESC";
        }
    }

    $sWhere = "";
    if (isset($_GET['sSearch']) && $_GET['sSearch'] != "")
    {
        $sWhere = "WHERE (";
        for ($i=0; $i<count($aColumns); $i++)
        {
            $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'], $_GET['sSearch'])."%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }

    for ($i=0 ; $i<count($aColumns); $i++)
    {
        if (isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '')
        {
            if ($sWhere == "")
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $aColumns[$i]." LIKE '%".mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_'.$i])."%' ";
        }
    }

    $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM $sTable
        $sWhere
        $sOrder
        $sLimit ";
    $rResult = mysqli_query($gaSql['link'], $sQuery);

    $sQuery = "SELECT FOUND_ROWS()";
    $rResultFilterTotal = mysqli_query($gaSql['link'], $sQuery);
    $aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];

    $sQuery = "
        SELECT COUNT(".$sIndexColumn.")
        FROM   $sTable
    ";
    $rResultTotal = mysqli_query($gaSql['link'], $sQuery);
    $aResultTotal = mysqli_fetch_array($rResultTotal);
    $iTotal = $aResultTotal[0];

    $output = array( 
       // "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

    $no = 1;
    while ($aRow = mysqli_fetch_array($rResult))
    {extract($aRow);

$query="SELECT user_id,fullname FROM user where user_id='$aRow[author]' LIMIT 1"; 
 $result = $connection->query($query) or die($connection->error.__LINE__);
 $rows_user= $result->fetch_assoc();
 $user_id =$rows_user['user_id'];

$query_store="SELECT store_id,store_name FROM store where store_id='$aRow[store_id]' LIMIT 1"; 
$result_store = $connection->query($query_store) or die($connection->error.__LINE__);
$row_store= $result_store->fetch_assoc();

//////////////////////////////////////
/// ulasan -----------------------------------
      $q_ulasan="SELECT review_id FROM review where product_id='$aRow[product_id]'"; 
      $result_ulasan= $connection->query($q_ulasan);
      $review =$result_ulasan->num_rows;

        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
        $str = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            $strlink = preg_replace("/\/sw-admin26\/sw-mod\/post\/(datatable\.php$)/","",$str);

            $checkdata = "<div class='text-center'><input type='checkbox' id='titleCheckdel' /><input type='hidden' class='deldata' name='item[]' value='$aRow[product_id]' disabled></div>";

    $btn_edit = "<a href='?mod=product&op=edit&product=".epm_encode($aRow['product_id'])."' class='btn btn-xs btn-default enable-tooltip' title='Edit'><i class='fa fa-pencil'></i></a>";
    
    $btn_del ='<a href="javascript:void(0)" class="btn btn-xs btn-danger enable-tooltip" data-href="'.$gotoprocess.'?id='.epm_encode($aRow['product_id']).'&aksi=delete" data-toggle="modal" data-target="#hapus" title="Hapus"><i class="fa fa-trash-o"></i></a>';
           
if($aRow['active']== 1){
             $status = "<buton class='btn btn-xs btn-default'>Publish</buton>";
            }else{
            $status = "<buton class='btn btn-xs btn-default'>Draft</buton>";
        }

$category = str_replace('-',' ',$aRow['category']);
$category=ucfirst($category);

if($aRow['product_discount'] == 0){
      $product_discount='';
} else{
    $product_discount='<span class="label label-info"><b>'.$product_discount= strtoupper($aRow['product_discount']).' %</b></span>';
}

if($aRow['product_discount'] == 0){
 $total='';
}
else{
$harga_diskon = $aRow['product_price'] * $aRow['product_discount'] /100;
$total_discount =   $aRow['product_price'] - $harga_diskon; 
  $total='<span class="text-defaults"><b>Rp'.format_angka($total_discount).'</span>';
}

if($aRow['product_img'] == NULL){
      $images='<img  src="./sw-assets/img/noimages.jpg" class="thumbnail" width="55" height="55" oncontextmenu="return false;">';
} else{
    $images='<img src="../timthumb?src='.$aRow['product_img'].'&h=55&w=55" class="thumbnail" oncontextmenu="return false;">';
    
}
        $row[] = $checkdata;
        $row[]="<div class='text-center'><br/>$images</div>";
        $row[] = "<a style='vertical-align:left!important;' class='text-center themed-color-spring' href='../product/$product_id-$seoname.html' target='_blank'><b>".substr($product_name, 0, 80)."</b></a><br/>
         <small class='themed-color-night'>Kode : #$product_code</small><br>

         <div class='btn-group btn-group-xs'>
        <a href='?mod=profile&id=".epm_encode($user_id)."' target='_blank' class='btn btn-xs btn-warning'>
                    <i class='fa fa-user'></i> $rows_user[fullname]
                    </a>
                    <a href='?mod=store&op=view&store_id=".epm_encode($row_store['store_id'])."' class='btn btn-xs btn-primary' target='_blank'>
                        <i class='fa fa-cutlery'></i> $row_store[store_name]
                    </a>
                    <buton class='btn btn-xs btn-default'>
                    <i class='fa fa-tag'></i> $category
                    </buton>
                    $status
                    
                <a href='?mod=review&op=detail&product=$aRow[product_id]' class='btn btn-xs btn-default' title='Ulasan'><b>$review Ulasan</b></a>

               <a href='http://www.facebook.com/sharer/sharer.php?u=../product/$aRow[product_id]-$seoname.html' target='_blank' class='btn btn-xs btn-primary' title='Facebook'><i class='fa fa-facebook'></i></a>
         <a href='http://twitter.com/share?url=../product/$aRow[product_id]-$seoname.html' target='_blank' class='btn btn-xs btn-success' title='Twitter'><i class='fa fa-twitter'></i></a>
         <a href='http://plus.google.com/share?url=../product/$aRow[product_id]-$seoname.html' target='_blank' class='btn btn-xs btn-danger' title='Google +'><i class='fa fa-google-plus'></i></a>
                    
                    </div>";

            $row[] ="<span class='text-danger'><b>Rp".format_angka($aRow['product_price'])."</b></span><br>
            $product_discount
            $total";

           $row[] = tgl_ind($aRow['date'])."<br><i class='fa fa-clock-o'></i> ". $aRow['time'];
            $row[] = "<div class='text-center'><div class='btn-group btn-group-xs'>
                    $btn_edit
                    $btn_del
            </div></div>";
        }
        $output['aaData'][] = $row;
    $no++;
    }
    echo json_encode($output);
}



