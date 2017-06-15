<?php

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "airport";

// db connection
$connectionHandle = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connectionHandle->connect_errno) {
	die("Connection Failed: " . $connectionHandle->connect_error);
}

?>