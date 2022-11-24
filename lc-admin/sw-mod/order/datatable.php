<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
   header('location:../../');
}else{
    $gotoprocess = "sw-mod/order/proses.php";
    require_once'../../../sw-library/config.php';
    include_once '../../../sw-library/sw-function.php';

    $aColumns = ['order_id','order_name','order_phone','order_city','order_price,order_quantity','order_total','order_date','order_time','order_status'];
    $sIndexColumn = "order_id";
    $sTable = "order_item";
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

    $sOrder = "ORDER BY order_id DESC";
    if (isset($_GET['iSortCol_0']))
    {
        $sOrder = "ORDER BY order_id DESC";
        for ($i=0; $i<intval($_GET['iSortingCols']) ; $i++)
        {
            if ($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true")
            {
                $sOrder .= $aColumns[ intval($_GET['iSortCol_'.$i])]."
                    ".mysqli_real_escape_string($gaSql['link'], $_GET['sSortDir_'.$i]) .", ";
            }
        }

        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY order_id DESC")
        {
            $sOrder = "ORDER BY order_id DESC";
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


 
        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
        $str = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            //$strlink = preg_replace("/\/sw-admin\/sw-mod\/post\/(datatable\.php$)/","",$str);

         $btn_del ='<a href="javascript:void(0)" class="btn btn-xs btn-danger" data-href="'.$gotoprocess.'?id='.epm_encode($aRow['order_id']).'&aksi=delete" data-toggle="modal" data-target="#hapus" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';

           $checkdata = "<div class='text-center'><input type='checkbox' id='titleCheckdel' /><input type='hidden' class='deldata' name='item[]' value='$aRow[order_id]' disabled></div>";

            if($aRow['order_status']== 1){
                $status = "<label class='label label-danger'>Proses</label>";
            }

            else if($aRow['order_status']== 2){
                $status = "<label class='label label-warning'>Dibayar DP/Lunas</label>";
            }

            else if($aRow['order_status']== 3){
                $status = "<label class='label label-info'>Selesai</label>";
            }

        $row[] = $checkdata;
        $row[] = "<div class='description'>
         <a style='vertical-align:left!important;' class='text-info' href='?mod=order&op=invoice&id=".epm_encode($order_id)."'><b>".ucfirst($order_name)."</b></a><br/>
            <small class='themed-color-night'>ID Order :#$order_id<br/>
            $status</small>
         </div>";

        $row[] = ucfirst($order_city);
        $row[] ="".$order_date."<br/><i class='fa fa-clock-o'></i> ".$order_time."";
        $row[] ="Rp".format_angka($order_price)."";
        $row[] = $order_quantity;
        $row[] ="<div class='text-right'><b>Rp".format_angka($order_total)."</b></div>";
        $row[] = "<div class='text-center'>
                    <div class='btn-group btn-group-xs pull-right'>
                    $btn_del
                </div></div>";
        }
        $output['aaData'][] = $row;
    $no++;
    }
    echo json_encode($output);
}



