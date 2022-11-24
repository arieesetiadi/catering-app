<?php
if(empty($_SESSION['SESION_LOGIN']) || !isset($_SESSION['SESION_LOGIN'])){ 
header('location:./login/');
 exit;}
 else{
$query_color="SELECT id,name from colortheme where id='$rows_login[colortheme]'";
$result_color=$connection->query($query_color);
$row_color = $result_color->fetch_assoc();

$query_mail= "SELECT msg_id from message where msg_status='N' and msg_type='1'"; 
$result_mail = $connection->query($query_mail);
$inbox = $result_mail->num_rows;



$qorder_header= "SELECT order_id,order_name,order_price,order_quantity,order_total,order_status,order_date from order_item where order_status='1' or order_status='2' order by order_item.order_id DESC LIMIT 6";

$resultOrder_header = $connection->query($qorder_header);
$count_order_header = $resultOrder_header->num_rows;


if(!empty($_GET['mod'])){ 
$mod = $_GET['mod'];}
else {
$mod ='';}?>

<!DOCTYPE html>
    <html class="no-js">
        <head>
            <meta charset="utf-8">
            <title>Administrator - <?php echo $site_name;?></title>
            <meta name="description" content="">
            <meta name="author" content="Cms s-widodo.com">
            <meta name="robots" content="noindex, nofollow">
   <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<link rel="shortcut icon" href="./sw-assets/img/favicon.png">
<link rel="stylesheet" href="sw-assets/css/bootstrap.min.css">
<link rel="stylesheet" href="sw-assets/css/plugins.css">
<link rel="stylesheet" href="sw-assets/css/main.css">
<link rel="stylesheet" href="sw-assets/css/themes.css">
<link rel="stylesheet" href="sw-assets/css/themes/<?php echo $row_color['name']?>.css">
<?php if ($mod == "theme" OR $mod == "setting" OR $mod == "layout"){ ?>
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/lib/codemirror.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/theme/github.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/addon/display/fullscreen.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/addon/hint/show-hint.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/addon/dialog/dialog.css" />
<?PHP }?>
<?php
if(!empty($_GET['op'])){
$op= htmlentities(@$_GET['op']);
if ($mod == "message" and $op == "edit-theme"){ ?>
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/lib/codemirror.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/theme/github.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/addon/display/fullscreen.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/addon/hint/show-hint.css" />
<link type="text/css" rel="stylesheet" href="sw-assets/js/codemirror/addon/dialog/dialog.css" />
<?php }}?>


<script src="sw-assets/js/jquery-1.11.1.min.js"></script>
<script src="sw-assets/js/modernizr-2.7.1-respond-1.4.2.min.js"></script>
<script src="sw-assets/js/bootstrap.min.js"></script>
</head>
<body>
<div id="page-container" class="sidebar-visible-lg sidebar-no-animations header-fixed-top">
<div id="main-container">
<header class="navbar navbar-default navbar-fixed-top">
<ul class="nav navbar-nav-custom">
<li>
<a onclick="App.sidebar('toggle-sidebar');" style="cursor:pointer">
<i class="fa fa-bars fa-fw"></i>
</a>
</li>
<li class="dropdown">
<a href="sw-assets/javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-plus-circle"></i> Baru <i class="fa fa-angle-down"></i></a>
<ul class="dropdown-menu dropdown-custom dropdown-options">
<li><a href="?mod=product&op=add"><i class="fa fa-plus-circle"></i> Product</a></li>
<li><a href="?mod=post&op=add"><i class="fa fa-plus-circle"></i> Post</a></li>
<li><a href="?mod=page&op=add"><i class="fa fa-plus-circle"></i> Pages</a></li>
</ul>
</li>
<li><a href="../" title="Buka Web" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Buka Web">
 <i class="fa fa-desktop"></i> View Web</a></li>

 <li class="pull-right" style="margin-left:10px;"><a><small><i class="fa fa-calendar"></i> <?php echo tanggal_ind($date);?></small></a></li>
</ul>
<ul class="nav navbar-nav-custom pull-right">


<li class="dropdown messages-menu">
    <a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown">
     <span data-toggle="tooltip" data-placement="bottom" title="Pesanan Baru">
     <i class="fa fa fa-shopping-bag"></i></span>
		<span class="label badge label-danger label-indicator animation-floating">
			<?php echo $count_order_header;?></span>
    </a>
<ul class="dropdown-menu dropdown-menu-right">
		<li class="header">Anda memiliki <?php echo $count_order_header;?> Pesanan</li>
<li>
    <!-- inner menu:-->
    <ul class="menu">
    <?php if($resultOrder_header->num_rows > 0){
    		while($row_order=$resultOrder_header->fetch_assoc()){

    if($row_order['order_status'] == 1){
    	$status_header='<button class="btn btn-alt btn-sm btn-primary" data-toggle="tooltip" data-original-title="Proses"><i class="fa fa-hourglass-start"></i></button>';}
    elseif($row_order['order_status'] == 2){
    $status_header='<button class="btn btn-alt btn-sm btn-warning" data-toggle="tooltip"  data-original-title="Dibayar"><i class="fa fa-fax"></i></button>';}
    	echo'
        <li>
            <a href="?mod=order&op=invoice&id='.epm_encode($row_order['order_id']).'">
                <div class="block-options pull-left">
                  '.$status_header.'
                </div>
                <h4>'.ucfirst($row_order['order_name']).'
                    <small>'.$row_order['order_date'].'</small>
                </h4>
                <p><small>1 Barang</small><br>
                 Rp. '.format_angka($row_order['order_total']).'</p>
            </a>
        </li>';}} else{
        		echo'<li><a href="javascript:void();" class="text-center">
        		Belum ada pemesanan barang</a></li>';}?>
    </ul>
</li>
<li class="footer"><a href="?mod=order">Semua Pesanan</a></li>
</ul>
</li>


<li>
<a href="./?mod=message"  data-toggle="tooltip" data-placement="bottom" title="<?php echo _e('Message');?>">
<i class="fa fa-envelope"></i>
<span class="label badge label-primary label-indicator">
<?php echo $inbox;?>
</span>
</a></li>


<li class="dropdown">
<a href="" class="dropdown-toggle" data-toggle="dropdown">
<?php if($photo !==''){
echo'  <img src="../sw-content/upload/avatar/'.$photo.'" alt="avatar">';} else {
echo'  <img src="sw-assets/img/avatar.jpg" alt="avatar">';}?>  
<?php echo $fullname;?> <i class="fa fa-angle-down"></i>
</a>
<ul class="dropdown-menu dropdown-custom dropdown-menu-right">
<li class="dropdown-header text-center">Account</li><li>
<li><a href="?mod=profile&id=<?php echo epm_encode($author);?>">
<i class="fa fa-user fa-fw pull-right"></i><?php echo _e('Profile');?></a></li>
<li>
<a href="?mod=setting"><i class="fa fa-cog fa-fw pull-right"></i><?php echo _e('Settings');?></a>
</li>
<li class="divider"></li>
<li>
<a href="javascript:void();" onClick="location.href='./logout.php';">
<i class="gi gi-exit fa-fw pull-right"></i> <?php echo _e('Logout');?></a>
</li>
</ul>
</li>
</ul>
</header>
<?php }?>