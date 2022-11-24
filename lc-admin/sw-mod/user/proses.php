<?php
session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_LOGIN'])){
    header( 'location: ../../' );
}
else {
require_once'../../../sw-library/config.php';
require_once'../../login/login_session.php';
include( '../../../sw-library/sw-function.php' );
$salt = '$%7sadg387435@#&*!=xx^67eywye{a911}+';
$modul='';
$aksi='';

if(!empty($_POST['modul'])){
$modul = $_POST['modul'];
}

if(!empty($_POST['aksi'])){
$aksi = $_POST['aksi'];
}

// add
if ($modul=='user' AND $aksi=='add'){
  $error = array();
if (empty($_POST['username'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$username = mysqli_real_escape_string($connection, $_POST['username']);
$_SESSION['username']=$username;
    }

if (empty($_POST['password'])) { 
        $error[] = 'tidak boleh kosong';
    } else { 
$password =mysqli_real_escape_string($connection,hash('sha256',$salt.$_POST['password'])); 
  }

if (empty($_POST['firstname'])) { 
        $error[] = 'tidak boleh kosong';
    } else { $firstname =mysqli_real_escape_string($connection, $_POST['firstname']); 
    $_SESSION['firstname']=$firstname;
  }


$lastname =mysqli_real_escape_string($connection,$_POST['lastname']);
$_SESSION['lastname']=$lastname;




if (empty($_POST['email'])) { 
        $error[] = 'email';
    } else {
$email = mysqli_real_escape_string($connection, $_POST['email']);
$_SESSION['email']=$email;
 }

if (empty($_POST['level'])) { 
        $error[] = 'level';
    } else {
$level = mysqli_real_escape_string($connection, $_POST['level']);
 }


if (empty($error)) { 
$query="SELECT user_id,user_login from user where user_login='$username'";
$result =$connection->query($query);
$hasil= $result->num_rows;
if ($hasil== 0){

$query2="SELECT user_id,user_login from user order by user_id DESC";
$result2 =$connection->query($query2);
$row =$result2->fetch_assoc();
$user_id=$row['user_id'] + 1;
$tambah="INSERT INTO user (user_id,user_login,
                              user_pass,     
                              user_email,
                              user_url,
                              user_registered,
                              fullname,
                              title,
                              description,
                              skill,
                              level,
                              time_login,
                              time_logout,
                              status,
                              session,
                              active,
                              lang,
                              photo,
                              approve,
                              colortheme,
                              ip,
                              browser)
                              values('$user_id',
                                '$username', 
                                '$password', 
                                '$email', 
                                'http://domain.com',
                                '$date $time',  
                                '$firstname $lastname',
                                '.........', 
                                '.........',
                                'Skill',
                                '$level', 
                                '$date $time', 
                                '$date $time', 
                                '0', 
                                'ofline', 
                                'Y', 
                                '2', 
                                '',
                                'Y',
                                '9',
                                '$ip', 
                                '$browser')" or die($connection->error.__LINE__);
//tambah profile user
$tambah2="INSERT INTO user_profile (user_id,
about,job,phone,gender,birthday,facebook,twitter,cover) values('$user_id', 
                  '..........', 
                  '..........', 
                  '000000000000',
                  'male',  
                  '00/00/0000',
                  'http://facebook.com', 
                  'http://twitter.com',
                  'NULL')" or die($connection->error.__LINE__);

          if($connection->query($tambah) === false) { 
          _goto( '../../?mod='.$modul.'&op=add');
          die($connection->error.__LINE__); 
          $_SESSION['message'] ='User Tidak dapat di simpan...!';
          } else   {
            $connection->query($tambah2);
         _goto( '../../?mod='.$modul);
          $_SESSION['username']='';
          $_SESSION['email']='';
          $_SESSION['firstname']='';
          $_SESSION['lastname']='';
          $_SESSION['message']='';
          } }
 else {
  _goto( '../../?mod='.$modul);
$_SESSION['message']='Maaf sebelumnya Username <b>'.$user_login.'</b> ini sudah terdaftar...!';
 }
 }
        else{
          foreach ($error as $key => $values) {            
          _goto( '../../?mod='.$modul.'&op=add');
           $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
          }}
}



// edit
elseif ($modul=='user' AND $aksi=='edit'){
$id=mysqli_real_escape_string($connection, $_POST['id']);
 $error = array();
if (empty($_POST['username'])) { 
        $error[] = 'tidak boleh kosong';
    } else {
$username = mysqli_real_escape_string($connection, $_POST['username']);
$_SESSION['username']=$username;
    }

if (empty($_POST['firstname'])) { 
        $error[] = 'tidak boleh kosong';
    } else { $firstname =mysqli_real_escape_string($connection, $_POST['firstname']); 
  }


   $lastname = mysqli_real_escape_string($connection, $_POST['lastname']); 
  

if (empty($_POST['email'])) { 
        $error[] = 'email';
    } else {
$email = mysqli_real_escape_string($connection, $_POST['email']);
}

if (empty($error)) { 
$update="UPDATE user SET user_login='$username',user_email='$email',fullname='$firstname $lastname' WHERE user_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
_goto( '../../?mod='.$modul.'&op=edit&user='.epm_encode($id).'');
 $_SESSION['message'] ='Halaman Tidak dapat di ubah...!';
} else   {
 _goto('../../?mod='.$modul);
$_SESSION['message']='';
} } 

else{
foreach ($error as $key => $values) {            
_goto( '../../?mod='.$modul.'&op=edit&user='.epm_encode($id).'');
    $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}}


// password change
elseif ($modul=='user' AND $aksi=='passwordChange'){
$password = mysqli_real_escape_string($connection,hash('sha256',$salt.$_POST['post']));
$update="UPDATE user SET user_pass='$password' WHERE user_id='$_POST[id]'";
if($connection->query($update) === true) { 
echo'sukses';
}}

// delete user
elseif (!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection, $_GET['id']);
if ($aksi=='delete'){

$cari= mysqli_query($connection,"SELECT photo from user where user_id='$id'");
$data=mysqli_fetch_assoc($cari);
$images_delete = strip_tags($data['photo']);
$tmpfile = "../../../sw-content/upload/avatar/".$images_delete;

$cari2= mysqli_query($connection,"SELECT cover from user_profile where user_id='$id'");
$data2=mysqli_fetch_assoc($cari2);
$detele_cover= strip_tags($data2['cover']);
$tmpfile_cover = "../../../sw-content/upload/cover/".$detele_cover;
// proses delete--------------------
$delete="DELETE FROM user WHERE user_id='$id'" or die($connection->error.__LINE__); 
$delete2="DELETE FROM user_profile WHERE user_id='$id'" or die($connection->error.__LINE__);
$delete3="DELETE FROM user_address WHERE user_id='$id'" or die($connection->error.__LINE__);
if($connection->query($delete) === true) { 
_goto( '../../?mod=user'); // sukses
$_SESSION['message'] ='';
$connection->query($delete2);
$connection->query($delete3);
    if(file_exists("../sw-content/upload/avatar/$images_delete")){
    unlink ($tmpfile);
    }

    if(file_exists("../sw-content/upload/cover/$detele_cover")){
    unlink ($tmpfile_cover);
    }


} else { 
_goto( '../../?mod=user');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}



// Proses Multi Delete user
elseif ($modul=='user' AND $aksi=='multidelete'){
   $idArr = $_POST['item'];
        foreach($idArr as $id){
          mysqli_query($connection,"DELETE FROM user WHERE user_id=".$id);
          mysqli_query($connection,"DELETE FROM user_profile WHERE user_id=".$id);
          mysqli_query($connection,"DELETE FROM user_address WHERE user_id=".$id);
  }
 _goto( '../../?mod='.$modul.'');
}



// add user level
elseif ($modul=='user' AND $aksi=='addLevel'){
$title =$_POST['title'];
$tambah="INSERT INTO user_level (level, active) values('$title', 'Y')" or die($connection->error.__LINE__);
if($connection->query($tambah) === true) {  
  _goto('../../?mod='.$modul.'&op=userlevel');
  echo 'ok';
}}

// edit user level
elseif ($modul=='user' AND $aksi=='edituserlevel') {
  $id = $_POST['id'];
  $title =$_POST['title'];
 
$update="UPDATE user_level SET level='$title' WHERE level_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
 // die($connection->error.__LINE__);
 _goto('../../?mod='.$modul.'&op=userlevel'); // error
  $_SESSION['message'] ='Level User Tidak dapat di ubah...!';
}
else   {
  _goto('../../?mod='.$modul.'&op=userlevel'); // sukses
  $_SESSION['message']='';

}}

// delete user level
if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection,epm_decode($_GET['id']));

