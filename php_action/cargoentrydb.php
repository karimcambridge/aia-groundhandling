<?php

require_once 'core.php';

if($_POST) {
	$airbill = $_POST['cargoAirbill'];
	$carrier = $_POST['cargoEntryCarrier'];

	$sql = "SELECT `ID` FROM `carriers` WHERE `name` = '$carrier' LIMIT 0,1";
	
	if($result = $connectionHandle->query($sql)) {
		if($result->num_rows == 1) {
			$carrierIDObj = $result->fetch_object();
			$carrierId = $carrierIDObj->ID;

			$sql = "INSERT INTO `airwaybills` (`airwaybill`, `carrier_id`) VALUES ('$airbill', '$carrierId')";
			$result = $connectionHandle->query($sql);

			if($result->errno) {
				echo 'MySQL Error: ' . $result->error;
				timeRedirect(10);
			} else {
				$_SESSION['cargoEntryCarrier'] = $carrier;
				instantRedirect();
			}
		} else {
			echo 'Carrier ' . $carrier . ' Not found! Please tell the I.T guys!';
			timeRedirect(10);
		}
	} else {
		if($result->errno) {
			echo 'MySQL Error: ' . $result->error;
			timeRedirect(10);
		} else {
			instantRedirect();
		}
	}
} else {
	echo 'POST FAILED!';
	timeRedirect(10);
}

?>