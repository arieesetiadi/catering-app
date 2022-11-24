<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header( 'location: ../../login' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include( '../../../sw-library/sw-function.php');

$config = get_parse_ini('../../../sw-library/config.ini.php');
require_once '../../../sw-library/ini.php';
$ini_file = "../../../sw-library/config.ini.php";
$allowed_ext = array('html');
$modul='';
$aksi='';

if(!empty($_POST['modul'])){
$modul = $_POST['modul'];
}

if(!empty($_POST['aksi'])){
$aksi = $_POST['aksi'];
}

// Proses Add
if ( $modul =='message' AND $aksi == 'add_theme'){
$error = array();
if (empty($_POST['name'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$name = mysqli_real_escape_string($connection,$_POST['name']);
    }

if (empty($_POST['active'])) {
  $status='2';
}else{
 $active =strip_tags($_POST['active']); 
}
    /*----------  LAMPIRAN  ----------*/
        $filename  = $_FILES['filename']['name'];
        $tipe  = strtolower(end(explode('.',$filename)));
        $file_tmp   = $_FILES['filename']['tmp_name'];
        $file_size  = $_FILES['filename']['size'];

if (empty($error)) { 
  if(in_array($tipe, $allowed_ext) === true){
  if($file_size < 1044070){

$extension = getExtension($filename);
$extension = strtolower($extension);
$filename =seo_title($filename);
$filename ="theme-".$filename.".".$extension."";
$lokasi = '../../../sw-content/upload/mail/'.$filename.'';
$tambah="INSERT INTO message_theme (name,
                              filename,     
                              date,
                              active)
                              values('$name', 
                                '$filename', 
                                '$date',
                                '$active')" or die($connection->error.__LINE__); 
          if($connection->query($tambah) === false) { 
          _goto( '../../?mod='.$modul.'');
          $_SESSION['message'] ='Theme E-mail Tidak dapat di publish...!';
          } else {
          _goto( '../../?mod='.$modul);
          move_uploaded_file($file_tmp, $lokasi);
          $_SESSION['message']='';
          } }
          else {
           _goto( '../../?mod='.$modul.'');
            $_SESSION['message'] ='File yang di unggah terlalu besar Maksimal Size 1MB..!';
          }
      }else{
         _goto( '../../?mod='.$modul.'');
            $_SESSION['message'] ='File yang di unggah tidak sesuai dengan format, Berkas harus berformat .html.!';
        }

          }else{
          foreach ($error as $key => $values) {            
           _goto( '../../?mod='.$modul.'');
            echo $values;
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
 }}}

elseif ($modul =='message' AND $aksi == 'edit_theme'){
  $id = strip_tags($_POST['id']);
$error = array();
if (empty($_POST['name'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$name = mysqli_real_escape_string($connection,$_POST['name']);
    }
$filename = strip_tags($_POST['filename']);
if (empty($error)) { 
  $file_data ='../../../sw-content/upload/mail/'.$filename.'';
$update="UPDATE message_theme SET name='$name' WHERE id='$id'" or die($conn->error.__LINE__); 
if($connection->query($update) === false) { 
  die($connection->error.__LINE__); 
_goto('../../?mod='.$modul.'&op=edit-theme&id='.$id.'');
// error
$_SESSION['message'] ='Theme Message Tidak dapat di ubah...!';
} else   {

_goto('../../?mod='.$modul.'&op=edit-theme&id='.$id.''); // sukses
    if ( file_exists("$file_data") ){
      $data = $_POST['content'];
      $newdata = stripslashes($data);
      if ( $newdata != '' ){
        $fw = fopen($file_data, 'w' ) or die( 'Could not open file!' );
        $fb = fwrite( $fw, $newdata ) or die( 'Could not write to file' );
        fclose( $fw );
      }
    }

$_SESSION['message']='';
} }

else{
foreach ($error as $key => $values) {            
_goto('../../?mod='.$modul.'&op=edit-theme&id='.$id.'');
 $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}
}


if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection, $_GET['id']);
if ($aksi=='delete-theme'){

$cari= mysqli_query($connection,"SELECT filename from message_theme where id='$id'");
$data=mysqli_fetch_assoc($cari);
$filename_del=strip_tags($data['filename']);
$tmpfile = "../../../sw-content/upload/mail/".$filename_del;

$delete="DELETE FROM message_theme WHERE id='$id'"; 
if($connection->query($delete) === true) { 
_goto( '../../?mod=message'); // sukses
$_SESSION['message'] ='';
   if(file_exists("../../../sw-content/upload/mail/$filename_del")){
unlink ($tmpfile);
} else{}
} else { 
_goto( '../../?mod=message');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}


// Proses SetActive
if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection, $_GET['id']);
if ($aksi=='setactive'){
    $active = @$_GET['active'];
    $update="UPDATE message_theme SET active='$active' WHERE id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
 _goto( '../../?mod=message');
  $_SESSION['message'] ='Status tidak berhasil diubah..!';
}
else{ 
 _goto( '../../?mod=message');  
}}}


if (isset($_POST['sendA'])) {
$id=strip_tags($_POST['id']);
$msg_subject = mysqli_real_escape_string($connection,$_POST['msg_subject']); 
$_SESSION['msg_subject']=$msg_subject;

$msg_mail=$_POST['msg_mail']; 
 
$msg_content=mysqli_real_escape_string($connection,$_POST['msg_content']);
$_SESSION['msg_content']=$msg_content;

if($msg_subject && $msg_mail && $msg_content){
$pecah = explode(",",$msg_mail);
  $total = count( $pecah );
   for ($i=0; $i<$total; $i++) {
    $msg_mail= $pecah[$i];
$pesan = '<html><body>';
$pesan .='<style type="text/css">@media screen and (max-width:600px){table[class=container]{width:95%!important}}body{width:100%!important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}#backgroundTable{margin:0;padding:0;width:100%!important;line-height:100%!important}.bgItem{background: #eeeeee;padding:10px;border-top: solid 4px #00A1D9}hr{border:0px;border-bottom:dashed 1px #00A1D9; height: 0px;}img{outline:0;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block}h1,h2,h3,h4,h5,h6{color:#000!important}h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color:#00f!important}h1 a:active,h2 a:active,h3 a:active,h4 a:active,h5 a:active,h6 a:active{color:red!important}h1 a:visited,h2 a:visited,h3 a:visited,h4 a:visited,h5 a:visited,h6 a:visited{color:purple!important}table{mso-table-lspace:0;mso-table-rspace:0}a{color:#000}@media only screen and (max-device-width:480px){a[href^=tel],a[href^=sms]{text-decoration:none;color:#000;pointer-events:none;cursor:default}.mobile_link a[href^=tel],.mobile_link a[href^=sms]{text-decoration:default;color:orange!important;pointer-events:auto;cursor:default}}@media only screen and (min-device-width:768px) and (max-device-width:1024px){a[href^=tel],a[href^=sms]{text-decoration:none;color:#00f;pointer-events:none;cursor:default}.mobile_link a[href^=tel],.mobile_link a[href^=sms]{text-decoration:default;color:orange!important;pointer-events:auto;cursor:default}}h2{color:#181818;font-family:Helvetica,Arial,sans-serif;font-size:22px;line-height:22px;font-weight:400}a.link2,p{font-family:Helvetica,Arial,sans-serif;font-size:16px}a.link2{text-decoration:none;color:#fff;border-radius:4px}p{margin:1em 0;color:#555;line-height:160%}</style>';

    $pesan.='<table cellpadding="0" width="100%" cellspacing="0" border="0" id="backgroundTable" class="bgBody">
<tr>
<td>
<table cellpadding="0" width="620" class="container" align="center" cellspacing="0" border="0">
<tr>
<td>

<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
<tr>
<td class="movableContentContainer bgItem">

<div class="movableContent">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
  <tr height="40">
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
  </tr>
  <tr>
    <td width="200" valign="top">&nbsp;</td>
    <td width="200" valign="top" align="center">
      <div class="contentEditableContainer contentImageEditable">
              <div class="contentEditable" align="center" >
                  <img src="'.$site_url.'/sw-content/'.$site_logo.'" width="155" height="155"  alt="Logo"  data-default="placeholder" />
              </div>
            </div>
    </td>
    <td width="200" valign="top">&nbsp;</td>
  </tr>
  <tr height="25">
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
  </tr>
</table>
</div>

<div class="movableContent">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
  <tr>
    <td width="100%" colspan="3" align="center" style="padding-bottom:10px;padding-top:25px;">
      <div class="contentEditableContainer contentTextEditable">
              <div class="contentEditable" align="center" >
                  <h2>'.$site_name.'</h2>
              </div>
            </div>
    </td>
  </tr>
  <tr>
    <td width="100">&nbsp;</td>
    <td width="400" align="center">
      <div class="contentEditableContainer contentTextEditable">
              <div class="contentEditable" align="left">
                  <p >Hallo : '.$msg_name.'
                    <br/>Terimakasih sudah mengirim email kepada kami<br>
                    <br>'.htmlentities($msg_content).'</p>
                    <br>
                    <br>
                    <p>
                    Salam Kami,<br>
                    '.$site_name.'<br>
                    '.$site_office_address.' - Indonesia<br><br>
                    Kontak<br>
                    Telp : '.$site_phone.'<br>
                    Telp : '.$site_phone_2.'<br>
            </p>
              </div>
            </div>
    </td>
    <td width="100">&nbsp;</td>
  </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
  <tr>
    <td width="200">&nbsp;</td>
    <td width="200" align="center" style="padding-top:25px;">
      <table cellpadding="0" cellspacing="0" border="0" align="center" width="200" height="50">
        <tr>
          <td bgcolor="#ED006F" align="center" style="border-radius:4px;" width="200" height="50">
            <div class="contentEditableContainer contentTextEditable">
                      <div class="contentEditable" align="center" >
                          <a target="_blank" href="'.$site_url.'" class="link2">Click To Website</a>
                      </div>
                    </div>
          </td>
        </tr>
      </table>
    </td>
    <td width="200">&nbsp;</td>
  </tr>
</table>
</div>

<div class="movableContent">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
<tr>
<td width="100%" colspan="2" style="padding-top:65px;">
<hr style="height:1px;border:none;color:#333;background-color:#ddd;" />
</td>
</tr>
<tr>
<td width="60%" height="70" valign="middle" style="padding-bottom:20px;">
<div class="contentEditableContainer contentTextEditable">
  <div class="contentEditable" align="left" >
      <span style="font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;">Sent to ['.$site_email.'] by ['.$site_name.']</span>
    <br/>
    <span style="font-size:11px;color:#555;font-family:Helvetica, Arial, sans-serif;line-height:200%;">['.$site_office_address.'] | ['.$site_phone.']</span>
    <br/>
    <span style="font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;">
    <a target="_blank" href="#" style="text-decoration:none;color:#555">Balas Ke: '.$site_email.'</a>
    </span>
  </div>
  </div>
</td>
<td width="40%" height="70" align="right" valign="top" align="right" style="padding-bottom:20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
    <td width="57%"></td>
    <td valign="top" width="34">
      <div class="contentEditableContainer contentFacebookEditable" style="display:inline;">
                <div class="contentEditable" >
              <a target="_blank" href="'.$social_facebook.'" data-default="placeholder"  style="text-decoration:none;">
                    <img src="https://s29.postimg.org/yrqilyk3r/facebook.png" data-default="placeholder" data-max-width="30" data-customIcon="true" width="30" height="30" alt="facebook" style="margin-right:40x;"></a>
                </div>
            </div>
    </td>
    <td valign="top" width="34">
      <div class="contentEditableContainer contentTwitterEditable" style="display:inline;">
              <div class="contentEditable">
              <a target="_blank" href="'.$social_twitter.'" data-default="placeholder"  style="text-decoration:none;">
                <img src="https://s27.postimg.org/uv8epq0s3/twitter.png" data-default="placeholder" data-max-width="30" data-customIcon="true" width="30" height="30" alt="twitter" style="margin-right:40x;"></a>
              </div>
            </div>
    </td>
    <td valign="top" width="34">
      <div class="contentEditableContainer contentImageEditable" style="display:inline;">
              <div class="contentEditable" >
                <a target="_blank" href="'.$social_google.'" data-default="placeholder"  style="text-decoration:none;">
          <img src="https://s30.postimg.org/3krn22tld/google.png" width="30" height="30" data-max-width="30" alt="Google" style="margin-right:40x;" />
        </a>
              </div>
            </div>
    </td>
  </tr>
</table>
</td>
</tr>
</table>
</div>
</td>
</tr>
</table>
</td></tr></table></td></tr></table>';
  $pesan .= "</body></html>";
  $to = $msg_mail;
  $subject = $msg_subject;
  $headers .='From: '.$site_name.'<'.$mail_info.'>'."\r\n";;
  $headers .= 'Cc: '.$site_email.''."\r\n";
  $headers .= "Reply-To: $site_email\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$tambah="INSERT INTO message (msg_name,
                              msg_subject,     
                              msg_mail, 
                              msg_content,
                              msg_time,
                              msg_type,
                              msg_tab,
                              msg_status)
                              values('$site_name', 
                                '$msg_subject', 
                                '$msg_mail', 
                                '$msg_content', 
                                '$timeNow', 
                                '2',
                                '1', 
                                'Y')" or die($connection->error.__LINE__); 
    $connection->query($tambah);
  _goto( '../../?mod='.$modul.'&op=sent');
          $_SESSION['msg_mail']='';
          $_SESSION['msg_subject']='';
          $_SESSION['msg_content']='';
          $_SESSION['message']='';
          mail($to, $subject, $pesan, $headers);
          } }
else {
  if(empty($id)){
_goto( '../../?mod='.$modul.'&op=compose');
} 
else{
_goto( '../../?mod='.$modul.'&op=compose&read='.$id.'');
}

$_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}
}

// SENT TEMPLATE ==============================
if (isset($_POST['sendB'])) {
  $id= $_POST['id']; 
$msg_subject = mysqli_real_escape_string($connection, $_POST['msg_subject']); 
$msg_mail= $_POST['msg_mail']; 
$filename=mysqli_real_escape_string($connection,$_POST['filename']);

if($msg_subject && $msg_mail && $filename){
$pecah = explode(",",$msg_mail);
  $total = count( $pecah );
   for ($i=0; $i<$total; $i++) {
    $msg_mail= $pecah[$i];
$lokasi = "../../../sw-content/upload/mail/".$filename;
  ///////////////////////
$htmlContent =file_get_contents("$lokasi");
$to = $msg_mail;
// Set content-type for sending HTML email
$headers ="MIME-Version: 1.0" . "\r\n";
$headers .="Content-type:text/html;charset=UTF-8"."\r\n";
// Additional headers
$headers .='From: '.$site_name.'<'.$site_email.'>'."\r\n";
$headers .= 'Cc: '.$site_email."\r\n";

$tambah="INSERT INTO message (msg_name,
                              msg_subject,     
                              msg_mail, 
                              msg_content,
                              msg_time,
                              msg_type,
                              msg_tab,
                              msg_status)
                              values('$site_name', 
                                '$msg_subject', 
                                '$msg_mail', 
                                '$filename', 
                                '$timeNow', 
                                '2',
                                '2', 
                                'Y')" or die($connection->error.__LINE__); 
          $connection->query($tambah);
        _goto( '../../?mod='.$modul.'&op=sent'); 
$_SESSION['message']='';
mail($to,$msg_subject,$htmlContent,$headers);
}}
else {
  if(empty($id)){
_goto( '../../?mod='.$modul.'&op=compose');
} 
else{
_goto( '../../?mod='.$modul.'&op=compose&read='.$id.'');
}
$_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}
}



// simpan pesan
elseif (isset($_POST['save'])) {
$error = array();
if (empty($_POST['msg_subject'])) { 
        $error[] = 'subject';
    } else { 
    $msg_subject = mysqli_real_escape_string($connection, $_POST['msg_subject']); 
    $_SESSION['msg_subject']=$msg_subject;
  }

if (empty($_POST['msg_mail'])) {// 
        $error[] = 'msg_mail';
    } else { $msg_mail=mysqli_real_escape_string($connection, $_POST['msg_mail']); 
$_SESSION['msg_mail']=$msg_mail;
  }


if (empty($_POST['msg_content'])) { 
        $error[] = 'msg_content';
    } else {
$msg_content = mysqli_real_escape_string($connection, $_POST['msg_content']);
 }

if (empty($error)) { 
$tambah="INSERT INTO message (msg_name,
                              msg_subject,     
                              msg_mail, 
                              msg_content,
                              msg_time,
                              msg_type,
                              msg_tab,
                              msg_status)
                              values('$site_name', 
                                '$msg_subject', 
                                '$msg_mail', 
                                '$msg_content', 
                                '$timeNow', 
                                '3',
                                '1', 
                                'Y')" or die($connection->error.__LINE__); 
          if($connection->query($tambah) === false) { 
          _goto( '../../?mod='.$modul.'&op=compose');
            die($connection->error.__LINE__);
          $_SESSION['message'] ='Message Tidak dapat di simpan...!';
          } else   {
          _goto( '../../?mod='.$modul.'&op=drafts');
          $_SESSION['msg_mail']='';
          $_SESSION['msg_subject']='';
          $_SESSION['msg_content']='';
          $_SESSION['message']='';
          } }

          else{
          foreach ($error as $key => $values) {            
          _goto( '../../?mod='.$modul.'&op=compose');
            //echo $values;
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
          }}}

