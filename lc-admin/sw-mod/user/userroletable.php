<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
   header('location:../../');
}else{
    require_once'../../../sw-library/config.php';
   require_once'../../login/login_session.php';
    include_once '../../../sw-library/sw-function.php';
    $gotoprocess = "sw-mod/user/proses.php";
    //column yang ingin dipanggil
  $aColumns = ['role_id','level_id','module_id','read_access','write_access','modify_access','delete_access'];
    //index table
    $sIndexColumn = "role_id";
    //nama table
    $sTable = "user_role";

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
        //"sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

    $no = 1;
    while ($aRow = mysqli_fetch_array($rResult))
    {

$q_module="SELECT displayname FROM module where module_id='$aRow[module_id]'";
$result = $connection->query($q_module);
$rows= $result->fetch_assoc();
//extract($rows);
$displayname = $rows['displayname'];

        // read access control
        if($aRow['read_access']=='Y'){
        $R = "<a class='btn btn-xs btn-success raccess' id='r$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[read_access]'><i class='fa fa-check'></i></a>";
        }else{
        $R = "<a class='btn btn-xs btn-danger raccess' id='r$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[read_access]'><i class='fa fa-times'></i></a>";
        }
        // write access control
        if($aRow['write_access']=='Y'){
        $W = "<a class='btn btn-xs btn-success waccess' id='w$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[write_access]'><i class='fa fa-check'></i></a>";
        }else{
        $W = "<a class='btn btn-xs btn-danger waccess' id='w$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[write_access]'><i class='fa fa-times'></i></a>";
        }
        // modify access control
        if($aRow['modify_access']=='Y'){
        $M = "<a class='btn btn-xs btn-success maccess' id='m$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[modify_access]'><i class='fa fa-check'></i></a>";
        }else{
        $M = "<a class='btn btn-xs btn-danger maccess' id='m$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[modify_access]'><i class='fa fa-times'></i></a>";
        }
        // delete access control
        if($aRow['delete_access']=='Y'){
        $D = "<a class='btn btn-xs btn-success daccess' id='d$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[delete_access]'><i class='fa fa-check'></i></a>";
        }else{
        $D = "<a class='btn btn-xs btn-danger daccess' id='d$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[delete_access]'><i class='fa fa-times'></i></a>";
        }
        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
    $checkdata = "<div class='text-center'><input type='checkbox'  class='deldata' name='item[]' value='$aRow[$sIndexColumn]'></div>";
 $btnEdit = "";

$btn_del='<a href="javascript:void(0)" data-href="'.$gotoprocess.'?id='.epm_encode($aRow[$sIndexColumn]).'&aksi=deleterole" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger enable-tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>';

$q_level="SELECT * FROM user_level where level_id='$aRow[level_id]'";
$result_l = $connection->query($q_level);
$rows_l= $result_l->fetch_assoc();
$levelName  = $rows_l['level'];

            $row[] = $checkdata;
            $row[] = $levelName;
            $row[] = $displayname;
            $row[] = "<div class='text-center'>".$R."</div>";
            $row[] = "<div class='text-center'>".$W."</div>";
            $row[] = "<div class='text-center'>".$M."</div>";
            $row[] = "<div class='text-center'>".$D."</div>";
            $row[] = "<div class='text-center'>
                    <div class='btn-group btn-group-xs'>
                 $btn_del
                    </div>
                </div>";
         }
        $output['aaData'][] = $row;
    $no++;
    }
    echo json_encode($output);
}
