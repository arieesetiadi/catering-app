<?php 
/* Admin Panel
* (c)Jan 1, 2016
*/
@session_start();
require_once'../sw-library/config.php';
require_once'./login/login_session.php';
if(empty($_SESSION['SESION_LOGIN']) || !isset($_SESSION['SESION_LOGIN'])){ 
header('location:./login/');
 exit;}

else{

require_once '../sw-library/sw-function.php';
include_once('cpanel.php');
$mod = "home";
$mod = @$_GET['mod'];
include'./head.php';
ob_start();
if(file_exists('./sw-mod/'.$mod.'/'.$mod.'.php')){
    theme_head();

    include'./sidebar.php';
    echo'<div id="page-content">';
    include('./sw-mod/'.$mod.'/'.$mod.'.php');
    echo'</div>';
    theme_foot();
}else{
    theme_head();
    include'./sidebar.php';
    echo'<div id="page-content">';
    include('./sw-mod/home/home.php');
    echo'</div>';
    theme_foot();
}

ob_end_flush(); // minify_html
}?>
