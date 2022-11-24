<?PHP session_start();
 if(!empty($_SESSION['SESION_LOGIN'])){ 
header('location:../');
//echo'login';
 exit;}
 else{
     require_once'../../sw-library/config.php';
?>
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Login Administrator</title>
<meta name="description" content="Login">
<meta name="author" content="pixelcave">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<!-- Icons -->
<link rel="shortcut icon" href="../sw-assets/favicon.png">
<link rel="apple-touch-icon" href="../sw-assets/favicon.png">

<link rel="stylesheet" href="../sw-assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../sw-assets/css/plugins.css">
<link rel="stylesheet" href="../sw-assets/css/main.css">
<link rel="stylesheet" href="../sw-assets/css/themes.css">
</head>
<body>

<!-- Login Container -->
<div id="login-container" class="animation-fadeIn">
<!-- Login Title -->
<div class="login-title text-center">
<h1><img src="../../sw-content/<?php echo $site_logo;?>"  oncontextmenu="return false;" width="200"/><br>
<small>Please <strong>Login</strong></small></h1>
</div>
<!-- END Login Title -->

<!-- Login Block -->
<div class="block push-bit">
<!-- Login Form -->
<div class="form-horizontal form-bordered form-control-borderless">
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><i class="gi gi-user"></i></span>
<input type="text" id="user_login" name="user_login" class="form-control input-lg" placeholder="Username">
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-key"></i></span>
<input type="password" id="user_pass" name="user_pass" class="form-control input-lg" placeholder="Password">
</div>
</div>
</div>
<div class="form-group form-actions">
<div class="col-md-12" style="min-height:40px;"><span id="stat"></span></div>

<div class="col-xs-4">

</div>
<div class="col-xs-8 text-right">
<button type="submit" class="btn btn-sm btn-primary" id="login"><i class="fa fa-angle-right"></i> Login to Dashboard</button>
</div>
</div>
<div class="form-group">
<div class="col-xs-12 text-center">
<!--<a href="javascript:void(0)" id="link-reminder-login"><small>Forgot password?</small></a> -
<a href="javascript:void(0)" id="link-register-login"><small>Create a new account</small></a>-->
</div>
</div>
</div>
<!-- END Login Form -->
            </div>
            <!-- END Login Block -->
       
       <!-- Footer -->
            <footer class="text-muted text-center">
                <small></span>CMS <span id="credits"><a class='credits_a' href="https://yusronwirawan.me" target="_blank">Y & A Catering - All Rights Reserved</a></span>
                <em>Version 3.0 Update 2022</em></small>
            </footer>
            <!-- END Footer -->
             </div>
        <!-- END Login Container -->

<script src="../sw-assets/js/jquery-1.11.1.min.js"></script>
<script src="../sw-assets/js/bootstrap.min.js"></script>
<script src="../sw-assets/js/plugins.js"></script>
<script src="../sw-assets/js/app.js"></script>
<script type="text/javascript" src="./jquery-login.js"></script>
<!-- Load and execute javascript code used only in this page -->
<script src="../sw-assets/js/login.js"></script>
<script>$(function(){ Login.init(); });</script>
    </body>
</html>
<?php }?>