if ($aksi=='deletelevel'){
$delete="DELETE FROM user_level WHERE level_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($delete) === true) { 
    _goto('../../?mod=user&op=userlevel'); // sukses
    $_SESSION['message'] ='';
} else { 
_goto('../../?mod=user&op=userlevel');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';

}}}

// multidelete user level
elseif ($modul=='user' AND $aksi=='multideletelevel'){
  $idArr = $_POST['item'];
        foreach($idArr as $id){
          mysqli_query($connection,"DELETE FROM user_level WHERE level_id=".$id);
  }
_goto('../../?mod='.$modul.'&op=userlevel');
}

// add user role
elseif ($modul=='user' AND $aksi=='adduserrole'){
$error = array();
if (empty($_POST['level'])) {
$error[] = 'tidak boleh kosong';
} else {
$level= strip_tags($_POST['level']);
}

if (empty($_POST['module_id'])) {
$error[] = 'tidak boleh kosong';
} else {
$module_id = strip_tags($_POST['module_id']);
}


  $read_access = strip_tags($_POST['read_access']);
  $write_access = strip_tags($_POST['write_access']);
  $modify_access = strip_tags($_POST['modify_access']);
  $delete_access = strip_tags($_POST['delete_access']);

if (empty($error)) { 
$tambah="INSERT INTO user_role (level_id, module_id, read_access, write_access, modify_access, delete_access) values('$level', '$module_id', '$read_access', '$write_access', '$modify_access', '$delete_access')" or die($connection->error.__LINE__);
if($connection->query($tambah) === false) { 
  _goto('../../?mod='.$modul.'&op=userrole');
    $_SESSION['message'] ='User Role tidak dapat di simpan..!';
} else {
 _goto('../../?mod='.$modul.'&op=userrole');
$_SESSION['message']='';
} } 
else{ foreach ($error as $key => $values) { 
  _goto('../../?mod='.$modul.'&op=userrole');
  $_SESSION['message'] ='Bidang inputan tidak boleh ada yang kosong..!';
}}
}


