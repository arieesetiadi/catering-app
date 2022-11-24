<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ./login');
    unset($_SESSION['SESION_LOGIN']);
	unset($_SESSION['SESION_USER']);
	session_destroy();

}else{
$SESION_LOGIN=''; $SESION_USER='';
if(!empty($_SESSION['SESION_LOGIN'])){
	$SESION_LOGIN=$_SESSION['SESION_LOGIN'];}

if(!empty($_SESSION['SESION_USER'])){
	$SESION_USER=$_SESSION['SESION_USER'];}

$query_login= "SELECT * FROM user where user_id='$SESION_USER' and session='$SESION_LOGIN' AND approve='Y' AND active='Y' and level='1' or level='2'";
 //login
$result_login = $connection->query($query_login) or die($connection->error.__LINE__);
$log_login = $result_login->num_rows;
$rows_login = $result_login->fetch_assoc();
extract($rows_login);
$author =$rows_login['user_id'];
$level_user=$rows_login['level'];

if($log_login == '0'){ 
header("location:./login/");
echo "Login itu hukumnya adalah <h1>Wajib</h1> ^_^";
unset($_SESSION['SESION_LOGIN']);
unset($_SESSION['SESION_USER']);
session_destroy();
} else {	

#------------------------------------------------------------------------------------
#------------------------------------------------------------------------------------
}}