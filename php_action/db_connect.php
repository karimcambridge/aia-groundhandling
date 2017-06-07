<?php

$localhost = "127.0.0.1";
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