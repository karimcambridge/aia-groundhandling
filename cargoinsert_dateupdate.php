<?php
include("core.php");

if($_POST['airwaybill'])
{
	$airwaybill = $_POST['airwaybill'];
	foreach($airwaybills as $value) {
		if($value->getName() == $airwaybill) {
			echo $value->getDateInTimestamp();
			break;
		}
	};
}
?>