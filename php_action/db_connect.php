<?php

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cargo";

// db connection
$connectionHandle = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connectionHandle->connect_error) {
  die("Connection Failed : " . $connectionHandle->connect_error);
}

?>
