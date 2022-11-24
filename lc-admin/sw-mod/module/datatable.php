<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location:./');
}else{
    include_once '../../../sw-library/sw-process.php';
    include_once '../../../sw-library/sw-function.php';

    $aColumns     = ['module_id','icon','displayname','link','active'];
    $sIndexColumn = "module_id";
    $sTable       = "module";

    $gaSql['user']     = DB_USER;
    $gaSql['password'] = DB_PASSWD;
    $gaSql['db']       = DB_NAME;
    $gaSql['server']   = DB_HOST;

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
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

    $no = 1;
    while ($aRow = mysqli_fetch_array($rResult))
    {
        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
            $checkdata = "<div class='text-center'><input type='checkbox' id='titleCheckdel' /><input type='hidden' class='deldata' name='item[$no][deldata]' value='$aRow[$sIndexColumn]' disabled></div>";
            $btnEdit = "<a href='?mod=module&op=edit&id=$aRow[$sIndexColumn]' class='btn btn-xs btn-default'><i class='fa fa-pencil'></i></a>";
            $btnDelete = "<a class='btn btn-xs btn-danger alertdel' id='$aRow[$sIndexColumn]'><i class='fa fa-times'></i></a>";
            $row[] = $checkdata;
            $row[] = '<i class="'.$aRow['icon'].'"></i>';
            $row[] = $aRow['displayname'];
            $row[] = $aRow['link'];
            $row[] = "<div class='text-center'>
            <div class='btn-group btn-group-xs'>
                $btnEdit
                $btnDelete
            </div></div>";
        }
        $output['aaData'][] = $row;
    $no++;
    }
    echo json_encode($output);
}
