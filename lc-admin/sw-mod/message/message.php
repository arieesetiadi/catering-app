<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/".$mod."/proses.php";
$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='24' AND level_id='$level_user'"; 
$result_role = $connection->query($query_role);
if($result_role->num_rows > 0){
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);
$message='';
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}

$inbox="SELECT msg_id,msg_name,msg_subject,msg_time,msg_status from message where msg_type='1' order by msg_id DESC";//pesan masuk
$r_inbox = $connection->query($inbox);
$j_inbox = $r_inbox->num_rows;
#-------------------------------------------------------------------------------------------------------------
$sent="SELECT msg_id,msg_name,msg_mail,msg_subject,msg_time,msg_status from message where msg_type='2' order by msg_id DESC";// pean terkirim
$r_sent = $connection->query($sent);
$j_sent = $r_sent->num_rows;
 #-------------------------------------------------------------------------------------------------------------
$draft="SELECT msg_id,msg_name,msg_subject,msg_time,msg_status from message where msg_type='3' order by msg_id DESC";// pesan tersimpan
$r_draft = $connection->query($draft);
$j_draft = $r_draft->num_rows;

$q_delet="SELECT msg_id,msg_name,msg_subject,msg_time,msg_status from message where msg_type='4' order by msg_id DESC";// pean terhapus
$r_delet = $connection->query($q_delet);
$j_delet = $r_delet->num_rows;
switch(@$_GET['op']){ default:?>
<?php 
echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-envelope"></i>'._e('Inbox').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Inbox').'</li>
</ul>';

if($write_access =='Y'){
echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';
echo'
<!-- Inbox Content -->
<div class="row">
<div class="col-sm-4 col-lg-3">';
require_once'./sw-mod/'.$mod.'/function.php';
echo'
</div>
<!-- END Menu Block -->';?>

<?php
echo'<!-- Messages List -->
<div class="col-sm-8 col-lg-9">
<!-- Messages List Block -->
<div class="block">
<!-- Messages List Title -->
<div class="block-title">
<h2>Inbox <strong>('.$j_inbox.')</strong></h2>
</div>
<!-- END Messages List Title -->

<div class="table-responsive">
<form id="validate" name="form1" method="post" action="'.$gotoprocess.'" method="post">
<input type="hidden" name="modul" value="message">
<input type="hidden" name="aksi" value="trash" readonly>
<table class="table table-hover table-vcenter">
<thead>
<tr>
<td class="text-center" width="8">
<input type="checkbox" id="selecctall" data-toggle="tooltip" title="Select All" />
</td>
<td colspan="3">
<div class="btn-group btn-group-sm">';
if($delete_access == 'Y'){
    echo'
<button type="button" data-toggle="modal" data-target="#modal-deleted" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';}
else {
    echo'
<button type="button" data-toggle="modal" data-target="#akses" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';
}
echo'
</div>
</td>
<td class="text-right" colspan="2">
</td>
</tr>
</thead>

<tbody>';
if($r_inbox->num_rows > 0){
while($rows= $r_inbox->fetch_assoc()){
extract($rows);
echo'
<tr>
<td class="text-center" style="width: 30px;">
<input type="checkbox" class="multicheck" name="item[]" value="'.$msg_id.'">
</td>

<td class="text-center" style="width: 30px;">';
if($msg_status == 'N'){
echo'<a href="javascript:void(0)" class="text-primary msg-read-btn"><i class="fa fa-circle"></i></a>';}
 else {
    echo'<a href="javascript:void(0)" class="text-muted msg-read-btn"><i class="fa fa-circle"></i></a>';
}
echo'
</td>

<td style="width: 20%;">
<a class="themed-color-night" href="?mod=message&op=open&id='.$msg_id.'">'.$msg_name.' <i class="fa fa-caret-right"></i><br> Admin</a></td>
<td>
<span class="text-muted">'.$msg_subject.'</span>
</td>
    </td>
<td class="text-right" style="width: 90px;"><em>'.$msg_time.'</em></td>
</tr>';}}
else{
  echo' <tr>
<td colspan="5"><div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada Pesan Masuk</p></div></td></tr>';}
echo'</tbody></table>

<!-- multi deleted -->
<div class="modal fade" id="modal-deleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> '._e('Delete').'</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div>
</div>
    </form>
</div>
</div>
<!-- END Messages List Block -->
</div>
</div>
<!-- END Inbox Content -->';
} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}?>
<?php
break; case 'open': ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="fa fa-eye"></i>'._e('View Message').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'">'._e('Inbox').'</a></li>
<li>'._e('View Message').'</li>
</ul>';
if($write_access =='Y'){
echo'
<!-- Inbox Content -->
<div class="row">
<div class="col-sm-4 col-lg-3">';
require_once'./sw-mod/'.$mod.'/function.php';
echo'
</div>
<!-- END Menu Block -->';?>

<!-- View Message -->
<div class="col-sm-8 col-lg-9">
<?php
if(!empty($_GET['id'])){
$id= mysqli_real_escape_string($connection, $_GET['id']); 
$query_read="SELECT * from message where msg_id='$id'";
$result_read = $connection->query($query_read);
if($result_read->num_rows > 0){
while($rows= $result_read->fetch_assoc()){
extract($rows);
$up=mysqli_query($connection,"UPDATE message SET msg_status='Y' WHERE msg_id='$id'");
echo'<!-- View Message Block -->
<div class="block full">
<!-- View Message Title -->
<div class="block-title">
<div class="block-options pull-right">
<a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="'._e('Delete').'"><i class="fa fa-times"></i></a>
</div>
</div>

<!-- Message Meta -->
<table class="table table-borderless table-vcenter remove-margin">
<tbody>
<tr>
<td class="text-center" style="width: 80px;">
<a href="#" class="pull-left">
<img src="sw-assets/img/default-avatar.jpg" alt="Avatar" class="img-circle">
</a>
</td>
<td class="hidden-xs">
<strong>'.$msg_name.'</strong><br>'.$msg_mail.'
</td>
<td class="text-right">
<strong>
'.$msg_time.'
</strong></td>
</tr>
</tbody>
</table>
<hr>
<!-- Message Body -->
<p>Subject <strong>'.$msg_subject.'</strong></p>
'.$msg_content.'
<hr>
<address>
<strong>Pengirim.</strong><br>
'.$msg_mail.'<br>
Ke<br>'.$site_name.'</address>
<hr>
<!-- END Message Body -->

<!-- Quick Reply Form -->
<form method="post" id="validate" class="form-horizontal form-bordered" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="message">
<input type="hidden" name="aksi" value="reply">
<input type="hidden" name="id" value="'.$id.'" readonly>
<input type="hidden" name="msg_mail" value="'.$msg_mail.'" readonly>
<div class="form-group">
<label class="col-md-3 col-lg-2 control-label" for="compose-to">Subject</label>
<div class="col-md-9 col-lg-10">
<input type="msg_subject" id="compose-to" name="msg_subject" class="required form-control form-control-borderless" placeholder="Subject" value="'.$msg_subject.'">
</div>
</div>

<div class="form-group">
<div class="col-md-9 col-lg-12">
<textarea id="compose-message" name="msg_content" rows="10" class="required form-control textarea-editor" placeholder="Your message..">
</textarea>
</div>
</div>
<div class="form-group form-actions">
<div class="col-md-12 col-lg-12">
<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Reply</button>
<button type="button" class="btn btn-sm btn-default" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
</div>
</div>
</form>
<!-- END Quick Reply Form -->

</div>
<!-- END View Message Block -->';}}
else{echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada Pesan yg ditemukan</p></div>';}}
echo'
</div>
<!-- END View Message -->
</div>
<!-- END Page Content -->';} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}?>

<?php
break; case 'compose': ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-pencil"></i>'._e('Compose Message').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'">'._e('Inbox').'</a></li>
<li>'._e('Compose Message').'</li>
</ul>';
if($read_access =='Y'){
    echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';
echo'

<!-- Inbox Content -->
<div class="row">
<div class="col-sm-4 col-lg-3">';
require_once'./sw-mod/'.$mod.'/function.php';
echo'
</div>
<!-- END Menu Block -->';?>
<?php
echo'<!-- Messages List -->
<div class="col-sm-8 col-lg-9">
<!-- Messages List Block -->
<div class="block">
<!-- Messages List Title -->
<div class="block-title">
<h2>Compose <strong>Message</strong></h2>
</div>
<!-- END Messages List Title -->
<!-- Messages List Content -->
<div class="table-responsive">
<!-- Compose Message Content -->';
if(!empty($_GET['read'])){
$read= mysqli_real_escape_string($connection, $_GET['read']); 
$query_read="SELECT * from message where msg_id='$read'";
$result_read = $connection->query($query_read);
if($result_read->num_rows > 0){
while($rows= $result_read->fetch_assoc()){
extract($rows);
echo'
<form method="post" id="validate" class="form-horizontal form-bordered" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="message">
<input type="hidden" name="id" value="'.$msg_id.'">
<div class="form-group">
<label class="col-md-3 col-lg-2 control-label" for="compose-to">To</label>
<div class="col-md-9 col-lg-10">
<input type="email" id="compose-to" name="msg_mail" class="required form-control form-control-borderless" value="'.$msg_mail.'" placeholder="Email">
</div>
</div>

<div class="form-group">
<label class="col-md-3 col-lg-2 control-label" for="compose-msg_subject">Subject</label>
<div class="col-md-9 col-lg-10">
<input type="text" id="compose-msg_subject" name="msg_subject" class="required form-control form-control-borderless" value="'.$msg_subject.'" placeholder="subject..">
</div>
</div>
<div class="form-group">
<label class="col-md-3 col-lg-2 control-label" for="compose-message">Message</label>
<div class="col-md-9 col-lg-10">';


if($msg_tab =='1'){
echo'<textarea id="compose-message" name="msg_content" rows="15" class="required form-control textarea-editor" placeholder="Your message.." required>'.htmlentities($msg_content).'
</textarea>';}
else{
echo'<input type="hidden" name="filename" value="'.$msg_content.'">';
    echo'<div class="alert alert-success alert-alt">Anda akan mengirim ulang email dengan template : 
    <b>'.$msg_content.'</b>
</div>';
}

echo'</div>
</div>
<div class="form-group form-actions">
<div class="col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2">';
if($msg_type !=='3'){
    if($msg_tab =='1'){
echo'<button type="submit" name="sendA" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Resending</button>';
}
else{
 echo'<button type="submit" name="sendB" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Resending</button>';   
}

}
else{
    echo'<button type="submit" name="sendupdate" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Send</button>';
}
echo'
    <button type="button" class="btn btn-sm btn-default" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
</div>
</div>
</form>';}}} else {
 
echo'<form method="post" id="validate" class="form-horizontal form-bordered" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="message">

<div class="form-group">
<label class="col-md-3 col-lg-2 control-label" for="compose-to">To</label>
<div class="col-md-9 col-lg-10">
<input type="text" name="msg_mail" id="example-tags"  class="input-tags" placeholder="Email" style="width:100%" required>
</div>
</div>

<div class="form-group">
<label class="col-md-3 col-lg-2 control-label" for="compose-msg_subject">Subject</label>
<div class="col-md-9 col-lg-10">
<input type="text" id="compose-msg_subject" name="msg_subject" class="required form-control form-control-borderless" placeholder="Subject" required>
</div>
</div>
<div class="form-group">
<label class="col-md-3 col-lg-2 control-label" for="compose-message">Message</label>
<div class="col-md-9 col-lg-10">
<!-- Default Tabs -->
<ul class="nav nav-tabs nav-tabs-simple" data-toggle="tabs">
<li class="active">
<a href="#editor"><i class="fa fa-pencil"></i> Editor</a></li>
<li><a href="#template"><i class="fa  fa-building-o"></i> Template</a></li>

</ul>
<div class="tab-content" style="padding:4px 0px!important;">
<div class="tab-pane active" id="editor">
<textarea id="compose-message" name="msg_content" rows="15" class="form-control textarea-editor" placeholder="Your message..">
</textarea>
<div class="form-group form-actions">
    <button type="submit" name="sendA" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Send</button>
    <button type="submit" name="save" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Save Draft</button>
</div>

</div>

<div class="tab-pane" id="template">
<!-- menampilkan tabel template -->';
$query="SELECT name,filename FROM message_theme where active='1' order by id DESC"; 
$result = $connection->query($query);
if($result->num_rows > 0){
echo'<div class="table-responsive">
<table class="table table-hover">
    <thead>
        <tr>
        <th class="text-center"><i class="fa fa-check-circle-o"></i></th>
            <th>Name</th>
            <th>Filename</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>';
while($Ar= $result->fetch_assoc()){

echo'<tr>
   <td style="width:80px;">
<div class="text-center">
<input type="radio" name="filename" value="'.$Ar['filename'].'">
</div></td>
    <td>'.$Ar['name'].'</td>
    <td>'.$Ar['filename'].'</td>
    <td><div class="btn-group btn-group-xs"><a href="javascript:void(0)" class="btn btn-xs btn-warning enable-tooltip" title="View Demo">
    <i class="fa  fa-search-plus"></i></a></div></td>
    </tr>';}
echo'
    </tbody>
</table>';
echo'</div>
<div class="form-group form-actions">
    <button type="submit" name="sendB" class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Send</button>
</div>';}
    else{echo' <div class="alert alert-success alert-alt">
Template  Message Belum tersedia</div>';}
    echo'
</div>
</div>
<!-- END Default Tabs -->
</div>
</div>
</form>';}
echo'
</div>
</div>
<!-- END Messages List Block -->
</div>
</div>
<!-- END Inbox Content -->';
} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}?>
<?php
break; case 'sent': ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-envelope"></i>'._e('Sent Message').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'"> '._e('Inbox').'</a></li>
<li>'._e('Sent Message').'</li>
</ul>';
echo'
<!-- Inbox Content -->
<div class="row">
<div class="col-sm-4 col-lg-3">';
require_once'./sw-mod/'.$mod.'/function.php';
echo'
</div>
<!-- END Menu Block -->';?>

<?php
echo'<!-- Messages List -->
<div class="col-sm-8 col-lg-9">
<!-- Messages List Block -->
<div class="block">
<!-- Messages List Title -->
<div class="block-title">
<h2>Sent <strong>('.$j_sent.')</strong></h2>
</div>
<!-- END Messages List Title -->
<!-- Messages List Content -->
<div class="table-responsive">
<form id="validate" name="form1" method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="message">
<input type="hidden" name="aksi" value="trashsent" readonly>
<table class="table table-hover table-vcenter">
<thead>
<tr>
<td class="text-center" width="8">
<input type="checkbox" id="selecctall" data-toggle="tooltip" title="Select All" />
</td>
<td colspan="3">
<div class="btn-group btn-group-sm">';
if($delete_access == 'Y'){
    echo'
<button type="button" data-toggle="modal" data-target="#modal-deleted" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';}
else {
    echo'
<button type="button" data-toggle="modal" data-target="#akses" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';
}
echo'
</div>
</td>
<td class="text-right" colspan="2">
</td>
</tr>
</thead>
<tbody>';
if($r_sent->num_rows > 0){
while($rows= $r_sent->fetch_assoc()){
extract($rows);
echo'
<tr>
<td class="text-center" style="width: 30px;">
<input type="checkbox" class="multicheck" name="item[]" value="'.$msg_id.'">
</td>

<td class="text-center" style="width: 30px;">';
if($msg_status == 'N'){
echo'<a href="javascript:void(0)" class="text-primary msg-read-btn"><i class="fa fa-circle"></i></a>';} else {
    echo'<a href="javascript:void(0)" class="text-muted msg-read-btn"><i class="fa fa-circle"></i></a>';
}
echo'
</td>

<td style="width: 20%;">
<a class="themed-color-night" href="?mod=message&op=compose&read='.$msg_id.'">Admin <i class="fa fa-caret-right"></i><br> '.$msg_mail.'</a></td>
<td>
<span class="text-muted">'.$msg_subject.'</span>
</td>
    </td>
<td class="text-right" style="width: 90px;"><em>'.$msg_time.'</em></td>
</tr>';}}
else{
  echo' <tr>
<td colspan="5"><div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada Pesan Terkirim</p></div></td></tr>';}
echo'
        </tbody>
    </table>
<!-- multi deleted -->
<div class="modal fade" id="modal-deleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> '._e('Delete').'</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div>
</div>
</form>
</div>
</div>
<!-- END Messages List Block -->
</div>
</div>
<!-- END Inbox Content -->';?>

<?php
break; case 'drafts': ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-envelope"></i>'._e('Drafts Message').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'"> '._e('Inbox').'</a></li>
<li>'._e('Drafts Message').'</li>
</ul>';
echo'
<!-- Inbox Content -->
<div class="row">
<div class="col-sm-4 col-lg-3">';
require_once'./sw-mod/'.$mod.'/function.php';
echo'
</div>
<!-- END Menu Block -->';?>

<?php
echo'<!-- Messages List -->
<div class="col-sm-8 col-lg-9">
<!-- Messages List Block -->
<div class="block">
<!-- Messages List Title -->
<div class="block-title">
<h2>Draft <strong>('.$j_draft.')</strong></h2>
</div>
<!-- END Messages List Title -->
<!-- Messages List Content -->
<div class="table-responsive">
<form id="validate" name="form2" method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="message">
<input type="hidden" name="aksi" value="trashdraft" readonly>
<table class="table table-hover table-vcenter">
<thead>
<tr>
<td class="text-center" width="8">
<input type="checkbox" id="selecctall" data-toggle="tooltip" title="Select All"/>
</td>
<td colspan="3">
<div class="btn-group btn-group-sm">';
if($delete_access == 'Y'){
    echo'
<button type="button" data-toggle="modal" data-target="#modal-deleted" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';}
else {
    echo'
<button type="button" data-toggle="modal" data-target="#akses" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';
}
echo'
</div>
</td>
<td class="text-right" colspan="2">
</td>
</tr>
</thead>
<tbody>';
if($r_draft->num_rows > 0){
while($rows= $r_draft->fetch_assoc()){
extract($rows);
echo'
<tr>
<td class="text-center" style="width: 30px;">
<input type="checkbox" class="multicheck" name="item[]" value="'.$msg_id.'">
</td>

<td class="text-center" style="width: 30px;">';
if($msg_status == 'N'){
echo'<a href="javascript:void(0)" class="text-primary msg-read-btn"><i class="fa fa-circle"></i></a>';} else {
    echo'<a href="javascript:void(0)" class="text-muted msg-read-btn"><i class="fa fa-circle"></i></a>';
}
echo'
</td>

<td style="width: 20%;"><a class="themed-color-night" href="?mod=message&op=compose&read='.$msg_id.'">'.$msg_name.'</a>
</td>
<td>
<span class="text-muted">'.$msg_subject.'</span>

</td>
    </td>
<td class="text-right" style="width: 90px;"><em>'.$msg_time.'</em></td>
</tr>';}}
else{
  echo' <tr>
<td colspan="5"><div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada Pesan Tersimpan</p></div></td></tr>';}
echo'
        </tbody>
    </table>

    <!-- multi deleted -->
<div class="modal fade" id="modal-deleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> '._e('Delete').'</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div>
</div>

    </form>
</div>
</div>
<!-- END Messages List Block -->
</div>
</div>
<!-- END Inbox Content -->';?>

<?php
break; case 'trash': ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-envelope"></i>'._e('Trash Message').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'"> '._e('Inbox').'</a></li>
<li>'._e('Trash Message').'</li>
</ul>';
echo'
<!-- Inbox Content -->
<div class="row">
<div class="col-sm-4 col-lg-3">';
require_once'./sw-mod/'.$mod.'/function.php';
echo'
</div>
<!-- END Menu Block -->';?>
<?php
echo'<!-- Messages List -->
<div class="col-sm-8 col-lg-9">
<!-- Messages List Block -->
<div class="block">
<!-- Messages List Title -->
<div class="block-title">
<h2>Trash <strong>('.$j_delet.')</strong></h2>
</div>
<!-- END Messages List Title -->
<!-- Messages List Content -->
<div class="table-responsive">
<form id="validate" name="form" method="post" action="'.$gotoprocess.'">
<input type="hidden" name="modul" value="message">
<input type="hidden" name="aksi" value="multidelete" readonly>
<table class="table table-hover table-vcenter">
<thead>
<tr>
<td class="text-center" width="8">
<input type="checkbox" id="selecctall" data-toggle="tooltip" title="Select All" />
</td>
<td colspan="3">
<div class="btn-group btn-group-sm">';
if($delete_access == 'Y'){
    echo'
<button type="button" data-toggle="modal" data-target="#modal-deleted" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';}
else {
    echo'
<button type="button" data-toggle="modal" data-target="#akses" class="btn btn-default"><i class="fa fa-times"></i> '._e('Delete').'</button>';
}
echo'
</div>
</td>
<td class="text-right" colspan="2">
</td>
</tr>
</thead>
<tbody>';
if($r_delet->num_rows > 0){
while($rows= $r_delet->fetch_assoc()){
extract($rows);
echo'
<tr>
<td class="text-center" style="width: 30px;">
<input type="checkbox" class="multicheck" name="item[]" value="'.$msg_id.'">

</td>

<td class="text-center" style="width: 30px;">';
if($msg_status == 'N'){
echo'<a href="javascript:void(0)" class="text-primary msg-read-btn"><i class="fa fa-circle"></i></a>';} else {
    echo'<a href="javascript:void(0)" class="text-muted msg-read-btn"><i class="fa fa-circle"></i></a>';
}
echo'
</td>

<td style="width: 20%;"><a class="themed-color-night" href="?mod=message&op=compose&read='.$msg_id.'">'.$msg_name.'</a></td>
<td>
<span class="text-muted">'.$msg_subject.'</span>
</td>
    </td>
<td class="text-right" style="width: 90px;"><em>'.$msg_time.'</em></td>
</tr>';}}
else{
  echo' <tr>
<td colspan="5"><div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada Pesan Terhapus</p></div></td></tr>';}
echo'
        </tbody>
    </table>
        <!-- multi deleted -->
<div class="modal fade" id="modal-deleted" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> '._e('Delete').'</button>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div>
</div>

    </form>
</div>
</div>
<!-- END Messages List Block -->
</div>
</div>
<!-- END Inbox Content -->';?>

<?php
break; case 'edit-theme': ?>
<?php echo'
<div class="content-header">
<div class="header-section">
<h1><i class="gi gi-envelope"></i>'._e('Theme Message').'<br></h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li><a href="./?mod='.$mod.'"> '._e('Message').'</a></li>
<li>'._e('Theme Message').'</li>
</ul>';
echo'
<!-- Inbox Content -->
<div class="row">
<div class="col-sm-4 col-lg-3">';
require_once'./sw-mod/'.$mod.'/function.php';
echo'
</div>
<!-- END Menu Block -->';?>

<?php
echo'<!-- Messages List -->
<div class="col-sm-8 col-lg-9">
<!-- Messages List Block -->
<div class="block">
<!-- Messages List Title -->
<div class="block-title">
<h2>Edit <strong>Theme Messages</strong></h2>
</div>';
if(!empty($_GET['id'])){
$id=mysqli_real_escape_string($connection,$_GET['id']); 
$update = "SELECT id,name,filename FROM message_theme WHERE id='$id'";
$result_update = $connection->query($update) or die($connection->error.__LINE__);
if($result_update->num_rows > 0){
 while($row=$result_update->fetch_assoc()){
extract($row);
$file="../sw-content/upload/mail/$filename";
   if (file_exists("$file")){
$fh_file = fopen($file, "r") or die("Could not open file!");
$data_file = fread($fh_file, filesize($file)) or die("Could not read file!");
        fclose($fh_file );
echo'
<form method="post" action="'.$gotoprocess.'" autocomplete="on">
<input type="hidden" name="modul" value="'.$mod.'">
<input type="hidden" name="aksi" value="edit_theme" readonly>
<input type="hidden" name="id" value="'.$id.'" readonly>
<input type="hidden" name="filename" value="'.$filename.'" readonly>
<div class="form-group">
<label>'._e('Name').'</label>
<input type="text" name="name" class="required form-control" placeholder="Name" value="'.$name.'">
</div>
<hr>
<style type="text/css">
.CodeMirror { height:500px; }
.CodeMirror-matchingtag { background: #4d4d4d; }
.breakpoints { width: .8em; }
.breakpoint { color: #3498db; }
</style>

<div class="form-group">
<label>'._e('Content').'</label>
<textarea class="form-control" id="swcodemirror" name="content" style="width:100%; height:500px;">'.$data_file.'</textarea>
</div>
<hr>
<div class="form-group form-actions">
<button type="submit" class="btn btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>
<button type="button" class="btn btn-warning" onClick="self.history.back();"><i class="fa fa-history"></i> '._e('Back').'</button>
</div>
</form>';
}}} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}
}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}
echo'</div>
<!-- END Messages List Block -->
</div>
</div>
<!-- END Inbox Content -->';?>

<?php break;
}
}else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}

echo'<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>'._e('Are you sure you want to delete ..?').'</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> '._e('Delete').'</a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>

<!-- Modal akses -->
<div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> '._e('Deleted').'</h4></div>
<div class="modal-body">
<p>Anda tidak memiliki hak akses.!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> '._e('Cancel').'</button>
</div></div></div></div>';
}
?>
