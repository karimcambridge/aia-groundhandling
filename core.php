<?php

session_start();

if(strpos($_SERVER['REQUEST_URI'], "groundhandling/index.php") == false) {
	if(!isset($_SESSION['accountId'])) {
		header('location: index.php');
		exit();
	}
}

require_once 'config.php';
require_once 'dbconnect.php';
require_once 'includes/AIAGroundOpsTemplate.interface.php';
require_once 'includes/account.class.php';
require_once 'includes/airwaybill.class.php';
require_once 'includes/cargotype.class.php';
require_once 'includes/carrier.class.php';
require_once 'includes/consignee.class.php';

$eventlognames = [
	"User Authentication",
	"User Log Out",
	"CSV Report Download",
	"Flypassen 3",
	"Flypassen 4",
	"Flypassen 5",
	"Flypassen 6",
	"Flypassen 7",
	"Flypassen 8",
	"Flypassen 9",
	"Flypassen 10",
	"Flypassen 11",
	"Flypassen 12",
	"Flypassen 13"
];

if($connectionHandle->ping()) {
	$airwaybills = array();
	$carriers = array();
	$cargotypes = array();

	$sql = "SELECT `accountid`, `username` FROM `". TABLE_ACCOUNTS ."` ORDER BY `". TABLE_ACCOUNTS ."`.`accountid` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$accounts[] = new Account($row['accountid'], $row['username']);
		}
	}
	$sql = "SELECT `ID`, `airwaybill`, `carrier_id`, `consignee_id`, `date_in`, UNIX_TIMESTAMP(`date_in`) AS `date_in_timestamp` FROM `". TABLE_AIRWAYBILLS ."` ORDER BY `". TABLE_AIRWAYBILLS ."`.`date_in` DESC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$airwaybills[] = new AirWayBill($row['ID'], $row['airwaybill'], $row['carrier_id'], $row['consignee_id'], $row['date_in'], $row['date_in_timestamp']);
		}
	}
	$sql = "SELECT * FROM `". TABLE_CARRIERS ."` ORDER BY `". TABLE_CARRIERS ."`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$carriers[] = new Carrier($row['ID'], $row['name']);
		}
	}
	$sql = "SELECT `ID`, `cargo_type`, `price_KG` FROM `". TABLE_CARGO_ITEM_TYPES ."` ORDER BY `". TABLE_CARGO_ITEM_TYPES ."`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$cargotypes[] = new CargoType($row['ID'], $row['cargo_type'], $row['price_KG']);
		}
	}
	$sql = "SELECT * FROM `". TABLE_CONSIGNEES ."` ORDER BY `". TABLE_CONSIGNEES ."`.`ID` ASC";
	
	if($result = $connectionHandle->query($sql)) {
		while ( $row = $result->fetch_assoc() ) {
			$consignees[] = new Consignee($row['ID'], $row['name'], $row['carrier_id']);
		}
	}
}

function logEvent($accountid, $eventid, $data = "")
{
	global $connectionHandle;
	if(empty($data)) {
		$result = $connectionHandle->query("INSERT INTO `". TABLE_EVENT_LOGS ."` (`accountid`, `event_id`) VALUES ($accountid, $eventid);");
	} else {
		$data = $connectionHandle->real_escape_string($data);
		$result = $connectionHandle->query("INSERT INTO `". TABLE_EVENT_LOGS ."` (`accountid`, `event_id`, `data`) VALUES ($accountid, $eventid, '". $data ."');");
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

function getAccountNameFromId($accountid)
{
	global $accounts;

	foreach($accounts as $account) {
		if($account->getId() == $accountid) {
			return $account->getName();
		}
	}
	return "";
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

function getConsigneeNameFromId($consigneeId)
{
	global $consignees;

	foreach($consignees as $consignee) {
		if($consignee->getId() == $consigneeId) {
			return $consignee->getName();
		}
	}
	return "None";
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
	if($refrigerated_time) {
		$checkoutFee += ($checkoutFee * 1.15);
	}
	//$checkoutFee += ($checkoutFee * 1.16); no vat!
	return $checkoutFee;
}

function number_of_cargo_days($from, $to)
{
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
    $holidayDays = ['*-12-25', '*-12-26', '*-01-01', '*-03-14', '*-08-01', '*-10-27']; # variable and fixed holidays

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach($periods as $period) {
        if(!in_array($period->format('N'), $workingDays)) continue;
        if(in_array($period->format('Y-m-d'), $holidayDays)) continue;
        if(in_array($period->format('*-m-d'), $holidayDays)) continue;
        $days++;
    }
    return $days;
}

function poundsToKG($pounds)
{
	$pounds *= 0.45359237;
	return $pounds;
}

?>