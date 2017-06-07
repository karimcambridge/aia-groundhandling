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
?>