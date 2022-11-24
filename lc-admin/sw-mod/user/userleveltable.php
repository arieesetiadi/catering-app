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
    $aColumns = ['level_id','level','active'];
    //index table
    $sIndexColumn = "level_id";
    //nama table
    $sTable = "user_level";

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
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );

    $no = 1;
    while ($aRow = mysqli_fetch_array($rResult))
    {
if($aRow['level_id'] == 1){
        //active deactive
        if($aRow['active']=='Y'){
            $active="<a class='btn btn-xs btn-info'><i class='fa fa-eye'></i> Active</a>";
        }else{
            $active="<a id='seth$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' class='btn btn-xs btn-warning setactive' data-active='$aRow[active]'><i class='fa fa-eye-slash'></i> Deactive</a>";
        }
    } else {

        //active deactive
        if($aRow['active']=='Y'){
            $active="<a id='seth$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' class='btn btn-xs btn-success setactive' data-active='$aRow[active]'><i class='fa fa-eye'></i> Active</a>";
        }else{
            $active="<a id='seth$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' class='btn btn-xs btn-warning setactive' data-active='$aRow[active]'><i class='fa fa-eye-slash'></i> Deactive</a>";
        }

    }
if($aRow['level_id'] == 1){
$btn_del="<a class='btn btn-xs btn-default' data-toggle='modal' data-target='#akses'><i class='fa fa-trash-o'></i></a>";
    }
    else {
$btn_del='<a href="javascript:void(0)" data-href="'.$gotoprocess.'?id='.epm_encode($aRow[$sIndexColumn]).'&aksi=deletelevel" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger enable-tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>';
    }
        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
        $checkdata = "<div class='text-center'><input type='checkbox' class='deldata' name='item[$no]' value='$aRow[$sIndexColumn]'>
        </div>";
            $row[] = $checkdata;
            $row[] = $aRow['level'];
            $row[] = "<div class='text-center'>".$active."</div>";
            $row[] = "<div class='text-center'><div class='btn-group btn-group-xs'>
                   
                    <a href='#modalEdit$aRow[$sIndexColumn]' class='btn btn-xs btn-default' data-toggle='modal'><i class='fa fa-pencil'></i></a>
                $btn_del 
            </div></div>

<div id='modalEdit$aRow[$sIndexColumn]' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>
<div class='modal-dialog modal-sm'>
<div class='modal-content'>
    <form id='validate' method='post' action='$gotoprocess' autocomplete='off'>
        <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h3 class='modal-title'>Edit Level User</h3>
        </div>
        <div class='modal-body'>
            <input type='hidden' name='modul' value='user'>
            <input type='hidden' name='aksi' value='edituserlevel'>
            <input type='hidden' name='id' value='$aRow[$sIndexColumn]'>
            <div class='form-group'>
                <label>Level</label>
                <input class='form-control' type='text' id='title' name='title' value='$aRow[level]' required>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='submit' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Simpan</button>
        </div>
    </form>
</div>
</div>
</div>";
        }
        $output['aaData'][] = $row;
    $no++;
    }
    echo json_encode($output);
}
