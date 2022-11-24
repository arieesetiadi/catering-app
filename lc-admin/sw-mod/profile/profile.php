<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
require_once'../sw-library/config.php';
require_once'../sw-library/sw-function.php';
$gotoprocess = "sw-mod/$mod/proses.php";
$message='';
if(!empty($_SESSION['message'])){$message=$_SESSION['message'];}
if(!empty($_GET['id']) ){
 $id = mysqli_escape_string($connection,epm_decode($_GET['id']));
 $id = mysqli_escape_string($connection,epm_decode($_GET['id']));
 $query="SELECT user.*,user_profile.* from user,user_profile where user.user_id=user_profile.user_id and user.user_id='$id'";
 $result = $connection->query($query);
 if($result->num_rows > 0){
 $row =$result->fetch_assoc();

 $query_p ="SELECT post_id,post_title,seotitle,post_content,post_time,post_date from  post where author='$row[user_id]'";
 $result_p = $connection->query($query_p);
 $jumlah =  $result_p->num_rows;

echo'
<div class="content-header content-header-media">
<div class="header-section">
<h1>'.$row['fullname'].'<br><small>'.$row['about'].'</small></h1>
</div>';
if($row['cover'] !== NULL){
echo' <img src="../sw-content/upload/cover/'.$row['cover'].'"  oncontextmenu="return false;">';  
} else {
echo' <img src="../sw-content/upload/cover/cover.jpg" class="animation-pulseSlow" oncontextmenu="return false;">';
}

if($row['user_id'] == $author){
echo'
    <div class="footer-section">
        <form id="finput" method="post" action="'.$gotoprocess.'" enctype="multipart/form-data">
        <input type="hidden" name="id" value="'.$row['user_id'].'">
            <input id="fpro" type="hidden" name="modul" value="profile">
            <input id="fco" type="hidden" name="aksi" value="cover">';?>
<div class="upload_cover">
<input class="upload" id="my_file" type="file" name="fupload" style="display:block" accept="image/*" onchange="document.getElementById('my_file').click();" data-toggle="tooltip" data-placement="right" data-original-title="Ganti Cover : Resize 1900x248 pixel untuk hasil maksimal">
<h3><i class="fa fa-camera"></i></h3>
</div>
        </form>
    </div><?php }?>

<script>$("#my_file").on("change", function() {$("#finput").submit();});
</script>
</div>
<?php showAlert(); ?>
<?php  echo'<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';?>
<div class="row">
    <div class="col-md-6 col-lg-7">
        <div class="block">
            <div class="block-title">
                <h2><?php echo _e('Latest Posts')?></h2>
            </div>
            <div class="block-content-full">
                <input type='hidden' class='current_page' />
                <input type='hidden' class='show_per_page' />
                <ul class="media-list media-feed media-feed-hover content">
<?php
 while($row_p = $result_p->fetch_assoc()){
 extract($row_p);
$post_content= trim(stripslashes(strip_tags($row_p['post_content'])));
if(strlen($post_content ) > 80) $post_content= substr($post_content, 0, 80).'..';
 echo'
<li class="media">
<div class="media-body">
<p class="push-bit">
<span class="text-muted pull-right">
    <small>'.tgl_indo($post_date).' '.$post_time.'</small>
    <span class="text-danger" data-toggle="tooltip" title="From Web"><i class="fa fa-globe"></i></span>
</span>
</p>
<h5><a href="'.$site_url.'/blog/'.$post_id.'-'.$seotitle.'.html" target="_blank"><strong>
'.ucfirst($post_title).'</strong></a></h5>
<p>'.$post_content.'</p>
  </div>
</li>';}?>

<li class="media text-center">
<a href="javascript:void(0)" class="btn btn-xs btn-default push">View more..</a>
</li>
</ul>
</div>
<div class="text-center">
<div class="page_navigation"></div>
</div>
</div>
</div>
    <div class="col-md-6 col-lg-5">
<?php
if($row['user_id'] == $author) {
echo'
        <!-- basic info-->
        <div class="block">
            <div class="block-title">
                <h2>'._e('Basic Info').'</h2>
            </div>
            <table class="table table-borderless table-striped">
                <tbody>
                    <tr>
                        <td width="80"><strong>'._e('Avatar').'</strong></td>
                        <td>
<form method="post" action="'.$gotoprocess.'" enctype="multipart/form-data">
<div id="avatar" style="cursor:pointer">';
if($row['photo'] != ''){
    echo'<img src="../sw-content/upload/avatar/'.$row['photo'].'" width="180" oncontextmenu="return false;">';
    }else{
echo'
<img src="sw-assets/img/avatar.jpg" width="180" oncontextmenu="return false;">';
   }
   echo'
</div>
<div id="new_avatar" style="display:none">
<input type="hidden" name="modul" value="profile">
<input type="hidden" name="aksi" value="avatar">
<input type="hidden" name="id" value="'.$row['user_id'].'">
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-primary btn-file"><i class="fa fa-camera"></i> Upload
<input type="file" id="fupload" class="upload" name="fupload" accept=".jpg, .jpeg, .png, .gif"/>
</span></span><input type="text" class="form-control" readonly>
</div> 
<button type="submit" id="submitavatar" class="btn btn-sm btn-primary pull-right">Submit</button>
</div>
</form>
</td>
</tr>';
echo'
<tr>
<td width="77"><strong>'._e('Name').'</strong></td>
<td>
<div id="name" style="cursor:pointer">'.$row['fullname'].'</div>
<div id="new_name" style="display:none">
<div class="input-group input-group-sm">
<input id="nametxt" type="text" name="name" class="form-control" value="'.$row['fullname'].'" placeholder="Type Your Name here">
<span class="input-group-btn">
    <button id="submitname" class="btn btn-primary btn-sm">Submit</button>
</span>
</div>
</div>
</td>
</tr>

<tr>
<td><strong>'._e('Gender').'</strong></td>
<td><div id="gender" style="cursor:pointer">'.strtoupper($row['gender']).'</div>
    <div id="new_gender" style="display:none">
        <div class="col-md-9">';
        if($row['gender'] =='male'){ ?>
        <label class="radio-inline" for="example-inline-radio1">
            <input type="radio" id="gendertxt" name="gender" value="male" checked> Male
        </label>
        <label class="radio-inline" for="example-inline-radio2">
            <input type="radio" id="gendertxt" name="gender" value="female"> Female
        </label>
        <?php }else{ ?>
        <label class="radio-inline" for="example-inline-radio1">
            <input type="radio" id="gendertxt" name="gender" value="male"> Male
        </label>
        <label class="radio-inline" for="example-inline-radio2">
            <input type="radio" id="gendertxt" name="gender" value="female" checked> Female
        </label>
        <?php } ?>
        </div>
        <button id="submitgender" class="btn btn-primary btn-xs">Submit</button>
    </div>
</td>
</tr>

<?php echo'<tr>
 <td><strong>'._e('Status').'</strong></td>
        <td>';
$query = "SELECT level FROM user_level where level_id='$row[level]'"; 
$result = $connection->query($query);
while($rows= $result->fetch_assoc()){
        echo $rows['level'];}echo'</td>
    </tr>
<tr>
<td><strong>'._e('Since').'</strong></td>
<td>';
$getregister = $row['user_registered'];
$pf = explode(' ',$getregister);
$pfdate = tgl_indo($pf[0]);
$pftime = $pf[1];
echo $pfdate." Pukul:".$pftime;
echo'</td>
</tr>
<tr>
<td><strong>'._e('Post').'</strong></td>
<td><a href="javascript:void();" class="label label-danger">'.$jumlah.'</a></td>
</tr>
                   
<tr>
<td><strong>'._e('Birthday').'</strong></td>
<td>
<div id="birthday" style="cursor:pointer">
'.$row['birthday'].'</div>
<div id="new_birthday" style="display:none">
<div class="input-group input-group-sm">
<input id="birthdaytxt" type="text" name="birthday" class="form-control" value="'.$row['birthday'].'"  placeholder="dd/mm/yyyy">
<span class="input-group-btn">
    <button id="submitbirthday" class="btn btn-primary btn-sm">Submit</button>
</span>
</div>
</div>
</td>
</tr>
</tbody>
</table>
 </div>
   
<!-- contact info -->
<div class="block">
<div class="block-title">
<h2>'._e('Contact Info').'</h2>
</div>
<table class="table table-borderless table-striped">
<tbody>
<tr>
<td width="80"><strong>'._e('Phone').'</strong></td>
<td>
    <div id="phone" style="cursor:pointer">'.$row['phone'].'</div>
    <div id="new_phone" style="display:none">
        <div class="input-group input-group-sm">
            <input id="phonetxt" type="text" name="phone" class="form-control" value="'.$row['phone'].'" placeholder="Type Your Phone here">
            <span class="input-group-btn">
                <button id="submitphone" class="btn btn-primary btn-sm">Submit</button>
            </span>
        </div>
    </div>
</td>
</tr>
<tr>
<td><strong>'._e('Email').'</strong></td>
<td>
<div id="email" style="cursor:pointer">'.$row['user_email'].'</div>
<div id="new_email" style="display:none">
<div class="input-group input-group-sm">
    <input id="emailtxt" type="text" name="email" class="form-control" value="'.$row['user_email'].'" placeholder="Type Your Phone here">
    <span class="input-group-btn">
        <button id ="submitemail" class="btn btn-primary btn-sm">Submit</button>
    </span>
</div>
</div>
</td>
</tr>
        <tr>
        <td><strong>'._e('Facebook').'</strong></td>
        <td>
        <div id="facebook" style="cursor:pointer">'.$row['facebook'].'</div>
        <div id="new_facebook" style="display:none">
        <div class="input-group input-group-sm">
        <input id="facebooktxt" type="text" name="facebook" class="form-control" value="'.$row['facebook'].'" placeholder="Type Your Facebook here">
        <span class="input-group-btn">
            <button id="submitfacebook" class="btn btn-primary btn-sm">Submit</button>
        </span>
        </div>
        </div>
        </td>
        </tr>
<tr>
<td><strong>'._e('Twitter').'</strong></td>
<td>
<div id="twitter" style="cursor:pointer">'.$row['twitter'].'</div>
<div id="new_twitter" style="display:none">
    <div class="input-group input-group-sm">
        <input id="twittertxt" type="text" name="twitter" class="form-control" value="'.$row['twitter'].'" placeholder="Type Your Twitter here">
        <span class="input-group-btn">
            <button id="submittwitter" class="btn btn-primary btn-sm">Submit</button>
        </span>
    </div>
</div>
</td>
</tr>
<tr>
<td><strong>'._e('Website').'</strong></td>
<td>
<div id="website" style="cursor:pointer">'.$row['user_url'].'</div>
<div id="new_website" style="display:none">
<div class="input-group input-group-sm">
    <input id="websitetxt" type="text" name="web" class="form-control" value="'.$row['user_url'].'" placeholder="Type Your Website here">
    <span class="input-group-btn">
        <button id="submitwebsite" class="btn btn-primary btn-sm">Submit</button>
    </span>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</div>
  
<!-- about info -->
<div class="block">
<div class="block-title">
    <h2>'._e('About Info').'</h2>
</div>
<table class="table table-borderless table-striped">
<tbody>
<tr>
<td width="80"><strong>Job</strong></td>
<td>
<div id="job" style="cursor:pointer">'.$row['job'].'</div>
<div id="new_job" style="display:none">
    <div class="input-group input-group-sm">
        <input id="jobtxt" type="text" name="job" class="form-control" value="'.$row['job'].'" placeholder="Type job here">
        <span class="input-group-btn">
            <button id="submitjob" class="btn btn-primary btn-sm">Submit</button>
        </span>
    </div>
</div>
</td>
</tr>
<tr>
<td><strong>Skills</strong></td>
<td>
    <div id="skills">';
    $skills = explode(',',$row['skill']);
    foreach($skills as $s){
echo'<a href="javascript:void();" class="label label-info">'.$s.'</a>&nbsp;';}
echo'
<i class="fa fa-pencil text-warning pull-right" style="cursor:pointer;"></i>
    </div>
    <div id="new_skills" style="display:none;">
    <div class="input-group input-group-sm">
    <input class="form-control" type="text" id="skillstxt" name="skill" value="'.$row['skill'].'" placeholder="Type Your Skill here"><br>
    <span class="input-group-btn">
    <button id="submitskills" type="button" class="btn btn-primary btn-sm">Submit</button>
    </span>
    </div>
    <span class="help-block">'._e('Pisahkan setiap isian dengan koma').'</span>
</div>
</td>
</tr>

<tr>
            <td style="width: 20%;"><strong>'._e('About').'</strong></td>
            <td>
            <div id="description">'.$row['about'].'<br><i class="fa fa-pencil text-warning pull-right" style="cursor:pointer;"></i></div>
            <div id="new_description" style="display:none;">
                <textarea id="descriptiontxt" rows="6" class="form-control" name="about">'.$row['about'].'</textarea>
                <button id="submitedescription" type="button" class="btn btn-xs btn-primary">Save</button>
            </div>
            </td>
        </tr>
    </tbody>
</table>
<!-- END Info Content -->
</div>';?>

<?php } else {
echo'<!-- basic info-->
<div class="block">
<div class="block-title">
<h2>'._e('Basic Info').'</h2>
</div>
<table class="table table-borderless table-striped">
<tbody>
<tr>
<td width="80"><strong>'._e('Avatar').'</strong></td>
<td>';
if($row['photo'] != ''){
    echo'<img src="../sw-content/upload/avatar/'.$row['photo'].'" width="180" oncontextmenu="return false;">';
    }else{
echo'
    <img src="sw-assets/img/avatar.jpg" width="180" oncontextmenu="return false;">';
   }
   echo'
</td>
</tr>
<tr>
<td width="77"><strong>'._e('Name').'</strong></td>
<td>'.$row['fullname'].'</td>
</tr>
<tr>
<td><strong>'._e('Gender').'</strong></td>
<td>'.$row['gender'].'</td>
</tr>
<tr>
<td><strong>'._e('Status').'</strong></td>
    <td>';
$query = "SELECT level FROM user_level where level_id='$row[level]'"; 
$result = $connection->query($query);
while($rows= $result->fetch_assoc()){
        echo $rows['level'];}
echo'</td>
</tr>
<tr>
<td><strong>'._e('Since').'</strong></td>
    <td>';
    $getregister = $row['user_registered'];
$pf = explode(' ',$getregister);
$pfdate = tgl_indo($pf[0]);
$pftime = $pf[1];
echo $pfdate." Pukul:".$pftime;
echo'</td>
</tr>
<tr>
<td><strong>'._e('Post').'</strong></td>
<td><a href="javascript:void();" class="label label-danger">'.$jumlah.'</a></td>
</tr>
<tr>
<td><strong>'._e('Birthday').'</strong></td>
<td>'.tgl_indo($row['birthday']).'</td>
</tr>
</tbody>
</table>
</div>
        <!-- contact info -->
        <div class="block">
            <div class="block-title">
                <h2>'._e('Contact Info').'</h2>
            </div>
            <table class="table table-borderless table-striped">
                <tbody>
                    <tr>
                        <td width="80"><strong>'._e('Phone').'</strong></td>
                        <td>'.$row['phone'].'</td>
                    </tr>
                    <tr>
                        <td><strong>'._e('Email').'</strong></td>
                        <td>'.$row['user_email'].'</td>
                    </tr>
                    <tr>
                        <td><strong>'._e('Facebook').'</strong></td>
                        <td>'.$row['facebook'].'</td>
                    </tr>
                    <tr>
                        <td><strong>Twitter</strong></td>
                        <td>'.$row['twitter'].'</td>
                    </tr>
                     <tr>
                        <td><strong>Website</strong></td>
                        <td>'.$row['user_url'].'</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- about info -->
        <div class="block">
            <div class="block-title">
                <h2>'._e('About Info').'</h2>
            </div>
            <table class="table table-borderless table-striped">
                <tbody>
                    <tr>
                        <td width="80"><strong>Job</strong></td>
                        <td>'.$row['job'].'</td>
                    </tr>
                    <tr>
                        <td><strong>Skills</strong></td>
                        <td>';
                        $skills = explode(',',$row['skill']);
    foreach($skills as $s){
echo'
<a href="#" class="label label-info">'.$s.'</a>&nbsp;';}
echo'
</td>
</tr>
<tr>
<td style="width: 20%;">'._e('About').'</strong></td>
<td>'.$row['about'].'</td>
</tr>
</tbody>
</table>
            <!-- END Info Content -->
        </div>';
}?>
</div>
<!-- END User Profile Content -->
</div>
<?php } else {
 //_goto('./404');

}} else {
 //_goto('./404');
}
}
