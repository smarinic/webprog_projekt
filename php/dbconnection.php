<?php
# DB login info
define('DB_HOST', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PWD', 'user123');
define('DB_NAME', 'filmoteka');
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
if ( mysqli_connect_errno() ) {
	// Izbaci gresku ako postoji
	exit('SQL greška: ' . mysqli_connect_error());
}
?>