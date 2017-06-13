<?php

session_start();

/*if(!isset($_SESSION['userId'])) {
	header('location:http://localhost/groundopps/index.php');
	die();
}*/

require_once 'php_action/sql_config.php';
require_once 'includes/AIAGroundOpsTemplate.interface.php';
require_once 'includes/airwaybill.class.php';
require_once 'includes/carrier.class.php';
require_once 'includes/cargotype.class.php';

if($connectionHandle->ping()) {
	$airwaybills = array();
	$carriers = array();
	$cargotypes = array();

	$sql = "SELECT `ID`, `airwaybill`, `carrier_id`, `date_in`, UNIX_TIMESTAMP(`date_in`) AS `date_in_timestamp` FROM `airwaybills` ORDER BY `airwaybills`.`date_in` DESC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$airwaybills[] = new AirWayBill($row['ID'], $row['airwaybill'], $row['carrier_id'], $row['date_in'], $row['date_in_timestamp']);
		}
	}
	$sql = "SELECT * FROM `carriers` ORDER BY `carriers`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$carriers[] = new Carrier($row['ID'], $row['name']);
		}
	}
	$sql = "SELECT `ID`, `cargo_type`, `price_KG` FROM `cargo_item_types` ORDER BY `cargo_item_types`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$cargotypes[] = new CargoType($row['ID'], $row['cargo_type'], $row['price_KG']);
		}
	}
}

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

function keepLinks(...$parameters)
{
	$previousParams = "";
	if(!empty($_GET)) {
    	// Loop through the parameters
    	foreach ($_GET as $parameter => $value) {
    		// Append the parameter and its value to the new path
    		if(in_array($parameter, $parameters)) {
    		  $previousParams .= "&" . $parameter . "=" . urlencode($value);
    		}
    	}
	}
	return $previousParams;
}

function getAirWayBill($airwaybillname)
{
	global $airwaybills;

	foreach($airwaybills as $airwaybill) {
		if(strcmp($airwaybill->getName(), $airwaybillname) == 0) {
			return $airwaybill;
		}
	}
	return NULL;
}

function getItemTypeId($item_type)
{
	global $cargotypes;
	$itemTypeId = -1; // Cargo Type ID

	foreach($cargotypes as $cargotype) {
		if(strcmp($cargotype->getName(), $item_type) == 0) {
			$itemTypeId = $cargotype->getId();
		}
	}
	return $itemTypeId;
}

function getItemTypeRate($item_type)
{
	global $cargotypes;
	$itemTypeRate = 0.0;

	foreach($cargotypes as $cargotype) {
		if(strcmp($cargotype->getName(), $item_type) == 0) {
			$itemTypeRate = $cargotype->getPricePerKg();
		}
	}
	return $itemTypeRate;
}

function calculateCheckoutFee($daysInCargo, $item_weight, $item_type)
{
	$itemTypeRate = getItemTypeRate($item_type);
	$checkoutFee = 0.0;
	if($daysInCargo == 6) {
		$checkoutFee = 5.0;
	}
	else if($daysInCargo >= 7) {
		$checkoutFee = 5.0;
		for($i = 0, $upperBound = round($item_weight); $i < $upperBound; $i++) {
			$checkoutFee += $itemTypeRate;
		}
	}
	return $checkoutFee;
}

function dateDifference($date_1, $date_2, $differenceFormat = '%a')
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}

function poundsToKG($pounds)
{
	$pounds *= 0.45359237;
	return $pounds;
}

?>