// reply 
elseif ( $modul == 'message' AND $aksi == 'reply' ){
$id =$_POST['id'];
$error = array();
if (empty($_POST['msg_subject'])) { 
        $error[] = 'subject';
    } else { 
    $msg_subject = mysqli_real_escape_string($connection, $_POST['msg_subject']); 
    $_SESSION['msg_subject']=$msg_subject;
  }

if (empty($_POST['msg_mail'])) {// 
        $error[] = 'msg_mail';
    } else { $msg_mail=mysqli_real_escape_string($connection, $_POST['msg_mail']); 
$_SESSION['msg_mail']=$msg_mail;
  }

if(!filter_var($msg_mail, FILTER_VALIDATE_EMAIL)) { 
_goto( '../../?mod='.$modul.'&op=open&id='.$id.'');
$_SESSION['message'] ='Tipe email tidak benar...!';
exit();}

if (empty($_POST['msg_content'])) { 
        $error[] = 'msg_content';
    } else {
$msg_content = mysqli_real_escape_string($connection, $_POST['msg_content']);
 }

if (empty($error)) { 
// PREPARE THE BODY OF THE pesan
  $pesan = '<html><body>';
  $pesan .= $msg_content;
  $pesan .= "</body></html>";
  $to = $msg_mail;
  $subject = $msg_subject;
  $headers .='From: '.$site_name.'<'.$mail_info.'>'."\r\n";;
  $headers .= 'Cc: '.$site_email.''."\r\n";
  $headers .= "Reply-To: $site_email\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$tambah="INSERT INTO message (msg_name,
                              msg_subject,     
                              msg_mail, 
                              msg_content,
                              msg_time,
                              msg_type,
                              msg_status)
                              values('$site_name', 
                                '$msg_subject', 
                                '$msg_mail', 
                                '$msg_content', 
                                '$timeNow', 
                                '2', 
                                'Y')" or die($connection->error.__LINE__); 
          if($connection->query($tambah) === false) { 
_goto( '../../?mod='.$modul.'&op=open&id='.$id.'');
            die($connection->error.__LINE__);
          $_SESSION['message'] ='Message Tidak dapat di terkirim...!';
          } else   {
          _goto( '../../?mod='.$modul.'&op=sent');
          $_SESSION['msg_mail']='';
          $_SESSION['msg_subject']='';
          $_SESSION['msg_content']='';
          $_SESSION['message']='';
          
          mail($to, $subject, $pesan, $headers);
          } }

          else{
          foreach ($error as $key => $values) {            
_goto( '../../?mod='.$modul.'&op=open&id='.$id.'');
            //echo $values;
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
          }}}


