<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
   header('location:../../');
}else{
    $gotoprocess = "sw-mod/post/proses.php";
    require_once'../../../sw-library/config.php';
    include_once '../../../sw-library/sw-function.php';

    $aColumns = ['post_id','post_title','seotitle','author','post_category','post_tags','post_time','post_date','post_hits','post_status'];
    $sIndexColumn = "post_id";
    $sTable = "post";
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

    $sOrder = "ORDER BY post_id DESC";
    if (isset($_GET['iSortCol_0']))
    {
        $sOrder = "ORDER BY post_id DESC";
        for ($i=0; $i<intval($_GET['iSortingCols']) ; $i++)
        {
            if ($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true")
            {
                $sOrder .= $aColumns[ intval($_GET['iSortCol_'.$i])]."
                    ".mysqli_real_escape_string($gaSql['link'], $_GET['sSortDir_'.$i]) .", ";
            }
        }

        $sOrder = substr_replace($sOrder, "", -2);
        if ($sOrder == "ORDER BY post_id DESC")
        {
            $sOrder = "ORDER BY post_id DESC";
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
    {extract($aRow);

 $query="SELECT user_id,fullname FROM user where user_id='$aRow[author]'"; 
 $result = $connection->query($query) or die($connection->error.__LINE__);
 $rows_user= $result->fetch_assoc();
 $user_id =$rows_user['user_id'];
 
        $row = array();
        for ($i=1 ; $i<count($aColumns) ; $i++)
        {
        $str = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            $strlink = preg_replace("/\/sw-admin26\/sw-mod\/post\/(datatable\.php$)/","",$str);

            $checkdata = "<div class='text-center'><input type='checkbox' id='titleCheckdel' /><input type='hidden' class='deldata' name='item[]' value='$aRow[post_id]' disabled></div>";

            if($user_id == $aRow['author']){
            $btn_edit = "<a href='?mod=post&op=edit&post=".epm_encode($aRow['post_id'])."' class='btn btn-xs btn-default' id='$aRow[post_id]'><i class='fa fa-pencil'></i></a>";
              $btn_del ='<a href="javascript:void(0)" class="btn btn-xs btn-danger" data-href="'.$gotoprocess.'?id='.epm_encode($aRow['post_id']).'&aksi=delete" data-toggle="modal" data-target="#hapus" title="'._e('Delete').'"><i class="fa fa-trash-o"></i></a>';
            }
            else{
$btn_edit='';
$btn_del='';
            }
if($aRow['post_status']== 1){
             $status = "<buton class='btn btn-xs btn-default'>Publish</buton>";
            }else{
            $status = "<buton class='btn btn-xs btn-default'>Draft</buton>";
        }

$post_tags = str_replace('-',' ',$aRow['post_tags']);
$post_tags=ucfirst($post_tags);

$post_category = str_replace('-',' ',$aRow['post_category']);
$post_category=ucfirst($post_category);
            $row[] = $checkdata;

            $row[] = "<a href='".$site_url."/blog/$post_id-$seotitle.html' target='_blank'>".substr(ucfirst($post_title), 0, 70)."</a><br><br>
                    <div class='btn-group btn-group-xs'><a href='?mod=profile&id=".epm_encode($aRow['author'])."' class='btn btn-xs btn-default'><i class='fa fa-user'></i> ".$rows_user['fullname']."</a>
                    
                    <buton class='btn btn-xs btn-default'>
                    <i class='fa fa-bookmark'></i> $post_category</buton>
                    $status
                    <buton class='btn btn-xs btn-default'><i class='fa fa-signal'></i> $aRow[post_hits]</buton>
                <a href='http://www.facebook.com/sharer/sharer.php?u=".$site_url."/blog/$post_id-$seotitle.html' target='_blank' class='btn btn-xs btn-primary' title='Facebook'><i class='fa fa-facebook'></i></a>
         <a href='http://twitter.com/share?url=".$site_url."/blog/$post_id-$seotitle.html' target='_blank' class='btn btn-xs btn-success' title='Twitter'><i class='fa fa-twitter'></i></a>
         <a href='http://plus.google.com/share?url=".$site_url."/blog/$post_id-$seotitle.html' target='_blank' class='btn btn-xs btn-danger' title='Google +'><i class='fa fa-google-plus'></i></a>
                    </div>";
             $row[] = $post_tags;
           $row[] = tgl_ind($aRow['post_date'])."<br><i class='fa fa-clock-o'></i> ". $aRow['post_time'];
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



