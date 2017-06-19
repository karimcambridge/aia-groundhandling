<?php
require_once 'core.php';

if($_POST['airwaybill'])
{
	$valueToEcho = "";
	$airwaybill = $_POST['airwaybill'];
	foreach($airwaybills as $value) {
		if($value->getName() == $airwaybill) {
			$valueToEcho .= $value->getDateInTimestamp();
		}
	};
	$valueToEcho .= ',';
	foreach($airwaybills as $value) {
		if($value->getName() == $airwaybill) {
			$valueToEcho .= getConsigneeNameFromId($value->getConsigneeId());
		}
	};
	echo $valueToEcho;
}
?>