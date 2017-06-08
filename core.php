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

require_once 'php_action/db_connect.php';
require_once 'includes/AIAGroundOpsTemplate.interface.php';
require_once 'includes/airwaybill.class.php';
require_once 'includes/carrier.class.php';
require_once 'includes/cargotype.class.php';

if($connectionHandle->ping()) {
	$airwaybills = array();
	$carriers = array();
	$cargotypes = array();

	$sql = "SELECT `ID`, `airwaybill`, `carrier_id`, `date_in` FROM `airwaybills` ORDER BY `airwaybills`.`date_in` DESC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$airwaybills[] = new AirWayBill($row['ID'], $row['airwaybill'], $row['carrier_id'], $row['date_in']);
		}
	}
	$sql = "SELECT * FROM `carriers` ORDER BY `carriers`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$carriers[] = new Carrier($row['ID'], $row['name']);
		}
	}
	$sql = "SELECT `ID`, `cargo_type` FROM `cargo_item_types` ORDER BY `cargo_item_types`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$cargotypes[] = new CargoType($row['ID'], $row['cargo_type']);
		}
	}
}

?>