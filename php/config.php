<?php
	$status = session_status();
	if($status !== 2) {
		session_start();
	}

	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}
	/* Database credentials. Assuming you are running MySQL
	server with default setting (user 'root' with no password) */
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'loja_repo');
	/* Attempt to connect to MySQL server */
	$link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
			if($link === false){
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}
	//Attempt to connect to MySQL Database
	$db_selected = $link->select_db(DB_NAME);
	if (!$db_selected) {
		// If we couldn't, then it either doesn't exist, or we can't see it.
		$sql = "CREATE DATABASE IF NOT EXISTS ".constant("DB_NAME");
		
		if ($link -> query($sql)) {
				console_log("Database ".DB_NAME." created successfully\n");
		} else {
				console_log('Error creating database');
		}
	}
?>