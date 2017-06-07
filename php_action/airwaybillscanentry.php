<?php

require_once '../core.php';

if($_POST) {
	$airbill = $_POST['cargoAirbill'];
	$previousCarrier = $_POST['carrierSelection'];
	$carrierId = -1;

	foreach($carriers as $carrier) {
		if(strcmp($carrier->getCarrierName(), $previousCarrier) == 0) {
			$carrierId = $carrier->getCarrierId();
		}
	}
	
	if($carrierId != -1) {
		$sql = "INSERT INTO `airwaybills` (`airwaybill`, `carrier_id`) VALUES ('$airbill', '$carrierId')";
		$result = $connectionHandle->query($sql);
		if($result->errno) {
			echo 'MySQL Airwaybill Error: ' . $result->error;
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