<?php
	define('DB_USER', 'defUser');
	define('DB_PASSWORD', 'defaultpassword');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'webdev');

	//"@" suppresses errors
	$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)  
	OR dies('Could not connect to MySQL: ' .
		mysqli_connect_error());
?>