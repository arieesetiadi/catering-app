<?PHP 
 if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location:../login');
}else{
require_once'../sw-library/sw-function.php';
$config = get_parse_ini('../sw-library/config.ini.php');
require_once '../sw-library/ini.php';

$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='1' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);
if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);

$message='';
if(!empty($_SESSION['message'])){$message=$_SESSION['message'];}
$tab_info='';
if(!empty($_SESSION['tab_info'])){$tab_info = $_SESSION['tab_info'];}
$tab_gambar='';
if(!empty($_SESSION['tab_gambar'])){$tab_gambar= $_SESSION['tab_gambar'];}
$tab_konfig='';
if(!empty($_SESSION['tab_konfig'])){$tab_konfig = $_SESSION['tab_konfig'];}
$tab_post='';
if(!empty($_SESSION['tab_post'])){$tab_post = $_SESSION['tab_post'];}
$gotoprocess = "sw-mod/$mod/proses.php";
switch(@$_GET['op']){ default: ?>
    <?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="fa fa-gears"></i>'._e('General Settings').'<br></h1>
</div></div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="?"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('General Settings').'</li>
</ul>';
if($read_access == 'Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';

echo'
<div class="block">
<div class="block-title">
<ul class="nav nav-tabs nav-tabs-simple" data-toggle="tabs">
<li>
<a href="#site_information"><span class="text-primary">
<i class="fa fa-desktop"></i> Site Information</span></a></li>
<li><a href="#gambar"><span class="text-danger"><i class="fa fa-picture-o"></i> Gambar Logo</span></a></li>

<li><a href="#social"><span class="text-error"><i class="fa fa-share-alt"></i> Social Media & Chat</span></a></li>

<li><a href="#config"><span class="text-warning"><i class="fa fa-cogs"></i> Konfigurasi</span></a></li>

<li><a href="#post"><span class="text-error"><i class="fa fa-file-text"></i> Post-Komentar</span></a></li>

<li><a href="#email"><span class="text-info"><i class="fa fa-envelope-o"></i> Mail Domain</span></a></li>
<li><a href="#backup_DB"><span class="text-success"><i class="fa fa-database"></i> Backup Database</span></a></li>

</ul>
</div>';
echo'
<div class="tab-content">
<div class="tab-pane active" id="site_information">
<div class="block-section clearfix">';?>

<?php
$query = "SELECT * FROM site order by site_id DESC LIMIT 1"; 
$result = $connection->query($query);
$row_site= $result->fetch_assoc();
echo'<form class="form-bordered" action="'.$gotoprocess.'" method="post" enctype="multipart/form-data" id="validate">
<input type="hidden" name="modul" value="post">
<input type="hidden" name="aksi" value="insert">
<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>'._e('Site Name').'</label>
<div id="site_name" style="cursor:pointer;">'.$row_site['site_name'].'</div>
<div id="sitename" style="display:none;">
<div class="input-group">
<input  id="text_sitename" type="text" name="site_name" class="form-control" value="'.$row_site['site_name'].'">
<span class="input-group-btn">
    <button id="sitenameOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>Domain</label>
<div id="site_url" style="cursor:pointer;">'.$row_site['site_url'].'</div>
<div id="siteurl" style="display:none;">
<div class="input-group">
<input  id="text_siteurl" type="text" name="site_url" class="form-control" value="'.$row_site['site_url'].'">
<span class="input-group-btn">
<button id="siteurlOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>
</div>

<div clas="row">
<div class="form-group">
<label>Sub Domain</label>
<div id="sub_url" style="cursor:pointer;">'.$row_site['sub_url'].'</div>
<div id="suburl" style="display:none;">
<div class="input-group">
<input  id="text_suburl" type="text" name="sub_url" class="form-control" value="'.$row_site['sub_url'].'">
<span class="input-group-btn">
<button id="suburlOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div></div>



<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>'._e('Owner').'</label>
<div id="site_owner" style="cursor:pointer;">'.$row_site['site_owner'].'</div>
<div id="siteowner" style="display:none;">
<div class="input-group">
<input id="text_siteowner" type="text" name="owner" class="form-control" value="'.$row_site['site_owner'].'">
<span class="input-group-btn">
<button id="siteownerOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Email</label>
<div id="site_email" style="cursor:pointer;">'.$row_site['site_email'].'</div>
<div id="siteemail" style="display:none;">
<div class="input-group">
    <input id="text_siteemail" type="text" name="email" class="form-control" value="'.$row_site['site_email'].'">
    <span class="input-group-btn">
        <button id="siteemailOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
    </span>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>'._e('Site Phone').' / WhatSapp</label>
<div id="site_phone" style="cursor:pointer;">'.$row_site['site_phone'].'</div>
<div id="sitephone" style="display:none;">
<div class="input-group">
<span class="input-group-btn">
<button class="btn btn-default" type="button"><i class="fa fa-phone"></i></button>
</span>
<input id="text_sitephone" type="text" name="phone" class="form-control" maxlength="20" value="'.$row_site['site_phone'].'">
<span class="input-group-btn">
<button id="sitephoneOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>Nomor Telepon/Wa example: 0896666665781</small>
</div>
</div>
</div>

<div class="col-sm-6">
<div class="form-group">
<label>'._e('Site Phone').'</label>
<div id="site_phone_2" style="cursor:pointer;">'.$row_site['site_phone_2'].'</div>
<div id="sitephone_2" style="display:none;">
<div class="input-group">
<span class="input-group-btn">
<button class="btn btn-default" type="button">
    <i class="fa fa-phone"></i>
</button>
</span>
<input id="text_sitephone_2" type="text" name="phone" class="form-control" maxlength="20" value="'.$row_site['site_phone_2'].'">
<span class="input-group-btn">
<button id="sitephone_2OK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>Nomor Telepon example:0896666665781</small>
</div>
</div>
</div>
</DIV>



<div class="form-group">
<label>'._e('Office Address').'</label>
<div id="site_address" style="cursor:pointer;">'.$row_site['site_office_address'].'</div>
<div id="siteaddress" style="display:none;">
<div class="input-group">
<input id="text_siteaddress" type="text" name="phone" class="form-control" value="'.$row_site['site_office_address'].'">
<span class="input-group-btn">
    <button id="siteaddressOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>


<div class="form-group">
<label>'._e('Site Description').'</label>
<div id="site_description" style="cursor:pointer;">'.$row_site['site_description'].'</div>
<div id="sitedescription" style="display:none;">
<textarea id="text_sitedescription" class="form-control" name="site_description" rows="3">'.$row_site['site_description'].'</textarea>
<button id="sitedescriptionOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</div>
</div>
<div class="form-group">
<label>'._e('Meta Keyword').'</label>
<div id="site_keyword" style="cursor:pointer;">'.$row_site['site_keyword'].'</div>
<div id="sitekeyword" style="display:none;">
<textarea id="text_sitekeyword" class="form-control" name="site_keyword" rows="6">'.$row_site['site_keyword'].'</textarea>
<button id="sitekeywordOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</div>
</div>


<div class="form-group">
<label>Maintenance Mode</label>
<div id="mmm">
<div id="maintenance_mode">';
 if($row_site['maintenance_mode']== 'Y'){ ?>
<label class="label label-success" style="cursor:pointer;">Active</label>
<?php } else {?>
<label class="label label-danger" style="cursor:pointer;">Non Active</label>
<?php } ?>
</div>
<div class="row" id="maintenancemode" style="display:none;">
<div class="col-sm-6 ref">
<?php  if($row_site['maintenance_mode']== 'Y'){
echo "<label class='switch switch-primary'><input id='maintenancemodeOk' data-id='N' type='checkbox' name='maintenance_mode' checked><span></span></label>";
} else
{
echo "<label class='switch switch-primary'><input id='maintenancemodeOk' data-id='Y' type='checkbox' name='maintenance_mode'><span></span></label>";
}
echo'
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<span class="help-block">Klik untuk mengaktifkan atau menonaktifkan Maintenance Mode pada Website</span>
</div>
</div>
</div>




</form>
</div>
</div>';

echo'
<div class="tab-pane '.$tab_gambar.'" id="gambar">
<div class="block-section clearfix">';
echo'
<form method="post" id="validate" enctype="multipart/form-data" class="form-horizontal form-bordered" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="setting">
<input type="hidden" name="aksi" value="site_favicon">
<div class="form-group">
<label class="col-md-3 control-label">Favicon</label>
    <div class="col-md-5">';
if($row_site['site_favicon'] == NULL){
echo'
<img id="uploadPreview1" src="./sw-assets/img/noimages.png" class="thumbnail img-responsive" width="60" oncontextmenu="return false;"/>';}
else{echo'
<img id="uploadPreview1" src="../'.$row_site['site_favicon'].'" class="thumbnail img-responsive" width="60" oncontextmenu="return false;"/>';}
echo'
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-primary btn-file"><i class="fa fa-upload"></i>
<input id="uploadImage1" onChange="PreviewImage(1);" type="file" class="upload" name="file" accept=".jpg, .jpeg, .ico, .png" required/>
</span></span>
<input type="text" placeholder="Browse file" class="form-control" readonly>
<span class="input-group-btn">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
</span>
</div>
<span class="text-danger">Format berkas harus berformat jpg, .jpeg, .ico, .png dan Maksimal Ukuran 60 KB 50x50 pixel.</span>
</div>
</div>
</form>
<br>

<form method="post" id="validate" enctype="multipart/form-data" class="form-horizontal form-bordered" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="setting">
<input type="hidden" name="aksi" value="site_logo">
<div class="form-group">
<label class="col-md-3 control-label">Logo Website</label>
    <div class="col-md-5">';
if($row_site['site_logo'] == NULL){
echo'
<img id="uploadPreview2" src="./sw-assets/img/noimages.png" class="thumbnail img-responsive" width="100" oncontextmenu="return false;"/>';}
else{echo'
<img id="uploadPreview2" src="../sw-content/'.$row_site['site_logo'].'" class="thumbnail img-responsive" style="background:#eee;" width="250" oncontextmenu="return false;"/>';}
echo'
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-primary btn-file"><i class="fa fa-upload"></i>
<input id="uploadImage2" onChange="PreviewImage(2);" type="file" class="upload" name="file" accept=".jpg, .jpeg, .ico, .png" required/>
</span></span>
<input type="text" placeholder="Browse file" class="form-control" readonly>
<span class="input-group-btn">
    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
</span>
</div>
<span class="text-danger">Format berkas harus berformat jpg, jpeg, png dan Maksimal Ukuran 100KB.</span>
</div>
</div>
</form>

<form id="validate" enctype="multipart/form-data" class="form-horizontal form-bordered">
<div class="form-group">
<label class="col-md-3 control-label">Ukuran Logo Website</label>
<div class="col-md-5">
<p class="form-control-static" id="logo_size" style="cursor:pointer;"><b>'.$logo_size.'</b></p>
<div id="logosize" style="display:none;">
<div class="input-group">
<input id="text_logosize" type="text" name="logo_size" class="form-control" value="'.$logo_size.'" required>
<span class="input-group-btn">
    <button id="logosizeOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>
</form>

</div>
</div>';?>


<!-- tab social media -->


<?php echo'
<div class="tab-pane" id="social">
<div class="block-section clearfix">';
echo'<form class="form-bordered" id="validate">
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label>Social Facebook</label>
<div id="social_fb" style="cursor:pointer;">'.$row_site['social_facebook'].'</div>
<div id="socialfb" style="display:none;">
<div class="input-group">
<div class="input-group-addon">URL</div>
<input id="text_socialfb" type="text" name="timezone" class="form-control" value="'.$row_site['social_facebook'].'">
<span class="input-group-btn">
<button id="socialfbOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>Url lengkap : https://www.facebook.com/@username</small>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<label>Social Twitter</label>
<div id="social_twit" style="cursor:pointer;">'.$row_site['social_twitter'].'</div>
<div id="socialtwit" style="display:none;">
<div class="input-group">
<div class="input-group-addon">URL</div>
<input id="text_socialtwit" type="text" name="timezone" class="form-control" value="'.$row_site['social_twitter'].'">
<span class="input-group-btn">
<button id="socialtwitOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>Url lengkap : http://twitter.com/@username</small>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Social Google +</label>
<div id="social_google" style="cursor:pointer;">'.$social_google.'</div>
<div id="socialgoogle" style="display:none;">
<div class="input-group">
<div class="input-group-addon">URL</div>
<input id="text_socialgoogle" type="text" name="social_google" class="form-control" value="'.$social_google.'">
<span class="input-group-btn">
    <button id="socialgoogleOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>Url lengkap : https://plus.google.com/u/0/@username</small>
</div>
</div>
</div>

<div class="col-sm-6">
 <div class="form-group">
<label>Instagram</label>
<div id="social_instagram" style="cursor:pointer;">';if($social_instagram !==''){echo'@'.$social_instagram.'';}else{echo '@username';}echo'</div>
<div id="instagram" style="display:none;">
<div class="input-group">
<div class="input-group-addon">@</div>
<input id="text_instagram" type="text" name="social_instagram" class="form-control" value="'.$social_instagram.'">
<span class="input-group-btn">
    <button id="instagramOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>User Instagram examle : ministore</small>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Social Line</label>
<div id="social_line" style="cursor:pointer;">';if($social_line !==''){echo'@'.$social_line.'';}else{echo '@username';}echo'</div>
<div id="line" style="display:none;">
<div class="input-group">
<div class="input-group-addon">@</div>
<input id="text_line" type="text" name="social_line" class="form-control" value="'.$social_line.'">
<span class="input-group-btn">
    <button id="lineOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>User line examle : ministore</small>
</div>
</div>
</div>


<div class="col-sm-6">
 <div class="form-group">
<label>Social BBM</label>
<div id="social_bbm" style="cursor:pointer;">';if($social_bbm !==''){echo''.$social_bbm.'';}else{echo 'PIN BBM';}echo'</div>
<div id="bbm" style="display:none;">
<div class="input-group">
<div class="input-group-addon">PIN</div>
<input id="text_bbm" type="text" name="social_instagram" class="form-control" value="'.$social_bbm.'">
<span class="input-group-btn">
    <button id="bbmOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
<small>pin BBM examle : YT6564</small>
</div>
</div>
</div>
</div>
</form>';

echo'<br><br>
<h4 class="sub-header">Code Live cat</h4>
<style type="text/css">
.CodeMirror { height: 300px; }
.CodeMirror-matchingtag { background: #4d4d4d; }
.breakpoints { width: .8em; }
.breakpoint { color: #3498db; }
</style>
Live cat (klik pada editor jika tidak menampilkan data) 
<form method="post" action="'.$gotoprocess.'" autocomplete="off">
    <input type="hidden" name="modul" value="setting">
    <input type="hidden" name="aksi" value="livecat">
    <textarea class="form-control" id="swcodemirror3" name="live_cat" style="width:100%; height300px;">'.$row_site['live_cat'].'</textarea>
    <div class="form-group form-actions"><br>
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
    </div>
</form>

</div>
</div>';?>

<!-- Konfig -->
<?php echo'
<div class="tab-pane '.$tab_konfig.'" id="config">
<div class="block-section clearfix">';
echo'<form class="form-bordered" id="validate">
<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Id Google Webmaster</label>
<div id="id_googleweb" style="cursor:pointer;">'.$id_googleweb.'</div>
<div id="idgoogleweb" style="display:none;">
<div class="input-group">
<input id="text_idgoogleweb" type="text" name="id_googleweb" class="form-control" value="'.$id_googleweb.'">
<span class="input-group-btn">
    <button id="idgooglewebOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
 <div class="form-group">
<label>Id Google Analytics</label>
<div id="id_googlean" style="cursor:pointer;">'.$id_googlean.'</div>
<div id="idgooglean" style="display:none;">
<div class="input-group">
<input id="text_idgooglean" type="text" name="id_googlean" class="form-control" value="'.$id_googlean.'">
<span class="input-group-btn"><button id="idgoogleanOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Id Alexa</label>
<div id="id_alexa" style="cursor:pointer;">'.$id_alexa.'</div>
<div id="idalexa" style="display:none;">
<div class="input-group">
<input id="text_idalexa" type="text" name="id_alexa" class="form-control" value="'.$id_alexa.'">
<span class="input-group-btn">
    <button id="idalexaOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
 <div class="form-group">
<label>Id Bing</label>
<div id="id_bing" style="cursor:pointer;">'.$id_bing.'</div>
<div id="idbing" style="display:none;">
<div class="input-group">
<input id="text_idbing" type="text" name="id_bing" class="form-control" value="'.$id_bing.'">
<span class="input-group-btn">
    <button id="idbingOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Id Yahoo</label>
<div id="id_yahoo" style="cursor:pointer;">'.$id_yahoo.'</div>
<div id="idyahoo" style="display:none;">
<div class="input-group">
<input id="text_idyahoo" type="text" name="id_yahoo" class="form-control" value="'.$id_yahoo.'">
<span class="input-group-btn">
    <button id="idyahooOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
 <div class="form-group">
<label>Id Facebook</label>
<div id="id_facebook" style="cursor:pointer;">'.$id_facebook.'</div>
<div id="idfacebook" style="display:none;">
<div class="input-group">
<input id="text_idfacebook" type="text" name="id_facebook" class="form-control" value="'.$id_facebook.'">
<span class="input-group-btn">
    <button id="idfacebookOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>
</div>

<div class="form-group">
<label>Id Google Map</label>
<div id="id_map" style="cursor:pointer;"><span class="text-info">'.htmlentities($row_site['google_map']).'</span></div>
<div id="idmap" style="display:none;">
<textarea id="text_idmap" class="form-control" name="id_map" rows="3">'.$row_site['google_map'].'</textarea>
<button id="idmapOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</div>
</div>
</form>';

$filename_meta = "../sw-library/meta-social.txt";
        if (file_exists("$filename_meta")){
        $fh_meta = fopen($filename_meta, "r") or die("Could not open file!");
        $data_meta = fread($fh_meta, filesize($filename_meta)) or die("Could not read file!");
        fclose($fh_meta);     
echo'<br><hr>
Meta Sosial (klik pada editor jika tidak menampilkan data)
<br><br>
<style type="text/css">
.CodeMirror { height: 300px; }
.CodeMirror-matchingtag { background: #4d4d4d; }
.breakpoints { width: .8em; }
.breakpoint { color: #3498db; }
</style>
<form method="post" action="'.$gotoprocess.'" autocomplete="off">
    <input type="hidden" name="modul" value="setting">
    <input type="hidden" name="aksi" value="metasocial">
    <textarea class="form-control" id="swcodemirror" name="meta_content" style="width:100%; height:300px;">'.$data_meta.'</textarea>
    <div class="form-group form-actions"><br>
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit Meta</button>
    </div>
</form>';}
echo'
</div>
</div>';?>

<?php 
echo'
<div class="tab-pane '.$tab_post.'" id="post">
<div class="block-section clearfix">';
echo'<form id="validate" class="form-bordered" action="'.$gotoprocess.'" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Format Tanggal</label>
<div id="format_tanggal" style="cursor:pointer;">';
if($timezone == 'ID'){echo''.tgl_indo($tanggal).' '.$jam_sekarang.'';}
else{echo $tgl_jam;}echo'</div>
<div id="formattanggal" style="display:none;">
<div class="input-group">
<select id="text_formattanggal" name="timezone" class="form-control">
<option value="ID">'.tgl_indo($tanggal).' '.$jam_sekarang.'</option>
<option value="US">'.$tgl_jam.'</option>
</select>
<span class="input-group-btn">
<button id="formattanggalOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button>
</span>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
 <div class="form-group">
<label>Item Per Artikel</label>
<div id="item_artikel" style="cursor:pointer;">'.$item_artikel.'</div>
<div id="itemartikel" style="display:none;">
<div class="input-group">
<input id="text_itemartikel" type="number" name="item_artikel" class="form-control" value="'.$item_artikel.'">
<span class="input-group-btn"><button id="itemartikelOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Item Related Artikel</label>
<div id="item_related_artikel" style="cursor:pointer;">'.$item_related_artikel.'</div>
<div id="itemrelatedartikel" style="display:none;">
<div class="input-group">
<input id="text_itemrelatedartikel" type="number" name="item_related_artikel" class="form-control" value="'.$item_related_artikel.'">
<span class="input-group-btn"><button id="itemrelatedartikelOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
 <div class="form-group">
<label>Item Per Produk</label>
<div id="item_produk" style="cursor:pointer;">'.$item_produk.'</div>
<div id="itemproduk" style="display:none;">
<div class="input-group">
<input id="text_itemproduk" type="number" name="item_produk" class="required number form-control" value="'.$item_produk.'">
<span class="input-group-btn"><button id="itemprodukOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
 <div class="form-group">
<label>Item Related Produk</label>
<div id="item_related_produk" style="cursor:pointer;">'.$item_related_produk.'</div>
<div id="itemrelatedproduk" style="display:none;">
<div class="input-group">
<input id="text_itemrelatedproduk" type="number" name="item_related_produk" class="required number form-control" value="'.$item_related_produk.'">
<span class="input-group-btn"><button id="itemrelatedprodukOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div>
</div>
</div>
</div>

<div class="col-sm-6">
 <div class="form-group">
<label>Komentar Mode</label>
<div id="komentar_mode" style="cursor:pointer;">'.$komentar_mode.'</div>
<div id="komentarmode" style="display:none;">
<div class="input-group">
<select id="text_komentarmode" name="komentar_mode" class="form-control" required>
<option value="Y">Y</option>
<option value="N">N</option>
</select>
<span class="input-group-btn"><button id="komentarmodeOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div>
</div>
</div>
</div>
</div>

</form>';
$filename_komentar = "../sw-library/komentar.txt";
        if (file_exists("$filename_komentar")){
        $fh_komentar = fopen($filename_komentar, "r") or die("Could not open file!");
        $data_komentar = fread($fh_komentar, filesize($filename_komentar)) or die("Could not read file!");
        fclose($fh_komentar);     
echo'<br><hr>
Silahkan paste kode plugin komentar anda di sini, anda bisa menggunakan plugin komentar Disqus atau Facebook
<br><br>
<style type="text/css">
.CodeMirror { height:200px; }
.CodeMirror-matchingtag { background: #4d4d4d; }
.breakpoints { width: .8em; }
.breakpoint { color: #3498db; }
</style>
<form method="post" action="'.$gotoprocess.'" autocomplete="on">
    <input type="hidden" name="modul" value="setting">
    <input type="hidden" name="aksi" value="komentar">
    <textarea class="form-control" id="swcodemirror2" name="meta_content" style="width:100%; height:200px;">'.$data_komentar.'</textarea>
    <div class="form-group form-actions"><br>
<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
    </div>
</form>';}
echo'
</div>
</div>';

// Mail
echo'<div class="tab-pane" id="email">
<div class="block-section clearfix">
<form id="validate" action="#" method="POST" role="form">
<div class="table-responsive">
<table class="table table-vcenter table-striped table-borderess table-hover">
<tbody>
<tr>
<td width="300">Email Info</td>
<td>
<div id="mail_info" style="cursor:pointer;">'.$mail_info.'</div>
<div id="mailinfo" style="display:none;">
<div class="input-group col-md-5">
<input id="text_mailinfo" type="mail" name="mail_info" class="form-control " value="'.$mail_info.'" required>
<span class="input-group-btn"><button id="mailinfoOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div></div>
</td>
</tr>
<tr>
<td width="300">Email No Reply</td>
<td>
<div id="mail_noreply" style="cursor:pointer;">'.$mail_noreply.'</div>
<div id="mailnoreply" style="display:none;">
<div class="input-group col-md-5">
<input id="text_mailnoreply" type="mail" name="mail_noreply" class="form-control " value="'.$mail_noreply.'" required>
<span class="input-group-btn"><button id="mailnoreplyOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div></div>
</td>
</tr>

<tr>
<td width="300">Protocol</td>
<td>
<div id="protocol" style="cursor:pointer;">'.$protocol.'</div>
<div id="proto" style="display:none;">
<div class="input-group col-md-5">
<select id="text_proto" name="protocol" class="form-control" required="required">
    <option value="SMPT">SMPT</option>
    <option value="mail">Mail</option>
</select>
<span class="input-group-btn"><button id="protoOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div></div>
</td>
</tr>

<tr>
<td width="300">Hostname</td>
<td>
<div id="hostname" style="cursor:pointer;">'.$hostname.'</div>
<div id="hostn" style="display:none;">
<div class="input-group col-md-5">
<input id="text_hostn" type="text" name="hostname" class="form-control" value="'.$hostname.'" required>
<span class="input-group-btn"><button id="hostnOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div></div>
</td>
</tr>

<tr>
<td width="300">Username</td>
<td>
<div id="usermail" style="cursor:pointer;">'.$usermail.'</div>
<div id="userm" style="display:none;">
<div class="input-group col-md-5">
<input id="text_userm" type="text" name="hostname" class="form-control" value="'.$usermail.'" required>
<span class="input-group-btn"><button id="usermOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div></div>
</td>
</tr>

<tr>
<td width="300">Password</td>
<td>
<div id="passmail" style="cursor:pointer;">'.$passmail.'</div>
<div id="passm" style="display:none;">
<div class="input-group col-md-5">
<input id="text_passm" type="text" name="hostname" class="form-control" value="'.$passmail.'" required>
<span class="input-group-btn"><button id="passmOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div></div>
</td>
</tr>

<tr>
<td width="300">Port</td>
<td>
<div id="portmail" style="cursor:pointer;">'.$portmail.'</div>
<div id="portm" style="display:none;">
<div class="input-group col-md-5">
<input id="text_portm" type="text" name="hostname" class="form-control" value="'.$portmail.'" required>
<span class="input-group-btn"><button id="portmOK" class="btn btn-primary" type="button"><i class="fa fa-check"></i></button></span>
</div></div>
</td>
</tr>
</tbody>
</table>
</div>
</form>
</div>
</div>';?>

<?php echo'
<div class="tab-pane" id="backup_DB">
<div class="block-section clearfix">
<form action="'.$gotoprocess.'" method="post">
<div class="form-group">
<label class="col-md-2">'._e('Backup').'</label>
<div class="col-md-10">
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="backup">
<button type="submit" name="backup" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> '._e('Download Backup').'</button>
</div>
</div>
</form>
</div>
</div>';?>
</div>
</div>
<?PHP } else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}?>
<?php break; } }else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';
}}