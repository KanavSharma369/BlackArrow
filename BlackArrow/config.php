<?php
/*
This file contains database configuration assumming you are running for user 'root' and password ''
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'black_arrow');

//Try to connect to database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);

if($conn == false){
	dir('ERROR: Can not connect to database!');
}

?>