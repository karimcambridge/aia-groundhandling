<?php

require_once '../core.php';

if($_POST) {
	$airbill = $_POST['cargoAirbill'];
	$previousCarrier = $_POST['carrierSelection'];
	$carrierId = -1;

	foreach($carriers as $carrier) {
		if(strcmp($carrier->getName(), $previousCarrier) == 0) {
			$carrierId = $carrier->getId();
		}
	}
	
	if($carrierId != -1) {
		$airbill = $connectionHandle->real_escape_string($airbill);
		$sql = "INSERT IGNORE INTO `airwaybills` (`airwaybill`, `carrier_id`) VALUES ('$airbill', '$carrierId')";
		$result = $connectionHandle->query($sql);

		if($connectionHandle->errno) {
			echo 'MySQL Airwaybill Error: ' . $connectionHandle->error;
			timeRedirect(10);
		} else {
			$_SESSION['carrierSelection'] = $previousCarrier;
			instantRedirect();
		}
	} else {
		echo 'There was an error finding the selected carrier ID. Please tell the I.T guys!';
		timeRedirect(10);
	}
} else {
	echo 'POST FAILED!';
	timeRedirect(10);
}

?>