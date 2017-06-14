<?php

session_start();

/*if(!isset($_SESSION['userId'])) {
	header('location:http://localhost/groundopps/index.php');
	die();
}*/

require_once 'php_action/sql_config.php';
require_once 'includes/AIAGroundOpsTemplate.interface.php';
require_once 'includes/airwaybill.class.php';
require_once 'includes/cargotype.class.php';
require_once 'includes/carrier.class.php';
require_once 'includes/consignee.class.php';

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
	$sql = "SELECT * FROM `consignees` ORDER BY `consignees`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$consignees[] = new Carrier($row['ID'], $row['name'], $row['carrier_id']);
		}
	}
}

function timeFormat($seconds)
{
    if(!is_numeric($seconds))
        throw new Exception("Invalid Parameter Type!");

    $ret = "";

    $hours = (string )floor($seconds / 3600);
    $secs = (string )$seconds % 60;
    $mins = (string )floor(($seconds - ($hours * 3600)) / 60);

    if(strlen($hours) == 1)
        $hours = "0" . $hours;
    if(strlen($secs) == 1)
        $secs = "0" . $secs;
    if(strlen($mins) == 1)
        $mins = "0" . $mins;

    if($hours == 0)
        $ret = "$mins:$secs";
    else
        $ret = "$hours:$mins:$secs";

    return $ret;
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

function getCargoRefrigeratedTimes($item_id)
{
	global $connectionHandle;
	$row = array();

	if(!is_numeric($item_id)) {
		return $row;
	}
	$query = "SELECT `refrigerated_time`, `refrigerated_unix` FROM `cargo_inventory` WHERE `ID` = " . $item_id . ";";
	if($result = $connectionHandle->query($query)) {
		if($result->num_rows) {
			$row = $result->fetch_assoc();
			return $row;
		}
	}
	return $row;
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

function getCarrierNameFromId($carrierId)
{
	global $carriers;

	foreach($carriers as $carrier) {
		if($carrier->getId() == $carrierId) {
			return $carrier->getName();
		}
	}
	return "";
}

function getCarrierIdFromName($carrier_name)
{
	global $carriers;

	foreach($carriers as $carrier) {
		if(strcmp($carrier->getName(), $carrier_name) == 0) {
			return $carrier->getId();
		}
	}
	return -1;
}

function calculateCheckoutFee($daysInCargo, $item_weight, $item_type, $refrigerated_time)
{
	$itemTypeRate = getItemTypeRate($item_type);
	if($refrigerated_time) {
		$itemTypeRate += 0.0378;
	}
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

function dateDiff($d1, $d2)
{
	return ceil(abs(strtotime($d1)-strtotime($d2))/86400); // Return the number of days between the two dates (ceil specific for cargo)
}

/*function dateDifference($date_1, $date_2, $differenceFormat = '%a') // Wouldn't this create a problem with more than 31 days?
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
}*/

function poundsToKG($pounds)
{
	$pounds *= 0.45359237;
	return $pounds;
}

?>