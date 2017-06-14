<?php

if(!isset($_SESSION['accountId'])) {
	header('location:index.php');
	die();
}

require_once 'php_action/core.php';

session_unset();
session_destroy();

header('location:index.php');
die();
?>