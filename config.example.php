<?php
	// Rename this file to config.php and enter in your MySQL database credentials

	// MySQL database credentials
	$host = '127.0.0.1';
	$database_name = 'response_map';
	$database_user = 'rmap_user';
	$database_pass = '';
	$adminpassword = '';

	// Establish a connection to the database
	$conn = mysqli_connect($host, $database_user, $database_pass, $database_name);

	// Google Maps API key
	$google_key = '';
?>