// update sent
elseif (isset($_POST['sendupdate'])) {
$id = strip_tags($_POST['id']);
$error = array();
if (empty($_POST['msg_subject'])) { 
        $error[] = 'subject';
    } else { 
    $msg_subject = mysqli_real_escape_string($connection, $_POST['msg_subject']); 
    $_SESSION['msg_subject']=$msg_subject;
  }

if (empty($_POST['msg_mail'])) {// 
        $error[] = 'msg_mail';
    } else { $msg_mail=mysqli_real_escape_string($connection, $_POST['msg_mail']); 
$_SESSION['msg_mail']=$msg_mail;
  }

if(!filter_var($msg_mail, FILTER_VALIDATE_EMAIL)) { 
  if(!empty($id)){
   _goto( '../../?mod='.$modul.'&op=compose'); 
 }else {
  _goto( '../../?mod='.$modul.'&op=compose&read='.$id.'');
 }

$_SESSION['message'] ='Tipe email tidak benar...!';
exit();}

if (empty($_POST['msg_content'])) { 
        $error[] = 'msg_content';
    } else {
$msg_content = mysqli_real_escape_string($connection, $_POST['msg_content']);
 }

if (empty($error)) { 
// PREPARE THE BODY OF THE pesan
$pesan = '<html><body>';
$pesan .='<style type="text/css">@media screen and (max-width:600px){table[class=container]{width:95%!important}}body{width:100%!important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}#backgroundTable{margin:0;padding:0;width:100%!important;line-height:100%!important}.bgItem{background: #eeeeee;padding:10px;border-top: solid 4px #00A1D9}hr{border:0px;border-bottom:dashed 1px #00A1D9; height: 0px;}img{outline:0;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block}h1,h2,h3,h4,h5,h6{color:#000!important}h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color:#00f!important}h1 a:active,h2 a:active,h3 a:active,h4 a:active,h5 a:active,h6 a:active{color:red!important}h1 a:visited,h2 a:visited,h3 a:visited,h4 a:visited,h5 a:visited,h6 a:visited{color:purple!important}table{mso-table-lspace:0;mso-table-rspace:0}a{color:#000}@media only screen and (max-device-width:480px){a[href^=tel],a[href^=sms]{text-decoration:none;color:#000;pointer-events:none;cursor:default}.mobile_link a[href^=tel],.mobile_link a[href^=sms]{text-decoration:default;color:orange!important;pointer-events:auto;cursor:default}}@media only screen and (min-device-width:768px) and (max-device-width:1024px){a[href^=tel],a[href^=sms]{text-decoration:none;color:#00f;pointer-events:none;cursor:default}.mobile_link a[href^=tel],.mobile_link a[href^=sms]{text-decoration:default;color:orange!important;pointer-events:auto;cursor:default}}h2{color:#181818;font-family:Helvetica,Arial,sans-serif;font-size:22px;line-height:22px;font-weight:400}a.link2,p{font-family:Helvetica,Arial,sans-serif;font-size:16px}a.link2{text-decoration:none;color:#fff;border-radius:4px}p{margin:1em 0;color:#555;line-height:160%}</style>';

    $pesan.='<table cellpadding="0" width="100%" cellspacing="0" border="0" id="backgroundTable" class="bgBody">
<tr>
<td>
<table cellpadding="0" width="620" class="container" align="center" cellspacing="0" border="0">
<tr>
<td>

<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
<tr>
<td class="movableContentContainer bgItem">

<div class="movableContent">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
  <tr height="40">
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
  </tr>
  <tr>
    <td width="200" valign="top">&nbsp;</td>
    <td width="200" valign="top" align="center">
      <div class="contentEditableContainer contentImageEditable">
              <div class="contentEditable" align="center" >
                  <img src="'.$site_url.'/sw-content/'.$site_logo.'" width="155" height="155"  alt="Logo"  data-default="placeholder" />
              </div>
            </div>
    </td>
    <td width="200" valign="top">&nbsp;</td>
  </tr>
  <tr height="25">
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
    <td width="200">&nbsp;</td>
  </tr>
</table>
</div>

<div class="movableContent">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
  <tr>
    <td width="100%" colspan="3" align="center" style="padding-bottom:10px;padding-top:25px;">
      <div class="contentEditableContainer contentTextEditable">
              <div class="contentEditable" align="center" >
                  <h2>'.$site_name.'</h2>
              </div>
            </div>
    </td>
  </tr>
  <tr>
    <td width="100">&nbsp;</td>
    <td width="400" align="center">
      <div class="contentEditableContainer contentTextEditable">
              <div class="contentEditable" align="left">
                  <p >Hallo : '.$msg_name.'
                    <br/>Terimakasih sudah mengirim email kepada kami <b>s-widodo.com</b><br>
                    <br>'.htmlentities($msg_content).'</p>
                    <br>
                    <br>
                    <p>
                    Salam Kami,<br>
                    '.$site_name.'<br>
                    '.$site_office_address.' - Indonesia<br><br>
                    Kontak<br>
                    Telp : '.$site_phone.'<br>
                    Telp : '.$site_phone_2.'<br>
            </p>
              </div>
            </div>
    </td>
    <td width="100">&nbsp;</td>
  </tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
  <tr>
    <td width="200">&nbsp;</td>
    <td width="200" align="center" style="padding-top:25px;">
      <table cellpadding="0" cellspacing="0" border="0" align="center" width="200" height="50">
        <tr>
          <td bgcolor="#ED006F" align="center" style="border-radius:4px;" width="200" height="50">
            <div class="contentEditableContainer contentTextEditable">
                      <div class="contentEditable" align="center" >
                          <a target="_blank" href="'.$site_url.'" class="link2">Click To Website</a>
                      </div>
                    </div>
          </td>
        </tr>
      </table>
    </td>
    <td width="200">&nbsp;</td>
  </tr>
</table>
</div>

<div class="movableContent">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="600" class="container">
<tr>
<td width="100%" colspan="2" style="padding-top:65px;">
<hr style="height:1px;border:none;color:#333;background-color:#ddd;" />
</td>
</tr>
<tr>
<td width="60%" height="70" valign="middle" style="padding-bottom:20px;">
<div class="contentEditableContainer contentTextEditable">
  <div class="contentEditable" align="left" >
      <span style="font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;">Sent to ['.$site_email.'] by ['.$site_name.']</span>
    <br/>
    <span style="font-size:11px;color:#555;font-family:Helvetica, Arial, sans-serif;line-height:200%;">['.$site_office_address.'] | ['.$site_phone.']</span>
    <br/>
    <span style="font-size:13px;color:#181818;font-family:Helvetica, Arial, sans-serif;line-height:200%;">
    <a target="_blank" href="#" style="text-decoration:none;color:#555">Balas Ke: '.$site_email.'</a>
    </span>
  </div>
  </div>
</td>
<td width="40%" height="70" align="right" valign="top" align="right" style="padding-bottom:20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
    <td width="57%"></td>
    <td valign="top" width="34">
      <div class="contentEditableContainer contentFacebookEditable" style="display:inline;">
                <div class="contentEditable" >
              <a target="_blank" href="'.$social_facebook.'" data-default="placeholder"  style="text-decoration:none;">
                    <img src="https://s29.postimg.org/yrqilyk3r/facebook.png" data-default="placeholder" data-max-width="30" data-customIcon="true" width="30" height="30" alt="facebook" style="margin-right:40x;"></a>
                </div>
            </div>
    </td>
    <td valign="top" width="34">
      <div class="contentEditableContainer contentTwitterEditable" style="display:inline;">
              <div class="contentEditable">
              <a target="_blank" href="'.$social_twitter.'" data-default="placeholder"  style="text-decoration:none;">
                <img src="https://s27.postimg.org/uv8epq0s3/twitter.png" data-default="placeholder" data-max-width="30" data-customIcon="true" width="30" height="30" alt="twitter" style="margin-right:40x;"></a>
              </div>
            </div>
    </td>
    <td valign="top" width="34">
      <div class="contentEditableContainer contentImageEditable" style="display:inline;">
              <div class="contentEditable" >
                <a target="_blank" href="'.$social_google.'" data-default="placeholder"  style="text-decoration:none;">
          <img src="https://s30.postimg.org/3krn22tld/google.png" width="30" height="30" data-max-width="30" alt="Google" style="margin-right:40x;" />
        </a>
              </div>
            </div>
    </td>
  </tr>
</table>
</td>
</tr>
</table>
</div>
</td>
</tr>
</table>
</td></tr></table></td></tr></table>';
  $pesan .= "</body></html>";
  $to = $msg_mail;
  $subject = $msg_subject;
  $headers .='From: '.$site_name.'<'.$mail_info.'>'."\r\n";;
  $headers .= 'Cc: '.$site_email.''."\r\n";
  $headers .= "Reply-To: $site_email\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$update="UPDATE message SET msg_type='2' WHERE msg_id='$id'";
if($connection->query($update) === false) { 
   if(!empty($id)){
   _goto( '../../?mod='.$modul.'&op=compose'); 
 }else {
  _goto( '../../?mod='.$modul.'&op=compose&read='.$id.'');
 }
          $_SESSION['message'] ='Message Tidak dapat di simpan...!';
          } else   {
          _goto( '../../?mod='.$modul.'&op=sent');
          $_SESSION['msg_mail']='';
          $_SESSION['msg_subject']='';
          $_SESSION['msg_content']='';
          $_SESSION['message']='';
          mail($to, $subject, $pesan, $headers);
          } }

          else{
          foreach ($error as $key => $values) {            
   if(!empty($id)){
   _goto( '../../?mod='.$modul.'&op=sent'); 
 }else {
  _goto( '../../?mod='.$modul.'&op=compose&read='.$id.'');
 }
$_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
          }}}


