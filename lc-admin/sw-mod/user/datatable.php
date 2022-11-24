<?php
session_start();
if(!isset($_SESSION['SESION_LOGIN'])){
   header('location:../../');
}else{
    require_once'../../../sw-library/config.php';
   require_once'../../login/login_session.php';
    include_once '../../../sw-library/sw-function.php';
    $gotoprocess = "sw-mod/user/proses.php";
     $aColumns = ['user_id','user_login','photo','fullname','level','session','time_login','time_logout','active','ip','browser'];
    $sIndexColumn = "user_id";
    $sTable = "user";
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
        FROM   $sTable";
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
$query = "SELECT author FROM post where author='$aRow[user_id]'"; 
$result = $connection->query($query) or die($connection->error.__LINE__);
$count =$result->num_rows;

        if($aRow['session'] !=='ofline'){
            $status="<b>Now Online</b><br><small class='text-primary'>
            <b>Login: $aRow[time_login]</b></small>";
        }else{
            $status="<b>Offline</b><br><small><small class='text-danger'>
            <b>Logout: $aRow[time_logout]</b></small>";
        }

if($aRow['session'] !== $_SESSION['SESION_LOGIN']){
if($level_user == 1){
if($aRow['active']=='Y'){
                $active="<a id='seth$aRow[user_id]' data-id='$aRow[$sIndexColumn]' class='btn btn-xs btn-success setactive' data-active='$aRow[active]'><i class='fa fa-eye'></i> Active</a>";
            }
            else{
                $active="<a id='seth$aRow[user_id]' data-id='$aRow[$sIndexColumn]' class='btn btn-xs btn-danger setactive' data-active='$aRow[active]'><i class='fa fa-eye-slash'></i> Deactive</a>";
            }
        }
else {
if($aRow['active']=='Y'){
                $active="<a class='btn btn-xs btn-success'><i class='fa fa-eye'></i> Active</a>";
            }else{
                $active="<a class='btn btn-xs btn-danger'><i class='fa fa-eye-slash'></i> Deactive</a>";
            }}

        }
    else {
if($aRow['active']=='Y'){
         $active="<a class='btn btn-xs btn-default'><i class='fa fa-eye'></i> Active</a>";
            }else{
        $active="<a class='btn btn-xs btn-default'><i class='fa fa-eye-slash'></i> Deactive</a>";
            }

    }
        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
            $checkdata = "<div class='text-center'>
            <input type='checkbox' class='deldata' name='item[]' value='$aRow[user_id]'></div>";



$valid = $aRow['level'];
$query_u = "SELECT level_id,level FROM user_level where level_id='$valid'"; 
$result_u = $connection->query($query_u) or die($conn->error.__LINE__);
$rows_u= $result_u->fetch_assoc();

if($aRow['session'] !== $_SESSION['SESION_LOGIN']){
if($level_user == 1){
            if($rows_u['level'] =='admin'){
                $level="<a id='setus$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[level]' class='btn btn-info setuser'><i class='gi gi-old_man'></i> Administrator</a>";

            }
            elseif($rows_u['level']=='user'){
                $level="<a id='setus$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[level]' class='btn btn-success setuser'><i class='gi gi-user'></i> User</a>";
            }else{
                $level="<a id='setus$aRow[$sIndexColumn]' data-id='$aRow[$sIndexColumn]' data-active='$aRow[level]' class='btn btn-primary setuser'><i class='fa fa-user'></i> Member</a>";    
            }
            }
            else{
               if($rows_u['level']=='admin'){
                $level="<a class='btn btn-info'><i class='gi gi-old_man'></i> Administrator</a>";
            }elseif($rows_u['level']=='user'){
                $level="<a class='btn btn-success'><i class='gi gi-user'></i> User</a>";
            }else{
                $level="<a class='btn btn-primary'><i class='fa fa-user'></i> Member</a>";    
            } 
            }
}
else {
if($rows_u['level']=='admin'){
                $level="<a class='btn btn-default'><i class='gi gi-old_man'></i> Administrator</a>";
            }elseif($rows_u['level']=='user'){
                $level="<a class='btn btn-default'><i class='gi gi-user'></i> User</a>";
            }else{
                $level="<a class='btn btn-default'><i class='fa fa-user'></i> Member</a>";    
            } 

}

if($aRow['user_id'] == $aRow[$sIndexColumn] ){
if($level_user == 1){
$btn_edit = "<a href='?mod=$sTable&op=edit&user=".epm_encode($aRow[$sIndexColumn])."' class='btn btn-xs btn-default' id='$aRow[$sIndexColumn]'><i class='fa fa-pencil'></i></a>";

if($aRow['session'] == $_SESSION['SESION_LOGIN']){
    # session login tidak ada hak akses hapus
$btn_del = '<a href="javascript:void(0)"" class="btn btn-xs btn-default" data-toggle="modal" data-target="#akses" class=btn btn-xs btn-default enable-tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>';
}else {
  # session login admin memiliki hak akses
$btn_del = " <a href='javascript:void(0)' data-href='".$gotoprocess."?id=$aRow[user_id]&aksi=delete' data-toggle='modal' data-target='#hapus' class='btn btn-xs btn-danger enable-tooltip' title='Hapus'><i class='fa fa-trash-o'></i></a>";

}
}
elseif ($aRow['session'] !== $_SESSION['SESION_LOGIN']){
$btn_edit = "<a href='?mod=$sTable&op=edit&user=".epm_encode($aRow[$sIndexColumn])."' class='btn btn-xs btn-default' id='$aRow[$sIndexColumn]'><i class='fa fa-pencil'></i></a>";

$btn_del ="<a href='javascript:void(0)' data-toggle='modal' data-target='#akses' class='btn btn-xs btn-danger enable-tooltip' title='Hapus'><i class='fa fa-trash-o'></i></a>";
    }  

    else{

$btn_edit = "<a href='?mod=$sTable&op=edit&user=".epm_encode($aRow[$sIndexColumn])."' class='btn btn-xs btn-default' id='$aRow[$sIndexColumn]'><i class='fa fa-pencil'></i></a>";

$btn_del = "<a class='btn btn-xs btn-danger' data-toggle='modal' data-target='#akses' class=btn btn-xs btn-default enable-tooltip' title='Hapus'><i class='fa fa-trash-o'></i></a>";

    }  

            }

             if($aRow['photo']!==''){
            $photo = "<div class='text-center'><img src='../sw-content/upload/avatar/$aRow[photo]' width='60' height='60' class='img-circle' oncontextmenu='return false;'></div>";
            }else{
               $photo = "<div class='text-center'><img src='./sw-assets/img/avatar.jpg' class='img-circle' width='60' height='60' oncontextmenu='return false;'></div>"; 
            }



             $row[] = $checkdata;
            $row[] ="<div class='text-center'>$photo</div>";
            $row[] = '<label><a class="text-success" href="?mod=profile&id='.epm_encode($aRow[$sIndexColumn]).'"><b>'.$aRow['fullname'].'</b>
                </a></label><br/>
            <div class="btn-group btn-group-xs">
            	<buton class="btn btn-xs btn-info">
                User: '.$aRow['user_login'].'</buton>

                <buton class="btn btn-xs btn-warning">
                Ip: '.$aRow['ip'].'</buton>
                <buton class="btn btn-xs btn-default">'.$aRow['browser'].'</buton>
            </div>';
            $row[] = "<div class='btn-group btn-group-xs'>".$level."".$active."</div>";
            $row[] = $status;
            $row[] = "<div class='text-center'><label class='label label-info'> ".$count." </label></div>";
            $row[] = "<div class='text-center'>
            <div class='btn-group btn-group-xs'>
                
                $btn_edit
                $btn_del
            </div></div>";
        }
        $output['aaData'][] = $row;
    $no++;
    }
    echo json_encode($output);
}


