<?php
	/* Rename this file to config.php and enter in your MySQL database credentials */

	$host = '127.0.0.1';
	$database_name = 'response_map';
	$database_user = 'rmap_user';
	$database_password = '';

	$conn = mysqli_connect($host, $database_user, $database_password, $database_name);
?>