// Proses Multi Delete Post
elseif ($modul=='message' AND $aksi=='trash'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
mysqli_query($connection,"UPDATE message SET msg_type='4' WHERE msg_id='$id'");
  }
 _goto( '../../?mod='.$modul.'');
  $_SESSION['message'] ='';
}

// Proses Multi Delete Post
elseif ($modul=='message' AND $aksi=='trashsent'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
mysqli_query($connection,"UPDATE message SET msg_type='4' WHERE msg_id='$id'");
  }
 _goto( '../../?mod='.$modul.'&op=sent');
  $_SESSION['message'] ='';
}

// Proses Multi Delete Post
elseif ($modul=='message' AND $aksi=='trashdraft'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
mysqli_query($connection,"UPDATE message SET msg_type='4' WHERE msg_id='$id'");
  }
 _goto( '../../?mod='.$modul.'&op=drafts');
  $_SESSION['message'] ='';
}

// Proses Multi Delete Post
elseif ($modul=='message' AND $aksi=='multidelete'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
mysqli_query($connection,"DELETE FROM message WHERE msg_id='$id'");
  }
 _goto( '../../?mod='.$modul.'&op=trash');
  $_SESSION['message'] ='';
}

else {
// _goto( '../../?mod=message');
 //$_SESSION['message'] ='Tidak ada aktifitas..!';
}

}
