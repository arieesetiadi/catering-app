<?php

	// DATABASE
	$host 		= "localhost"; 		// Host name
	$username 	= "root"; 			// Mysql username
	$password 	= ""; 				// Mysql password
	$db_name 	= "sigerdev"; 		// Mysql password


	$connection = mysqli_connect($host, $username, $password, $db_name);

	error_reporting(E_ALL ^ E_NOTICE);

?>
