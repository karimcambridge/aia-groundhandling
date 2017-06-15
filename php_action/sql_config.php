<?php

$localhost = "localhost";
$username = "groundhandling";
$password = "";
$dbname = "AIAgroundhandling";

// db connection
$connectionHandle = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connectionHandle->connect_errno) {
	die("Connection Failed: " . $connectionHandle->connect_error);
}

?>