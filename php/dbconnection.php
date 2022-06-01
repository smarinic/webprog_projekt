<?php
if ( mysqli_connect_errno() ) {
	// Throw error if SQL connection already exists
	exit('SQL greška: ' . mysqli_connect_error());
}

/**
 * Creates database connection from defined constants.
 * 
 * @return mysqli|null|false Returns connection object or false if there was an error.
 */ 
function createConnection() {
	// DB login info
	if(!defined('DB_HOST')) {
		define('DB_HOST', 'localhost');
	}
	if(!defined('DB_USER')) {
		define('DB_USER', 'dbuser');
	}
	if(!defined('DB_PWD')) {
		define('DB_PWD', 'user123');
	}
	if(!defined('DB_NAME')) {
		define('DB_NAME', 'filmoteka');
	}
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
	return $conn;
}
?>