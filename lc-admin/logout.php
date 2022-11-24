<?PHP session_start(); 
require_once'../sw-library/config.php';
require_once'./login/login_session.php';
$save=mysqli_query($connection, "UPDATE user set status='0', session='ofline' where user_id='$author'")
or die (mysqli_error($connection));
unset($_SESSION['SESION_LOGIN']);
session_destroy();
header('Location:./login/');
exit();
?>

		
