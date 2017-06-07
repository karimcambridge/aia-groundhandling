<?php

session_start();

/*if(!isset($_SESSION['userId'])) {
	header('location:http://localhost/groundopps/index.php');
	die();
}*/

function instantRedirect() {
	if(isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
	die();
}

function timeRedirect($value) {
	sleep($value);
	if(isset($_SERVER["HTTP_REFERER"])) {
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
	die();
}

require_once 'db_connect.php';
require_once 'includes/carrier.php';

if($connectionHandle->ping()) {
	$carriers = array();
	$sql = "SELECT * FROM `carriers`";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$carriers[] = new Carrier($row["ID"], $row["name"]);
		}
	}
}

?>