// level user process
elseif ($modul=='user' AND $aksi=='setuser'){
	$id = $_POST['id'];
    $active = $_POST['active'];
  $update="UPDATE user SET level='$active' WHERE user_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
 echo 'error'; 
}
else{ echo 'sukses..'; 
}

}

// active process
elseif ($modul=='user' AND $aksi=='setactive'){
	$id = $_POST['id'];
    $active = $_POST['active'];
    $update="UPDATE user SET active='$active' WHERE user_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
 echo 'error'; 
}
else{ echo 'sukses..'; 
}
}

// read access process
elseif ($modul=='user' AND $aksi=='raccess_pro'){
    $id = $_POST['id'];
    $active = $_POST['active'];
$update="UPDATE user_role SET read_access='$active' WHERE role_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
  echo 'error'; 
}
else{ echo 'sukses..'; 
} }

// write access process
elseif ($modul=='user' AND $aksi=='waccess_pro'){
    $id = $_POST['id'];
    $active = $_POST['active'];
$update="UPDATE user_role SET write_access='$active' WHERE role_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
  echo 'error'; 
}
else{ echo 'sukses..'; 
} }

// modify access process
elseif ($modul=='user' AND $aksi=='maccess_pro'){
    $id = $_POST['id'];
    $active = $_POST['active'];
$update="UPDATE user_role SET modify_access='$active' WHERE role_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
  echo 'error'; 
}
else{ echo 'sukses..'; 
} }

// delete access process
elseif ($modul=='user' AND $aksi=='daccess_pro'){
    $id = $_POST['id'];
    $active = $_POST['active'];
$update="UPDATE user_role SET delete_access='$active' WHERE role_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($update) === false) { 
  echo 'error'; 
}
else{ echo 'sukses..'; 
} } 


// delete user role
if(!empty($_GET['id'])){ 
$aksi=mysqli_real_escape_string($connection, $_GET['aksi']);
$id =mysqli_real_escape_string($connection,epm_decode($_GET['id']));
if ($aksi=='deleterole'){
$delete="DELETE FROM user_role WHERE role_id='$id'" or die($connection->error.__LINE__); 
if($connection->query($delete) === true) { 
_goto('../../?mod=user&op=userrole'); // sukses
$_SESSION['message'] ='';
} else { 
_goto('../../?mod=user&op=userrole');
    $_SESSION['message'] ='Item tidak berhasil dihapus..!';
}}}

// multidelete user role
elseif ($modul=='user' AND $aksi=='multideleteuserrole'){
  $idArr = $_POST['item'];
        foreach($idArr as $id){
mysqli_query($connection,"DELETE FROM user_role WHERE role_id=".$id);
  }
  $_SESSION['message'] ='';
_goto('../../?mod='.$modul.'&op=userrole');
}

else 
{
  echo "error";
}
}
