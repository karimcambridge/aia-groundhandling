<?php

if(!isset($_SESSION['accountId'])) {
	header('location:http://127.00.1/groundopps/index.php');
	die();
}

require_once 'php_action/core.php';

session_unset();
session_destroy();

header('location:http://127.0.0.1/groundopps/index.php');
die();
?>