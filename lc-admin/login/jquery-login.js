
function loading(){
	$("#stat").html('<div class="alert alert-info"><img src="../sw-assets/img/spinner-mini.gif"> <i>Authenticating..</i></div>');
}
$(document).ready(function()
 {
	$("#login").click(function(){login();});
});

function login(){
	if($("#user_login").val()=="" || $("#user_pass").val()=="")
	{
		
		$("#stat").fadeTo('slow','1.99');
		$("#stat").fadeIn('slow',function(){$("#stat").html('<div class="alert alert-warning">Username/Password belum lengkap !</div>');})
		return false;
	}
	else
	{
		loading();
		var url_admin    = '../';
		var user_login = $("#user_login").val();
		var user_pass = $("#user_pass").val();
		$.getJSON("../login/login-proses.php",{username:user_login,password:user_pass},function(json)
		{
			if(json.response.error == "0")	// jika login gagal
			{
			
				$("#stat").fadeTo('slow','1.99');
				$("#stat").fadeIn('slow',function(){$("#stat").html('<div class="alert alert-danger">Periksa username & Password anda.!</div>');});
			}			
			else	// Login sukses
			{
				$("#stat").fadeOut('slow',function(){
				window.location.replace("../");
				//window.location = url_admin;
				});
			}
		});
		return false;
	}
};