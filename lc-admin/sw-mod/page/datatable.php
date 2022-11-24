<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
   header('location:../../login');
}else{
    require_once'../../../sw-library/config.php';
    include_once '../../../sw-library/sw-function.php';
    $gotoprocess = "sw-mod/page/proses.php";
    $aColumns = ['page_id','title','seotitle','active'];
    $sIndexColumn = "page_id";
    $sTable = "page";
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

    $sOrder = "";
    if (isset($_GET['iSortCol_0']))
    {
        $sOrder = "ORDER BY  ";
        for ($i=0; $i<intval($_GET['iSortingCols']) ; $i++)
        {
            if ($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true")
            {
                $sOrder .= $aColumns[ intval($_GET['iSortCol_'.$i])]."
                    ".mysqli_real_escape_string($gaSql['link'], $_GET['sSortDir_'.$i]) .", ";
            }
        }

        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY")
        {
            $sOrder = "";
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
        $sLimit
    ";
    $rResult = mysqli_query($gaSql['link'], $sQuery);

    $sQuery = "
        SELECT FOUND_ROWS()
    ";
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
    {
        if($aRow['active']=='Y'){
            $active="<a id='seth$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' class='btn btn-xs btn-success setactive' data-active='$aRow[active]'><i class='fa fa-eye'></i> Active</a>";
        }else{
            $active="<a id='seth$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' class='btn btn-xs btn-danger setactive' data-active='$aRow[active]'><i class='fa fa-eye-slash'></i> Deactive</a>";
        }
        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
            $checkdata = "<div class='text-center'>
            <input type='checkbox' class='deldata' name='item[]' value='$aRow[page_id]'></div>";
            $row[] = $checkdata;
            $row[] ='<a href="'.$site_url.'/pages/'.$aRow['seotitle'].'.html" target="_blank">'.$aRow['title'].'</a>';
            $row[] = '<div class="text-center">'.$active.'</div>';
            $row[] = "<div class='text-center'>
            <div class='btn-group btn-group-xs'>
                <a href='?mod=page&op=edit&page=$aRow[page_id]' class='btn btn-xs btn-default enable-tooltip' title='Edit'><i class='fa fa-pencil'></i></a>
                <a href='javascript:void(0)' data-href='".$gotoprocess."?id=$aRow[page_id]&aksi=delete' data-toggle='modal' data-target='#hapus' class='btn btn-xs btn-danger enable-tooltip' title='Hapus'><i class='fa fa-trash-o'></i></a>
            </div></div>";
        }
        $output['aaData'][] = $row;
    $no++;
    }
    echo json_encode($output);
}


